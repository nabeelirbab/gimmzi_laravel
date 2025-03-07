jQuery(document).ready(function($){
// document start


 // Navbar
 $( "<span class='clickD'></span>" ).insertAfter(".navbar-nav li.menu-item-has-children > a");
 $('.navbar-nav li .clickD').click(function(e) {
     e.preventDefault();
     var $this = $(this);
     if ($this.next().hasClass('show'))
        {
            $this.next().removeClass('show');
            $this.removeClass('toggled');
        } 
        else 
        {
            $this.parent().parent().find('.sub-menu').removeClass('show');
            $this.parent().parent().find('.toggled').removeClass('toggled');
            $this.next().toggleClass('show');
            $this.toggleClass('toggled');
        }
 });

 $(window).on('resize', function(){
     if ($(this).width() < 1025) {
         $('html').click(function(){
             $('.navbar-nav li .clickD').removeClass('toggled');
             $('.toggled').removeClass('toggled');
             $('.sub-menu').removeClass('show');
         });
         $(document).click(function(){
             $('.navbar-nav li .clickD').removeClass('toggled');
             $('.toggled').removeClass('toggled');
             $('.sub-menu').removeClass('show');
         });
         $('.navbar-nav').click(function(e){
            e.stopPropagation();
         });
     }
 });
 // Navbar end


 
/* ===== For menu animation === */
$(".navbar-toggler").click(function(){
    $(".navbar-toggler").toggleClass("open");
    $(".navbar-toggler .stick").toggleClass("open");
    $('body,html' ).toggleClass("open-nav");
});

// Navbar end


// custom file upload btn open
jQuery("input[type=file].file_upload_btn").on("change",function(){
    var file_name = jQuery(this).val().split('\\').pop();
    // jQuery(".customfile_label").text(file_name);
    $(this).parents(".custom_file_uploader").find(".custom_file_uploader_inr").text(file_name);
 });

 // jQuery Equal Height

$.fn.jQueryEqualHeight = function(innerDiv) {
    if (innerDiv == undefined) {
        innerDiv = '.card';
    }
    var currentTallest = 0, currentRowStart = 0, rowDivs = new Array(), topPosition = 0;
    $(this).each(function() {
        $(this).find(innerDiv).height('auto')
        topPosition = $(this).position().top;
        if (currentRowStart != topPosition) {
            for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
                rowDivs[currentDiv].find(innerDiv).height(currentTallest);
            }
            rowDivs.length = 0;
            currentRowStart = topPosition;
            currentTallest = $(this).find(innerDiv).height();
            rowDivs.push($(this));
        } else {
            rowDivs.push($(this));
            currentTallest = (currentTallest < $(this).find(innerDiv).height()) ? ($(this).find(innerDiv).height()) : (currentTallest);
        }
        for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
            rowDivs[currentDiv].find(innerDiv).height(currentTallest);
        }
    });
};
// jQuery Equal Height end


function equal_height() {

    $('.setting_pg_gimmziw_top_col').jQueryEqualHeight('.gimmzi_section_bxss h3');

    
}
equal_height();
$(window).on('load', function(event) {
    equal_height();
});
$(window).resize(function(event) {
    equal_height();
});


// $(".addtime_part").on('click', function(){
//     var newel = $(this).parents(".open_close_datetm").find('.open_close_datetm_row:last').clone(true);
//     $(newel).insertAfter($(this).parents(".open_close_datetm").find('.open_close_datetm_row:last'));
// });

    
$(".tab_partcipate_part_btnn").on('click', function(){
    $(".tab_partcipate_part_btnn").removeClass("active");
    $(this).addClass("active");
});



// fixed nav bar
// $(window).scroll(function() {     
//     var scroll = $(window).scrollTop();     
//     if (scroll > 200) { 
//         $(".main-head").addClass("fixed"); 
//     } 
//     else {
//       $(".main-head").removeClass("fixed"); 
//     }
// }) 


