'use strict';

import {describe, expect, it} from "@jest/globals";
import {isReactionsDataValid} from "./index.js";
import {AlbumsTypeError, ArgumentError} from "../../errors.js";

describe("isReactionsDataValid()", () => {
    it("throws an ArgumentError if no arguments passed", () => {
        expect(() => {
            isReactionsDataValid();
        }).toThrowError(ArgumentError);
    });

    it("throws an AlbumsTypeError if argument is not an object", () => {
        expect(() => {
            isReactionsDataValid([]);
        }).toThrowError(AlbumsTypeError);
    });

    it("throws an AlbumsTypeError if `applied-action` key is missing", () => {
        expect(() => {
            isReactionsDataValid({})
        }).toThrowError(AlbumsTypeError);
    });

    it("throws an AlbumsTypeError if `applied-action` is not of type `string`", () => {
        expect(() => {
            isReactionsDataValid({1: {"applied-action": []}});
        }).toThrowError(AlbumsTypeError);
    });

    it("throws an AlbumsTypeError if `buttons` key is missing", () => {
        expect(() => {
            isReactionsDataValid({1: {"applied-action": []}})
        }).toThrowError(AlbumsTypeError);
    });

    it("throws an AlbumsTypeError if `buttons` is not an object", () => {
        expect(() => {
            isReactionsDataValid({1: {"buttons": "", "applied-action": []}})
        }).toThrowError(AlbumsTypeError);
    });

    it("throws an AlbumsTypeError if `buttons` doesn't contain `like` data", () => {
        expect(() => {
            isReactionsDataValid({1: {"buttons": {}, "applied-action": []}});
        }).toThrowError(AlbumsTypeError);
    });

    it("throws an AlbumsTypeError if `buttons like` data is not of type `boolean`", () => {
        expect(() => {
            isReactionsDataValid({1: {"buttons": {"like-add": "incorrectType"}, "applied-action": ""}});
        }).toThrowError(AlbumsTypeError);
    });

    it("throws an AlbumsTypeError if `buttons` doesn't contain `dislike` data", () => {
        expect(() => {
            isReactionsDataValid({1: {"buttons": {"like-add": false}, "applied-action": ""}});
        }).toThrowError(AlbumsTypeError);
    });

    it("throws an AlbumsTypeError if `buttons dislike` data is not of type `boolean`", () => {
        expect(() => {
            isReactionsDataValid({
                1: {
                    "buttons": {"like-add": false, "dislike-add": "incorrectValue"},
                    "applied-action": ""
                }
            });
        }).toThrowError(AlbumsTypeError);
    });

    it("throws an AlbumsTypeError if both `buttons like` and `buttons dislike` are equal to `true`", () => {
        expect(() => {
            isReactionsDataValid({
                1: {
                    "buttons": {"like-add": true, "dislike-add": true},
                    "applied-action": ""
                }
            });
        }).toThrowError(AlbumsTypeError);
    });

    it("returns true for a valid argument", () => {
        expect(isReactionsDataValid({
            1: {
                "buttons": {"like-add": true, "dislike-add": false},
                "applied-action": ""
            }
        })).toBe(true);
    });
});