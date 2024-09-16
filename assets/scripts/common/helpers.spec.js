'use strict';

import {describe, expect, it, jest} from "@jest/globals";
import {AlbumsTypeError, ArgumentError} from "../reactions/errors.js";

import {debounce, isObject, DEFAULT_DEBOUNCE_DELAY_MS} from "./helpers.js";

describe("common/helpers.js", () => {
    describe("debounce()", () => {
        jest.useFakeTimers();

        it("throws an ArgumentError if `callback` argument is missing", () => {
            expect(() => {
                debounce()
            }).toThrowError(ArgumentError);
        });

        it("throws an AlbumsTypeError if string instead of `function` is passed as a `callback`", () => {
            expect(() => {
                debounce("notAFunction")
            }).toThrowError(AlbumsTypeError);
        });

        it("throws an AlbumsTypeError if null instead of `function` is passed as a `callback`", () => {
            expect(() => {
                debounce(null);
            }).toThrowError(AlbumsTypeError);
        });

        it("throws an AlbumsTypeError if undefined instead of `function` is passed as a `callback`", () => {
            expect(() => {
                debounce(undefined);
            }).toThrowError(AlbumsTypeError);
        });

        it("throws an AlbumsTypeError if non-integer instead of `number` is passed as a `delay`", () => {
            expect(() => {
                debounce(() => {
                }, "nonIntegerDelay");
            }).toThrowError(AlbumsTypeError);
        });

        it("runs a callback after the timeout end", () => {
            const callback = jest.fn();
            const debouncedFn = debounce(callback);

            debouncedFn();
            debouncedFn();
            debouncedFn();
            debouncedFn();
            debouncedFn();
            jest.advanceTimersByTime(DEFAULT_DEBOUNCE_DELAY_MS);

            expect(callback).toHaveBeenCalled();
            expect(callback).toHaveBeenCalledTimes(1);
        });

        it("doesn't run a callback before the timeout end", () => {
            const callback = jest.fn();
            const debouncedFn = debounce(callback);

            debouncedFn();
            debouncedFn();
            debouncedFn();
            debouncedFn();
            debouncedFn();
            jest.advanceTimersByTime(DEFAULT_DEBOUNCE_DELAY_MS - 10);

            expect(callback).toHaveBeenCalledTimes(0);
        });

        it("runs a callback after each timeout", () => {
            const callback = jest.fn();
            const debouncedFn = debounce(callback);

            debouncedFn();
            debouncedFn();
            debouncedFn();
            jest.advanceTimersByTime(DEFAULT_DEBOUNCE_DELAY_MS);
            debouncedFn();
            debouncedFn();
            jest.advanceTimersByTime(DEFAULT_DEBOUNCE_DELAY_MS);

            expect(callback).toHaveBeenCalledTimes(2);
        });

        it("runs a callback with arguments form the last invocation", () => {
            const callback = jest.fn();
            const debouncedFn = debounce(callback);

            debouncedFn([1, 2, 3]);
            debouncedFn([1, 2, 3, 4]);
            jest.advanceTimersByTime(DEFAULT_DEBOUNCE_DELAY_MS);

            expect(callback).toHaveBeenCalledTimes(1);
            expect(callback).toHaveBeenCalledWith([1, 2, 3, 4]);
        });

        it("overrides default timeout delay", () => {
            const DELAY_SHIFT = 100;
            const callback = jest.fn();
            const debouncedFn = debounce(callback, DEFAULT_DEBOUNCE_DELAY_MS + DELAY_SHIFT);

            debouncedFn();
            debouncedFn();
            jest.advanceTimersByTime(DEFAULT_DEBOUNCE_DELAY_MS);

            expect(callback).toHaveBeenCalledTimes(0);

            jest.advanceTimersByTime(DELAY_SHIFT); // debounce delay ends now and callback runs

            expect(callback).toHaveBeenCalledTimes(1);
        });
    });

    describe("isObject()", () => {
        it("throws an ArgumentError if argument is missing", () => {
            expect(() => {
                isObject();
            }).toThrowError(ArgumentError);
        });

        it('returns `false` if argument is not of type `object`', () => {
            expect(isObject(() => {
            })).toBe(false);
        });

        it('returns `false` if argument is undefined', () => {
            expect(isObject(undefined)).toBe(false);
        })

        it('returns `false` if argument is array', () => {
            expect(isObject([])).toBe(false);
        });

        it('returns `false` if argument is null', () => {
            expect(isObject(null)).toBe(false);
        });

        it('returns `true` if argument is of type `object`, but not `array` or null', () => {
            expect(isObject({})).toBe(true);
        });
    });
});