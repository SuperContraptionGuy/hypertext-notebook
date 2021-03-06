/*!
 * Jodit Editor (https://xdsoft.net/jodit/)
 * Released under MIT see LICENSE.txt in the project root for license information.
 * Copyright (c) 2013-2021 Valeriy Chupurnov. All rights reserved. https://xdsoft.net
 */

/**
 * Check if browser has a color picker (a new HTML5 attribute for input tag)
 */
export function hasBrowserColorPicker(): boolean {
	let supportsColor = true;

	try {
		const a = document.createElement('input');

		a.type = 'color';
		supportsColor =
			a.type === 'color' && typeof a.selectionStart !== 'number';
	} catch (e) {
		supportsColor = false;
	}

	return supportsColor;
}
