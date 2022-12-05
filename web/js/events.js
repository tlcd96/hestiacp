// Init kinda namespace object
var VE = {
	// Hestia Events object
	core: {}, // core functions
	navigation: {
		state: {
			active_menu: 1,
			menu_selector: '.main-menu-item',
			menu_active_selector: '.active',
		},
	}, // menu and element navigation functions
	notifications: {},
	callbacks: {
		// events callback functions
		click: {},
		mouseover: {},
		mouseout: {},
		keypress: {},
	},
	helpers: {}, // simple handy methods
	tmp: {
		sort_par: 'sort-name',
		sort_direction: -1,
		sort_as_int: 0,
		form_changed: 0,
		search_activated: 0,
		search_display_interval: 0,
		search_hover_interval: 0,
	},
};

/*
 * Main method that invokes further event processing
 * @param root is root HTML DOM element that. Pass HTML DOM Element or css selector
 * @param event_type (eg: click, mouseover etc..)
 */
VE.core.register = function (root, event_type) {
	var root = !root ? 'body' : root; // if elm is not passed just bind events to body DOM Element
	var event_type = !event_type ? 'click' : event_type; // set event type to "click" by default
	$(root).bind(event_type, function (evt) {
		var elm = $(evt.target);
		VE.core.dispatch(evt, elm, event_type); // dispatch captured event
	});
};

/*
 * Dispatch event that was previously registered
 * @param evt related event object
 * @param elm that was catched
 * @param event_type (eg: click, mouseover etc..)
 */
VE.core.dispatch = function (evt, elm, event_type) {
	if ('undefined' == typeof VE.callbacks[event_type]) {
		return VE.helpers.warn(
			'There is no corresponding object that should contain event callbacks for "' +
				event_type +
				'" event type'
		);
	}
	// get class of element
	var classes = $(elm).attr('class');
	// if no classes are attached, then just stop any further processings
	if (!classes) {
		return; // no classes assigned
	}
	// split the classes and check if it related to function
	$(classes.split(/\s/)).each(function (i, key) {
		VE.callbacks[event_type][key] && VE.callbacks[event_type][key](evt, elm);
	});
};

//
//  CALLBACKS
//

/*
 * Suspend action
 */
VE.callbacks.click.do_suspend = function (evt, elm) {
	var ref = elm.hasClass('actions-panel') ? elm : elm.parents('.actions-panel');
	var url = $('input[name="suspend_url"]', ref).val();
	var dialog_elm = ref.find('.js-confirm-dialog-suspend');
	VE.helpers.createConfirmationDialog(dialog_elm, $(elm).parent().attr('title'), url);
};

/*
 * Unsuspend action
 */
VE.callbacks.click.do_unsuspend = function (evt, elm) {
	var ref = elm.hasClass('actions-panel') ? elm : elm.parents('.actions-panel');
	var url = $('input[name="unsuspend_url"]', ref).val();
	var dialog_elm = ref.find('.js-confirm-dialog-suspend');
	VE.helpers.createConfirmationDialog(dialog_elm, $(elm).parent().attr('title'), url);
};

/*
 * Delete action
 */
VE.callbacks.click.do_delete = function (evt, elm) {
	var ref = elm.hasClass('actions-panel') ? elm : elm.parents('.actions-panel');
	var url = $('input[name="delete_url"]', ref).val();
	var dialog_elm = ref.find('.js-confirm-dialog-delete');
	VE.helpers.createConfirmationDialog(dialog_elm, $(elm).parent().attr('title'), url);
};

VE.callbacks.click.do_servicerestart = function (evt, elm) {
	var ref = elm.hasClass('actions-panel') ? elm : elm.parents('.actions-panel');
	var url = $('input[name="servicerestart_url"]', ref).val();
	var dialog_elm = ref.find('.js-confirm-dialog-servicerestart');
	VE.helpers.createConfirmationDialog(dialog_elm, $(elm).parent().attr('title'), url);
};

VE.callbacks.click.do_servicestop = function (evt, elm) {
	var ref = elm.hasClass('actions-panel') ? elm : elm.parents('.actions-panel');
	var url = $('input[name="servicestop_url"]', ref).val();
	var dialog_elm = ref.find('.js-confirm-dialog-servicestop');
	VE.helpers.createConfirmationDialog(dialog_elm, $(elm).parent().attr('title'), url);
};

/*
 * Create dialog box on the fly
 * @param elm Element which contains the dialog contents
 * @param dialog_title
 * @param confirmed_location_url URL that will be redirected to if user hit "OK"
 * @param custom_config Custom configuration parameters passed to dialog initialization (optional)
 */
