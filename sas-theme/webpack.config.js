const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const WebpackBar = require('webpackbar');
const webpack = require('webpack');

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
    resolve: {
        alias: {
          'jquery': 'jquery/src/jquery',
          'foundation': 'foundation-sites/js/foundation.core',
          'slick-carousel': 'slick-carousel/slick/slick.js'
        }
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
                    // 'sass-loader'
                    {
                        loader: 'sass-loader',
                        options: {
                          sassOptions: {
                            includePaths: [
                              path.resolve(__dirname, 'node_modules/foundation-sites/scss'),
                              path.resolve(__dirname, 'assets/styles/src')
                            ]
                          }
                        }
                      }
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
        new WebpackBar({
            name: 'build', // Customize the name if you want
            color: '#00ff00', // Customize the color
        }),
        new webpack.ProvidePlugin({
            $: 'jquery',
            jQuery: 'jquery',
            'window.jQuery': 'jquery',
            'window.$': 'jquery'
        })
    ],
    stats: {
        assets: true, // Keep assets by chunk messages
        assetsSort: "size", // Optionally, sort the assets by size
        children: false, // Hide child compilation details
        chunks: true, // Show chunks (by chunk)
        chunkModules: false, // Hide modules within chunks
        modules: false, // Hide the modules section
        warnings: false, // Keep the warnings
        performance: true, // Keep performance warnings
        excludeAssets: [/assets\/styles\/dist\/fonts/, /assets\/styles\/dist\/images/], // Exclude specific asset paths
      },
};