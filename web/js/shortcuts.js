/**
 * @typedef {{ key: string, altKey?: boolean, ctrlKey?: boolean, metaKey?: boolean, shiftKey?: boolean }} KeyCombination
 * @typedef {{ code: string, altKey?: boolean, ctrlKey?: boolean, metaKey?: boolean, shiftKey?: boolean }} CodeCombination
 * @typedef {{ combination: KeyCombination, event: 'keydown' | 'keyup', callback: (evt: KeyboardEvent) => void, target: EventTarget }} RegisteredShortcut
 * @typedef {{ type?: 'keydown' | 'keyup', propagate?: boolean, disabledInInput?: boolean, target?: EventTarget }} ShortcutOptions
 */

document.addEventListener('alpine:init', () => {
	Alpine.store('shortcuts', {
		/**
		 * @type RegisteredShortcut[]
		 */
		registeredShortcuts: [],

		/**
		 * @param {KeyCombination | CodeCombination} combination
		 * A combination using a `code` representing a physical key on the keyboard or a `key`
		 * representing the character generated by pressing the key. Modifiers can be added using the
		 * `altKey`, `ctrlKey`, `metaKey` or `shiftKey` parameters.
		 * @param {(evt: KeyboardEvent) => void} callback
		 * The callback function that will be called when the correct combination is pressed.
		 * @param {ShortcutOptions?} options
		 * An object of options, containing the event `type`, whether it will `propagate`, the `target`
		 * element, and whether it's `disabledInInput`.
		 * @returns {this} The `Shortcuts` object.
		 */
		register(combination, callback, options) {
			/** @type ShortcutOptions */
			const defaultOptions = {
				type: 'keydown',
				propagate: false,
				disabledInInput: false,
				target: document,
			};
			options = { ...defaultOptions, ...options };

			/**
			 * @param {KeyboardEvent} evt
			 */
			const func = (evt) => {
				if (options.disabledInInput) {
					// Don't enable shortcut keys in input, textarea, select fields
					const element = evt.target.nodeType === 3 ? evt.target.parentNode : evt.target;
					if (['input', 'textarea', 'selectbox'].includes(element.tagName.toLowerCase())) {
						return;
					}
				}

				const validations = [
					combination.code
						? combination.code == evt.code
						: combination.key.toLowerCase() == evt.key.toLowerCase(),
					(combination.altKey && evt.altKey) || (!combination.altKey && !evt.altKey),
					(combination.ctrlKey && evt.ctrlKey) || (!combination.ctrlKey && !evt.ctrlKey),
					(combination.metaKey && evt.metaKey) || (!combination.metaKey && !evt.metaKey),
					(combination.shiftKey && evt.shiftKey) || (!combination.shiftKey && !evt.shiftKey),
				];
				const valid = validations.filter((validation) => validation);

				if (valid.length === validations.length) {
					callback(evt);

					if (!options.propagate) {
						evt.stopPropagation();
						evt.preventDefault();
					}
				}
			};

			this.registeredShortcuts.push({
				combination: combination,
				callback: func,
				target: options.target,
				event: options.type,
			});
			options.target.addEventListener(options.type, func);

			return this;
		},

		/**
		 * @param {KeyCombination | CodeCombination} combination
		 * A combination using a `code` representing a physical key on the keyboard or a `key`
		 * representing the character generated by pressing the key. Modifiers can be added using the
		 * `altKey`, `ctrlKey`, `metaKey` or `shiftKey` parameters.
		 * @returns {this} The `Shortcuts` object.
		 */
		unregister(combination) {
			const shortcut = this.registeredShortcuts.find(
				(shortcut) => JSON.stringify(shortcut.combination) == JSON.stringify(combination)
			);
			if (!shortcut) return;

			this.registeredShortcuts = this.registeredShortcuts.filter(
				(shortcut) => JSON.stringify(shortcut.combination) != JSON.stringify(combination)
			);
			shortcut.target.removeEventListener(shortcut.event, shortcut.callback, false);

			return this;
		},
	});

	Alpine.store('shortcuts')
		.register(
			{ key: 'A' },
			(_evt) => {
				const createButton = document.querySelector('.button#btn-create');
				if (!createButton) {
					return;
				}
				location.href = createButton.href;
			},
			{ disabledInInput: true }
		)
		.register(
			{ key: 'A', ctrlKey: true, shiftKey: true },
			(_evt) => {
				const checked = document.querySelector('.l-unit .ch-toggle:eq(0)').checked;
				document
					.querySelectorAll('.l-unit')
					.forEach((el) => el.classList.toggle('selected'), !checked);
				document.querySelectorAll('.l-unit .ch-toggle').forEach((el) => (el.checked = !checked));
			},
			{ disabledInInput: true }
		)
		.register({ code: 'Enter', ctrlKey: true }, (_evt) => {
			document.querySelector('form#vstobjects').submit();
		})
		.register({ code: 'Backspace', ctrlKey: true }, (_evt) => {
			const redirect = document.querySelector('a.button#btn-back').href;

			if (Alpine.store('form').dirty && redirect) {
				VE.helpers.createConfirmationDialog($('.js-confirm-dialog-redirect'), '', redirect);
			} else if (document.querySelector('form#vstobjects .button.cancel')) {
				location.href = $('form#vstobjects input.cancel')
					.attr('onclick')
					.replace("location.href='", '')
					.replace("'", '');
			} else if (redirect) {
				location.href = redirect;
			}
		})
		.register(
			{ key: 'F' },
			(_evt) => {
				const searchBox = document.querySelector('.js-search-input');
				searchBox.classList.toggle('activated', true);
				searchBox.focus();
			},
			{ disabledInInput: true }
		)
		.register(
			{ code: 'Digit1' },
			(_evt) => {
				const target = document.querySelector('.main-menu .main-menu-item:nth-of-type(1) a');
				if (!target) {
					return;
				}
				if (Alpine.store('form').dirty) {
					VE.helpers.createConfirmationDialog($('.js-confirm-dialog-redirect'), '', target.href);
				} else {
					location.href = target.href;
				}
			},
			{ disabledInInput: true }
		)
		.register(
			{ code: 'Digit2' },
			(_evt) => {
				const target = document.querySelector('.main-menu .main-menu-item:nth-of-type(2) a');
				if (!target) {
					return;
				}
				if (Alpine.store('form').dirty) {
					VE.helpers.createConfirmationDialog($('.js-confirm-dialog-redirect'), '', target.href);
				} else {
					location.href = target.href;
				}
			},
			{ disabledInInput: true }
		)
		.register(
			{ code: 'Digit3' },
			(_evt) => {
				const target = document.querySelector('.main-menu .main-menu-item:nth-of-type(3) a');
				if (!target) {
					return;
				}
				if (Alpine.store('form').dirty) {
					VE.helpers.createConfirmationDialog($('.js-confirm-dialog-redirect'), '', target.href);
				} else {
					location.href = target.href;
				}
			},
			{ disabledInInput: true }
		)
		.register(
			{ code: 'Digit4' },
			(_evt) => {
				const target = document.querySelector('.main-menu .main-menu-item:nth-of-type(4) a');
				if (!target) {
					return;
				}
				if (Alpine.store('form').dirty) {
					VE.helpers.createConfirmationDialog($('.js-confirm-dialog-redirect'), '', target.href);
				} else {
					location.href = target.href;
				}
			},
			{ disabledInInput: true }
		)
		.register(
			{ code: 'Digit5' },
			(_evt) => {
				const target = document.querySelector('.main-menu .main-menu-item:nth-of-type(5) a');
				if (!target) {
					return;
				}
				if (Alpine.store('form').dirty) {
					VE.helpers.createConfirmationDialog($('.js-confirm-dialog-redirect'), '', target.href);
				} else {
					location.href = target.href;
				}
			},
			{ disabledInInput: true }
		)
		.register(
			{ code: 'Digit6' },
			(_evt) => {
				const target = document.querySelector('.main-menu .main-menu-item:nth-of-type(6) a');
				if (!target) {
					return;
				}
				if (Alpine.store('form').dirty) {
					VE.helpers.createConfirmationDialog($('.js-confirm-dialog-redirect'), '', target.href);
				} else {
					location.href = target.href;
				}
			},
			{ disabledInInput: true }
		)
		.register(
			{ code: 'Digit7' },
			(_evt) => {
				const target = document.querySelector('.main-menu .main-menu-item:nth-of-type(7) a');
				if (!target) {
					return;
				}
				if (Alpine.store('form').dirty) {
					VE.helpers.createConfirmationDialog($('.js-confirm-dialog-redirect'), '', target.href);
				} else {
					location.href = target.href;
				}
			},
			{ disabledInInput: true }
		)
		.register(
			{ key: 'H' },
			(_evt) => {
				const shortcutsDialog = document.querySelector('.shortcuts');
				if (shortcutsDialog.open) {
					shortcutsDialog.close();
				} else {
					shortcutsDialog.showModal();
				}
			},
			{ disabledInInput: true }
		)
		.register({ code: 'Escape' }, (_evt) => {
			const shortcutsDialog = document.querySelector('.shortcuts');
			if (shortcutsDialog.open) {
				shortcutsDialog.close();
			}
			document.querySelectorAll('input, checkbox, textarea, select').forEach((el) => el.blur());
		})
		.register(
			{ code: 'ArrowLeft' },
			(_evt) => {
				VE.navigation.move_focus_left();
			},
			{ disabledInInput: true }
		)
		.register(
			{ code: 'ArrowRight' },
			(_evt) => {
				VE.navigation.move_focus_right();
			},
			{ disabledInInput: true }
		)
		.register(
			{ code: 'ArrowDown' },
			(_evt) => {
				VE.navigation.move_focus_down();
			},
			{ disabledInInput: true }
		)
		.register(
			{ code: 'ArrowUp' },
			(_evt) => {
				VE.navigation.move_focus_up();
			},
			{ disabledInInput: true }
		)
		.register(
			{ key: 'L' },
			(_evt) => {
				const el = $('.units.active .l-unit.focus .shortcut-l');
				if (el.length) {
					VE.navigation.shortcut(el);
				}
			},
			{ disabledInInput: true }
		)
		.register(
			{ key: 'S' },
			(_evt) => {
				const el = $('.units.active .l-unit.focus .shortcut-s');
				if (el.length) {
					VE.navigation.shortcut(el);
				}
			},
			{ disabledInInput: true }
		)
		.register(
			{ key: 'W' },
			(_evt) => {
				const el = $('.units.active .l-unit.focus .shortcut-w');
				if (el.length) {
					VE.navigation.shortcut(el);
				}
			},
			{ disabledInInput: true }
		)
		.register(
			{ key: 'D' },
			(_evt) => {
				const el = $('.units.active .l-unit.focus .shortcut-d');
				if (el.length) {
					VE.navigation.shortcut(el);
				}
			},
			{ disabledInInput: true }
		)
		.register(
			{ key: 'R' },
			(_evt) => {
				const el = $('.units.active .l-unit.focus .shortcut-r');
				if (el.length) {
					VE.navigation.shortcut(el);
				}
			},
			{ disabledInInput: true }
		)
		.register(
			{ key: 'N' },
			(_evt) => {
				const el = $('.units.active .l-unit.focus .shortcut-n');
				if (el.length) {
					VE.navigation.shortcut(el);
				}
			},
			{ disabledInInput: true }
		)
		.register(
			{ key: 'U' },
			(_evt) => {
				const el = $('.units.active .l-unit.focus .shortcut-u');
				if (el.length) {
					VE.navigation.shortcut(el);
				}
			},
			{ disabledInInput: true }
		)
		.register(
			{ code: 'Delete' },
			(_evt) => {
				const el = $('.units.active .l-unit.focus .shortcut-delete');
				if (el.length) {
					VE.navigation.shortcut(el);
				}
			},
			{ disabledInInput: true }
		)
		.register(
			{ code: 'Enter' },
			(evt) => {
				if (evt.target.tagName == 'INPUT' && evt.target.form.id == 'vstobjects') {
					document.querySelector('form#vstobjects').submit();
				}

				if (Alpine.store('form').dirty) {
					if (!$('.ui-dialog').is(':visible')) {
						VE.helpers.createConfirmationDialog(
							$('.js-confirm-dialog-redirect')[0],
							'',
							document.querySelector(`${VE.navigation.state.menu_selector}.focus a`).href
						);
					} else {
						// if dialog is opened - submitting confirm box by "enter" shortcut
						document.querySelector('.ui-dialog button.submit').click();
					}
				} else {
					if (!$('.ui-dialog').is(':visible')) {
						const el = $('.units.active .l-unit.focus .shortcut-enter');
						if (el.length) {
							VE.navigation.shortcut(el);
						} else {
							VE.navigation.enter_focused();
						}
					} else {
						// if dialog is opened - submitting confirm box by "enter" shortcut
						document.querySelector('.ui-dialog button.submit').click();
					}
				}
			},
			{ propagate: true }
		);
});
