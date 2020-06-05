/*global require __dirname module */
let path = require('path');
const webpack = require('webpack');

let conf = {
    entry: {
        main: './src/scrypts/main.js', // основной модуль, содержит подгружаемые библиотеки, в том числе JQuery
        index: './src/scrypts/index.js', // Основной скрипт
        lk: './src/scrypts/lk.js' // модуль личного кабинета
    },
    output: {
        path: path.resolve(__dirname, 'web','build'),
        filename: '[name].js',
        publicPath: 'web/build/'
    },
    plugins: [
        new webpack.ProvidePlugin({
              jQuery: 'jquery',
              $: 'jquery',
              'window.jQuery': 'jquery'
          }),
      ],
    optimization: {
        splitChunks: {
            cacheGroups: {
                commons: {
                    name: 'base',
                    test: 'main',
                    chunks: 'all',
                    minChunks: 2,
                    enforce: true
                },
            }
        },
        // dumps the manifest into a separate file
        runtimeChunk: {
            name: "manifest",
        }
    },
    devServer: {
        overlay: true
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                loader: 'babel-loader',
            }
        ]
    }

};

module.exports = (env,options) => {
    console.log(options.mode);
    conf.devtool = options.mode === "production" ?
                        false :
                        "cheap-module-source-map";
    return conf;
};