'use strict';

import {describe, expect, it} from "@jest/globals";
import {AlbumsTypeError, ArgumentError} from "../../errors.js";
import $ from "jquery";
import {unsetBootstrapButtonActive} from "./index.js";

describe("unsetBootstrapButtonActive()", () => {
    it("throws an ArgumentError if argument is missing", () => {
        expect(() => {
            unsetBootstrapButtonActive();
        }).toThrowError(ArgumentError);
    });

    it("throws an AlbumsTypeError if passed argument is not a 'jQuery' instance", () => {
        expect(() => {
            unsetBootstrapButtonActive([]);
        }).toThrowError(AlbumsTypeError);
    });

    it("removes `.active` class and `aria-pressed` attribute", () => {
        const $btn = $("<button class='active another-class' aria-pressed='true' />");

        unsetBootstrapButtonActive($btn);

        expect($btn[0].classList.contains("active")).toBe(false);
        expect($btn[0].attributes["aria-pressed"]).toBe(undefined);

        expect($btn[0].classList.contains("another-class")).toBe(true);
    });
});