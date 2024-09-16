'use strict';

window.onerror = function (message, url, line, col, error) {
    console.error(`${message}\n at ${url}. ${error}:${line}:${col}`);
};

import "bootstrap/dist/js/bootstrap.bundle.js";

import "lightbox2/dist/js/lightbox.min.js";

import {reactionsInit} from "./reactions/index.js";

import validation from "./validation.js";

import "./delete-album.js";
import "./delete-image.js";
import "./create-album.js";
import "./create-image.js";
import "./add-comment.js";
import "./update-image-details.js";

(() => {
    reactionsInit();
})();