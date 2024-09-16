'use strict';

import {describe, expect, it, jest} from "@jest/globals";
import {getImageReactionsDataOrDefault} from "./index.js";
import {get} from "../../../common/sessionStorage.js";
import {AlbumsTypeError, ArgumentError} from "../../errors.js";
import * as sessionStorageModule from "../../sessionStorage.js";
import * as buildDefaultImageReactionsDataModule from "../buildDefaultImageReactionsData/index.js";
import * as isReactionsDataValidModule from "../isReactionsDataValid/index.js";

describe("getImageReactionsDataOrDefault()", () => {
    it("throws an ArgumentError if no arguments passed", () => {
        expect(() => {
            getImageReactionsDataOrDefault();
        }).toThrowError(ArgumentError);
    });

    it("throws a TypeError if non-number argument passed", () => {
        expect(() => {
            getImageReactionsDataOrDefault("NaN");
        }).toThrowError(TypeError);
    });

    it("throws a TypeError if negative number passed as an argument", () => {
        expect(() => {
            getImageReactionsDataOrDefault(-1);
        }).toThrowError(TypeError);
    });

    it("returns default if there's no reactions data in session storage", () => {
        jest.spyOn(sessionStorageModule, "getReactionsData").mockReturnValue(null);
        jest.spyOn(buildDefaultImageReactionsDataModule, "buildDefaultImageReactionsData").mockReturnValue([]);

        const result = getImageReactionsDataOrDefault(1);

        expect(result).toEqual([]);
    });

    it("returns default if session storage contains invalid reactions data", () => {
        jest.spyOn(sessionStorageModule, "getReactionsData").mockReturnValue("invalidReactionsData");
        jest.spyOn(buildDefaultImageReactionsDataModule, "buildDefaultImageReactionsData").mockReturnValue([]);
        jest.spyOn(isReactionsDataValidModule, "isReactionsDataValid").mockReturnValue(false);

        const result = getImageReactionsDataOrDefault(1);

        expect(isReactionsDataValidModule.isReactionsDataValid).toHaveBeenCalledTimes(1);
        expect(result).toEqual([]);
    });

    it("returns default if session storage data is valid, but doesn't have anything for requested image id", () => {
        jest.spyOn(sessionStorageModule, "getReactionsData").mockReturnValue({});
        jest.spyOn(buildDefaultImageReactionsDataModule, "buildDefaultImageReactionsData").mockReturnValue([]);
        jest.spyOn(isReactionsDataValidModule, "isReactionsDataValid").mockReturnValue(false);

        const result = getImageReactionsDataOrDefault(1);

        expect(isReactionsDataValidModule.isReactionsDataValid).toHaveBeenCalledTimes(1);
        expect(result).toEqual([]);
    });

    it("returns data from session storage if it valid", () => {
        jest.spyOn(sessionStorageModule, "getReactionsData").mockReturnValue({1: "validValueFromSessionStorage"});
        jest.spyOn(buildDefaultImageReactionsDataModule, "buildDefaultImageReactionsData").mockReturnValue([]);
        jest.spyOn(isReactionsDataValidModule, "isReactionsDataValid").mockReturnValue(true);

        const result = getImageReactionsDataOrDefault(1);

        expect(isReactionsDataValidModule.isReactionsDataValid).toHaveBeenCalledTimes(1);
        expect(result).toBe("validValueFromSessionStorage");
    });
});