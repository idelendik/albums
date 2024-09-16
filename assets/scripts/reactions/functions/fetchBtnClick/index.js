'use strict';

import {REACTION_API_URL} from "../../constants.js";
import {resolveAppliedActions} from "../resolveAppliedActions/index.js";


export async function fetchBtnClick(actionsToApply) {
    if (actionsToApply.length === 0) return;

    try {
        const resp = await fetch(`${REACTION_API_URL}`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(actionsToApply),
        });

        if (!resp.ok) {
            console.error('an error occurred while saving your reaction to the DB. Please try again');
            return;
        }

        try {
            const json = await resp.json();

            resolveAppliedActions(json);
        } catch (e) {
            console.error(e);
        }
    } catch (e) {
        console.error('an error occurred while sending your request to the server', e);
    }
}