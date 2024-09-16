'use strict';

import {isJqueryObject} from "../../../common/helpers.js";
import $ from "jquery";

export function getImageIdFromDataAttr(buttonsWithImageId) {
    if (!isJqueryObject(buttonsWithImageId) || buttonsWithImageId.length === 0) throw new Error("no image id found");

    let imageIds = buttonsWithImageId.map((idx, button) => $(button).data('image-id'));
    imageIds = [...new Set(imageIds)];

    if (imageIds.length > 1) throw new Error("buttons contain different image ids");

    if (!Number.isFinite(imageIds[0])) throw new Error("id should be finite");

    return Number(imageIds[0]);
}