// smooth scroll to any section
// if($('a.scroll').length){
//     $("a.scroll").on('click', function(event) {
//       if (this.hash !== "") {
//         event.preventDefault();
//         var target = this.hash, $target = $(target);
//         $('html, body').animate({
//           scrollTop: $target.offset().top - 60
//         }, 800, function(){
//           window.location.href.substr(0, window.location.href.indexOf('#'));
//         });
//       } 
//     });
  
//   }


// back to top
if($("#scroll").length){
    $(window).scroll(function(){ 
        if ($(this).scrollTop() > 200) { 
            $('#scroll').fadeIn(200); 
        } else { 
            $('#scroll').fadeOut(200); 
        } 
    }); 
    $('#scroll').click(function(){ 
        $("html, body").animate({ scrollTop: 0 }, 500); 
        return false; 
    }); 
}




// one page scroll menu link
// $('a[href*="#"]').on('click', function (e) {
//     e.preventDefault();
//     $(document).off("scroll");
//     $('.navbar-nav > li > a').each(function () {
//         $(this).parent('li').removeClass('current-menu-item');
//     });
//     $(this).parent('li').addClass('current-menu-item');
//     var target = this.hash, $target = $(target);
//     $('html, body').stop().animate({
//         'scrollTop': $target.offset().top
//     }, 500, 'swing', function () {
//         window.location.href.substr(0, window.location.href.indexOf('#'));
//         $(document).on("scroll", onScroll);
//     });
// });
//  $(document).on("scroll", onScroll);
// function onScroll(event){
//     var scrollPos = $(document).scrollTop() + 100;
//     $('.navbar-nav > li > a').each(function () {
//         var currLink = $(this);
//         var refElement = $(currLink.attr("href"));
//         if (refElement.position().top <= scrollPos && refElement.position().top + refElement.height() > scrollPos) {
//             $('.navbar-nav > li').removeClass("current-menu-item");
//             currLink.parent('li').addClass("current-menu-item");
//         }
//         else{
//             currLink.parent('li').removeClass("current-menu-item");
//         }
//     });
// }






// $('.brandout-sider').slick({
//   dots: false,
//   arrows: true,
//   infinite: true,
//   slidesToShow: 3,
//   slidesToScroll: 1,
//   autoplay: true,
//   autoplaySpeed: 3000,
//   centerMode: true,
//   adaptiveHeight: true,
//   centerPadding: '0px',
//   responsive: [
//     {
//       breakpoint: 767,
//       settings: {
//         slidesToShow: 2,
//         slidesToScroll: 2
//       }
//     },
//     {
//       breakpoint: 480,
//       settings: {
//         slidesToShow: 1,
//         slidesToScroll: 1
//       }
//     }
//   ]
// });












// jQuery Equal Height

$.fn.jQueryEqualHeight = function(innerDiv) {
    if (innerDiv == undefined) {
        innerDiv = '.card';
    }
    var currentTallest = 0, currentRowStart = 0, rowDivs = new Array(), topPosition = 0;
    $(this).each(function() {
        $(this).find(innerDiv).height('auto')
        topPosition = $(this).position().top;
        if (currentRowStart != topPosition) {
            for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
                rowDivs[currentDiv].find(innerDiv).height(currentTallest);
            }
            rowDivs.length = 0;
            currentRowStart = topPosition;
            currentTallest = $(this).find(innerDiv).height();
            rowDivs.push($(this));
        } else {
            rowDivs.push($(this));
            currentTallest = (currentTallest < $(this).find(innerDiv).height()) ? ($(this).find(innerDiv).height()) : (currentTallest);
        }
        for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
            rowDivs[currentDiv].find(innerDiv).height(currentTallest);
        }
    });
};
// jQuery Equal Height end

function equal_height() {
    $(".merch_plans_box_main").each(function(){
      let gl2 = $(this);
      gl2.find('.merch_plan_box_col').jQueryEqualHeight('.merchant_plan_main_wrap');
    });

    $(".merch_plans_box_main").each(function(){
      let gl3 = $(this);
      gl3.find('.merch_plan_box_col').jQueryEqualHeight('.merchant_plan_main_wrap');
    });
    
}
equal_height();
$(window).on('load', function(event) {
    equal_height();
});
$(window).resize(function(event) {
    equal_height();
});




