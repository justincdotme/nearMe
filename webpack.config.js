var path = require('path');
var webpack = require('webpack');
const ExtractTextPlugin = require('extract-text-webpack-plugin');

module.exports = {
    entry: [
        './resources/assets/js/app'
    ],
    devtool: 'source-map',
    output: {
        filename: './public/assets/js/dist/main.js'
    },
    module: {
        loaders: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                loader: 'babel-loader',
                query: {
                    presets: ['es2015']
            }
            },
            {
                test: /\.scss$/,
                loader: ExtractTextPlugin.extract('css-loader!sass-loader')
            }
        ]
    },
    plugins: [
        new ExtractTextPlugin(
            {
                filename: './public/assets/css/dist/[name].css',
                disable: false,
                allChunks: true
            }
        )
    ],
    resolve: {
        extensions: ['.js', 'scss']
    }
};