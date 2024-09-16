'use strict';

import {AlbumsTypeError, ArgumentError} from "../reactions/errors.js";
import {tryJsonParse, tryJsonStringify} from "./json.js";

export function getItem(key) {
    if (arguments.length === 0) throw new ArgumentError();
    if (typeof key !== "string") throw new AlbumsTypeError("should be `string`");

    return sessionStorage.getItem(key);
}

export function setItem(key, value) {
    if (arguments.length === 0) throw new ArgumentError();
    if (arguments.length === 1) throw new ArgumentError("`value` is missing");
    if (typeof key !== "string") throw new AlbumsTypeError("`key` should be a `string`");

    try {
        sessionStorage.setItem(key, value);
    } catch (e) {
        console.info(e);
    }
}