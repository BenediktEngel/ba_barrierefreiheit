(function($){
    let container, menu, links, i, len, lastFocused;

    const button = $(".menu-toggle"),
          navigation = $(".main-navigation"),
          navContainer = $(".main-navigation > div > ul, .main-navigation > div#primary-menu"),
          primaryNavLink = $(".main-navigation > div > ul a"),
          searchToggle = $(".search-toggle"),
          searchForm = $(".search-form"),
          navSearchForm = $( '.nav-search-container' ),
          lisWithSubmenus = $('.menu-item-has-children'),
          searchInput = $('.banner-header .site-header .search-form input'),
          searchFormControls = $(
            ".banner-header .site-header .search-form .search-term," +
            ".banner-header .site-header .search-form button"
          ),
          searchClose = $(".searchbar-close"),
          xlScreen = document.getElementsByTagName('body')[0].clientWidth > 1024;

  // Hide menu toggle button if menu is empty and return early.
  if ( ! navContainer ){
    button.attr("style","display: none;");
    return;
  }

  //Hides the search form in banner-header template
  const cpCloseSearch = function(){
    searchForm.removeClass("toggled").attr('aria-expanded',false);
  }

  const cpOpenSearch = function(){
    searchForm.addClass("toggled").attr('aria-expanded',true);
  }

  //expands primary menu
  const expandMenu = function(){
    button.attr("aria-pressed",true);
    
    navContainer.slideUp(0, function(){
      navContainer.removeClass('accessible-hide')
      navContainer.slideDown(200).attr('aria-expanded',true);
    });
  }

  //hides primary menu
  const hideMenu = function(){
    button.attr("aria-pressed",false);
    navContainer.slideUp(200,function(){
      navContainer.addClass('accessible-hide').slideDown(0).attr('aria-expanded',false);
    });
  }

  //hides or expands primary menu based on current state
  const toggleMenu = function(){
    if (! navContainer.hasClass("accessible-hide") ){
      hideMenu();
    } else {
      expandMenu();
    }
  }

  const getClientWidth = function(){
    return document.getElementsByTagName('body')[0].clientWidth 
  }

/* Manage Header Focus Order */

//function that can cut and paste header search form to achieve correct focus order. 
  const placeSearchForm = function( location ){
      let insert = navSearchForm.clone();
      navSearchForm.remove();
      if ( 'before' === location ){
        navigation.before(insert);
      } else {
        navigation.after(insert);
      }
  }

  const setNavFocusOrder = function(){
    if ( template.bannerHeader ){
      return;
    }

    if ( getClientWidth() < 1024 && navigation.next().hasClass('nav-search-container') ){
      placeSearchForm( 'before' );
    } 

    if ( getClientWidth() >= 1024 && navigation.prev().hasClass('nav-search-container') ){
      placeSearchForm( 'after' );
    }
  }

  //handle clicks on the menu-toggle button
  button.click(function(){
    toggleMenu();
  });

  //ensure responsive menu focuses in a logical way
  setNavFocusOrder();
  
  /*
  End Manage Header Focus Order
  */

  /*
  Responsive Main Navigation Focus*/

    /*
  Get last link in main nav
  */
  const findLastLink = function(){
    let lastLink = navContainer.children().last();
    
    while( lastLink.hasClass( 'menu-item-has-children' ) ){
      lastLink = lastLink.children('ul').children().last();
    }

    return lastLink.children('a');
  }

  const lastNavLink = findLastLink();

  const focusFirstContentControl = function(){
    $('.site-content').find('a, button, input').first().focus();
  }

  const focusMenuToggle = function(){
    button.focus();
  }

  lastNavLink.blur(function(){
    focusMenuToggle();
  })


//skip menu in focus order unless toggle is activated
  $(document).on('focus','.main-navigation a',null,function(e){
    const isHidden = navContainer.hasClass("accessible-hide");
    if ( isHidden ){
      if ( lastFocused.attr('class') && lastFocused.attr('class').indexOf('menu-toggle') > -1 ){
        focusFirstContentControl();
      } else {
        focusMenuToggle();
      }
    }
  });

  $(document).on( 'focus', 'a, input, button', null, function(e){
    const parents = template.bannerHeader ? $(this).parents('.site-header .search-form') : $(this).parents('.main-navigation');
    if ( !parents.length ){
      lastFocused = $(this);
    }
  } )

  //handle clicks on the search toggle and search close buttons in banner-header.php
  searchToggle.click(function(){
    if ( searchForm.hasClass('toggled') ){
      cpCloseSearch();
    } else{
      cpOpenSearch()
      searchForm.find( 'input' ).focus();
    }
  });

  //bring off-screen search form on screen when input is focused in banner-header.php
  searchFormControls.focus(function(){
    if (!searchForm.hasClass("toggled")){
      cpOpenSearch();
    }
  });

  //hide search form when its last focusable element blurs
  searchFormControls.blur(function(){
    cpCloseSearch();
  })

  searchClose.click(function(){
    cpCloseSearch();
  });

  //add aria role to submenu parents
  lisWithSubmenus.attr( 'aria-haspopup', true );  

  // Get all the link elements within the menu.
  links = $(".main-navigation ul a");

  // Each time a menu link is focused or blurred, toggle focus.

  function toggleFocus( ele ) {
    while ( ! ele.hasClass("nav-menu") ){
      if ( ele.is( "li" ) ){
        if ( ele.hasClass( "focus" ) ){
          ele.removeClass(" focus" );
        } else {
          ele.addClass( "focus" );
        }
      }
      ele = ele.parent();
    }
  }

  links.focus(function(){
    toggleFocus($(this));
  });

  links.blur(function(){
    toggleFocus($(this));
  });

  /**
  * Toggles `focus` class to allow submenu access on tablets.
  */

  container = document.getElementsByClassName("main-navigation")[0];

  ( function( container ) {
    let touchStartFn;
    let parentLink = container.querySelectorAll(
      ".menu-item-has-children > a, .page_item_has_children > a"
    );

    if ( "ontouchstart" in window ) {
      touchStartFn = function( e ) {
        let menuItem = this.parentNode;

        if ( ! menuItem.classList.contains( "focus" ) ) {
          e.preventDefault();
          for ( i = 0; i < menuItem.parentNode.children.length; i+=1 ) {
            if ( menuItem === menuItem.parentNode.children[i] ) {
              continue;
            }
            menuItem.parentNode.children[i].classList.remove( "focus" );
          }
          menuItem.classList.add( "focus" );
        } else {
          menuItem.classList.remove( "focus" );
        }
      };

      for ( i = 0; i < parentLink.length; i+=1 ) {
        parentLink[i].addEventListener( "touchstart", touchStartFn, false );
      }
    }
  }( container ) );

})(jQuery);