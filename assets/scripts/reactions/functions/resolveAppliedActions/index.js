'use strict';

import {getReactionsData, setReactionsData} from "../../sessionStorage.js";

export function resolveAppliedActions(responseData) {
    const imageId = responseData['image-id'];
    const appliedActions = responseData['applied-actions'];

    // const reactions = getImageReactionsDataOrDefault(getImageIdFromDataAttr());
    const reactions = getReactionsData();

    // set both buttons to inactive
    Object.keys(reactions[imageId]['buttons']).forEach((key) => {
        reactions[imageId]['buttons'][key] = false;
    });

    // filter out *-delete action, because we store only *-add in applied
    const reactionToStoreAsApplied = appliedActions.filter((item) => !item.endsWith("delete"))[0] ?? "";

    // update applied action
    reactions[imageId]['applied-action'] = reactionToStoreAsApplied;

    // highlight button with applied action
    if (reactionToStoreAsApplied) {
        reactions[imageId]['buttons'][reactionToStoreAsApplied] = true;
    }

    setReactionsData(reactions);
}