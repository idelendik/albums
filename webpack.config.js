'use strict';

import * as path from "path";
import {fileURLToPath} from "url";
import Dotenv from "dotenv-webpack";

const __filename = fileURLToPath(import.meta.url); // get the resolved path to the file
const __dirname = path.dirname(__filename); // get the name of the directory

export default function (env) {
    return {
        stats: {
            errorDetails: true,
        },
        mode: env.MODE,
        entry: './assets/scripts/index.js',
        output: {
            filename: 'index.[contenthash].js',
            path: path.resolve(__dirname, 'public', 'assets', 'scripts'),
            clean: true,
        },
        devtool: 'eval-source-map',
        watch: true,
        plugins: [
            new Dotenv({
                path: `.env.${env.MODE}`
            }),
        ]
    }
};