'use strict';

import {describe, expect, it, jest} from "@jest/globals";
import {prepareActionsToSend} from "./index.js";
import * as getAllReactionButtonsModule from "../getAllReactionButtons/index.js";
import * as getImageIdFromDataAttrModule from "../getImageIdFromDataAttr/index.js";
import * as getImageReactionsDataOrDefaultModule from "../getImageReactionsDataOrDefault/index.js";

describe("prepareActionsToSend()", () => {
    it("no applied action, like-add is active", () => {
        jest.spyOn(getAllReactionButtonsModule, "getAllReactionButtons").mockReturnValue(null);
        jest.spyOn(getImageIdFromDataAttrModule, "getImageIdFromDataAttr").mockReturnValue(null);
        jest.spyOn(getImageReactionsDataOrDefaultModule, 'getImageReactionsDataOrDefault')
            .mockReturnValue({
                "buttons": {"like-add": true, "dislike-add": false},
                "applied-action": ""
            });

        const result = prepareActionsToSend();

        expect(result).toEqual(["like-add"]);
    });

    it("no applied action, dislike-add is active", () => {
        jest.spyOn(getAllReactionButtonsModule, "getAllReactionButtons").mockReturnValue(null);
        jest.spyOn(getImageIdFromDataAttrModule, "getImageIdFromDataAttr").mockReturnValue(null);
        jest.spyOn(getImageReactionsDataOrDefaultModule, 'getImageReactionsDataOrDefault')
            .mockReturnValue({"buttons": {"like-add": false, "dislike-add": true}, "applied-action": ""});

        const result = prepareActionsToSend();

        expect(result).toEqual(['dislike-add']);
    });

    it("applied action is like-add, buttons are not active", () => {
        jest.spyOn(getAllReactionButtonsModule, "getAllReactionButtons").mockReturnValue(null);
        jest.spyOn(getImageIdFromDataAttrModule, "getImageIdFromDataAttr").mockReturnValue(null);
        jest.spyOn(getImageReactionsDataOrDefaultModule, 'getImageReactionsDataOrDefault')
            .mockReturnValue({"buttons": {'like-add': false, 'dislike-add': false}, 'applied-action': 'like-add'});

        const result = prepareActionsToSend();

        expect(result).toEqual(['like-delete']);
    });

    it("applied action is like-add, `dislike-add` button is active", () => {
        jest.spyOn(getAllReactionButtonsModule, "getAllReactionButtons").mockReturnValue(null);
        jest.spyOn(getImageIdFromDataAttrModule, "getImageIdFromDataAttr").mockReturnValue(null);
        jest.spyOn(getImageReactionsDataOrDefaultModule, 'getImageReactionsDataOrDefault')
            .mockReturnValue({"buttons": {'like-add': false, 'dislike-add': true}, 'applied-action': 'like-add'});

        const result = prepareActionsToSend();

        expect(result).toEqual(['like-delete', 'dislike-add']);
    });

    it("applied action is dislike-add, buttons are not active", () => {
        jest.spyOn(getAllReactionButtonsModule, "getAllReactionButtons").mockReturnValue(null);
        jest.spyOn(getImageIdFromDataAttrModule, "getImageIdFromDataAttr").mockReturnValue(null);
        jest.spyOn(getImageReactionsDataOrDefaultModule, 'getImageReactionsDataOrDefault')
            .mockReturnValue({"buttons": {'like-add': false, 'dislike-add': false}, 'applied-action': 'dislike-add'});

        const result = prepareActionsToSend();

        expect(result).toEqual(['dislike-delete']);
    });

    it("applied action is dislike-add, `like-add` button is active", () => {
        jest.spyOn(getAllReactionButtonsModule, "getAllReactionButtons").mockReturnValue(null);
        jest.spyOn(getImageIdFromDataAttrModule, "getImageIdFromDataAttr").mockReturnValue(null);
        jest.spyOn(getImageReactionsDataOrDefaultModule, 'getImageReactionsDataOrDefault')
            .mockReturnValue({"buttons": {'like-add': true, 'dislike-add': false}, 'applied-action': 'dislike-add'});

        const result = prepareActionsToSend();

        expect(result).toEqual(['dislike-delete', 'like-add']);
    });
});