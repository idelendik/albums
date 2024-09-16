'use strict';

import {describe, expect, it, jest} from "@jest/globals";
import * as helpers from "./helpers.js";
import * as json from "../common/json.js";
import * as commonSessionStorage from "../common/sessionStorage.js";
import {AlbumsTypeError, ArgumentError} from "./errors.js";
import {getReactionsData, setReactionsData} from "./sessionStorage.js";
import {getItem, setItem} from "../common/sessionStorage.js";
import * as isReactionDataValidModule from "./functions/isReactionsDataValid";

describe("sessionStorage.js", () => {
    describe("getReactionsData()", () => {
        it("processes invalid JSON", () => {
            jest.spyOn(commonSessionStorage, 'getItem').mockReturnValue('[]]')

            const result = getReactionsData();

            expect(result).toBeNull();
        });

        it("processes valid JSON", () => {
            jest.spyOn(commonSessionStorage, 'getItem').mockReturnValue('{"test": 1}');

            const result = getReactionsData();

            expect(result).toEqual({"test": 1});
        });
    });

    describe("setReactionsData()", () => {
        it("throws an ArgumentError argument is missing", () => {
            expect(() => {
                setReactionsData();
            }).toThrowError(ArgumentError);
        });

        it("throws an AlbumsTypeError if passed argument is not an object", () => {
            expect(() => {
                setReactionsData("someValue");
            }).toThrowError(AlbumsTypeError);
        });

        it("throws an AlbumsTypeError if passed argument is not valid reactions data object", () => {
            jest.spyOn(isReactionDataValidModule, "isReactionsDataValid").mockReturnValue(false);

            expect(() => {
                setReactionsData({});
            }).toThrowError(AlbumsTypeError);
        });

        it("doesn't set an invalid JSON", () => {
            jest.spyOn(isReactionDataValidModule, "isReactionsDataValid").mockReturnValue(true);
            jest.spyOn(json, "tryJsonStringify").mockReturnValue(null);
            jest.spyOn(global.Storage.prototype, "setItem");

            setReactionsData({"key": "{}}"});

            expect(global.Storage.prototype.setItem).not.toHaveBeenCalled();
        });
    });
});