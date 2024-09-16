'use strict';

import {AlbumsTypeError, ArgumentError} from "../../errors.js";
import {isObject} from "../../../common/helpers.js";
import {ACTION_TYPE, REACTION_TYPE} from "../../constants.js";
import {buildEventName} from "../buildEventName/index.js";

export function isReactionsDataValid(reactionsData) {
    if (arguments.length === 0) throw new ArgumentError();

    if (!isObject(reactionsData)) throw new AlbumsTypeError("object required");

    if (Object.keys(reactionsData).length === 0) throw new AlbumsTypeError("passed object is empty");

    Object.entries(reactionsData).forEach(([imageId, data]) => {
        if (!Object.keys(data).includes('applied-action')) throw new AlbumsTypeError("reactions data is invalid - `applied-action` key required")

        if (typeof data['applied-action'] !== 'string') throw new AlbumsTypeError("should be a `string`");

        if (!Object.keys(data).includes('buttons')) throw new AlbumsTypeError("reactions data is invalid - `buttons` key required");

        const buttonsData = data['buttons'];

        if (!isObject(buttonsData)) throw new AlbumsTypeError("object required");

        const keyLikeAdd = buildEventName(REACTION_TYPE.LIKE, ACTION_TYPE.ADD);

        if (!Object.keys(buttonsData).includes(keyLikeAdd)) throw new AlbumsTypeError(`reactions data is invalid - ${keyLikeAdd} key required`);
        if (typeof buttonsData[keyLikeAdd] !== "boolean") throw new AlbumsTypeError("boolean required");

        const keyDislikeAdd = buildEventName(REACTION_TYPE.DISLIKE, ACTION_TYPE.ADD);

        if (!Object.keys(buttonsData).includes(keyDislikeAdd)) throw new AlbumsTypeError(`reactions data is invalid - ${keyDislikeAdd} key required`)
        if (typeof buttonsData[keyDislikeAdd] !== "boolean") throw new AlbumsTypeError("boolean required");

        if (buttonsData[keyLikeAdd] && buttonsData[keyDislikeAdd]) throw new AlbumsTypeError(`reactions data is invalid - both ${keyLikeAdd} and ${keyDislikeAdd} cannot be equal to true`);
    });

    return true;
}