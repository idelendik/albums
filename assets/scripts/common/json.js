'use strict';

import {AlbumsTypeError, ArgumentError} from "../reactions/errors.js";

export function tryJsonParse(value) {
    if (arguments.length === 0) throw new ArgumentError();
    if (typeof value !== "string") throw new AlbumsTypeError("should be `string`");

    try {
        return JSON.parse(value);
    } catch (e) {
        console.error("invalid JSON:", e);
    }

    return null;
}

export function tryJsonStringify(value) {
    if (arguments.length === 0) throw new ArgumentError();
    if (typeof value === "bigint") throw new AlbumsTypeError("`value` cannot be a `bigint`");

    try {
        return JSON.stringify(value);
    } catch (e) {
        console.error("cannot stringify", e);
    }

    return null;
}