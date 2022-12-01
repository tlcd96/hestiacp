(function ($) {
	var doc = $(document);
	doc
		.on(
			'click',
			'.menu-toggle-square, aside.menu .backdrop, .js_control>span[data-action]',
			function (e) {
				e.preventDefault();
				e.stopPropagation();
				e.stopImmediatePropagation();
				e.originalEvent.stopImmediatePropagation();
				var t = $(this);
				var action = t.attr('data-action');
				switch (action) {
					case 'menu-left-open':
						var aside = $('aside.menu.left');
						if (!aside.hasClass('active')) {
							aside.addClass('active');
						}
						break;
					case 'menu-right-open':
						var aside = $('aside.menu.right');
						if (!aside.hasClass('active')) {
							aside.addClass('active');
						}
						break;
					case 'close-right-menu':
					case 'menu-right-close':
						var aside = $('aside.menu.right');
						if (aside.hasClass('active')) {
							aside.removeClass('active');
						}
						var ul = aside.find('.sub-menu.active');
						ul.each(function () {
							var u = $(this);
							u.removeClass('active');
							var i = u.prev().children('.box-icon');
							i.removeClass('active');
							i.attr('data-action', 'open-submenu');
						});
						break;
					case 'close-left-menu':
					case 'menu-left-close':
						var aside = $('aside.menu.left');
						if (aside.hasClass('active')) {
							aside.removeClass('active');
						}
						var ul = aside.find('.sub-menu.active');
						ul.each(function () {
							var u = $(this);
							u.removeClass('active');
							var i = u.prev().children('.box-icon');
							i.removeClass('active');
							i.attr('data-action', 'open-submenu');
						});
						break;
				}
			}
		)
		.on(
			'click',
			'.box-icon[data-action="open-submenu"],.box-icon[data-action="close-submenu"]',
			function (e) {
				e.preventDefault();
				e.stopPropagation();
				e.stopImmediatePropagation();
				e.originalEvent.stopImmediatePropagation();
				var t = $(this);
				var action = t.attr('data-action');
				var ul = t.parent().parent().children('ul');
				switch (action) {
					case 'open-submenu':
						if (!ul.hasClass('active')) {
							ul.addClass('active');
							var i = ul.prev().children('.box-icon');
							i.addClass('active');
							i.attr('data-action', 'close-submenu');
						}
						var siblings = ul.parent().siblings().find('.sub-menu.active');
						siblings.each(function () {
							var u = $(this);
							u.removeClass('active');
							var i = u.prev().children('.box-icon');
							i.removeClass('active');
							i.attr('data-action', 'open-submenu');
						});
						break;
					case 'close-submenu':
						if (ul.hasClass('active')) {
							ul.removeClass('active');
							var i = ul.prev().children('.box-icon');
							i.removeClass('active');
							i.attr('data-action', 'open-submenu');
							ul.find('.sub-menu.active').each(function () {
								var u = $(this);
								u.removeClass('active');
								var i = u.prev().children('.box-icon');
								i.removeClass('active');
								i.attr('data-action', 'open-submenu');
							});
						}
						break;
				}
			}
		);
})(jQuery);
