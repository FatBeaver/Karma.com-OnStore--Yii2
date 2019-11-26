$(document).ready(function() {
    "use strict";

    var window_width = $(window).width(),
        window_height = window.innerHeight,
        header_height = $(".default-header").height(),
        header_height_static = $(".site-header.static").outerHeight(),
        fitscreen = window_height - header_height;


    $(".fullscreen").css("height", window_height)
    $(".fitscreen").css("height", fitscreen);

    //------- Active Nice Select --------//

    $('select').niceSelect();


    $('.navbar-nav li.dropdown').hover(function() {
        $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
    }, function() {
        $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
    });

    $('.img-pop-up').magnificPopup({
        type: 'image',
        gallery: {
            enabled: true
        }
    });

    // Search Toggle
    $("#search_input_box").hide();
    $("#search").on("click", function() {
        $("#search_input_box").slideToggle();
        $("#search_input").focus();
    });
    $("#close_search").on("click", function() {
        $('#search_input_box').slideUp(500);
    });

    /*==========================
    		javaScript for sticky header
    		============================*/
    $(".sticky-header").sticky();

    /*=================================
    Javascript for banner area carousel
    ==================================*/
    $(".active-banner-slider").owlCarousel({
        items: 1,
        autoplay: true,
        autoplayTimeout: 4000,
        loop: true,
        nav: true,
        navText: ["<img src='img/banner/prev.png'>", "<img src='img/banner/next.png'>"],
        dots: false
    });

    /*=================================
    Javascript for product area carousel
    ==================================*/
    $(".active-product-area").owlCarousel({
        items: 1,
        autoplay: false,
        autoplayTimeout: 10000,
        loop: true,
        nav: true,
        navText: ["<img src='img/product/prev.png'>", "<img src='img/product/next.png'>"],
        dots: false
    });

    /*=================================
    Javascript for single product area carousel
    ==================================*/
    $(".s_Product_carousel").owlCarousel({
        items: 1,
        autoplay: false,
        autoplayTimeout: 10000,
        loop: true,
        nav: false,
        dots: true
    });

    /*=================================
    Javascript for exclusive area carousel
    ==================================*/
    $(".active-exclusive-product-slider").owlCarousel({
        items: 1,
        autoplay: true,
        autoplayTimeout: 3000,
        loop: true,
        nav: true,
        navText: ["<img src='img/product/prev.png'>", "<img src='img/product/next.png'>"],
        dots: false
    });

    //--------- Accordion Icon Change ---------//

    $('.collapse').on('shown.bs.collapse', function() {
        $(this).parent().find(".lnr-arrow-right").removeClass("lnr-arrow-right").addClass("lnr-arrow-left");
    }).on('hidden.bs.collapse', function() {
        $(this).parent().find(".lnr-arrow-left").removeClass("lnr-arrow-left").addClass("lnr-arrow-right");
    });

    // Select all links with hashes
    $('.main-menubar a[href*="#"]')
        // Remove links that don't actually link to anything
        .not('[href="#"]')
        .not('[href="#0"]')
        .click(function(event) {
            // On-page links
            if (
                location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') &&
                location.hostname == this.hostname
            ) {
                // Figure out element to scroll to
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                // Does a scroll target exist?
                if (target.length) {
                    // Only prevent default if animation is actually gonna happen
                    event.preventDefault();
                    $('html, body').animate({
                        scrollTop: target.offset().top - 70
                    }, 1000, function() {
                        // Callback after animation
                        // Must change focus!
                        var $target = $(target);
                        $target.focus();
                        if ($target.is(":focus")) { // Checking if the target was focused
                            return false;
                        } else {
                            $target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
                            $target.focus(); // Set focus again
                        };
                    });
                }
            }
        });



    // -------   Mail Send ajax

    $(document).ready(function() {
        var form = $('#booking'); // contact form
        var submit = $('.submit-btn'); // submit button
        var alert = $('.alert-msg'); // alert div for show alert message

        // form submit event
        form.on('submit', function(e) {
            e.preventDefault(); // prevent default form submit

            $.ajax({
                url: 'booking.php', // form action url
                type: 'POST', // form submit method get/post
                dataType: 'html', // request type html/json/xml
                data: form.serialize(), // serialize form data
                beforeSend: function() {
                    alert.fadeOut();
                    submit.html('Sending....'); // change submit button text
                },
                success: function(data) {
                    alert.html(data).fadeIn(); // fade in response data
                    form.trigger('reset'); // reset form
                    submit.attr("style", "display: none !important");; // reset submit button text
                },
                error: function(e) {
                    console.log(e)
                }
            });
        });
    });




    $(document).ready(function() {
        $('#mc_embed_signup').find('form').ajaxChimp();
    });



    if (document.getElementById("js-countdown")) {

        var countdown = new Date("October 17, 2018");

        function getRemainingTime(endtime) {
            var milliseconds = Date.parse(endtime) - Date.parse(new Date());
            var seconds = Math.floor(milliseconds / 1000 % 60);
            var minutes = Math.floor(milliseconds / 1000 / 60 % 60);
            var hours = Math.floor(milliseconds / (1000 * 60 * 60) % 24);
            var days = Math.floor(milliseconds / (1000 * 60 * 60 * 24));

            return {
                'total': milliseconds,
                'seconds': seconds,
                'minutes': minutes,
                'hours': hours,
                'days': days
            };
        }

        function initClock(id, endtime) {
            var counter = document.getElementById(id);
            var daysItem = counter.querySelector('.js-countdown-days');
            var hoursItem = counter.querySelector('.js-countdown-hours');
            var minutesItem = counter.querySelector('.js-countdown-minutes');
            var secondsItem = counter.querySelector('.js-countdown-seconds');

            function updateClock() {
                var time = getRemainingTime(endtime);

                daysItem.innerHTML = time.days;
                hoursItem.innerHTML = ('0' + time.hours).slice(-2);
                minutesItem.innerHTML = ('0' + time.minutes).slice(-2);
                secondsItem.innerHTML = ('0' + time.seconds).slice(-2);

                if (time.total <= 0) {
                    clearInterval(timeinterval);
                }
            }

            updateClock();
            var timeinterval = setInterval(updateClock, 1000);
        }

        initClock('js-countdown', countdown);

    };



    $('.quick-view-carousel-details').owlCarousel({
        loop: true,
        dots: true,
        items: 1,
    })



    //----- Active No ui slider --------//



    $(function() {

        if (document.getElementById("price-range")) {

            var nonLinearSlider = document.getElementById('price-range');

            noUiSlider.create(nonLinearSlider, {
                connect: true,
                behaviour: 'tap',
                start: [0, 10000],
                range: {
                    // Starting at 500, step the value by 500,
                    // until 4000 is reached. From there, step by 1000.
                    'min': [0],
                    '10%': [500, 500],
                    '50%': [4000, 1000],
                    'max': [10000]
                }
            });


            var nodes = [
                document.getElementById('lower-value'), // 0
                document.getElementById('upper-value') // 1
            ];

            // Display the slider value and how far the handle moved
            // from the left edge of the slider.
            nonLinearSlider.noUiSlider.on('update', function(values, handle, unencoded, isTap, positions) {
                nodes[handle].innerHTML = values[handle];
            });

        }

    });


    //-------- Have Cupon Button Text Toggle Change -------//

    $('.have-btn').on('click', function(e) {
        e.preventDefault();
        $('.have-btn span').text(function(i, text) {
            return text === "Have a Coupon?" ? "Close Coupon" : "Have a Coupon?";
        })
        $('.cupon-code').fadeToggle("slow");
    });

    $('.load-more-btn').on('click', function(e) {
        e.preventDefault();
        $('.load-product').fadeIn('slow');
        $(this).fadeOut();
    });





    //------- Start Quantity Increase & Decrease Value --------//




    var value,
        quantity = document.getElementsByClassName('quantity-container');

    function createBindings(quantityContainer) {
        var quantityAmount = quantityContainer.getElementsByClassName('quantity-amount')[0];
        var increase = quantityContainer.getElementsByClassName('increase')[0];
        var decrease = quantityContainer.getElementsByClassName('decrease')[0];
        increase.addEventListener('click', function() { increaseValue(quantityAmount); });
        decrease.addEventListener('click', function() { decreaseValue(quantityAmount); });
    }

    function init() {
        for (var i = 0; i < quantity.length; i++) {
            createBindings(quantity[i]);
        }
    };

    function increaseValue(quantityAmount) {
        value = parseInt(quantityAmount.value, 10);

        console.log(quantityAmount, quantityAmount.value);

        value = isNaN(value) ? 0 : value;
        value++;
        quantityAmount.value = value;
    }

    function decreaseValue(quantityAmount) {
        value = parseInt(quantityAmount.value, 10);

        value = isNaN(value) ? 0 : value;
        if (value > 0) value--;

        quantityAmount.value = value;
    }

    init();

    //------- End Quantity Increase & Decrease Value --------//

    /*----------------------------------------------------*/
    /*  Google map js
      /*----------------------------------------------------*/

    if ($("#mapBox").length) {
        var $lat = $("#mapBox").data("lat");
        var $lon = $("#mapBox").data("lon");
        var $zoom = $("#mapBox").data("zoom");
        var $marker = $("#mapBox").data("marker");
        var $info = $("#mapBox").data("info");
        var $markerLat = $("#mapBox").data("mlat");
        var $markerLon = $("#mapBox").data("mlon");
        var map = new GMaps({
            el: "#mapBox",
            lat: $lat,
            lng: $lon,
            scrollwheel: false,
            scaleControl: true,
            streetViewControl: false,
            panControl: true,
            disableDoubleClickZoom: true,
            mapTypeControl: false,
            zoom: $zoom,
            styles: [{
                    featureType: "water",
                    elementType: "geometry.fill",
                    stylers: [{
                        color: "#dcdfe6"
                    }]
                },
                {
                    featureType: "transit",
                    stylers: [{
                            color: "#808080"
                        },
                        {
                            visibility: "off"
                        }
                    ]
                },
                {
                    featureType: "road.highway",
                    elementType: "geometry.stroke",
                    stylers: [{
                            visibility: "on"
                        },
                        {
                            color: "#dcdfe6"
                        }
                    ]
                },
                {
                    featureType: "road.highway",
                    elementType: "geometry.fill",
                    stylers: [{
                        color: "#ffffff"
                    }]
                },
                {
                    featureType: "road.local",
                    elementType: "geometry.fill",
                    stylers: [{
                            visibility: "on"
                        },
                        {
                            color: "#ffffff"
                        },
                        {
                            weight: 1.8
                        }
                    ]
                },
                {
                    featureType: "road.local",
                    elementType: "geometry.stroke",
                    stylers: [{
                        color: "#d7d7d7"
                    }]
                },
                {
                    featureType: "poi",
                    elementType: "geometry.fill",
                    stylers: [{
                            visibility: "on"
                        },
                        {
                            color: "#ebebeb"
                        }
                    ]
                },
                {
                    featureType: "administrative",
                    elementType: "geometry",
                    stylers: [{
                        color: "#a7a7a7"
                    }]
                },
                {
                    featureType: "road.arterial",
                    elementType: "geometry.fill",
                    stylers: [{
                        color: "#ffffff"
                    }]
                },
                {
                    featureType: "road.arterial",
                    elementType: "geometry.fill",
                    stylers: [{
                        color: "#ffffff"
                    }]
                },
                {
                    featureType: "landscape",
                    elementType: "geometry.fill",
                    stylers: [{
                            visibility: "on"
                        },
                        {
                            color: "#efefef"
                        }
                    ]
                },
                {
                    featureType: "road",
                    elementType: "labels.text.fill",
                    stylers: [{
                        color: "#696969"
                    }]
                },
                {
                    featureType: "administrative",
                    elementType: "labels.text.fill",
                    stylers: [{
                            visibility: "on"
                        },
                        {
                            color: "#737373"
                        }
                    ]
                },
                {
                    featureType: "poi",
                    elementType: "labels.icon",
                    stylers: [{
                        visibility: "off"
                    }]
                },
                {
                    featureType: "poi",
                    elementType: "labels",
                    stylers: [{
                        visibility: "off"
                    }]
                },
                {
                    featureType: "road.arterial",
                    elementType: "geometry.stroke",
                    stylers: [{
                        color: "#d6d6d6"
                    }]
                },
                {
                    featureType: "road",
                    elementType: "labels.icon",
                    stylers: [{
                        visibility: "off"
                    }]
                },
                {},
                {
                    featureType: "poi",
                    elementType: "geometry.fill",
                    stylers: [{
                        color: "#dadada"
                    }]
                }
            ]
        });
    }



    if ($('.sign-up-form').is(':visible')) {
        $('.sign-up-form').fadeOut(0);
        $('.sign-up-form').addClass('hover');
    }

    $('.sign-up-button').on('click', function(e) {
        e.preventDefault();
        $('.sign-up-hover').fadeOut(500);
        setTimeout(function() {
            $('.sign-up-form').fadeIn(400);
        }, 700);
    });

    $('.main-categories').children("li:last").remove();

    // <<========================== AJAX Requests ===============================>>

    $('.ajax_link_pager').on('click', 'ul.pagination > li > a', function(e) {
            e.preventDefault();
            var page = $(this).data('page');
            var count = $('.mr-auto > .nice-select > ul.list > li.selected').data('value');
            var id = $('#category_id').data('id');
            var price = [$('#lower-value').text(), $('#upper-value').text()];

            if ($('.index_category_list > .row').is(':visible')) {
                $('.index_category_list > .row').fadeOut(400);
            }

            $.ajax({
                url: '/category/link-pager',
                data: { page: page, count: count, id: id, price: price },
                type: 'GET',
                success: function(result) {

                    changeNavPagination(result);
                }
            });

            setTimeout(function() {
                $.ajax({
                    url: '/category/select-page',
                    data: { page: page, count: count, id: id, price: price },
                    type: 'GET',
                    success: function(result) {

                        selectPage(result);
                    }
                })
            }, 350);

        })
        //-----------------------------------------------------------------

    $('.mr-auto > .nice-select > ul.list > li').on('click', function(e) {
        // e.preventDefault();
        var count = $(this).data('value');
        var id = $('#category_id').data('id');
        var price = [$('#lower-value').text(), $('#upper-value').text()];

        if ($('.index_category_list > .row').is(':visible')) {
            $('.index_category_list > .row').slideUp(1100);
        }
        if ($('.ajax_link_pager > ul').is(':visible')) {
            $('.ajax_link_pager > ul').slideUp(500);
        }

        setTimeout(function() {
            $.ajax({
                url: '/category/link-pager',
                data: { count: count, id: id, price: price, },
                type: 'GET',
                success: function(result) {

                    changeNavPaginationForCountProd(result);
                }
            });
        }, 450)

        setTimeout(function() {
            $.ajax({
                url: '/category/select-page',
                data: { count: count, id: id, price: price },
                type: 'GET',
                success: function(result) {

                    selectCountProdPage(result);
                }
            })
        }, 1050);
    })


    //-----------------------------------------------------------------------
    function selectPage(selectedProducts) {
        $('.index_category_list').html(selectedProducts);
        if ($('.index_category_list > .row').is(':visible')) {
            $('.index_category_list > .row').fadeOut(0);
        }
        if ($('.index_category_list > .row').is(':hidden')) {
            $('.index_category_list > .row').fadeIn(400);
        }
    }

    function changeNavPagination(pagination) {
        $('.ajax_link_pager').html(pagination);
    }

    function changeNavPaginationForCountProd(pagination) {
        $('.ajax_link_pager').html(pagination);
        if ($('.ajax_link_pager > ul').is(':visible')) {
            $('.ajax_link_pager > ul').fadeOut(0);
        }
        if ($('.ajax_link_pager > ul').is(':hidden')) {
            $('.ajax_link_pager > ul').slideDown(500);
        }
    }

    function selectCountProdPage(products) {
        $('.index_category_list').html(products);
        if ($('.index_category_list > .row').is(':visible')) {
            $('.index_category_list > .row').slideUp(0);
        }
        if ($('.index_category_list > .row').is(':hidden')) {
            $('.index_category_list > .row').slideDown(1100);
        }
    }

    // =================== SIGN_UP FORM VALIDATE =======================
    $('.sign-up-name').on('blur', function(e) {
        usernameAjaxValid();
    });

    $('.sign-up-email').on('blur', function() {
        emailAjaxValid();
    });

    $('.sign-up-password').on('blur', function() {
        passwordAjaxValid();
    });


    function usernameAjaxValid() {
        if ($('.sign-up-password').val() != '') {
            passwordAjaxValid();
        }
        var username = $('.sign-up-name').val();
        $.ajax({
            url: '/site/username-validate',
            data: { username: username },
            type: 'get',
            success: function(result) {
                if (!result) {
                    $('.sign-up-name').removeClass('error-input');
                    $('.sign-up-name').addClass('success');
                    $('.div-name').html('<p style="font-size:22px; color:rgb(6, 196, 6); margin-bottom:-5px;">Отлично!</p>');
                    return true;
                }
                $('.sign-up-name').removeClass('success');
                $('.sign-up-name').addClass('error-input');
                $('.div-name').html('<p style="font-size:16px; color:rgb(223, 21, 21) ; margin-bottom:-5px;">' + result + '</p>');
            }
        });
    }

    function emailAjaxValid() {
        var email = $('.sign-up-email').val();
        $.ajax({
            url: '/site/email-validate',
            data: { email: email },
            type: 'get',
            success: function(result) {
                if (!result) {
                    $('.sign-up-email').removeClass('error-input');
                    $('.sign-up-email').addClass('success');
                    $('.div-email').html('<p style="font-size:22px; color:rgb(6, 196, 6); margin-bottom:-5px;">Отлично!</p>');
                    return true;
                }
                $('.sign-up-email').removeClass('success');
                $('.sign-up-email').addClass('error-input');
                $('.div-email').html('<p style="font-size:18px; color:rgb(223, 21, 21) ; margin-bottom:-5px;">' + result + '</p>');
            }
        });
    }

    function passwordAjaxValid() {
        var password = $('.sign-up-password').val();
        $.ajax({
            url: '/site/password-validate',
            data: { password: password },
            type: 'get',
            success: function(result) {
                if (!result) {
                    $('.sign-up-password').removeClass('error-input');
                    $('.sign-up-password').addClass('success');
                    $('.div-password').html('<p style="font-size:22px; color:rgb(6, 196, 6); margin-bottom:-5px;">Отлично!</p>');
                    return true;
                }
                $('.sign-up-password').removeClass('success');
                $('.sign-up-password').addClass('error-input');
                $('.div-password').html('<p style="font-size:18px; color:rgb(223, 21, 21) ; margin-bottom:-5px;">' + result + '</p>');
            }
        });
    }

    $('.sign-up-submit').on('click', function() {
        if ($('.sign-up-password').hasClass('error-input')) {
            passwordAjaxValid();
        }
        if ($('.sign-up-email').hasClass('error-input')) {
            emailAjaxValid();
        }
        if ($('.sign-up-username').hasClass('error-input')) {
            usernameAjaxValid();
        }

        if (($('.sign-up-password').hasClass('error-input')) || ($('.sign-up-email').hasClass('error-input')) ||
            ($('.sign-up-username').hasClass('error-input'))) {
            $('.sign-up-submit').prop("disabled", true);
            setTimeout(function() {
                $('.sign-up-submit').prop("disabled", false);
            }, 100);
        } else {
            $('.sign-up-submit').prop("disabled", false);
        }
    });

    // ======================== LOGIN FORM VALIDATE ==================
    function emailLoginValidate() {
        var email = $('.login-email-input').val();
        $.ajax({
            url: 'login-email-validate',
            data: { email: email },
            type: 'GET',
            success: function(result) {
                if (!result) {
                    $('.login-email-input').removeClass('error-input');
                    $('.login-email-input').addClass('success');
                    $('.div-email-login').html('<p style="font-size:22px; color:rgb(6, 196, 6); margin-bottom:-5px;">Отлично!</p>');
                    return true;
                }
                $('.login-email-input').removeClass('success');
                $('.login-email-input').addClass('error-input');
                $('.div-email-login').html('<p style="font-size:18px; color:rgb(223, 21, 21) ; margin-bottom:-5px;">' + result + '</p>');
            }
        })
    }

    function passwordLoginValidate() {
        var email = $('.login-email-input').val();
        var password = $('.login-password-input').val();
        $.ajax({
            url: 'login-password-validate',
            data: { email: email, password: password },
            type: 'GET',
            success: function(result) {
                if (!result) {
                    $('.login-password-input').removeClass('error-input');
                    $('.login-password-input').addClass('success');
                    $('.div-password-login').html('<p style="font-size:22px; color:rgb(6, 196, 6); margin-bottom:-5px;">Отлично!</p>');
                    return true;
                }
                $('.login-password-input').removeClass('success');
                $('.login-password-input').addClass('error-input');
                $('.div-password-login').html('<p style="font-size:18px; color:rgb(223, 21, 21) ; margin-bottom:-5px;">' + result + '</p>');
            }
        })
    }

    $('.login-email-input').on('blur', function(e) {
        emailLoginValidate();
    });

    $('.login-password-input').on('blur', function() {
        passwordLoginValidate();
    });

    $('.div-login-submit').on('click', function(e) {

        if (($('.login-email-input').hasClass('error-input')) ||
            ($('.login-password-input').hasClass('error-input'))) {
            $('.login-submit').prop("disabled", true);
            setTimeout(function() {
                $('.login-submit').prop("disabled", false);
            }, 100);
        } else {
            $('.login-submit').prop("disabled", false);
        }
    });


    // ===================== AJAX REVIEWS ===========================
    $('.review').on('click', function(e) {
        e.preventDefault();

        var id = $('#message').data('product');
        var text = $('#message').val();

        $.ajax({
            url: '/product/add-review',
            data: { id: id, text: text },
            type: 'GET',
            success: function(result) {
                $('.review_list').prepend(result);
                $('.review_list').children("div:first").hide(0);
                $('.review_list').animate({
                    paddingTop: "140px",
                }, 800);
                $('.review_list').animate({
                    paddingTop: "-140px",
                }, 1000);
                setTimeout(function() {
                    $('.review_list').children("div:first").slideDown(600);
                }, 800);

            }
        })
    });

    $('.select-star').on('click', function(e) {
        e.preventDefault();

        var stars = $(this).data('rating');
        var id = $('#message').data('product');

        $.ajax({
            url: '/product/select-star',
            data: { id: id, stars: stars },
            type: 'GET',
            success: function(result) {
                $('.total_rate').html(result);
            }
        })
    })

    //------------------- PAGINATION_REVIEW--------------------
    $('.review_list').on('click', '.nav-reviews > p > .review-pagination-button', function(e) {
        e.preventDefault();

        var page = $(this).data('page');
        var id = $('.detail-product-id').data('id')

        $.ajax({
            url: '/product/select-page-reviews',
            data: { page: page, id: id },
            type: 'GET',
            success: function(result) {
                if (!result) {
                    alert('Невозможно обновить страницу.');
                    return false;
                }
                showNextReviewPage(result);
            }
        })
    });

    function showNextReviewPage(result) {
        $('.review_list').animate({
            width: "0.2%",
        }, 1100);

        setTimeout(function() {
            $('.review_list').html(result);
            $('.review_list').animate({
                width: "100%",
            }, 1100);
        }, 1100);


    }

    // =========================== ORDER-BY PRICE AJAX ==================================
    $('#price-range').on('mouseup', '.noUi-base > .noUi-origin > .noUi-handle-lower', function() {
        priceOrder();
    });
    $('#price-range').on('mouseup', '.noUi-base > .noUi-origin > .noUi-handle-upper', function() {
        priceOrder();
    });

    function priceOrder() {
        var price = [$('#lower-value').text(), $('#upper-value').text()];
        var page = $(this).data('page');
        var count = $('.mr-auto > .nice-select > ul.list > li.selected').data('value');
        var id = $('#category_id').data('id');

        $.ajax({
            url: '/category/select-page',
            type: 'GET',
            data: { price: price, page: page, count: count, id: id },
            success: function(result) {
                $('.index_category_list').hide(1500);

                setTimeout(function() {
                    $('.index_category_list').html(result);
                }, 1500);

                $('.index_category_list').show(1100);
            }
        });

        $.ajax({
            url: '/category/link-pager',
            type: 'GET',
            data: { price: price, page: page, count: count, id: id },
            success: function(result) {
                $('.ajax_link_pager').hide(1500);

                setTimeout(function() {
                    $('.ajax_link_pager').html(result);
                }, 1500);

                $('.ajax_link_pager').show(1100);
            }
        });
    }

    // ========================= EDIT PROFILE ==============================
    // ------------------------- Helpers Select Country -----------------
    $('.country_list').on('click', '.help_item', function() {
        var text = $(this).text();
        var country_id = $(this).data('id');

        $('#country_label').data('country', country_id);

        $('#country_label').val(text);
        $('.country_help').addClass('non-visible');
    });

    $('#country_label').on('keypress', function() {
        if ($(this).val().length >= 1) {
            var countryName = $(this).val();
            selectCountry(countryName);
        }
    });

    function selectCountry(countryName) {
        $.ajax({
            url: '/site/select-country',
            data: { countryName: countryName },
            type: 'GET',
            success: function(result) {
                $('.country_help').removeClass('non-visible');
                $('.country_list').empty();
                result.forEach(function(item, i, array) {
                    $('.country_list')
                        .prepend('<li data-id="' + item.id_country + '" class="help_item">' + item.name + '</li>');
                });
            }
        });
    }

    $('.country-star').on('mouseleave', function() {
        $('.country_help').addClass('non-visible');
    })

    // ----------------------- Helpers Select Region ------------------------
    $('.region_list').on('click', '.help_item', function() {
        var text = $(this).text();
        var region_id = $(this).data('id');

        $('#region_label').data('region', region_id);

        $('#region_label').val(text);
        $('.region_help').addClass('non-visible');
    });

    $('#region_label').on('keypress', function() {
        if ($(this).val().length >= 1) {
            var regionName = $(this).val();
            var country_id = $('#country_label').data('country');

            selectRegion(regionName, country_id);
        }
    });

    function selectRegion(regionName, country_id) {
        $.ajax({
            url: '/site/select-region',
            data: { regionName: regionName, country_id: country_id },
            type: 'GET',
            success: function(result) {
                $('.region_help').removeClass('non-visible');
                $('.region_list').empty();
                result.forEach(function(item, i, array) {
                    $('.region_list')
                        .prepend('<li data-id="' + item.id_region + '" class="help_item">' + item.name + '</li>');
                });

            }
        });
    }

    $('.region-star').on('mouseleave', function() {
        $('.region_help').addClass('non-visible');
    })

    // ---------------------- Helpers Select City -----------------------------
    $('.city_list').on('click', '.help_item', function() {
        var text = $(this).text();
        var city_id = $(this).data('id');

        $('#city_label').data('city', city_id);

        $('#city_label').val(text);
        $('.city_help').addClass('non-visible');
    });

    $('#city_label').on('keypress', function() {
        if ($(this).val().length >= 1) {
            var cityName = $(this).val();
            var country_id = $('#country_label').data('country');
            var region_id = $('#region_label').data('region');

            selectCity(cityName, country_id, region_id);
        }
    });

    function selectCity(cityName, country_id, region_id) {
        $.ajax({
            url: '/site/select-city',
            data: { cityName: cityName, country_id: country_id, region_id: region_id },
            type: 'GET',
            success: function(result) {
                $('.city_help').removeClass('non-visible');
                $('.city_list').empty();
                result.forEach(function(item, i, array) {
                    $('.city_list')
                        .prepend('<li data-id="' + item.id_city + '" class="help_item">' + item.name + '</li>');
                });
            }
        });
    }

    $('.city-star').on('mouseleave', function() {
        $('.city_help').addClass('non-visible');
    })


    // ======================= CART AJAX =================================
    $('.qty-cart-product').prop("disabled", true);

    $('.add-to-cart').on('click', function(e) {
        e.preventDefault();

        var id = $(this).data('id');

        $.ajax({
            url: '/cart/add-product',
            data: { id: id },
            type: 'GET',
            success: function(result) {
                if (!result) {
                    alert("Не удалось добавить товар в козрину.");
                }
                addToCart(result);
            }
        });
    });

    $('.add-to-cart-single').on('click', function(e) {
        e.preventDefault();

        var id = $(this).data('id');
        var qty = $('#sst').val();

        $.ajax({
            url: '/cart/add-product',
            data: { id: id, qty: qty },
            type: 'GET',
            success: function(result) {
                if (!result) {
                    alert("Не удалось добавить товар в козрину.");
                }
                addToCart(result);
            }
        });
    });

    function addToCart(result) {
        $('.nav-item-cart').addClass('cart-style');

        $('.ajax_cart').addClass('cart-qty');
        $('.ajax_cart').text(result);

        $('.nav-item-cart').addClass('nav-item-cart-big');

        setTimeout(function() {
            $('.nav-item-cart-big').removeClass('nav-item-cart');
            $('.nav-item-cart-big').addClass('nav-item-cart');
            $('.nav-item-cart').removeClass('nav-item-cart-big');
        }, 590);
    }

    // ---------------- Increased || Reduced -----------------
    $('.increase').on('click', function() {
        var inputValue = $(this).parent().children('.qty-cart-product').val();
        var id = $(this).parent().children('.qty-cart-product').data('id');

        $.ajax({
            url: '/cart/change-count-product',
            data: { id: id, count: inputValue },
            type: 'GET',
            success: function(result) {
                changeCountProduct(result, id);
            }
        })

    });

    $('.reduced').on('click', function() {
        var inputValue = $(this).parent().children('.qty-cart-product').val();
        var id = $(this).parent().children('.qty-cart-product').data('id');

        $.ajax({
            url: '/cart/change-count-product',
            data: { id: id, count: inputValue },
            type: 'GET',
            success: function(result) {
                changeCountProduct(result, id);
            }
        })

    });

    function changeCountProduct(result, id) {
        $('#prod-' + id).html(result.product_total_sum);
        $('#total-price').html('$ ' + result.total_sum);
        addToCart(result.total_qty);
    }

    // ------------------- Remove Product From Cart ------------------
    $('.remove-prod').on('click', function(e) {
        e.preventDefault();
        var product_id = $(this).data('id');

        $.ajax({
            url: '/cart/remove-product',
            data: { id: product_id },
            type: 'GET',
            success: function(result) {
                if (result.total_qty == 0) {
                    addToCart(result.total_qty);
                    $('.table-responsive').html('<h1 style="margin-left:29%; font-size:42px;">Товаров в корзине пока нет...</h1>')
                } else {
                    $('#total-price').html('$ ' + result.total_sum);
                    addToCart(result.total_qty);
                    $('#row-' + product_id).empty();
                }
            }
        })
    });

    // ------------------- Shipping Block -------------------
    $('.shipping_box > ul > li').on('click', function(e) {
        e.preventDefault();
        var price = $(this).children('a').data('price');
        var oldPrice = $('.shipping_box > ul > li.active').children('a').data('price');

        $('.shipping_box > ul > li').removeClass('active');
        $(this).addClass('active');

        $.ajax({
            url: '/cart/shipping',
            data: { oldPrice: oldPrice, price: price },
            type: 'GET',
            success: function(result) {
                $('#total-price').html('$ ' + result);
            }
        });
    });
    // ---------------------- Validate Checkout Form ------------------ 
    //$('.process-button').prop("disabled", true);

    function cartInputValidate(formElem) {
        if (formElem.val().length == 0) {
            $('.process-button').prop("disabled", true);
            setTimeout(function() {
                $('.process-button').prop("disabled", false);
            }, 100);
            formElem.addClass('cart-form-error');
            formElem.parent().children('.error-block').text('Заполните данное поле.');
        } else {
            formElem.removeClass('cart-form-error');
            formElem.parent().children('.error-block').text('');
        }
    }

    function emailValidate(formElem) {
        var pattern = /^[a-z0-9_-]+@[a-z0-9-]+\.[a-z]{2,6}$/i;

        if (formElem.val().search(pattern) != 0) {
            $('.process-button').prop("disabled", true);
            setTimeout(function() {
                $('.process-button').prop("disabled", false);
            }, 100);
            formElem.addClass('cart-form-error');
            formElem.parent().children('.error-block').text('Введите корректный Email');
        } else {
            formElem.removeClass('cart-form-error');
            formElem.parent().children('.error-block').text('');
        }
    }

    $('.process-button').on('click', function() {
        var firstNameEl = $('#first'),
            lastNameEl = $('#last'),
            numberEl = $('#number'),
            emailEl = $('#email'),
            countryEl = $('#country_label'),
            regionEl = $('#region_label'),
            cityEl = $('#city_label'),
            firstAddEl = $('#add1'),
            secondAddEl = $('#add2');

        cartInputValidate(firstNameEl);
        cartInputValidate(lastNameEl);
        cartInputValidate(numberEl);
        cartInputValidate(emailEl);
        cartInputValidate(countryEl);
        cartInputValidate(regionEl);
        cartInputValidate(cityEl);
        cartInputValidate(firstAddEl);
        cartInputValidate(secondAddEl);
        emailValidate(emailEl);
    });




    // ======================= BLOG ========================
    $('.input-search').on('keypress', function(e) {
        if ($(this).val().length >= 2) {
            var value = $(this).val();

            $.ajax({
                url: '/blog/search',
                data: { value: value },
                type: 'GET',
                success: function(result) {
                    $('.blog_left_sidebar').html(result);
                }
            });
        }
    });
});