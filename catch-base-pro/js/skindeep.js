jQuery(document).ready(function($) {

  var postgrid = (function( $container ) {
    var $container = jQuery($container);
    $container.imagesLoaded( function(){ 
      $container.masonry({ 
        itemSelector: '.grid-item', 
        columnWidth: '.grid-item',
        hiddenStyle: { opacity: 0 }
      }); 
    });
    infinite_count = 0;
    // Triggers re-layout on infinite scroll
    $( document.body ).on( 'post-load', function () {
      infinite_count = infinite_count + 1;
      var $selector = $('#infinite-view-' + infinite_count);
      var $elements = $selector.find('.post');
      $container.append( $elements )
      .masonry( 'appended', $elements );
      // $elements.hide();
      $container.imagesLoaded( function() {
        $container.masonry('layout');
        // $elements.fadeIn();
      });
    });
  })

  postgrid('.featured-grid');

});

// jQuery(document).on('post-load', function() {
//   var $newElems = $( newElements ).css({ opacity: 0 });
//   $newElems.imagesLoaded(function(){
//     $newElems.animate({ opacity: 1 });
//     $('.featured-grid').masonry( 'appended', $newElems, true );
//   });
// });

jQuery(document).ready(function($) {
  // Make masthead sticky
  var sticky = new Waypoint.Sticky({
    element: $('header#masthead')[0],
    wrapper: '<div class="sticky-wrapper waypoint" />'
  });
});

