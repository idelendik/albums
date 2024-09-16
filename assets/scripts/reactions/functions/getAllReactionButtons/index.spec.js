'use strict';

import {describe, expect, it} from "@jest/globals";
import {REACTION_BUTTON_ID_PREFIX} from "../../constants.js";
import {getAllReactionButtons} from "./index.js";

describe("getAllReactionButtons()", () => {
    const testCases = [
        {
            name: "ignores a button if it doesn't contain an id",
            markup: "<button />",
            expected: 0,
        },
        {
            name: "ignores a button if it contains a class with a target name instead of an id",
            markup: `<button class='${REACTION_BUTTON_ID_PREFIX}' id='someId' />`,
            expected: 0,
        },
        {
            name: "returns a button if its id starts with a target id",
            markup: `<button id='${REACTION_BUTTON_ID_PREFIX}' />`,
            expected: 1,
        },
        {
            name: "returns a button if its id contains target id",
            markup: `<button id='someId ${REACTION_BUTTON_ID_PREFIX}' />`,
            expected: 1,
        },
        {
            name: "ignores input[type='button'] with no ids",
            markup: `<input type="button" id='${REACTION_BUTTON_ID_PREFIX}' />`,
            expected: 0,
        },
        {
            name: "ignores non-buttons with a target id",
            markup: `<div id='${REACTION_BUTTON_ID_PREFIX}'></div>`,
            expected: 0,
        },
        {
            name: "returns more than one result",
            markup: `<button id='${REACTION_BUTTON_ID_PREFIX}' /><button id='${REACTION_BUTTON_ID_PREFIX}' />`,
            expected: 2,
        }
    ];

    testCases.forEach(({name, markup, expected}) => {
        it(name, () => {
            document.body.innerHTML = markup;

            const actual = getAllReactionButtons();

            expect(actual.length).toEqual(expected);
        });
    })
});