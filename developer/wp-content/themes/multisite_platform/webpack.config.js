// Version: 1.0.0
const fs = require("fs");
const path = require("path");
const CopyWebpackPlugin = require("copy-webpack-plugin");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const ImageMinimizerPlugin = require("image-minimizer-webpack-plugin");
const RemoveEmptyScriptsPlugin = require("webpack-remove-empty-scripts");
const env = process.env.NODE_ENV || "development";

const entriesFiles = (folder = "js", ext = "js", substring = 3) => {
  let regex = new RegExp(`.*\.${ext}$`);
  const folderPath = path.resolve(__dirname, `src/${folder}/`);
  if (!fs.existsSync(folderPath)) {
    return {};
  }
  return fs
    .readdirSync(folderPath)
    .filter((file) => file.match(regex))
    .map((file) => {
      return {
        name: file.substring(0, file.length - substring),
        path: path.resolve(__dirname, `src/${folder}/${file}`),
      };
    })
    .reduce((files, file) => {
      files[file.name] = file.path;
      return files;
    }, {});
};

let config = {
  mode: env,
  entry: {
    ...entriesFiles(),
    ...entriesFiles("scss", "scss", 5),
    ...entriesFiles("css", "css", 4),
  },
  output: {
    path: path.resolve(__dirname, `dist`),
    filename: "js/[name].js",
    publicPath: "/",
    environment: {
      arrowFunction: false,
    },
    clean: {
      keep: /.*\.php/,
    },
  },
  module: {
    rules: [
      {
        test: /\.css$/,
        exclude: /node_modules/,
        use: [
          {
            loader: MiniCssExtractPlugin.loader,
          },
          {
            loader: "css-loader",
            options: {
              url: false,
            },
          },
          {
            loader: "postcss-loader",
            options: {
              postcssOptions: {
                config: path.resolve(__dirname, "postcss.tailwind.config.js"),
              },
            },
          },
        ],
      },
      {
        test: /\.s[ac]ss$/,
        exclude: /node_modules/,
        use: [
          {
            loader: MiniCssExtractPlugin.loader,
          },
          {
            loader: "css-loader",
            options: {
              url: false,
            },
          },
          {
            loader: "postcss-loader",
            options: {
              postcssOptions: {
                config: path.resolve(__dirname, "postcss.config.js"),
              },
            },
          },
          {
            loader: "sass-loader",
            options: {
              implementation: require("sass"),
            },
          },
        ],
      },
      {
        test: /\.js$/,
        exclude: /(node_modules)/,
        use: {
          loader: "babel-loader",
        },
      },
      {
        test: /\.(ttf|eot|svg|woff(2)?)$/i,
        loader: "file-loader",
        options: {
          name: "[name].[ext]",
          outputPath: "fonts/",
        },
      },
      {
        test: /\.(jpe?g|png|gif|svg)$/i,
        type: "asset",
      },
      {
        test: /\.(jpe?g|png|gif|svg)$/i,
        use: [
          {
            loader: ImageMinimizerPlugin.loader,
            options: {
              minimizer: {
                implementation: ImageMinimizerPlugin.imageminMinify,
                options: {
                  plugins: [
                    "imagemin-gifsicle",
                    "imagemin-mozjpeg",
                    "imagemin-pngquant",
                    "imagemin-svgo",
                  ],
                },
              },
            },
          },
        ],
      },
    ],
  },
  plugins: [
    new RemoveEmptyScriptsPlugin(),
    new MiniCssExtractPlugin({
      filename: "css/[name].css",
    }),

    new CopyWebpackPlugin({
      patterns: [
        {
          from: path.join(__dirname, "src/images"),
          to: "images",
          noErrorOnMissing: true,
        },
        {
          from: path.join(__dirname, "src/fonts"),
          to: "fonts",
          noErrorOnMissing: true,
        },
      ],
    }),
  ],
};
if (env === "development") {
  config.devServer = {
    host: "localhost",
    port: 9000,
    contentBase: path.resolve(__dirname, `dist`),
    publicPath: "/",
    writeToDisk: true,
  };
}

module.exports = config;
