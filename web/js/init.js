// Replace .no-js class with .js
document.documentElement.className = document.documentElement.className.replace('no-js', 'js');

$(document).ready(function () {
	if ($('.body-login')[0]) {
		$('input').first().focus();
	}

	$('.submenu-select-dropdown').each(function () {
		$(this).wrap("<span class='submenu-select-wrapper'></span>");
		$(this).after("<span class='holder'></span>");
	});
	$('.submenu-select-dropdown')
		.change(function () {
			var selectedOption = $(this).find(':selected').text();
			$(this).next('.holder').text(selectedOption);
		})
		.trigger('change');
	$('.js-to-top').on('click', function () {
		$('html, body').animate({ scrollTop: 0 }, 'normal');
	});

	$('.button').on('click', function (evt) {
		var action = $(this).data('action');
		var id = $(this).data('id');
		if (action == 'submit' && document.getElementById(id)) {
			evt.preventDefault();
			$(document.getElementById(id)).submit();
		}
	});

	var isMobile = false; //initiate as false
	// device detection
	/* eslint-disable no-useless-escape */
	if (
		/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(
			navigator.userAgent
		) ||
		/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(
			navigator.userAgent.substr(0, 4)
		)
	) {
		isMobile = true;
		$('body').addClass('mobile');
	}
	/* eslint-enable no-useless-escape */

	$(window).scroll(function () {
		set_sticky_class();
	});

	$('.toolbar-right .sort-by').click(function () {
		$('.context-menu.sort-order').toggle();
	});

	// SEARCH BOX

	$('.toolbar-search .js-search-input').hover(
		function () {
			clearTimeout(VE.tmp.search_display_interval);
			clearTimeout(VE.tmp.search_hover_interval);
			VE.tmp.search_display_interval = setTimeout(function () {
				$('.js-search-input').addClass('activated');
			}, 150);
		},
		function () {
			clearTimeout(VE.tmp.search_display_interval);
			clearTimeout(VE.tmp.search_hover_interval);
			VE.tmp.search_hover_interval = setTimeout(function () {
				if (!VE.tmp.search_activated && !$('.js-search-input').val().length) {
					$('.js-search-input').removeClass('activated');
				}
			}, 600);
		}
	);

	$('.js-search-input').focus(function () {
		VE.tmp.search_activated = 1;
		clearTimeout(VE.tmp.search_hover_interval);
	});
	$('.js-search-input').blur(function () {
		VE.tmp.search_activated = 0;
		clearTimeout(VE.tmp.search_hover_interval);
		VE.tmp.search_hover_interval = setTimeout(function () {
			if (!$('.js-search-input').val().length) {
				$('.js-search-input').removeClass('activated');
			}
		}, 600);
	});

	// TIMER

	if ($('.movement.left').length) {
		VE.helpers.refresh_timer.right = $('.movement.right');
		VE.helpers.refresh_timer.left = $('.movement.left');
		VE.helpers.refresh_timer.start();

		$('.pause').click(function () {
			VE.helpers.refresh_timer.stop();
			$('.pause').addClass('u-hidden');
			$('.play').removeClass('u-hidden');
			$('.refresh-timer').addClass('paused');
		});

		$('.play').click(function () {
			VE.helpers.refresh_timer.start();
			$('.pause').removeClass('u-hidden');
			$('.play').addClass('u-hidden');
			$('.refresh-timer').removeClass('paused');
		});
	}

	// SORTING

	$('#vstobjects input, #vstobjects select, #vstobjects textarea').change(function () {
		VE.tmp.form_changed = 1;
	});

	$('.sort-order span').click(function () {
		$('.context-menu.sort-order').toggle();
		if ($(this).hasClass('active')) return;

		$('.sort-order span').removeClass('active');
		$(this).addClass('active');
		VE.tmp.sort_par = $(this).parent('li').attr('entity');
		VE.tmp.sort_as_int = $(this).parent('li').attr('sort_as_int');
		VE.tmp.sort_direction = $(this).hasClass('up') * 1 || -1;

		$('.toolbar .sort-by b').html($(this).parent('li').find('.name').html());
		$('.toolbar .sort-by i').removeClass('fa-arrow-up-a-z fa-arrow-down-a-z');
		$(this).hasClass('up')
			? $('.toolbar .sort-by i').addClass('fa-arrow-up-a-z')
			: $('.toolbar .sort-by i').addClass('fa-arrow-down-a-z');
		$('.units .l-unit')
			.sort(function (a, b) {
				if (VE.tmp.sort_as_int)
					return parseInt($(a).attr(VE.tmp.sort_par)) >= parseInt($(b).attr(VE.tmp.sort_par))
						? VE.tmp.sort_direction
						: VE.tmp.sort_direction * -1;
				else
					return $(a).attr(VE.tmp.sort_par) <= $(b).attr(VE.tmp.sort_par)
						? VE.tmp.sort_direction
						: VE.tmp.sort_direction * -1;
			})
			.appendTo('.l-center.units');
	});

	$('#objects').submit(function (e) {
		if (!e.originalEvent) {
			return;
		}
		e.preventDefault();
		$('.ch-toggle').each(function () {
			if ($(this).prop('checked')) {
				key = this.name;
				div = $('<input type="hidden" name="' + key + '" value="' + this.value + '">');
				$('#objects').append(div);
			}
		});

		$('#objects').submit();
		return false;
	});

	// Shortcuts

	shortcut.add(
		'Ctrl+Enter',
		function () {
			$('form#vstobjects').submit();
		},
		{
			type: 'keydown',
			propagate: false,
			disable_in_input: false,
			target: document,
		}
	);

	shortcut.add(
		'Ctrl+Backspace',
		function () {
			var redirect = $('a.button#btn-back').attr('href');
			if (VE.tmp.form_changed && redirect) {
				VE.helpers.createConfirmationDialog($('.js-confirm-dialog-redirect'), '', redirect);
			} else if ($('form#vstobjects .button.cancel')[0]) {
				location.href = $('form#vstobjects input.cancel')
					.attr('onclick')
					.replace("location.href='", '')
					.replace("'", '');
			} else if (redirect) {
				location.href = redirect;
			}
		},
		{
			type: 'keydown',
			propagate: false,
			disable_in_input: false,
			target: document,
		}
	);

	shortcut.add(
		'f',
		function () {
			$('.js-search-input').addClass('activated').focus();
		},
		{
			type: 'keydown',
			propagate: false,
			disable_in_input: true,
			target: document,
		}
	);

	$(window).on('keypress', function (evt) {
		var tag = evt.target.tagName.toLowerCase();
		if (evt.charCode == 97 && tag != 'input' && tag != 'textarea' && tag != 'selectbox') {
			evt.preventDefault();
			if (!evt.ctrlKey && !evt.shiftKey) {
				if ($('.button#btn-create').length) {
					location.href = $('.button#btn-create').attr('href');
				}
			} else {
				if ($('.l-unit .ch-toggle:eq(0)').prop('checked')) {
					$('.l-unit').removeClass('selected');
					$('.l-unit .ch-toggle').prop('checked', false);
				} else {
					$('.l-unit').addClass('selected');
					$('.l-unit .ch-toggle').prop('checked', true);
				}
			}
		}
	});

	shortcut.add(
		'1',
		function () {
			var target = $('.main-menu .main-menu-item:nth-of-type(1) a');
			if (target.length != 1) {
				return;
			}
			if (VE.tmp.form_changed) {
				VE.helpers.createConfirmationDialog(
					$('.js-confirm-dialog-redirect'),
					'',
					target.attr('href')
				);
			} else {
				location.href = target.attr('href');
			}
		},
		{
			type: 'keydown',
			propagate: false,
			disable_in_input: true,
			target: document,
		}
	);

	shortcut.add(
		'2',
		function () {
			var target = $('.main-menu .main-menu-item:nth-of-type(2) a');
			if (target.length != 1) {
				return;
			}
			if (VE.tmp.form_changed) {
				VE.helpers.createConfirmationDialog(
					$('.js-confirm-dialog-redirect'),
					'',
					target.attr('href')
				);
			} else {
				location.href = target.attr('href');
			}
		},
		{
			type: 'keydown',
			propagate: false,
			disable_in_input: true,
			target: document,
		}
	);

	shortcut.add(
		'3',
		function () {
			var target = $('.main-menu .main-menu-item:nth-of-type(3) a');
			if (target.length != 1) {
				return;
			}
			if (VE.tmp.form_changed) {
				VE.helpers.createConfirmationDialog(
					$('.js-confirm-dialog-redirect'),
					'',
					target.attr('href')
				);
			} else {
				location.href = target.attr('href');
			}
		},
		{
			type: 'keydown',
			propagate: false,
			disable_in_input: true,
			target: document,
		}
	);

	shortcut.add(
		'4',
		function () {
			var target = $('.main-menu .main-menu-item:nth-of-type(4) a');
			if (target.length != 1) {
				return;
			}
			if (VE.tmp.form_changed) {
				VE.helpers.createConfirmationDialog(
					$('.js-confirm-dialog-redirect'),
					'',
					target.attr('href')
				);
			} else {
				location.href = target.attr('href');
			}
		},
		{
			type: 'keydown',
			propagate: false,
			disable_in_input: true,
			target: document,
		}
	);

	shortcut.add(
		'5',
		function () {
			var target = $('.main-menu .main-menu-item:nth-of-type(5) a');
			if (target.length != 1) {
				return;
			}
			if (VE.tmp.form_changed) {
				VE.helpers.createConfirmationDialog(
					$('.js-confirm-dialog-redirect'),
					'',
					target.attr('href')
				);
			} else {
				location.href = target.attr('href');
			}
		},
		{
			type: 'keydown',
			propagate: false,
			disable_in_input: true,
			target: document,
		}
	);

	shortcut.add(
		'6',
		function () {
			var target = $('.main-menu .main-menu-item:nth-of-type(6) a');
			if (target.length != 1) {
				return;
			}
			if (VE.tmp.form_changed) {
				VE.helpers.createConfirmationDialog(
					$('.js-confirm-dialog-redirect'),
					'',
					target.attr('href')
				);
			} else {
				location.href = target.attr('href');
			}
		},
		{
			type: 'keydown',
			propagate: false,
			disable_in_input: true,
			target: document,
		}
	);

	shortcut.add(
		'7',
		function () {
			var target = $('.main-menu .main-menu-item:nth-of-type(7) a');
			if (target.length != 1) {
				return;
			}
			if (VE.tmp.form_changed) {
				VE.helpers.createConfirmationDialog(
					$('.js-confirm-dialog-redirect'),
					'',
					target.attr('href')
				);
			} else {
				location.href = target.attr('href');
			}
		},
		{
			type: 'keydown',
			propagate: false,
			disable_in_input: true,
			target: document,
		}
	);

	shortcut.add(
		'h',
		function () {
			var shortcutsDialog = document.querySelector('.shortcuts');
			if (shortcutsDialog.open) {
				shortcutsDialog.close();
			} else {
				shortcutsDialog.showModal();
			}
		},
		{
			type: 'keydown',
			propagate: false,
			disable_in_input: true,
			target: document,
		}
	);

	shortcut.add(
		'Esc',
		function () {
			var shortcutsDialog = document.querySelector('.shortcuts');
			if (shortcutsDialog.open) {
				shortcutsDialog.close();
			}
			$('input, checkbox, textarea, select').blur();
		},
		{
			type: 'keydown',
			propagate: false,
			disable_in_input: false,
			target: document,
		}
	);

	shortcut.add(
		'Left',
		function () {
			VE.navigation.move_focus_left();
		},
		{
			type: 'keydown',
			propagate: false,
			disable_in_input: true,
			target: document,
		}
	);

	shortcut.add(
		'Right',
		function () {
			VE.navigation.move_focus_right();
		},
		{
			type: 'keydown',
			propagate: false,
			disable_in_input: true,
			target: document,
		}
	);

	shortcut.add(
		'down',
		function () {
			VE.navigation.move_focus_down();
		},
		{
			type: 'keydown',
			propagate: false,
			disable_in_input: true,
			target: document,
		}
	);

	shortcut.add(
		'up',
		function () {
			VE.navigation.move_focus_up();
		},
		{
			type: 'keydown',
			propagate: false,
			disable_in_input: true,
			target: document,
		}
	);

	shortcut.add(
		'l',
		function () {
			var elm = $('.units.active .l-unit.focus .shortcut-l');
			if (elm.length) {
				VE.navigation.shortcut(elm);
			}
		},
		{
			type: 'keydown',
			propagate: false,
			disable_in_input: true,
			target: document,
		}
	);

	shortcut.add(
		's',
		function () {
			var elm = $('.units.active .l-unit.focus .shortcut-s');
			if (elm.length) {
				VE.navigation.shortcut(elm);
			}
		},
		{
			type: 'keydown',
			propagate: false,
			disable_in_input: true,
			target: document,
		}
	);

	shortcut.add(
		'w',
		function () {
			var elm = $('.units.active .l-unit.focus .shortcut-w');
			if (elm.length) {
				VE.navigation.shortcut(elm);
			}
		},
		{
			type: 'keydown',
			propagate: false,
			disable_in_input: true,
			target: document,
		}
	);

	shortcut.add(
		'd',
		function () {
			var elm = $('.units.active .l-unit.focus .shortcut-d');
			if (elm.length) {
				VE.navigation.shortcut(elm);
			}
		},
		{
			type: 'keydown',
			propagate: false,
			disable_in_input: true,
			target: document,
		}
	);

	shortcut.add(
		'r',
		function () {
			var elm = $('.units.active .l-unit.focus .shortcut-r');
			if (elm.length) {
				VE.navigation.shortcut(elm);
			}
		},
		{
			type: 'keydown',
			propagate: false,
			disable_in_input: true,
			target: document,
		}
	);

	shortcut.add(
		'n',
		function () {
			var elm = $('.units.active .l-unit.focus .shortcut-n');
			if (elm.length) {
				VE.navigation.shortcut(elm);
			}
		},
		{
			type: 'keydown',
			propagate: false,
			disable_in_input: true,
			target: document,
		}
	);

	shortcut.add(
		'u',
		function () {
			var elm = $('.units.active .l-unit.focus .shortcut-u');
			if (elm.length) {
				VE.navigation.shortcut(elm);
			}
		},
		{
			type: 'keydown',
			propagate: false,
			disable_in_input: true,
			target: document,
		}
	);

	shortcut.add(
		'Delete',
		function () {
			var elm = $('.units.active .l-unit.focus .shortcut-delete');
			if (elm.length) {
				VE.navigation.shortcut(elm);
			}
		},
		{
			type: 'keydown',
			propagate: false,
			disable_in_input: true,
			target: document,
		}
	);

	shortcut.add(
		'Enter',
		function (evt) {
			if (evt.target.tagName == 'INPUT' && evt.target.form.id == 'vstobjects') {
				$('form#vstobjects').submit();
			}

			if (VE.tmp.form_changed) {
				if (!$('.ui-dialog').is(':visible')) {
					VE.helpers.createConfirmationDialog(
						$('.js-confirm-dialog-redirect')[0],
						'',
						$(VE.navigation.state.menu_selector + '.focus a').attr('href')
					);
				} else {
					// if dialog is opened - submitting confirm box by "enter" shortcut
					$('.ui-dialog button.submit').click();
				}
			} else {
				if (!$('.ui-dialog').is(':visible')) {
					var elm = $('.units.active .l-unit.focus .shortcut-enter');
					if (elm.length) {
						VE.navigation.shortcut(elm);
					} else {
						VE.navigation.enter_focused();
					}
				} else {
					// if dialog is opened - submitting confirm box by "enter" shortcut
					$('.ui-dialog button.submit').click();
				}
			}
		},
		{
			type: 'keydown',
			propagate: true,
			disable_in_input: false,
			target: document,
		}
	);

	$('.shortcuts-close').on('click', function () {
		var shortcutsDialog = document.querySelector('.shortcuts');
		if (shortcutsDialog.open) {
			shortcutsDialog.close();
		}
	});

	$('.js-shortcuts').on('click', function () {
		event.preventDefault();
		var shortcutsDialog = document.querySelector('.shortcuts');
		if (shortcutsDialog.open) {
			shortcutsDialog.close();
		} else {
			shortcutsDialog.showModal();
		}
	});

	$(document).click(function (evt) {
		//close notification popup
		if (
			!$(evt.target).hasClass('js-notifications') &&
			$(evt.target).parents('ul.notification-container').length == 0
		) {
			$('.notification-container').addClass('u-hidden');
			$('.js-notifications').removeClass('active');
		}
	});

	// focusing on the first input at form
	if (location.href.indexOf('lead=') == -1 && !$('.ui-dialog').is(':visible')) {
		$('#vstobjects .form-control:not([disabled]), #vstobjects .form-select:not([disabled])')
			.first()
			.focus();
	}

	$('.js-notifications').click(function (evt) {
		if (!$('.js-notifications').hasClass('active')) {
			VE.notifications.get_list();
			$('.js-notifications').addClass('active');
		} else {
			$('.notification-container').addClass('u-hidden');
			$('.js-notifications').removeClass('active');
		}
	});

	$('.js-toggle-top-bar-menu').click(function (evt) {
		$(this).siblings('.top-bar-nav-list').toggle();
	});

	$('.button').attr('title', 'ctrl+Enter');
	$('.button.cancel').attr('title', 'ctrl+Backspace');

	VE.core.register();
	if (location.href.search(/list/) != -1) {
		var shift_select_ref = $('body').finderSelect({
			children: '.l-unit',
			onFinish: function (evt) {
				if (
					$('.l-content').find('.l-unit.selected').length == $('.l-content').find('.l-unit').length
				) {
					$('.toggle-all').addClass('clicked-on');
				}
			},
			toggleAllHook: function () {
				if ($('.l-unit').length == $('.ch-toggle:checked').length) {
					$('.l-unit.selected').removeClass('selected');
					$('.ch-toggle').prop('checked', false);
					$('#toggle-all').prop('checked', false);
				} else {
					$('.ch-toggle').prop('checked', true);
					$('#toggle-all').prop('checked', true);
				}
			},
		});

		$('table').on('mousedown', 'td', function (e) {
			if (e.ctrlKey) {
				e.preventDefault();
			}
		});
	}

	//
	$('form#objects').on('submit', function (evt) {
		$('.l-unit').find('.ch-toggle').prop('checked', false);
		$('.l-unit.selected').find('.ch-toggle').prop('checked', true);
	});
	// todo: maybe give the save button id?
	$('.button[data-id=vstobjects][data-action=submit]').on('click', function (ev) {
		let loadingAnimationEle = document.createElement('div');
		loadingAnimationEle.className = 'spinner';
		loadingAnimationEle.innerHTML =
			'<div class="spinner-inner"></div><div class="spinner-mask"></div> <div class="spinner-mask-two"></div>';

		// this both gives an indication that we've clicked and is loading, also prevents double-clicking/clicking-on-something-else while loading.
		$('.button[data-id=vstobjects][data-action=submit]').replaceWith(loadingAnimationEle);
		$('.button').replaceWith('');
		// workaround a render bug on Safari (loading icon doesn't render without this)
		ev.preventDefault();
		$('#vstobjects').submit();
	});
});

