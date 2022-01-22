(function ($) {
    "use strict";
    new WOW().init();
    /*---stickey menu---*/
    $(window).on('scroll', function () {
        var scroll = $(window).scrollTop();
        if (scroll < 100) {
            $(".sticky-header").removeClass("sticky");
        } else {
            $(".sticky-header").addClass("sticky");
        }
    });
    $('#nav-tab a,#nav-tab2 a').on('click', function (e) {
        e.preventDefault()
        $(this).tab('show')
    })
    $('.modal').on('shown.bs.modal', function (e) {
        $('.product_navactive').resize();
    })
    $('.product_navactive a').on('click', function (e) {
        e.preventDefault();
        var $href = $(this).attr('href');
        $('.product_navactive a').removeClass('active');
        $(this).addClass('active');
        $('.product-details-large .tab-pane').removeClass('active show');
        $('.product-details-large ' + $href).addClass('active show');
    })
    /*--- niceSelect---*/
    $('.select_option').niceSelect();
    /*---categories slideToggle---*/
    $(".categories_title").on("click", function () {
        $(this).toggleClass('active');
        $('.categories_menu_toggle').slideToggle('medium');
    });
    /*---widget sub categories---*/
    $(".widget_sub_categories > a").on("click", function () {
        $(this).toggleClass('active');
        $(this).siblings('.widget_dropdown_categories').slideToggle('medium');

    });

    /*----------  Category more toggle  ----------*/
    $(".categories_menu_toggle li.hidden").hide();
    $("#more-btn").on('click', function (e) {
        e.preventDefault();
        $(".categories_menu_toggle li.hidden").toggle(500);
        var htmlAfter = '<i class="fa fa-minus" aria-hidden="true"></i> Less Categories';
        var htmlBefore = '<i class="fa fa-plus" aria-hidden="true"></i> More Categories';
        if ($(this).html() == htmlBefore) {
            $(this).html(htmlAfter);
        } else {
            $(this).html(htmlBefore);
        }
    });
    /*---Category menu---*/
    function categorySubMenuToggle() {
        $('.categories_menu_toggle li.menu_item_children > a').on('click', function () {
            if ($(window).width() < 991) {
                $(this).removeAttr('href');
                var element = $(this).parent('li');
                if (element.hasClass('open')) {
                    element.removeClass('open');
                    element.find('li').removeClass('open');
                    element.find('ul').slideUp();
                } else {
                    element.addClass('open');
                    element.children('ul').slideDown();
                    element.siblings('li').children('ul').slideUp();
                    element.siblings('li').removeClass('open');
                    element.siblings('li').find('li').removeClass('open');
                    element.siblings('li').find('ul').slideUp();
                }
            }
        });
        $('.categories_menu_toggle li.menu_item_children > a').append('<span class="expand"></span>');
    }
    categorySubMenuToggle();
    /*---search box slideToggle---*/
    $(".search_box > a").on("click", function () {
        $(this).toggleClass('active');
        $('.search_widget').slideToggle('medium');
    });
    /*---header account slideToggle---*/
    $(".header_account > a").on("click", function () {
        $(this).toggleClass('active');
        $('.dropdown_account').slideToggle('medium');
    });
    /*---slide toggle activation---*/
    /*---mini cart activation---*/
    $('.mini_cart_wrapper > a').on('click', function () {
        $('.mini_cart,.off_canvars_overlay').addClass('active')
    });
    $('.mini_cart_close,.off_canvars_overlay').on('click', function () {
        $('.mini_cart,.off_canvars_overlay').removeClass('active')
    });
    /*---canvas menu activation---*/
    $('.canvas_open,.off_canvars_overlay').on('click', function () {
        $('.offcanvas_menu_wrapper,.off_canvars_overlay').addClass('active')
    });
    $('.canvas_close,.off_canvars_overlay').on('click', function () {
        $('.offcanvas_menu_wrapper,.off_canvars_overlay').removeClass('active')
    });
    /*---Off Canvas Menu---*/
    var $offcanvasNav = $('.offcanvas_main_menu'),
        $offcanvasNavSubMenu = $offcanvasNav.find('.sub-menu');
    $offcanvasNavSubMenu.parent().prepend('<span class="menu-expand"><i class="fa fa-angle-down"></i></span>');
    $offcanvasNavSubMenu.slideUp();
    $offcanvasNav.on('click', 'li a, li .menu-expand', function (e) {
        var $this = $(this);
        if (($this.parent().attr('class').match(/\b(menu-item-has-children|has-children|has-sub-menu)\b/)) && ($this.attr('href') === '#' || $this.hasClass('menu-expand'))) {
            e.preventDefault();
            if ($this.siblings('ul:visible').length) {
                $this.siblings('ul').slideUp('slow');
            } else {
                $this.closest('li').siblings('li').find('ul:visible').slideUp('slow');
                $this.siblings('ul').slideDown('slow');
            }
        }
        if ($this.is('a') || $this.is('span') || $this.attr('clas').match(/\b(menu-expand)\b/)) {
            $this.parent().toggleClass('menu-open');
        } else if ($this.is('li') && $this.attr('class').match(/\b('menu-item-has-children')\b/)) {
            $this.toggleClass('menu-open');
        }
    });
})(jQuery);
//MainSlider
var swiper = new Swiper('.MainSlider-container', {
    spaceBetween: 0,
    centeredSlides: true,
    loop: true,
    // effect: 'fade',
    speed: 500,
    autoplay: {
        delay: 6000,
        disableOnInteraction: false,
    },
    keyboard: {
        enabled: true,
    },
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
});
//blogs
var swiper = new Swiper('.blogs-container', {
    spaceBetween: 0,
    centeredSlides: true,
    speed: 2000,
    autoplay: {
        delay: 4000,
        disableOnInteraction: false,
    },

    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    breakpoints: {
        0: {
            slidesPerView: 1,
        },
        991: {
            slidesPerView: 2,
        },
    },
});

//books slider
var swiper = new Swiper('.booksSlider', {
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    speed: 1000,
    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
    },
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    slidesPerView: 'auto',
    breakpoints: {
        0: {
            slidesPerView: 2,
        },
        576: {
            slidesPerView: 2,
        },
        768: {
            slidesPerView: 3,
        },
        991: {
            slidesPerView: 5,
        },
    },
    observer: true,
    observeParents: true,
});

//product slider
var swiper = new Swiper('.authorSlider', {
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    speed: 1500,
    autoplay: {
        delay: 3000,
        disableOnInteraction: false,
    },
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    slidesPerView: 'auto',
    breakpoints: {
        0: {
            slidesPerView: 1,
        },
        576: {
            slidesPerView: 2,
        },
        768: {
            slidesPerView: 3,
        },
        991: {
            slidesPerView: 4,
        },
    },
    observer: true,
    observeParents: true,
});

// testimonials
var swiper = new Swiper('.testimonialsSlider', {
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    speed: 1000,
    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
    },
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    slidesPerView: 'auto',
    breakpoints: {
        0: {
            slidesPerView: 1,
        },
        576: {
            slidesPerView: 2,
        },
        768: {
            slidesPerView: 2,
        },
        991: {
            slidesPerView: 3,
        },
    },
    observer: true,
    observeParents: true,
});



//   odometer
$('.odometer').appear(function (e) {
    var odo = $(".odometer");
    odo.each(function () {
        var countNumber = $(this).attr("data-count");
        $(this).html(countNumber);
    });
});


//dropify
$('.dropify').dropify();