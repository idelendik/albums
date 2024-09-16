'use strict';

import {getImageIdFromDataAttr} from "../getImageIdFromDataAttr/index.js";
import {getImageReactionsDataOrDefault} from "../getImageReactionsDataOrDefault/index.js";
import {getAllReactionButtons} from "../getAllReactionButtons/index.js";

export function prepareActionsToSend() {
    const reactionsData = getImageReactionsDataOrDefault(getImageIdFromDataAttr(getAllReactionButtons()));

    const buttonsState = reactionsData['buttons'];
    const appliedReaction = reactionsData['applied-action'];

    if (appliedReaction.length === 0) {
        // send a truthy reaction or noting
        if (buttonsState['like-add']) return ['like-add'];
        if (buttonsState['dislike-add']) return ['dislike-add'];
    } else {
        if (appliedReaction === 'like-add') {
            let res = [];

            if (!buttonsState['like-add']) {
                res.push('like-delete');
            }

            if (buttonsState['dislike-add']) {
                res.push('dislike-add');
            }

            return res;
        } else if (appliedReaction === 'dislike-add') {
            let res = [];

            if (!buttonsState['dislike-add']) {
                res.push('dislike-delete');
            }

            if (buttonsState['like-add']) {
                res.push('like-add');
            }

            return res;
        }
    }

    return [];
}