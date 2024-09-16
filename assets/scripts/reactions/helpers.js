'use strict';

import {REACTION_TYPE, ACTION_TYPE} from "./constants.js";
import {ArgumentError, AlbumsTypeError} from "./errors.js";

export function isAction(actionValue) {
    if (arguments.length === 0) throw new ArgumentError();
    if (actionValue === null || actionValue === undefined) throw new AlbumsTypeError();
    if (typeof actionValue !== "string") throw new AlbumsTypeError();

    return Object.values(ACTION_TYPE).includes(actionValue.toLowerCase());
}

export function isReaction(reactionValue) {
    if (arguments.length === 0) throw new ArgumentError();
    if (reactionValue === null || reactionValue === undefined) throw new AlbumsTypeError();
    if (typeof reactionValue !== "string") throw new AlbumsTypeError();

    return Object.values(REACTION_TYPE).includes(reactionValue.toLowerCase());
}