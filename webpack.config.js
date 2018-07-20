 var path = require('path');
 var webpack = require('webpack');

 module.exports = {
    mode: 'development',
     entry: {
        main: './js/main.js'
     },
     output: {
         path: path.resolve(__dirname, 'build'),
         filename: 'main.bundle.js'
     },
     module: {
         rules: [
             {
                 test: /\.js$/,
                 loader: 'babel-loader',
                 query: {
                     presets: ['es2015']
                 }
             }
         ]
     },
    plugins: [
        new webpack.ProvidePlugin({
          $: "jquery",
          jQuery: "jquery"
        })
    ],
     stats: {
         colors: true
     }
 };