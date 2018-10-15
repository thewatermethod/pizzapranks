/*
	Open command prompt as administrator

	cd YOUR-THEME-DIRECTORY
    npm install
    */

//these are all the modules that you installed above
var gulp = require("gulp"),
  concat = require("gulp-concat"),
  uglify = require("gulp-uglify"),
  sourcemaps = require("gulp-sourcemaps"),
  runSequence = require("run-sequence"),
  sass = require("gulp-sass"),
  pump = require("pump"),
  autoprefixer = require("autoprefixer"),
  csslint = require("gulp-csslint"),
  cssnano = require("cssnano"),
  discardDuplicates = require("postcss-discard-duplicates"),
  postcss = require("gulp-postcss"),
  copy = require("copy");

gulp.task("compile-bootstrap", function() {
  return gulp
    .src("node_modules/bootstrap/scss/bootstrap.scss")
    .pipe(sass({ outputStyle: "expanded" }).on("error", sass.logError))
    .pipe(gulp.dest("scss/"));
});

// this task builds and minifies the sass into css for the theme
gulp.task("build-sass", function() {
  var plugins = [
    autoprefixer({ browsers: ["last 1 version"] }),
    cssnano(),
    discardDuplicates()
  ];

  return (
    gulp
      .src([
        "vendor/css/normalize.css",
        "scss/vars.scss",
        "scss/*.scss",
        "scss/*.css"
      ])
      //.pipe( sourcemaps.init() )
      .pipe(concat("compiled.scss"))
      .pipe(sass({ outputStyle: "expanded" }).on("error", sass.logError))
      .pipe(postcss(plugins))
      .pipe(csslint())
      .pipe(csslint.formatter())
      //.pipe( sourcemaps.write() )
      .pipe(gulp.dest("dist/css/"))
  );
});

gulp.task("concat-js", function(cb) {
  pump(
    [
      gulp.src(["js/vendor/*.js", "js/calendar.js", "js/main.js"]),
      concat("compiled.js"),
      uglify(),
      gulp.dest("dist/js")
    ],
    cb
  );
});

gulp.task("transport-vendor-css", function(cb) {
  copy(
    ["node_modules/normalize.css/normalize.css"],
    "css/vendor",
    { flatten: true },
    cb
  );
});

gulp.task("transport-vendor-js", function(cb) {
  copy(
    [
      "node_modules/webfontloader/webfontloader.js",
      "node_modules/moment/min/moment.min.js",
      "node_modules/vue/dist/vue.js"
    ],
    "js/vendor",
    { flatten: true },
    cb
  );
});

// runs all the processes
gulp.task("default", function() {
  runSequence(
    "transport-vendor-js",
    "transport-vendor-css",
    "build-sass",
    "concat-js"
  );
});
