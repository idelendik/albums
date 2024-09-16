'use strict';

import {AlbumsTypeError, ArgumentError} from "../../errors.js";
import {isAction, isReaction} from "../../helpers.js";

export function buildEventName(reactionType, actionType) {
    if (arguments.length === 0) throw new ArgumentError();
    if (arguments.length === 1) throw new ArgumentError('`actionType` required');

    if (!isReaction(reactionType)) throw new AlbumsTypeError("`reactionType` should be of REACTION_TYPE");
    if (!isAction(actionType)) throw new AlbumsTypeError("`actionType` should be of ACTION_TYPE");

    return `${reactionType}-${actionType}`;
}