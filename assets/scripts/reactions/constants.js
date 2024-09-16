'use strict';

export const REACTION_BUTTON_ID_PREFIX = 'btn-reaction';

export const REACTION_API_URL = `${process.env.BASE_URL}/images/reaction`;

export const REACTION_TYPE = Object.freeze({
    LIKE: "like",
    DISLIKE: "dislike"
});
export const ACTION_TYPE = Object.freeze({
    ADD: "add",
    DELETE: "delete"
});

export const REACTION_BUTTON_ATTRIBUTE = 'name';