//custom file upload button
jQuery(".mcd_inp_file_main").on("change",function(){
var file_name = jQuery('input[type=file]').val().split('\\').pop();
jQuery(".browse_btn_file_img_cont").text(file_name);
});


  


/* new js start from here 02/04/2024 */


/* circle load progress js start */
$("[data-value]").each(function () {
    let _this = $(this);
    let value = Number(_this.attr("data-value"));
    let n_path = _this.find(".pr_cls1");
    let length = n_path.get(0).getTotalLength();
    let i = 0;
  
    n_path.css({
      "stroke-dasharray": length + 1,
      "stroke-dashoffset": length + 1,
      opacity: 1
    });
  
    setInterval(function () {
      if (i <= value) {
        n_path.css(
          "stroke-dashoffset",
          "calc(" + length + " - (" + length + " *" + i + ") / 100)"
        );
        _this.find(".pr_text").text(i + "%");
        i++;
      }
    }, 10);
  });
/* circle load progress js end */


// $( ".datepicker" ).each(function(i,ev){
//   $(ev).datepicker();
// });



if($('.com_list_box_slider').length){
  $('.com_list_box_slider').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    fade: true,
    asNavFor: '.com_list_box_slider_nav',
    dots: false,
    infinite:true,
  });
  $('.com_list_box_slider_nav').slick({
    slidesToShow: 5,
    slidesToScroll: 1,
    asNavFor: '.com_list_box_slider',
    arrows: false,
    dots: false,
    centerMode: true,
    centerPaddibg: '0px',
    focusOnSelect: true,
    infinite:true,
  });
  $('.com_list_box_slider_nav .slick-center').next().addClass('sl_next');
  $('.com_list_box_slider_nav .slick-center').prev().addClass('sl_prev');
  $('.com_list_box_slider_nav').on('afterChange',function(event,slick,currentslide){
    $(this).find('.slick-center').next().addClass('sl_next');
    $(this).find('.slick-center').prev().addClass('sl_prev');
});
$('.com_list_box_slider_nav').on('beforeChange',function(event,slick,currentslide){
    $(this).find('.slick-center').next().removeClass('sl_next');
    $(this).find('.slick-center').prev().removeClass('sl_prev');
});
  }

  if( $('.mud_top_thumb_slider').length){
    $('.mud_top_thumb_slider').slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      dots: false,
      fade: true,
      asNavFor: '.mud_top_nav_slider'
    });
    $('.mud_top_nav_slider').slick({
      slidesToShow: 5,
      slidesToScroll: 1,
      asNavFor: '.mud_top_thumb_slider',
      dots: false,
      focusOnSelect: true,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 4,
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 3,
          }
        }
      ]
    });
  }
  
  if($('.mud_locs_slider').length){
    $('.mud_locs_slider').slick({
      dots: false,
      infinite: true,
      speed: 300,
      slidesToShow: 4,
      slidesToScroll: 1,
      prevArrow: ".locs_nav_lt",
      nextArrow: ".locs_nav_rt",
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
          }
        },
        {
          breakpoint: 992,
          settings: {
            slidesToShow: 2,
          }
        },
        {
          breakpoint: 576,
          settings: {
            slidesToShow: 1,
          }
        }
      ]
    });
    }
  
    if($('.badge_sec_top_slider').length){
      $('.badge_sec_top_slider').slick({
        dots: false,
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        slidesToScroll: 1
      });
      }
  
      /* slider initialization after tab loading start */
      $('[data-bs-toggle="tab"]').on('shown.bs.tab', function (event) {
        $('.slick-slider').slick('setPosition');
      });
  
  
  
    /* light box initialization */
    if($("[data-fancybox]").length){
    Fancybox.bind('[data-fancybox="gallery"]', {
      
    });
    Fancybox.bind('[data-fancybox]', {
      
    });     
  }
  
  
    /* search menu trigger */
    $(".search_hd_link").on("click", function(){
      $(this).next().slideToggle();
    });
  
  
    if($('.find_service_slider').length){
      $('.find_service_slider').slick({
        arrows:false,
        dots: true,
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        slidesToScroll: 1,
        adaptiveHeight: true,
        autoplay: true,
        autoplaySpeed: 5000,
        focusOnSelect: false,
        pauseOnHover:false,
      });
      $('.play_pause_toggle').click( function() {
        if ($(this).html() == '<i class="fa-solid fa-play"></i>'){
           $('.find_service_slider').slick('slickPlay')
           $(this).html('<i class="fa-solid fa-pause"></i>') 
        } else {
          $('.find_service_slider').slick('slickPause')  
          $(this).html('<i class="fa-solid fa-play"></i>') 
        }  
      });
      }
  
    
  
   /* pass word show hide functionality */
   $(".pass-icon-eye").on('click',function(){
    $(this).parents(".pasrwd-field").find(".pass-input-field").attr("type","text");
    $(this).hide();
    $(this).parent().find(".pass-icon-eye-off").show();
  });
  $(".pass-icon-eye-off").on('click',function(){
    $(this).parents(".pasrwd-field").find(".pass-input-field").attr("type","password");
    $(this).hide();
    $(this).parent().find(".pass-icon-eye").show();
  });
  
  
  /* select on change div show/hide js start */
  
  if($(".cust_select_dropmenu").length){
    $(".cust_select_btn").each(function(ind,eve){
      $(eve).on("click", function(){
        $(this).parents().find(".cust_select_dropmenu_bar").slideToggle();
        $(".cust_select_dropmenu_bar li").on("click", function(){
            var text_val= $(this).text();
            $(this).parents().find(".cust_select_dropmenu_bar").slideUp();
            $(this).parents().find(".cust_selected_text").text(text_val);
        }); 
      });
    });
  }
  
  /* select on change div show/hide js end */
  
  /* pricing list accordion custom js code start */
  if($(".list_head").length){
  $(".desc").slideUp();
  $(".list_head").each(function(index,event){
    $(event).on("click",function(){
      $(".desc").slideUp();
      $(this).toggleClass("open");
      $(".list_head").not(this).removeClass("open");
      $(this).siblings(".desc").stop().slideToggle();
    });
  });
  }
  /* pricing list accordion custom js code end */
  
  
  /* custom step form js start */
  var current_fs, next_fs, skp_fs, previous_fs; //fieldsets
  var currentStep = 1;
  var updateProgressBar;
  $(".next-step").click(function (e) {
      e.preventDefault();
      current_fs = $(this).parents('.step');
      next_fs = $(this).parents('.step').next();
      current_fs.hide();
      next_fs.show();
      if (currentStep < 2) {
          currentStep++;
      }
      return false;
  });
  // $(".skip-step").click(function (e) {
  //     e.preventDefault();
  //     current_fs = $(this).parents('.step');
  //     skp_fs = $(this).parents('.step').next();
  //     current_fs.hide();
  //     skp_fs.show();
  //     if (currentStep < 2) {
  //         currentStep++;
  //     }
  //     return false;
  // });
  
  $(".prev-step").click(function (e) {
      e.preventDefault();
      current_fs = $(this).parents('.step');
      previous_fs = $(this).parents('.step').prev();
      current_fs.hide();
      previous_fs.show();
      if (currentStep > 1) {
          currentStep--;
      }
      return false;
  });
  /* custom step form js end */
  
  
  
  
  // document end
  
  })
  
  
  if($("#range").length){
    const range = document.getElementById('range'),
          tooltip = document.getElementById('tooltip'),
          setValue = ()=>{
              const
                  newValue = Number( (range.value - range.min) * 100 / (range.max - range.min) ),
                  newPosition = 16 - (newValue * 0.32);
              tooltip.innerHTML = `<span>$${range.value} of $${range.max} </span>`;
              tooltip.style.left = `calc(${newValue}% + (${newPosition}px))`;
              document.documentElement.style.setProperty("--range-progress", `calc(${newValue}% + (${newPosition}px))`);
          };
      document.addEventListener("DOMContentLoaded", setValue);
      range.addEventListener('input', setValue);
  }




// document end



