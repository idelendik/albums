'use strict';

import {ArgumentError} from "../../errors.js";
import {getReactionsData} from "../../sessionStorage.js";
import {buildDefaultImageReactionsData} from "../buildDefaultImageReactionsData/index.js";
import {isReactionsDataValid} from "../isReactionsDataValid/index.js";

export function getImageReactionsDataOrDefault(imageId) {
    if (arguments.length === 0) throw new ArgumentError();
    if (!Number.isFinite(imageId)) throw new TypeError("`imageId` must be a number");
    if (imageId <= 0) throw new TypeError("`imageId` must be a positive number");

    const defaultReactionsData = buildDefaultImageReactionsData();

    const dataFromStorage = getReactionsData();

    if (dataFromStorage === null) return defaultReactionsData;
    if (!isReactionsDataValid(dataFromStorage)) return defaultReactionsData;
    if (!dataFromStorage[imageId]) return defaultReactionsData;

    return dataFromStorage[imageId];
}