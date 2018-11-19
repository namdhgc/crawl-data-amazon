;(function($, window, document, undefined){
	"use strict";

	$(document).ready(function(){
    var headerBlockEle = $('.js-header-block');

    if(!headerBlockEle.length){
      return;
    }

    var heightHeaderBlockVal = headerBlockEle.outerHeight(true);
		var windowEle            = $(window);
    var bodyEle              = $("body");
    var menuMainCateEle      = $('.js-main-cate-menu > .menu-main');

		/* ========================================================================
			Scroll fixed header block
		=========================================================================== */
    (function(){
      var allowScroll             = true;
			var isHomePage              = false;
			var heightHeaderScrollVal   = 60;
			var allCategoryTableEle     = $(".js-all-category-table");
			var productTabTitleBlockEle = $(".js-product-tab-title-block");

      // ---------------- Check allow scroll ----------------
      if(!menuMainCateEle.length ||
        allCategoryTableEle.length ||
				productTabTitleBlockEle.length
			) {
          allowScroll = false;
      }else {
				headerBlockEle.css("position","absolute");
        bodyEle.css("padding-top",heightHeaderBlockVal + "px");
      }

			// ---------------- Check Home page ----------------
			var homeFeatureBlockEle = $('.home-feature-block');
			if(homeFeatureBlockEle.length) {
				isHomePage = true;
			}

      if(allowScroll === true) {
        var currentOffsetTop  = 0;
				var offsetStartScroll = 0; // Offset top when header start fixed

				if(isHomePage) {
					var heightHomeFeatureBlockEleVal = homeFeatureBlockEle.outerHeight(false);
					offsetStartScroll                = homeFeatureBlockEle.offset().top + heightHomeFeatureBlockEleVal - heightHeaderScrollVal - 1;
					var menuMainMenuCateEle          = headerBlockEle.find('.main-cate-menu .menu-main');

					windowEle.scroll(function(){
						currentOffsetTop = windowEle.scrollTop();

						if(currentOffsetTop > offsetStartScroll) {
							headerBlockEle.addClass('is-fixed');
							menuMainMenuCateEle.removeClass("is-show");
						}else {
							headerBlockEle.removeClass('is-fixed');
							menuMainMenuCateEle.addClass("is-show");
						}
					});//end scroll
				}else {
					windowEle.scroll(function(){
	          currentOffsetTop  = windowEle.scrollTop();
						offsetStartScroll = heightHeaderBlockVal - heightHeaderScrollVal;

	          if(currentOffsetTop > offsetStartScroll) { //60 == height of .header-block .row-2
	            headerBlockEle.addClass('is-fixed');
	          }else {
	            headerBlockEle.removeClass('is-fixed');
	          }
	        });//end scroll
				}//end if
      }//end if
    })();

		/* ========================================================================
			Auto complete search
		=========================================================================== */
		(function(){
			var mainSearchFormEle = headerBlockEle.find(".js-main-search-form");
			if(!mainSearchFormEle.length) {
	      return ;
	    }

			var keywordInputEle = mainSearchFormEle.find(".keyword-txt");
			var searchBtnEle    = mainSearchFormEle.find(".search-btn");
			var xhr             = null;
			var matches         = [];
			var i               = null;

			keywordInputEle.autoComplete({
        minChars: 3,
				delay: 800,
        source: function(keywordVal, suggest){
          keywordVal = keywordVal.toLowerCase();
					try { xhr.abort(); } catch(e){}
					xhr = $.ajax({
						url   : "ajax-autocomplete.html",
						cache : false,
						method: "GET",
						data  : {
							q   : keywordVal,
						},
						dataType: 'json',

						beforeSend: function() {
							searchBtnEle.addClass("loading");
						},

						error: function(error) {
							searchBtnEle.removeClass("loading");
						},

						success: function(result) {
							matches = [];
			        for (i=0; i<result.length; i++)
			            if (~result[i].toLowerCase().indexOf(keywordVal)) matches.push(result[i]);
			        suggest(matches);
							searchBtnEle.removeClass("loading");
						},// end success
					});//end $.ajax
        }//end source
      });//end autoComplete
		})();
	});//end document ready
})(jQuery, window, document);
