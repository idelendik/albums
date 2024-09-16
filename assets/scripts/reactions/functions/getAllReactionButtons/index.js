'use strict';

import $ from "jquery";
import {REACTION_BUTTON_ID_PREFIX} from "../../constants.js";

export function getAllReactionButtons() {
    return $(`button[id*="${REACTION_BUTTON_ID_PREFIX}"]`);
}