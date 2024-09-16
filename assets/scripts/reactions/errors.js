'use strict';

const ERROR_MISSING_ARGUMENT = "missing argument(s)";
const ERROR_INCORRECT_ARGUMENT_TYPE = "incorrect argument type";

// TODO: rename to AlbumsArgumentError to emphasize that this is our own custom error
export class ArgumentError extends Error {
    constructor(message = "") {
        super(`${ERROR_MISSING_ARGUMENT}, ${message}`);

        this.name = "ArgumentError";
    }
}

export class AlbumsTypeError extends TypeError {
    constructor(message = "") {
        super(`${ERROR_INCORRECT_ARGUMENT_TYPE}, ${message}`);

        this.name = "AlbumsTypeError";
    }
}