VE.helpers.createConfirmationDialog = function (
	elm,
	dialog_title,
	confirmed_location_url,
	custom_config
) {
	var custom_config = !custom_config ? {} : custom_config;
	var config = {
		modal: true,
		//autoOpen: true,
		resizable: false,
		width: 360,
		title: dialog_title,
		close: function () {
			$(this).dialog('destroy');
		},
		buttons: {
			OK: function (event, ui) {
				location.href = confirmed_location_url;
			},
			Cancel: function () {
				$(this).dialog('close');
			},
		},
		create: function () {
			var buttonGroup = $(this).closest('.ui-dialog').find('.ui-dialog-buttonset');
			buttonGroup.find('button:first').addClass('button submit');
			buttonGroup.find('button:last').addClass('button button-secondary cancel');
		},
	};

	var reference_copied = $(elm[0]).clone();
	config = $.extend(config, custom_config);
	$(reference_copied).dialog(config);
};

/*
 * Simple debug output
 */
VE.helpers.warn = function (msg) {
	alert('WARNING: ' + msg);
};

VE.helpers.extendPasswordFields = function () {
	var references = ['.js-password-input'];

	$(document).ready(function () {
		$(references).each(function (i, ref) {
			VE.helpers.initAdditionalPasswordFieldElements(ref);
		});
	});
};

VE.helpers.initAdditionalPasswordFieldElements = function (ref) {
	var enabled = $.cookie('hide_passwords') == '1' ? true : false;
	if (enabled) {
		VE.helpers.hidePasswordFieldText(ref);
	}

	$(ref).prop('autocomplete', 'off');

	var enabled_html = enabled ? '' : 'show-passwords-enabled-action';
	var html =
		'<span class="toggle-password"><i class="toggle-psw-visibility-icon fas fa-eye-slash ' +
		enabled_html +
		'" onclick="VE.helpers.toggleHiddenPasswordText(\'' +
		ref +
		'\', this)"></i></span>';
	$(ref).after(html);
};

VE.helpers.hidePasswordFieldText = function (ref) {
	$.cookie('hide_passwords', '1', { expires: 365, path: '/' });
	$(ref).prop('type', 'password');
};

VE.helpers.revealPasswordFieldText = function (ref) {
	$.cookie('hide_passwords', '0', { expires: 365, path: '/' });
	$(ref).prop('type', 'text');
};

VE.helpers.toggleHiddenPasswordText = function (ref, triggering_elm) {
	$(triggering_elm).toggleClass('show-passwords-enabled-action');

	if ($(ref).prop('type') == 'text') {
		VE.helpers.hidePasswordFieldText(ref);
	} else {
		VE.helpers.revealPasswordFieldText(ref);
	}
};

var reloadTimer = 150;
var reloadFunction = '';

//$(document).ready(startTime);
function startTime() {
	if ($('.spinner')[0]) {
		reloadFunction = setInterval(updateInterval, 100);
	}
}

function updateInterval() {
	reloadTimer = reloadTimer - 1;
	if (reloadTimer == 0) {
		location.reload();
	}
}

function stopTimer() {
	if (reloadFunction) {
		clearInterval(reloadFunction);
		reloadFunction = false;
		$('.spinner').addClass('paused');
		$('.pause-stop i').removeClass('fa-pause');
		$('.pause-stop i').addClass('fa-play');
	} else {
		reloadFunction = setInterval(updateInterval, 100);
		$('.spinner').removeClass('paused');
		$('.pause-stop i').removeClass('fa-play');
		$('.pause-stop i').addClass('fa-pause');
	}
}

VE.navigation.enter_focused = function () {
	if ($('.units').hasClass('active')) {
		location.href = $('.units.active .l-unit.focus .actions-panel__col.actions-panel__edit a').attr(
			'href'
		);
	} else {
		if ($(VE.navigation.state.menu_selector + '.focus a').attr('href')) {
			location.href = $(VE.navigation.state.menu_selector + '.focus a').attr('href');
		}
	}
};

VE.navigation.move_focus_left = function () {
	var index = parseInt(
		$(VE.navigation.state.menu_selector).index($(VE.navigation.state.menu_selector + '.focus'))
	);
	if (index == -1)
		index = parseInt(
			$(VE.navigation.state.menu_selector).index($(VE.navigation.state.menu_active_selector))
		);

	if ($('.units').hasClass('active')) {
		$('.units').removeClass('active');
		index++;
	}

	$(VE.navigation.state.menu_selector).removeClass('focus');

	if (index > 0) {
		$($(VE.navigation.state.menu_selector)[index - 1]).addClass('focus');
	} else {
		VE.navigation.switch_menu('last');
	}
};

VE.navigation.move_focus_right = function () {
	var max_index = $(VE.navigation.state.menu_selector).length - 1;
	var index = parseInt(
		$(VE.navigation.state.menu_selector).index($(VE.navigation.state.menu_selector + '.focus'))
	);
	if (index == -1)
		index =
			parseInt(
				$(VE.navigation.state.menu_selector).index($(VE.navigation.state.menu_active_selector))
			) || 0;
	$(VE.navigation.state.menu_selector).removeClass('focus');

	if ($('.units').hasClass('active')) {
		$('.units').removeClass('active');
		index--;
	}

	if (index < max_index) {
		$($(VE.navigation.state.menu_selector)[index + 1]).addClass('focus');
	} else {
		VE.navigation.switch_menu('first');
	}
};

