'use strict';

import {describe, expect, it} from "@jest/globals";
import {AlbumsTypeError, ArgumentError} from "../../errors.js";
import {buildEventName} from "./index.js";
import {ACTION_TYPE, REACTION_TYPE} from "../../constants.js";

describe("buildEventName()", () => {
    it("throws an ArgumentError if argument is missing", () => {
        expect(() => {
            buildEventName();
        }).toThrowError(ArgumentError);
    });

    it("throws an ArgumentError if amount of arguments is less than expected", () => {
        expect(() => {
            buildEventName(REACTION_TYPE.LIKE);
        }).toThrowError(ArgumentError);
    });

    it("throws an AlbumsTypeError if `reactionType` is not of REACTION_TYPE", () => {
        expect(() => {
            buildEventName("incorrectArgument1", ACTION_TYPE.ADD);
        }).toThrowError(AlbumsTypeError);
    });

    it("throws an AlbumsTypeError if `actionType` is not of ACTION_TYPE", () => {
        expect(() => {
            buildEventName(REACTION_TYPE.LIKE, "incorrectArgument2");
        }).toThrowError(AlbumsTypeError);
    });

    it("returns a string", () => {
        expect(buildEventName(REACTION_TYPE.LIKE, ACTION_TYPE.ADD)).toBe("like-add");
        expect(buildEventName(REACTION_TYPE.DISLIKE, ACTION_TYPE.DELETE)).toBe("dislike-delete");
    });
});