/**
 * generates a random string
 * using a cryptographically secure rng,
 * and ensuring it contains at least 1 lowercase, 1 uppercase, and 1 number.
 *
 * @param int length
 * @throws Error if length is too small to create a "sufficiently secure" string
 * @returns string
 */
function randomString2(length = 16) {
	var chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
	var secure_rng = function (min, max) {
		if (min < 0 || min > 0xffff) {
			throw new Error(
				'minimum supported number is 0, this generator can only make numbers between 0-65535 inclusive.'
			);
		}
		if (max > 0xffff || max < 0) {
			throw new Error(
				'max supported number is 65535, this generator can only make numbers between 0-65535 inclusive.'
			);
		}
		if (min > max) {
			throw new Error('dude min>max wtf');
		}
		// micro-optimization
		let randArr = max > 255 ? new Uint16Array(1) : new Uint8Array(1);
		let ret;
		let attempts = 0;
		for (;;) {
			crypto.getRandomValues(randArr);
			ret = randArr[0];
			if (ret >= min && ret <= max) {
				return ret;
			}
			++attempts;
			if (attempts > 1000000) {
				// should basically never happen with max 0xFFFF/Uint16Array.
				throw new Error('tried a million times, something is wrong');
			}
		}
	};
	let attempts = 0;
	let minimumStrengthRegex = new RegExp(
		/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\d)[a-zA-Z\d]{8,}$/
	);
	let randmax = chars.length - 1;
	for (;;) {
		let ret = '';
		for (let i = 0; i < length; ++i) {
			ret += chars[secure_rng(0, randmax)];
		}
		if (minimumStrengthRegex.test(ret)) {
			return ret;
		}
		++attempts;
		if (attempts > 1000000) {
			throw new Error('tried a million times, something is wrong');
		}
	}
}
