const path = require("path");
const TerserJSPlugin = require("terser-webpack-plugin");

module.exports = {
  entry: "./js/main.js",
  output: {
    filename: "bundle.js",
    path: path.resolve(__dirname, "dist/js"),
  },

  optimization: {
    minimizer: [new TerserJSPlugin({})],
  },
};
