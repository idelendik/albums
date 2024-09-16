'use strict';

import {describe, fdescribe, xdescribe, expect, it, jest} from "@jest/globals";
import {tryJsonParse, tryJsonStringify} from "./json.js"
import {ArgumentError, AlbumsTypeError} from "../reactions/errors.js";
import {setReactionsData} from "../reactions/sessionStorage.js";


describe("common/json.js", () => {
    describe("tryJsonParse()", () => {
        it("throws an ArgumentError if argument is missing", () => {
            expect(() => {
                tryJsonParse();
            }).toThrowError(ArgumentError);
        });

        it("throws an AlbumsTypeError if non-string argument is passed", () => {
            expect(() => {
                tryJsonParse(1);
            }).toThrowError(AlbumsTypeError);
        });

        it("returns `null` if an invalid JSON is passed", () => {
            jest.spyOn(JSON, 'parse').mockImplementation(() => {
                throw new SyntaxError();
            });

            expect(tryJsonParse("{")).toBeNull();
            expect(JSON.parse).toHaveBeenCalledTimes(1);
            expect(JSON.parse).toHaveBeenCalledWith("{");
        });

        it("processes an object correctly", () => {
            jest.spyOn(JSON, 'parse').mockReturnValue({"test": 1});

            expect(tryJsonParse('{"test": 1}')).toEqual({"test": 1});
            expect(JSON.parse).toHaveBeenCalledWith('{"test": 1}');
            expect(JSON.parse).toHaveBeenCalledTimes(1);
        });

        it("processes a string correctly", () => {
            jest.spyOn(JSON, 'parse').mockReturnValue(1);

            expect(tryJsonParse("1")).toBe(1);
            expect(JSON.parse).toHaveBeenCalledWith("1");
            expect(JSON.parse).toHaveBeenCalledTimes(1);
        });

        it("processes null correctly", () => {
            jest.spyOn(JSON, 'parse').mockReturnValue(null);

            expect(tryJsonParse("null")).toEqual(null);
            expect(JSON.parse).toHaveBeenCalledWith("null");
            expect(JSON.parse).toHaveBeenCalledTimes(1);
        });
    });

    describe("tryJsonStringify()", () => {
        it("throws an ArgumentError if argument is missing", () => {
            expect(() => {
                tryJsonStringify();
            }).toThrowError(ArgumentError);
        });

        it("throws an AlbumsTypeError if passed `value` is of type `bigint`", () => {
            expect(() => {
                tryJsonStringify(BigInt(10));
            }).toThrowError(AlbumsTypeError);
        });

        it("processes an object correctly", () => {
            jest.spyOn(JSON, 'stringify').mockReturnValue('{"test":1}');

            expect(tryJsonStringify({"test": 1})).toBe('{"test":1}');
            expect(JSON.stringify).toHaveBeenCalledWith({"test": 1});
            expect(JSON.stringify).toHaveBeenCalledTimes(1);
        });

        it("processes correctly", () => {
            jest.spyOn(JSON, 'stringify').mockReturnValue("null");

            expect(tryJsonStringify(null)).toBe("null");
            expect(JSON.stringify).toHaveBeenCalledWith(null);
            expect(JSON.stringify).toHaveBeenCalledTimes(1);

        });

        it("processes correctly", () => {
            jest.spyOn(JSON, 'stringify').mockReturnValue(undefined);

            expect(tryJsonStringify(undefined)).toBe(undefined);
            expect(JSON.stringify).toHaveBeenCalledWith(undefined);
            expect(JSON.stringify).toHaveBeenCalledTimes(1);
        });
    });
})