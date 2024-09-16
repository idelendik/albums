'use strict';

import $ from "jquery";

import {AlbumsTypeError, ArgumentError} from "../reactions/errors.js";

export const DEFAULT_DEBOUNCE_DELAY_MS = 400;

export function debounce(callback, delayMs = DEFAULT_DEBOUNCE_DELAY_MS) {
    if (arguments.length === 0) throw new ArgumentError();
    if (typeof callback !== "function") throw new AlbumsTypeError();
    if (!Number.isInteger(delayMs)) throw new AlbumsTypeError();

    let timeoutId;

    return (...args) => {
        if (timeoutId) {
            clearTimeout(timeoutId);
        }

        timeoutId = setTimeout(() => {
            callback(...args);
        }, delayMs);
    }
}

export function isJqueryObject(value) {
    return (value instanceof $) && isObject(value);
}

export function isObject(value) {
    if (arguments.length === 0) throw new ArgumentError();

    if (typeof value !== "object") return false;

    if (Array.isArray(value)) return false;

    if (value === null) return false;

    return true;
}

