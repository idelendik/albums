'use strict';

import {describe, expect, it, jest} from "@jest/globals";
import {getItem, setItem} from "./sessionStorage.js";
import {AlbumsTypeError, ArgumentError} from "../reactions/errors.js";

describe("common/sessionStorage.js", () => {
    describe("getItem()", () => {
        it("throws an ArgumentError if argument is missing", () => {
            expect(() => {
                getItem();
            }).toThrowError(ArgumentError);
        });

        it("throws an AlbumsTypeError if passed argument is not of type `string`", () => {
            expect(() => {
                getItem(1);
            }).toThrowError(AlbumsTypeError);
        });

        it("returns `null` if nothing is stored in sessionStorage by the passed key", () => {
            const result = getItem("keyName");

            expect(result).toBe(null);
        });
    });

    describe("setItem()", () => {
        it("throws an ArgumentError arguments are missing", () => {
            expect(() => {
                setItem();
            }).toThrowError(ArgumentError);
        });

        it("throws an ArgumentError if `value` argument is missing", () => {
            expect(() => {
                setItem("keyName");
            }).toThrowError(ArgumentError);
        });

        it("throws an AlbumsTypeError if passed `key` is not of type `string`", () => {
            expect(() => {
                setItem(1, "someValue");
            }).toThrowError(AlbumsTypeError);
        });

        it("processes a `number` value", () => {
            global.Storage.prototype.setItem = jest.fn();

            setItem("keyName", "someString");

            expect(global.Storage.prototype.setItem).toHaveBeenCalledTimes(1);
            expect(global.Storage.prototype.setItem).toHaveBeenCalledWith("keyName", "someString");
        });

        it("processes an `array` value", () => {
            global.Storage.prototype.setItem = jest.fn();

            setItem("keyName", "[1,2,3]");

            expect(global.Storage.prototype.setItem).toHaveBeenCalledTimes(1);
            expect(global.Storage.prototype.setItem).toHaveBeenCalledWith("keyName", "[1,2,3]");
        });
    });
});