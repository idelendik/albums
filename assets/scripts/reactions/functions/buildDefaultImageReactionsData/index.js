'use strict';

import {ACTION_TYPE, REACTION_TYPE} from "../../constants.js";
import {buildEventName} from "../buildEventName/index.js";


export function buildDefaultImageReactionsData() {
    return {
        'buttons': {
            [`${buildEventName(REACTION_TYPE.LIKE, ACTION_TYPE.ADD)}`]: false,
            [`${buildEventName(REACTION_TYPE.DISLIKE, ACTION_TYPE.ADD)}`]: false,
        },
        'applied-action': ''
    };
}