jQuery(document).ready(function($) {
  var radicalGrid = (function() {
      // list of items
    var $radgrid = jQuery( '.category-radical-interruptions .grid' ),
      // the items
      $items = $radgrid.children( 'article.hentry' ),
      // current expanded item's index
      current = -1,
      // position (top) of the expanded item
      // used to know if the preview will expand in a different row
      previewPos = -1,
      // extra amount of pixels to scroll the window
      scrollExtra = 0,
      // extra margin when expanded (between preview overlay and the next items)
      marginExpanded = 10,
      $window = jQuery( window ), winsize,
      $body = jQuery( 'html, body' ),
      // transitionend events
      transEndEventNames = {
        'WebkitTransition' : 'webkitTransitionEnd',
        'MozTransition' : 'transitionend',
        'OTransition' : 'oTransitionEnd',
        'msTransition' : 'MSTransitionEnd',
        'transition' : 'transitionend'
      },
      transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ],
      // support for csstransitions
      support = Modernizr.csstransitions,
      // default settings
      settings = {
        minHeight : 500,
        speed : 350,
        easing : 'ease'
      };

    function init( config ) {

      // the settings..
      settings = jQuery.extend( true, {}, settings, config );

      // preload all images
      $radgrid.imagesLoaded( function() {

        // save itemÂ´s size and offset
        saveItemInfo( true );
        // get windowÂ´s size
        getWinSize();
        // initialize some events
        initEvents();

      } );

    }

    // add more items to the grid.
    // the new items need to appended to the grid.
    // after that call radicalGrid.addItems(theItems);
    function addItems( $newitems ) {

      $items = $items.add( $newitems );

      $newitems.each( function() {
        var $item = jQuery( this );
        $item.data( {
          offsetTop : $item.offset().top,
          height : $item.height()
        } );
      } );

      initItemsEvents( $newitems );

    }

    // saves the itemÂ´s offset top and height (if saveheight is true)
    function saveItemInfo( saveheight ) {
      $items.each( function() {
        var $item = jQuery( this );
        $item.data( 'offsetTop', $item.offset().top );
        if( saveheight ) {
          $item.data( 'height', $item.height() );
        }
      } );
    }

    function initEvents() {

      // when clicking an item, show the preview with the itemÂ´s info and large image.
      // close the item if already expanded.
      // also close if clicking on the itemÂ´s cross
      initItemsEvents( $items );

      // on window resize get the windowÂ´s size again
      // reset some values..
      $window.on( 'debouncedresize', function() {

        scrollExtra = 0;
        previewPos = -1;
        // save itemÂ´s offset
        saveItemInfo();
        getWinSize();
        var preview = jQuery.data( this, 'preview' );
        if( typeof preview !== 'undefined' ) {
          hidePreview();
        }

      } );

    }

    function initItemsEvents( $items ) {
      $items.on( 'click', 'span.artist__close', function() {
        hidePreview();
        return false;
      } ).children( 'a' ).on( 'click', function(e) {

        var $item = jQuery( this ).parent();
        // check if item already opened
        if (current === $item.index() ) {
          hidePreview();
        } else {
          showPreview( $item );
        }
        return false;
      } );
    }

    function getWinSize() {
      winsize = { width : $window.width(), height : $window.height() };
    }

    function showPreview( $item ) {

      var preview = jQuery.data( this, 'preview' ),
        // itemÂ´s offset top
        position = $item.data( 'offsetTop' );

      scrollExtra = 0;

      // if a preview exists and previewPos is different (different row) from itemÂ´s top then close it
      if( typeof preview !== 'undefined' ) {

        // not in the same row
        if( previewPos !== position ) {
          // if position > previewPos then we need to take te current previewÂ´s height in consideration when scrolling the window
          if( position > previewPos ) {
            scrollExtra = preview.height;
          }
          hidePreview();
        }
        // same row
        else {
          preview.update( $item );
          return false;
        }

      }

      // update previewPos
      previewPos = position;
      // initialize new preview for the clicked item
      preview = jQuery.data( this, 'preview', new Preview( $item ) );
      // expand preview overlay
      preview.open();

    }

    function hidePreview() {
      current = -1;
      var preview = jQuery.data( this, 'preview' );
      preview.close();
      jQuery.removeData( this, 'preview' );
    }

    // the preview obj / overlay
    function Preview( $item ) {
      this.$item = $item;
      this.expandedIdx = this.$item.index();
      this.create();
      this.update();
    }

    Preview.prototype = {
      create : function() {
        // create Preview structure:
        this.$title = jQuery( '<h3></h3>' );
        this.$description = jQuery( '<div class="artist__bio"></div>' );
        this.$href = jQuery( '<a target="_blank" class="website_link artist__link" href="#">Find Out More</a>' );
        this.$track = jQuery( '<a target="_blank" class="soundcloud_link artist__link" href="#">Play</a>' );
        this.$youtube = jQuery( '<a target="_blank" class="youtube_link artist__link" href="#">Video</a>' );
        this.$details = jQuery( '<div class="artist__details"></div>' ).append( this.$title, this.$description );
        this.$links = jQuery( '<div class="artist__links"></div>' ).append( this.$track, this.$youtube, this.$href );
        this.$loading = jQuery( '<div class="artist__loading"></div>' );
        this.$fullimage = jQuery( '<div class="artist__fullimg"></div>' ).append( this.$loading );
        this.$closePreview = jQuery( '<span class="artist__close"></span>' );
        this.$previewInner = jQuery( '<div class="artist__expander-inner"></div>' ).append( this.$closePreview, this.$fullimage, this.$details, this.$links );
        this.$previewEl = jQuery( '<div class="artist__expander"></div>' ).append( this.$previewInner );
        // append preview element to the item
        this.$item.append( this.getEl() );
        // set the transitions for the preview and the item
        if( support ) {
          this.setTransition();
        }
      },
      update : function( $item ) {

        if( $item ) {
          this.$item = $item;
        }

        // if already expanded remove class "artist__expanded" from current item and add it to new item
        if( current !== -1 ) {
          var $currentItem = $items.eq( current );
          $currentItem.removeClass( 'artist__expanded' );
          this.$item.addClass( 'artist__expanded' );
          // position the preview correctly
          this.positionPreview();
        }

        // update current value
        current = this.$item.index();

        // update previewÂ´s content
        var $itemEl = this.$item.children( 'a' ),
          eldata = {
            href : $itemEl.data( 'link' ),
            track : $itemEl.data( 'track' ),
            youtube : $itemEl.data( 'youtube' ),
            largesrc : $itemEl.data( 'largesrc' ),
            title : $itemEl.data( 'title' ),
            description : $itemEl.data( 'description' )
          };

        this.$title.html( eldata.title );
        this.$description.html( '<p>'+eldata.description+'</p>' );
        this.$href.attr( 'href', eldata.href );
        this.$track.attr( 'href', eldata.track );
        this.$youtube.attr( 'href', eldata.youtube );

        this.$href.removeClass('active');
        this.$track.removeClass('active');
        this.$youtube.removeClass('active');

        if( eldata.href ) {
          this.$href.addClass('active');
        }

        if( eldata.track ) {
          this.$track.addClass('active');
        }

        if( eldata.youtube ) {
          this.$youtube.addClass('active');
        }

        var self = this;

        // remove the current image in the preview
        if( typeof self.$largeImg !== 'undefined' ) {
          self.$largeImg.remove();
        }

        // preload large image and add it to the preview
        // for smaller screens we donÂ´t display the large image (the media query will hide the fullimage wrapper)
        if( self.$fullimage.is( ':visible' ) ) {
          this.$loading.show();
          jQuery( '<img/>' ).load( function() {
            var $img = jQuery( this );
            if( $img.attr( 'src' ) === self.$item.children('a').data( 'largesrc' ) ) {
              self.$loading.hide();
              self.$fullimage.find( 'img' ).remove();
              self.$largeImg = $img.delay( 350 ).fadeIn( 350 );
              self.$fullimage.append( self.$largeImg );
            }
          } ).attr( 'src', eldata.largesrc );
        }
      },
      open : function() {

        setTimeout( jQuery.proxy( function() {
          // set the height for the preview and the item
          this.setHeights();
          // scroll to position the preview in the right place
          this.positionPreview();
        }, this ), 25 );

      },
      close : function() {

        var self = this,
          onEndFn = function() {
            if( support ) {
              jQuery( this ).off( transEndEventName );
            }
            self.$item.removeClass( 'artist__expanded' );
            self.$previewEl.remove();
          };

        setTimeout( jQuery.proxy( function() {

          if( typeof this.$largeImg !== 'undefined' ) {
            this.$largeImg.fadeOut( 'fast' );
          }
          this.$previewEl.css( 'height', 0 );
          // the current expanded item (might be different from this.$item)
          var $expandedItem = $items.eq( this.expandedIdx );
          $expandedItem.css( 'height', $expandedItem.data( 'height' ) ).on( transEndEventName, onEndFn );

          if( !support ) {
            onEndFn.call();
          }

        }, this ), 25 );

        return false;

      },
      calcHeight : function() {

        var heightPreview = winsize.height - this.$item.data( 'height' ) - marginExpanded,
          itemHeight = winsize.height;

        if( heightPreview < settings.minHeight ) {
          heightPreview = settings.minHeight;
          itemHeight = settings.minHeight + this.$item.data( 'height' ) + marginExpanded;
        }

        this.height = heightPreview;
        this.itemHeight = itemHeight;

      },
      setHeights : function() {

        var self = this,
          onEndFn = function() {
            if( support ) {
              self.$item.off( transEndEventName );
            }
            self.$item.addClass( 'artist__expanded' );
          };

        this.calcHeight();
        this.$previewEl.css( 'height', this.height );
        this.$item.css( 'height', this.itemHeight ).on( transEndEventName, onEndFn );

        if( !support ) {
          onEndFn.call();
        }

      },
      positionPreview : function() {

        // scroll page
        // case 1 : preview height + item height fits in windowÂ´s height
        // case 2 : preview height + item height does not fit in windowÂ´s height and preview height is smaller than windowÂ´s height
        // case 3 : preview height + item height does not fit in windowÂ´s height and preview height is bigger than windowÂ´s height
        var position = this.$item.data( 'offsetTop' ),
          previewOffsetT = this.$previewEl.offset().top - scrollExtra,
          scrollVal = this.height + this.$item.data( 'height' ) + marginExpanded <= winsize.height ? position : this.height < winsize.height ? previewOffsetT - ( winsize.height - this.height ) : previewOffsetT;

        $body.animate( { scrollTop : scrollVal }, settings.speed );

      },
      setTransition  : function() {
        this.$previewEl.css( 'transition', 'height ' + settings.speed + 'ms ' + settings.easing );
        this.$item.css( 'transition', 'height ' + settings.speed + 'ms ' + settings.easing );
      },
      getEl : function() {
        return this.$previewEl;
      }
    };

    return {
      init : init,
      addItems : addItems
    };

  })();

  // Init Lineup radicalGrid
  radicalGrid.init();
});