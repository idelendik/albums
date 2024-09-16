'use strict';

import {AlbumsTypeError, ArgumentError} from "../../errors.js";
import $ from "jquery";

export function unsetBootstrapButtonActive($btn) {
    if (arguments.length === 0) throw new ArgumentError('argument is missing');
    if ((!($btn instanceof $))) throw new AlbumsTypeError('is not an instance of jQuery');
    if (!$btn.is('button')) throw new AlbumsTypeError(`is not a jQuery button`);

    $btn.removeClass('active').attr("aria-pressed", null);
}