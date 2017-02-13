var path = require('path');
var webpack = require('webpack');
var ExtractTextPlugin = require('extract-text-webpack-plugin');
var OptimizeCssAssetsPlugin = require('optimize-css-assets-webpack-plugin');

module.exports = {
    entry: {
        app: './resources/assets/js/app',
        vendor: ['vue', 'html5shiv']
    },
    devtool: 'source-map',
    output: {
        path: path.resolve(__dirname, 'public/assets/'),
        filename: 'js/dist/[name].js',
        publicPath: './public'
        //filename: './public/assets/js/dist/main.js'
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
            },
            {
                test: /\.vue$/,
                loader: 'vue-loader',
                options: {
                    loaders: {
                        // Since sass-loader (weirdly) has SCSS as its default parse mode, we map
                        // the "scss" and "sass" values for the lang attribute to the right configs here.
                        // other preprocessors should work out of the box, no loader config like this necessary.
                        'scss': 'vue-style-loader!css-loader!sass-loader',
                        'sass': 'vue-style-loader!css-loader!sass-loader?indentedSyntax'
                    }
                    // other vue-loader options go here
                }
            }
        ]
    },
    plugins: [
        new ExtractTextPlugin(
            {
                filename: './css/dist/[name].css',
                disable: false,
                allChunks: true
            }
        ),
        new webpack.optimize.CommonsChunkPlugin({
            names: ['vendor']
        }),
        new OptimizeCssAssetsPlugin({
            assetNameRegExp: /\.css$/g,
            cssProcessor: require('cssnano'),
            cssProcessorOptions: { discardComments: {removeAll: true } },
            canPrint: true
        })
    ],
    resolve: {
        extensions: ['.js', 'scss'],
        alias: {
            'vue$': 'vue/dist/vue.common.js'
        }
    }
};

if (process.env.NODE_ENV === 'production') {
    module.exports.plugins.push(
        new webpack.optimize.UglifyJsPlugin({
            sourcemap: true,
            compress: {
                warnings: false
            }
        })
    );

    module.exports.plugins.push(
        new webpack.DefinePlugin({
            'process.env': {
                NODE_ENV: '"production"'
            }
        })
    );
}