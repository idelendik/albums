'use strict';

import {ArgumentError} from "../../errors.js";
import $ from "jquery";
import {getImageIdFromDataAttr} from "../getImageIdFromDataAttr/index.js";
import {REACTION_BUTTON_ATTRIBUTE} from "../../constants.js";
import {getReactionsData, setReactionsData} from "../../sessionStorage.js";
import {getImageReactionsDataOrDefault} from "../getImageReactionsDataOrDefault/index.js";
import {getAllReactionButtons} from "../getAllReactionButtons/index.js";

export function resolveButtonsState($btn) {
    if (arguments.length === 0) throw new ArgumentError('argument is missing');
    if (!($btn instanceof $)) throw new TypeError('argument must be a jQuery instance');

    const imageId = getImageIdFromDataAttr(getAllReactionButtons());
    const imageReactionsData = getImageReactionsDataOrDefault(imageId);

    const currentReactionType = $btn.attr(REACTION_BUTTON_ATTRIBUTE);
    if (!currentReactionType) return;

    Object.entries(imageReactionsData['buttons']).forEach(([buttonType, isButtonActive]) => {
        imageReactionsData['buttons'][buttonType] = buttonType.startsWith(currentReactionType) ? !isButtonActive : false;
    });

    setReactionsData(Object.assign(getReactionsData() ?? {}, {[imageId]: imageReactionsData}));
}