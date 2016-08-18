var production = true;

var webpack = require('webpack');
var glob = require("glob");

var files = glob.sync("./jsx/apps/**.jsx");

var entry = {};

files.forEach(function (file) {
    //webpack will use the key as the output
    var fileName = file.split("/").pop();
    //get the file name, not the extension
    fileName = fileName.split(".")[0];
    entry[fileName] = file; 
});

module.exports = {
    context: __dirname,
    entry: entry,
    devServer:{
        inline : true,
        port : 1111
    },
    output: {
        path: "../build/js/dashboard",
        filename: "[name].min.js"
    },
    cache: true,
    module : {
        loaders : [
            {
                test :  /(\.jsx|\.js)$/,
                exclude : /node_modules/,
                loader: 'babel-loader',
                query : {
                    presets : ["es2015", "react"]
                }
            }
        ]
    },
    plugins: [
        new webpack.optimize.DedupePlugin(),
        new webpack.optimize.OccurenceOrderPlugin(),
        new webpack.optimize.UglifyJsPlugin({ mangle: false, sourcemap: false, compress : {warnings: true} }),
        production ? new webpack.DefinePlugin({
            'process.env':{
                'NODE_ENV': JSON.stringify('production')
            }
        }) : null,
    ],
};