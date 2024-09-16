'use strict';

import {AlbumsTypeError, ArgumentError} from "../../errors.js";
import $ from "jquery";

export function setBootstrapButtonActive($btn) {
    if (arguments.length === 0) throw new ArgumentError();
    if (!($btn instanceof $)) throw new AlbumsTypeError('is not an instance of jQuery');
    if (!$btn.is('button')) throw new AlbumsTypeError(`is not a jQuery button`);

    $btn.addClass('active').attr("aria-pressed", "true");
}