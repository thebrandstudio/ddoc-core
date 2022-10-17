/** @format */

(function ($, window) {
	'use strict';
	var $window = $(window);
	var drthWidgets = {
		LoadWidgets: function () {
			var e_front = elementorFrontend,
				e_module = elementorModules;

			var $proWidgets = {
				'droit-video_popup.default': '_video_popup',
				'ddoc-video-docs.default': '_video_popup',
				'droit-advance-accordions.default': '_dl_pro_accordions',
				'droit-advance_pricing.default': '_dl_pro_advance_pricing',
				'droit-tabs.default': '_dl_pro_tabs',
				'dladdons-testimonial-pro.default': '_dl_pro_advance_slider',
			};

			var widgetsMap = {
				'drth-test.default': drthWidgets.drth_test,
				'droit-video_popup.default': drthWidgets._video_popup,
				'ddoc-video-docs.default': drthWidgets._video_popup,
				'droit-advance-accordions.default': drthWidgets._dl_pro_accordions,
				'droit-advance_pricing.default': drthWidgets._dl_pro_advance_pricing,
				'droit-tabs.default': drthWidgets._dl_pro_tabs,
				'drth-tab.default': drthWidgets.__ddoc_tab,
				'drth-search.default': drthWidgets.__ddoc_search,
				'ddoc-login-form.default': drthWidgets.__ddoc_login,
				'ddoc-register-form.default': drthWidgets.__ddoc_registration,
				'dladdons-testimonial-pro.default': drthWidgets._dl_pro_advance_slider,
			};

			$.each(widgetsMap, function (name, callback) {
				if (dlth_theme.dl_pro == 'yes' && name in $proWidgets) {
				} else {
					e_front.hooks.addAction('frontend/element_ready/' + name, callback);
				}
			});
		},

		_video_popup: function ($scope) {
			var $selector = $scope.find('.droit-video-popup, .video-popup');
			if ($selector.length > 0) {
				$($selector).magnificPopup({
					type: 'iframe',
					mainClass: 'mfp-fade',
					removalDelay: 160,
					preloader: !0,
					fixedContentPos: !1,
				});
			}
		},

		_dl_pro_accordions: function ($scope) {
			var $accrodion = $scope.find('.dl_accordion');
			if ($accrodion.length > 0) {
				$accrodion
					.find('.dl_accordion_item.is-active')
					.children('.dl_accordion_panel')
					.slideDown();
				$accrodion.find('.dl_accordion_item').on('click', function () {
					// Cancel the siblings
					$(this)
						.siblings('.dl_accordion_item')
						.removeClass('is-active')
						.children('.dl_accordion_panel')
						.slideUp(500);
					// Toggle the item
					$(this)
						.toggleClass('is-active')
						.children('.dl_accordion_panel')
						.slideToggle('ease-out');
				});
			}
		},
		_dl_pro_advance_pricing: function ($scope) {
			var t = $scope.find('.dl_switcher_control-item'),
				h = $scope.find('.dl_switcher_content-item');
			// tab style
			t.click(function (e) {
				e.preventDefault();
				var $this = $(this);

				// close all switcher active class
				t.each(function () {
					let $self = $(this);
					$self.removeClass('on-select');
				});

				// close all content tab
				h.each(function () {
					let $self = $(this);
					$self.removeClass('on-active');
				});

				// selector content
				let $target = $this.data('target');
				let $content = $scope.find('[data-toggle=' + $target + ']');
				$content.addClass('on-active');
				// selected tab
				$this.addClass('on-select');
			});

			// switch style
			var s = $scope.find('.dl_toggle');
			s.click(function (e) {
				e.preventDefault();
				var $this = $(this);
				$this.toggleClass('dl-active');
				$this.parents('.dl_switcher_control').toggleClass('dl-active');

				// content
				h.each(function () {
					let $self = $(this);
					$self.toggleClass('on-active');
				});
			});
		},
		_dl_pro_tabs: function ($scope, t, e) {
			var a = '#' + $scope.find('.dl_tab_container').attr('id').toString();
			t(a + ' ul.dl_tab_menu > li').each(function (e) {
				t(this).hasClass('active-default')
					? (t(a + ' ul.dl_tab_menu > li')
							.removeClass('dl_active')
							.addClass('dl_inactive'),
					  t(this).removeClass('dl_inactive'))
					: 0 == e && t(this).removeClass('dl_inactive').addClass('dl_active');
			}),
				t(a + ' .tab_container div').each(function (e) {
					t(this).hasClass('active-default')
						? t(a + ' .tab_container > div').removeClass('dl_active')
						: 0 == e &&
						  t(this).removeClass('dl_inactive').addClass('dl_active');
				}),
				t(a + ' ul.dl_tab_menu > li').click(function () {
					var e = t(this).index(),
						a = t(this).closest('.droit-advance-tabs'),
						n = t(a).children('.droit-tabs-nav').children('ul').children('li'),
						i = t(a).children('.tab_container').children('div');
					t(this).parent('li').addClass('dl_active'),
						t(n)
							.removeClass('dl_active active-default')
							.addClass('dl_inactive'),
						t(this).addClass('dl_active').removeClass('dl_inactive'),
						t(i).removeClass('dl_active').addClass('dl_inactive'),
						t(i).eq(e).addClass('dl_active').removeClass('dl_inactive');
					t(i).each(function (e) {
						t(this).removeClass('active-default');
					});
				});
		},


		_dl_pro_advance_slider: function ($scope) {
			var $slider = $scope.find('.dl_pro_testimonial_slider'),
				$item = $scope.find('.swiper-slide'),
				$dat = $slider.data('settings');

			// let $breakPoints = $dat.breakpoints ? $dat.breakpoints : {};

			// render slider
			new Swiper($slider, $dat);

			// auto slider
			if ($dat.dl_mouseover) {
				$slider.hover(
					function () {
						this.swiper.autoplay.stop();
					},
					function () {
						this.swiper.autoplay.start();
					}
				);
			}

			if ($dat.dl_autoplay) {
				$slider.each(function () {
					this.swiper.autoplay.start();
				});
			} else {
				$slider.each(function () {
					this.swiper.autoplay.stop();
				});
			}

			let $delay = $dat.speed;
			if ($dat.autoplay) {
				$delay = $dat.autoplay.delay;
			}

			// window.addEventListener('resize', function () {
			// 	droitElementsPro.autoloadMedia($breakPoints, $scope);
			// });
			// auto load media
			// droitElementsPro.autoloadMedia($breakPoints, $scope);
		},

		//  ddoc tab
		__ddoc_tab($scope) {
			let button = $scope.find('.dt_doc_tab_content > ul >li');

			button.on('click', function (e) {
            	e.preventDefault();
				let contentId = $(this).data('id');
				$(this).find('a').addClass('active');
				$(this).siblings('li').find('a').removeClass('active');
				console.log($(this).parent());

				$(contentId).fadeIn();
				$(contentId).siblings().hide();
			});
		},
		//  ddoc ajax search
		__ddoc_search: function ($scope) {
			$(document).on('click', '.ddoc-doc-ajax-search', function (e) {
				e.preventDefault();
				let keyWord = $('.ddoc-keyworkd-imports').val();
				if (keyWord === '') {
					alert('Please Type something on search fields');
					return false;
				}
				let cat = $('.category-select').val();
				let catVal = '';

				if (cat !== 'Category') {
					catVal = cat;
				}
				var data = {
					action: 'ddoc_search_doc',
					keyword: keyWord,
					cat: catVal,
				};
				// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
				jQuery.post(dlth_theme.ajax_url, data, function (response) {
					$('.ddoc-live-search').removeClass('d-none');
					$('.ddoc-live-search').html(response);
					console.log(response);
				});
			});
			$(document).on('keyup', '.ddoc-keyworkd-imports', function () {
				let keyWord = $(this).val();
				var data = {
					action: 'ddoc_search_doc',
					keyword: keyWord,
				};

				// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
				jQuery.post(dlth_theme.ajax_url, data, function (response) {
					$('.ddoc-live-search').removeClass('d-none');
					$('.ddoc-live-search').html(response);
				});
			});
			// search suggestion

			$('.search-suggation span').on('click', function () {
				let keyWordget = $(this).text();
				console.log(keyWordget);
				$('.ddoc-keyworkd-imports').val(keyWordget);
				$('.ddoc-doc-ajax-search').trigger('click');
			});

			if ($('.category-select').length > 0) {
				$('.category-select').niceSelect();
			}
		},
		// login form with ajax
		__ddoc_login: function ($scope) {
			$(document).on('click', '.ddoc-login', function () {
				let buttonContent = $(this).find('span');
				buttonContent.removeClass('d-none');
				let userData = {
					userEmail: $('.ddoc-login-from .ddoc-user').val(),
					userPass: $('.ddoc-login-from .ddoc-user-pass').val(),
					remember: $('.ddoc-remember-me').is(':checked') ? 'true' : 'false',
				};
				var data = {
					action: 'ddoc_ajax_login_form',
					user_data: userData,
					security: dlth_theme.wp_nonce,
				};
				// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
				jQuery.post(dlth_theme.ajax_url, data, function (response) {
					buttonContent.addClass('d-none');
					$('.success-login').html(response);
					let success = JSON.parse(response);
					let arr = $.map(success, function (n, i) {
						return '<li>' + n + '</li>';
					});
					$('.success-login').html(arr.join(' '));
					if (success.login_success == 'Login Successfull') {
						// location.reload();
						window.location.href = success.login_success_url;
					}
				});
			});
		},
		__ddoc_registration: function ($scope) {
			$(document).on('click', '.ddoc-registration', function () {
				if ($('.ddoc-registration-from .ddoc-user-login').val() == '') {
					alert('User Name is required');
					return false;
				}
				let userData = {
					dispaly_name: $('.ddoc-registration-from .ddoc-registration').val(),
					user_login: $('.ddoc-registration-from .ddoc-user-login').val(),
					user_email: $('.ddoc-registration-from .ddoc-user-email').val(),
					user_pass: $('.ddoc-registration-from .ddoc-user-pas').val(),
				};
				var data = {
					action: 'ddoc_ajax_registraion_form',
					user_data: userData,
					security: dlth_theme.wp_nonce,
				};
				// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
				jQuery.post(dlth_theme.ajax_url, data, function (response) {
					let success = JSON.parse(response);
					let arr = $.map(success, function (n, i) {
						return '<li>' + n + '</li>';
					});
					$('.success-registration').html(arr.join(' '));
				});
			});
		},
	};
	function _dl_pro_count_down_redirect(url) {
		window.location.replace(url);
	}
	// load elementor
	$window.on('elementor/frontend/init', drthWidgets.LoadWidgets);
})(jQuery, window);