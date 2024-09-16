'use strict';

import {describe, expect, it} from "@jest/globals";
import {AlbumsTypeError, ArgumentError} from "../../errors.js";
import $ from "jquery";
import {highlightButtonByAttr} from "./index.js";
import {REACTION_TYPE} from "../../constants.js";
import * as getAllReactionButtonsModule from "../getAllReactionButtons/index.js";
import * as getImageIdFromDataAttrModule from "../getImageIdFromDataAttr/index.js";
import * as getImageReactionsDataOrDefaultModule from "../getImageReactionsDataOrDefault/index.js";
import * as setBootstrapButtonActiveModule from "../setBootstrapButtonActive/index.js";
import * as unsetBootstrapButtonActiveModule from "../unsetBootstrapButtonActive/index.js";
import * as buildEventNameModule from "../buildEventName/index.js";

describe("highlightButtonByAttr()", () => {
    it("throws an ArgumentError if no arguments passed", () => {
        expect(() => {
            highlightButtonByAttr();
        }).toThrowError(ArgumentError);
    });

    it("throws an ArgumentError if passed less arguments than expected", () => {
        expect(() => {
            highlightButtonByAttr([]);
        }).toThrowError(ArgumentError);
    });

    it("throws a TypeError if `$buttons` argument is not an instance of `jQuery`", () => {
        expect(() => {
            highlightButtonByAttr("invalidArgument1", "invalidArgument2");
        }).toThrowError(AlbumsTypeError);
    });

    it("throws an ArgumentError if button doesn't contain specified attribute", () => {
        expect(() => {
            const $button = $(`<button name='${REACTION_TYPE.LIKE}' />`);
            highlightButtonByAttr($button, 'invalidAttribute');
        }).toThrowError(ArgumentError);
    });

    it("highlights a button", () => {
        jest.spyOn(getAllReactionButtonsModule, "getAllReactionButtons").mockReturnValue(null);
        jest.spyOn(getImageIdFromDataAttrModule, "getImageIdFromDataAttr").mockReturnValue(null);
        jest.spyOn(getImageReactionsDataOrDefaultModule, 'getImageReactionsDataOrDefault').mockReturnValue({'buttons': {'event-name': true}})
        jest.spyOn(setBootstrapButtonActiveModule, 'setBootstrapButtonActive');
        jest.spyOn(unsetBootstrapButtonActiveModule, 'unsetBootstrapButtonActive');
        jest.spyOn(buildEventNameModule, 'buildEventName').mockReturnValue('event-name');

        const $button = $(`<button name='${REACTION_TYPE.LIKE}' />`);

        highlightButtonByAttr($button, 'name');

        expect(setBootstrapButtonActiveModule.setBootstrapButtonActive).toHaveBeenCalledTimes(1);
        expect(unsetBootstrapButtonActiveModule.unsetBootstrapButtonActive).toHaveBeenCalledTimes(0);
    });
});