VE.navigation.move_focus_down = function () {
	var max_index = $('.units .l-unit:not(.header)').length - 1;
	var index = parseInt($('.units .l-unit').index($('.units .l-unit.focus')));

	if (index < max_index) {
		$('.units .l-unit.focus').removeClass('focus');
		$($('.units .l-unit:not(.header)')[index + 1]).addClass('focus');

		$('html, body').animate(
			{
				scrollTop: $('.units .l-unit.focus').offset().top - 200,
			},
			200
		);
	}
};

VE.navigation.move_focus_up = function () {
	var index = parseInt($('.units .l-unit:not(.header)').index($('.units .l-unit.focus')));

	if (index == -1) index = 0;

	if (index > 0) {
		$('.units .l-unit.focus').removeClass('focus');
		$($('.units .l-unit:not(.header)')[index - 1]).addClass('focus');

		$('html, body').animate(
			{
				scrollTop: $('.units .l-unit.focus').offset().top - 200,
			},
			200
		);
	}
};

VE.navigation.switch_menu = function (position) {
	position = position || 'first'; // last

	if (VE.navigation.state.active_menu == 0) {
		VE.navigation.state.active_menu = 1;
		VE.navigation.state.menu_selector = '.main-menu-item';
		VE.navigation.state.menu_active_selector = '.active';

		if (position == 'first') {
			$($(VE.navigation.state.menu_selector)[0]).addClass('focus');
		} else {
			var max_index = $(VE.navigation.state.menu_selector).length - 1;
			$($(VE.navigation.state.menu_selector)[max_index]).addClass('focus');
		}
	}
};

VE.notifications.get_list = function () {
	/// TODO get notifications only once
	$.ajax({
		url: '/list/notifications/?ajax=1&token=' + $('#token').attr('token'),
		dataType: 'json',
	}).done(function (data) {
		var acc = [];

		$.each(data, function (i, elm) {
			var tpl = Tpl.get('notification', 'WEB');
			if (elm.ACK == 'no') tpl.set(':UNSEEN', 'unseen');
			else tpl.set(':UNSEEN', '');

			tpl.set(':ID', elm.ID);
			tpl.set(':TYPE', elm.TYPE);
			tpl.set(':TOPIC', elm.TOPIC);
			tpl.set(':NOTICE', elm.NOTICE);
			tpl.set(':TIME', elm.TIME);
			tpl.set(':DATE', elm.DATE);
			acc.push(tpl.finalize());
		});

		if (!Object.keys(data).length) {
			var tpl = Tpl.get('notification_empty', 'WEB');
			acc.push(tpl.finalize());
		}

		if (Object.keys(data).length > 2) {
			var tpl = Tpl.get('notification_mark_all', 'WEB');
			acc.push(tpl.finalize());
		}

		$('.top-bar-notifications-list').html(acc.done()).removeClass('u-hidden');

		$('.js-delete-notification').click(function (event) {
			event.preventDefault();
			var notificationId = $(this).closest('.top-bar-notification-item').attr('id');
			VE.notifications.delete(notificationId.replace('notification-', ''));
		});

		$('.js-mark-all-notifications').click(function (event) {
			event.preventDefault();
			VE.notifications.delete_all();
		});
	});
};

VE.notifications.delete = function (id) {
	$.ajax({
		url:
			'/delete/notification/?delete=1&notification_id=' +
			id +
			'&token=' +
			$('#token').attr('token'),
	});

	if ($('.top-bar-notification-item:visible').length == 1) {
		$('.js-notifications .status-icon').removeClass('status-icon');
		$('.js-notifications').removeClass('active').removeClass('updates');
		$('.js-mark-all-notifications').parent().fadeOut();
	}
	$('#notification-' + id).fadeOut();
};

VE.notifications.delete_all = function () {
	$.ajax({
		url: '/delete/notification/?delete=1&token=' + $('#token').attr('token'),
	});
	$('.top-bar-notification-item').fadeOut();
	$('.js-notifications .status-icon').removeClass('status-icon');
	$('.js-notifications').removeClass('updates');
	$('.js-mark-all-notifications').parent().fadeOut();
};

VE.navigation.shortcut = function (elm) {
	var action = elm.attr('key-action');

	if (action == 'js') {
		var e = elm.find('.data-controls');
		VE.core.dispatch(true, e, 'click');
	}
	if (action == 'href') {
		location.href = elm.find('a').attr('href');
	}
};

VE.helpers.extendPasswordFields();
