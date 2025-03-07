jQuery(document).ready(function ($) {
    // document start

    // sticky navbar start

    $(window).scroll(function () {
        var scroll = $(window).scrollTop();
        if (scroll > 100) {
            $(".new-main-head").addClass("fixed");
        } else {
            $(".new-main-head").removeClass("fixed");
        }
    });
    function top_padding() {
        $("body").css("padding-top", $(".new-main-head").outerHeight());
    }
    top_padding();
    $(window).on("resize", function () {
        top_padding();
    });

    // sticky navbar end

    // Navbar end

    $(".explore-slider").slick({
        dots: true,
        arrows: false,
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
    });

    $(".new-features-slider").slick({
        dots: false,
        arrows: false,
        infinite: true,
        slidesToShow: 7,
        slidesToScroll: 7,
        responsive: [
            {
                breakpoint: 1280,
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 5,
                    autoplay: true,
                    autoplaySpeed: 3000,
                },
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 4,
                },
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                },
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                },
            },
        ],
    });

    // header form hide show start

    $(".search-btn").on("click", function (e) {
        e.preventDefault();
        $(this).toggleClass("src-open");
        $(".search-wpr").toggleClass("open");
    });
    $(".search-btn-cls").on("click", function (e) {
        e.preventDefault();
        $(".search-wpr.open").removeClass("open");
        $(".search-btn.src-open").removeClass("src-open");
    });
    // header form hide show start

    // left panel accordian start

    $(".category_lft_clm_main .category_lft_clm_wpr").each(function () {
        $(this).find(".filter-head").addClass("active");
    });
    $(".category_lft_clm_wpr .filter-head").click(function () {
        $(this).next().stop(true, true).slideToggle();
        var filter_hdcls = $(this);
        if (!filter_hdcls.hasClass("active")) {
            filter_hdcls.addClass("active");
        } else {
            filter_hdcls.removeClass("active");
        }
    });

    // left panel accordian end

    // map button click map hide and show start

    $(".mapbtn").on("click", function (e) {
        e.preventDefault();
        $(this).toggleClass("active");
        $(".filter-mdl-blk").slideToggle();
        var hidTxt = $(".mapbtn-hide");
        if (hidTxt.text() == "Hide Map") {
            hidTxt.text("View Map");
        } else {
            hidTxt.text("Hide Map");
        }
    });

    // map button click map hide and show end

    // left panel filter mobile start

    $(".fltrbtncls").on("click", function (e) {
        e.preventDefault();
        $(this).toggleClass("src-pnl");
        $(".filter-sec-col-lft").toggleClass("open");
    });
    $(".fltr-btnclose").on("click", function (e) {
        e.preventDefault();
        $(".filter-sec-col-lft.open").removeClass("open");
        $(".fltrbtncls.src-pnl").removeClass("src-pnl");
    });

    // left panel filter mobile end

    // document end
});
