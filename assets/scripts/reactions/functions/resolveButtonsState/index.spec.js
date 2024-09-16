'use strict';

import {describe, expect, it, jest} from "@jest/globals";
import {ArgumentError} from "../../errors.js";
import $ from "jquery";
import {resolveButtonsState} from "./index.js";
import {REACTION_TYPE} from "../../constants.js";
import * as getAllReactionButtonsModule from "../getAllReactionButtons/index.js";
import * as getImageIdFromDataAttrModule from "../getImageIdFromDataAttr/index.js";
import * as getImageReactionsDataOrDefaultModule from "../getImageReactionsDataOrDefault/index.js";
import * as sessionStorageModule from "../../sessionStorage.js";

describe("resolveButtonsState()", () => {
    it("throws an ArgumentError if no arguments passed", () => {
        expect(() => {
            resolveButtonsState();
        }).toThrowError(ArgumentError);
    });

    it("throws a TypeError if argument is not a jQuery instance", () => {
        expect(() => {
            resolveButtonsState("argument 1");
        }).toThrowError(TypeError);
    });

    it("doesn't call a save function if button doesn't contain a specific attribute", () => {
        jest.spyOn(getAllReactionButtonsModule, "getAllReactionButtons").mockReturnValue(null);
        jest.spyOn(getImageIdFromDataAttrModule, "getImageIdFromDataAttr").mockReturnValue(null);
        jest.spyOn(getImageReactionsDataOrDefaultModule, "getImageReactionsDataOrDefault").mockReturnValue(null);
        jest.spyOn(sessionStorageModule, "setReactionsData");

        resolveButtonsState($("<button />"));

        expect(sessionStorageModule.setReactionsData).not.toHaveBeenCalled();
    });


    it("toggle button state", () => {
        jest.spyOn(getAllReactionButtonsModule, "getAllReactionButtons").mockReturnValue(null);
        jest.spyOn(getImageIdFromDataAttrModule, "getImageIdFromDataAttr").mockReturnValue(1);
        jest.spyOn(getImageReactionsDataOrDefaultModule, "getImageReactionsDataOrDefault").mockReturnValue({"buttons": {"nameId": true}});
        jest.spyOn(sessionStorageModule, "getReactionsData").mockReturnValue({});
        jest.spyOn(sessionStorageModule, "setReactionsData").mockImplementation(() => null);

        resolveButtonsState($("<button name='nameId' />"));

        expect(sessionStorageModule.setReactionsData).toHaveBeenCalledTimes(1);
        expect(sessionStorageModule.setReactionsData).toHaveBeenCalledWith({1: {"buttons": {"nameId": false}}});
    });
});