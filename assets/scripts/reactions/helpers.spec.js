'use strict';

import {it, expect, describe, jest} from "@jest/globals";
import {ACTION_TYPE, REACTION_TYPE} from './constants.js';
import {AlbumsTypeError, ArgumentError} from './errors.js';
import * as helpers from "./helpers.js";

describe("helpers.js", () => {
    describe("isAction()", () => {
        it("throws an ArgumentError if argument is missing", () => {
            expect(() => {
                helpers.isAction();
            }).toThrowError(ArgumentError);
        });

        it("throws an AlbumsTypeError if `null` instead of `string` is passed", () => {
            expect(() => {
                helpers.isAction(null);
            }).toThrowError(AlbumsTypeError);
        });

        it("throws an AlbumsTypeError if `undefined` instead of `string` is passed", () => {
            expect(() => {
                helpers.isAction(undefined);
            }).toThrowError(AlbumsTypeError);
        });

        it("throws an AlbumsTypeError if non-string argument is passed", () => {
            expect(() => {
                helpers.isAction(1);
            }).toThrowError(AlbumsTypeError);
        });

        it("returns `false` for non-action arguments", () => {
            expect(helpers.isAction("notAction")).toBe(false);
            expect(helpers.isAction(REACTION_TYPE.LIKE)).toBe(false);
        });

        it("returns `true` for arguments of type `action`", () => {
            expect(helpers.isAction(ACTION_TYPE.ADD)).toBe(true);
        });

        it("returns `true` for lowercased and uppercased arguments of type `action`", () => {
            expect(helpers.isAction(ACTION_TYPE.ADD.toLowerCase())).toBe(true);
            expect(helpers.isAction(ACTION_TYPE.ADD.toUpperCase())).toBe(true);
        });
    });

    describe("isReaction()", () => {
        it("throws an ArgumentError if argument is missing", () => {
            expect(() => {
                helpers.isReaction();
            }).toThrowError(ArgumentError);
        });

        it("throws an AlbumsTypeError if `null` instead of `string` is passed", () => {
            expect(() => {
                helpers.isReaction(null);
            }).toThrowError(AlbumsTypeError);
        });

        it("throws an AlbumsTypeError if `undefined` instead of `string` is passed", () => {
            expect(() => {
                helpers.isReaction(undefined);
            }).toThrowError(AlbumsTypeError);
        });

        it("throws an AlbumsTypeError if non-string argument is passed", () => {
            expect(() => {
                helpers.isReaction(1);
            }).toThrowError(AlbumsTypeError);
        });

        it("returns `false` for non-reaction arguments", () => {
            expect(helpers.isReaction("notReaction")).toBe(false);
            expect(helpers.isReaction(ACTION_TYPE.ADD));
        });

        it("returns `true` for arguments of type `reaction`", () => {
            expect(helpers.isReaction(REACTION_TYPE.LIKE)).toBe(true);
        });

        it("returns `true` for lowercased and uppercased arguments of type `reaction`", () => {
            expect(helpers.isReaction(REACTION_TYPE.LIKE.toLowerCase())).toBe(true);
            expect(helpers.isReaction(REACTION_TYPE.LIKE.toUpperCase())).toBe(true);
        });
    });
});