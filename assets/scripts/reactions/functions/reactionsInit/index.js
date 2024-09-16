'use strict';

import $ from "jquery";
import {debounce} from "../../../common/helpers.js";
import {REACTION_BUTTON_ATTRIBUTE} from "../../constants.js"
import {prepareActionsToSend} from "../prepareActionsToSend/index.js";
import {fetchBtnClick} from "../fetchBtnClick/index.js";
import {getAllReactionButtons} from "../getAllReactionButtons/index.js";
import {highlightButtonByAttr} from "../highlightButtonByAttr/index.js";
import {resolveButtonsState} from "../resolveButtonsState/index.js";

export function reactionsInit() {
    if (typeof $ === "undefined") {
        throw new Error("jQuery is not defined");
    }

    const debouncedFetch = debounce(() => {
        const actionsToSend = prepareActionsToSend();

        fetchBtnClick(actionsToSend);
    });

    const $allButtons = getAllReactionButtons();
    if ($allButtons.length === 0) {
        console.warn("no reaction buttons exist");
        return;
    }

    highlightButtonByAttr($allButtons, REACTION_BUTTON_ATTRIBUTE);

    $allButtons.each((idx, btn) => $(btn).on('click', (e) => {
        const $btn = $(e.currentTarget);

        resolveButtonsState($btn);

        highlightButtonByAttr($allButtons, REACTION_BUTTON_ATTRIBUTE);

        debouncedFetch();
    }));
}