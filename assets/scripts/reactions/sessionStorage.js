'use strict';

import {getItem, setItem} from "../common/sessionStorage.js";
import {tryJsonParse, tryJsonStringify} from "../common/json.js";
import {AlbumsTypeError, ArgumentError} from "./errors.js";
import {isObject} from "../common/helpers.js";
import {isReactionsDataValid} from "./functions/isReactionsDataValid/index.js";

export const SESSION_STORAGE_REACTIONS_KEY = 'reactions';

export function getReactionsData() {
    const dataFromSessionStorage = getItem(SESSION_STORAGE_REACTIONS_KEY);
    if (dataFromSessionStorage === null) return null;

    const jsonData = tryJsonParse(dataFromSessionStorage);
    if (tryJsonParse(dataFromSessionStorage) === null) return null;

    return jsonData;
}

export function setReactionsData(value) {
    if (arguments.length === 0) throw new ArgumentError();
    if (!isObject(value)) throw new AlbumsTypeError('argument should be an object');
    if (!isReactionsDataValid(value)) throw new AlbumsTypeError('trying to save invalid reactions data');

    let valueToStore = tryJsonStringify(value);
    if (valueToStore === null) return;

    setItem(SESSION_STORAGE_REACTIONS_KEY, valueToStore);
}