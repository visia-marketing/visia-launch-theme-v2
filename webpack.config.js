const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = {
    entry: {
        main: [
            './assets/scripts/src/main.js',
            './assets/styles/src/main.scss'
        ]
    },
    devtool: 'source-map', // Recommended for development
    output: {
        filename: 'assets/scripts/dist/[name].min.js',
        path: path.resolve(__dirname)
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: ['@babel/preset-env']
                    }
                }
            },
            {
                test: /\.scss$/,
                use: [
                    MiniCssExtractPlugin.loader,
                    'css-loader',
                    'postcss-loader',
                    'sass-loader'
                ]
            },
            {
                test: /\.(woff(2)?|ttf|eot|svg|otf)$/,
                type: 'asset/resource',
                generator: {
                    filename: 'assets/styles/dist/fonts/[name][ext]'
                }
            },
            {
                test: /\.(png|jpg|jpeg|gif|svg)$/,
                type: 'asset/resource',
                generator: {
                    filename: 'assets/styles/dist/images/[name][ext]'
                }
            }
            
        ]
    },
    
    plugins: [
        new MiniCssExtractPlugin({
            filename: 'assets/styles/dist/[name].min.css'
        }),
    ]
};