applyRandomString = function (min_length = 16) {
	$('input[name=v_password]').val(randomString2(min_length));
	App.Actions.WEB.update_password_meter();
};

App.Actions.WEB.update_password_meter = function () {
	var password = $('input[name="v_password"]').val();
	var min_small = new RegExp(/^(?=.*[a-z]).+$/);
	var min_cap = new RegExp(/^(?=.*[A-Z]).+$/);
	var min_num = new RegExp(/^(?=.*\d).+$/);
	var min_length = 8;
	var score = 0;
	if (password.length >= min_length) {
		score = score + 1;
	}
	if (min_small.test(password)) {
		score = score + 1;
	}
	if (min_cap.test(password)) {
		score = score + 1;
	}
	if (min_num.test(password)) {
		score = score + 1;
	}
	$('.password-meter').val(score);
};

App.Listeners.WEB.keypress_v_password = function () {
	var ref = $('input[name="v_password"]');
	ref.bind('keypress input', function (evt) {
		clearTimeout(window.frp_usr_tmt);
		window.frp_usr_tmt = setTimeout(function () {
			var elm = $(evt.target);
			App.Actions.WEB.update_password_meter(elm, $(elm).val());
		}, 100);
	});
};
App.Listeners.WEB.keypress_v_password();

$(document).ready(function () {
	$('.js-add-ns-button').click(function () {
		var n = $('input[name^=v_ns]').length;
		if (n < 8) {
			var t = $($('input[name=v_ns1]').parents('div')[0]).clone(true, true);
			t.find('input').attr({ value: '', name: 'v_ns' + (n + 1) });
			t.find('span').show();
			$('.js-add-ns').before(t);
		}
		if (n == 7) {
			$('.js-add-ns').addClass('u-hidden');
		}
	});

	$('.js-remove-ns').click(function () {
		$(this).parents('div')[0].remove();
		$('input[name^=v_ns]').each(function (i, ns) {
			$(ns).attr({ name: 'v_ns' + (i + 1) });
			i < 2 ? $(ns).parent().find('span').hide() : $(ns).parent().find('span').show();
		});
		$('.js-add-ns').removeClass('u-hidden');
	});

	$('input[name^=v_ns]').each(function (i, ns) {
		i < 2 ? $(ns).parent().find('span').hide() : $(ns).parent().find('span').show();
	});
});
