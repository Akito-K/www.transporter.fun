'use strict';
var path = require('path');
var webpack = require('webpack');
var env = process.env.NODE_ENV;
let config = {
    entry: {
//        script :'./ts/script.ts'
//        admin  :'./ts/admin.ts'
//        mypage :'./ts/mypage.ts'
//        'owner' :'./ts/owner.ts'
        'carrier' :'./ts/carrier.ts'
    },
    output: {
        filename: '[name].js'
    },
    resolve: {
        extensions:['.ts', '.webpack.js', '.web.js', '.js']
    },
    module: {
        loaders: [
            { test: /\.ts$/, loader: 'ts-loader' }
        ]
    },
    plugins: [
        new webpack.DefinePlugin({
            'process.env.NODE_ENV' : JSON.stringify(env)
        }),
        new webpack.optimize.OccurrenceOrderPlugin()
    ]
};

if (env === 'production') {
    config.output.filename = '[name].min.js';
    config.plugins.push(new webpack.optimize.UglifyJsPlugin({
        compress: {
            warnings: false
        }
    }));
} else {
    config.devtool = 'source-map';
}

module.exports = config;