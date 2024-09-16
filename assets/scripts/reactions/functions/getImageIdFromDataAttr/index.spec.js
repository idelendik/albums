'use strict';

import {describe, expect, it} from "@jest/globals";
import {getImageIdFromDataAttr} from "./index.js";
import $ from "jquery";

describe("getImageIdFromDataAttr()", () => {
    it("throws an Error if no image ids found", () => {
        expect(() => {
            getImageIdFromDataAttr();
        }).toThrowError();
    });

    it("throws an Error if ids with different values found", () => {
        const buttonWithImageIds = $().add("<button data-image-id='123'/><button data-image-id='321'/>");

        expect(() => {
            getImageIdFromDataAttr(buttonWithImageIds);
        }).toThrowError();
    });

    it("throws an Error if image ids is not a number", () => {
        const buttonWithImageIds = $().add("<button data-image-id='123'/><button data-image-id='NaN'/>");

        expect(() => {
            getImageIdFromDataAttr(buttonWithImageIds);
        }).toThrowError();
    });

    it("returns image id as a number", () => {
        const buttonWithImageIds = $().add("<button data-image-id='123'/><button data-image-id='123'/>");

        expect(getImageIdFromDataAttr(buttonWithImageIds)).toBe(123);
    });
});