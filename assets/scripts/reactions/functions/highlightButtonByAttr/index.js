'use strict';

import {AlbumsTypeError, ArgumentError} from "../../errors.js";
import $ from "jquery";
import {getImageIdFromDataAttr} from "../getImageIdFromDataAttr/index.js";
import {ACTION_TYPE} from "../../constants.js";
import {getImageReactionsDataOrDefault} from "../getImageReactionsDataOrDefault/index.js";
import {getAllReactionButtons} from "../getAllReactionButtons/index.js";
import {buildEventName} from "../buildEventName/index.js";
import {setBootstrapButtonActive} from "../setBootstrapButtonActive/index.js";
import {unsetBootstrapButtonActive} from "../unsetBootstrapButtonActive/index.js";

export function highlightButtonByAttr($buttons, attributeName) {
    if (arguments.length === 0) throw new ArgumentError();
    if (arguments.length === 1) throw new ArgumentError("`attributeName` required");
    if (!($buttons instanceof $)) throw new AlbumsTypeError("`$buttons` must be an instance of jQuery");

    $buttons.each((idx, button) => {
        const $button = $(button);

        const $attributeValue = $button.attr(attributeName);
        if (!$attributeValue) throw new ArgumentError("button doesn't contain specified attribute");

        const reactions = getImageReactionsDataOrDefault(getImageIdFromDataAttr(getAllReactionButtons()));

        const eventName = buildEventName($attributeValue, ACTION_TYPE.ADD);

        if (reactions['buttons'][eventName]) {
            setBootstrapButtonActive($button);
        } else {
            unsetBootstrapButtonActive($button);
        }
    });
}