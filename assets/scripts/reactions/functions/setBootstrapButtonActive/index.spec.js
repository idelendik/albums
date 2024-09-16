'use strict';

import {describe, expect, it} from "@jest/globals";
import {AlbumsTypeError, ArgumentError} from "../../errors.js";
import $ from "jquery";
import {setBootstrapButtonActive} from "./index.js";

describe("setBootstrapButtonActive()", () => {
    it("throws an ArgumentError if argument is missing", () => {
        expect(() => {
            setBootstrapButtonActive();
        }).toThrowError(ArgumentError);
    });

    it("throws an AlbumsTypeError if passed argument is not a 'jQuery' instance", () => {
        expect(() => {
            setBootstrapButtonActive([]);
        }).toThrowError(AlbumsTypeError);
    });

    it("adds `.active` class and `aria-pressed` attribute", () => {
        const $btn = $("<button class='another-class'/>");

        setBootstrapButtonActive($btn);

        expect($btn[0].classList.contains("active")).toBe(true);
        expect($btn[0].attributes["aria-pressed"]).not.toBe(undefined);

        expect($btn[0].classList.contains("another-class")).toBe(true);
    });
});