"use strict";

var gulp = require("gulp");
var plumber = require("gulp-plumber");
var sourcemap = require("gulp-sourcemaps");
var sass = require("gulp-sass");
var postcss = require("gulp-postcss");
var autoprefixer = require("autoprefixer");
var csso = require("gulp-csso");
var rename = require("gulp-rename");
var imagemin = require("gulp-imagemin");
var webp = require("gulp-webp");
var browserSync = require("browser-sync");
var del = require("del");
var uglify = require("gulp-uglify");
var connect = require('gulp-connect-php');

gulp.task("clean", function () {
  return del("build");
});

gulp.task("copy", function () {
  return gulp.src([
    "source/fonts/**/*.{woff,woff2}",
    "source/js/**/*.min.js",
    "source/*.ico",
  ], {
    base: "source"
  })
  .pipe(gulp.dest("build"));
});

gulp.task ("css", function () {
  return gulp.src("source/sass/style.scss")
    .pipe(plumber())
    .pipe(sourcemap.init())
    .pipe(sass())
    .pipe(postcss([
      autoprefixer()
    ]))
    .pipe(csso())
    .pipe(rename("style.min.css"))
    .pipe(sourcemap.write("."))
    .pipe(gulp.dest("build/css"))
    .pipe(browserSync.stream());
});

gulp.task("images", function () {
  return gulp.src("source/img/**/*.{png,jpg,svg}")
    .pipe(imagemin ([
      imagemin.optipng({optimizationLevel: 3}),
      imagemin.jpegtran({progressive: true}),
      imagemin.svgo()
    ]))
    .pipe(gulp.dest("build/img"));
});

gulp.task("webp", function () {
  return gulp.src("source/img/**/*.{png,jpg}")
    .pipe(webp({quality: 90}))
    .pipe(gulp.dest("build/img"));
});

gulp.task("jscompress", function () {
  return gulp.src("source/**/script.js")
    .pipe(uglify())
    .pipe(rename("script.min.js"))
    .pipe(gulp.dest("build/js"));
});

gulp.task("php", function () {
  return gulp.src("source/**/*.php")
  .pipe(gulp.dest("build"));
});

gulp.task("refresh", function (done) {
  browserSync.reload();
  done();
});

gulp.task("build", gulp.series(
  "clean",
  "copy",
  "css",
  "jscompress",
  "php",
  "images",
  "webp"
));

gulp.task('connect-sync', function() {
  connect.server({base: "build/", port: 8000}, function (){
    browserSync({
      proxy: '127.0.0.1:8000'
    });
  });

  gulp.watch("source/sass/**/*.{scss,sass}", gulp.series("css", "refresh"));
  gulp.watch("source/js/script.js", gulp.series("jscompress", "refresh"));
  gulp.watch("source/**/*.php", gulp.series("php", "refresh"));
});

gulp.task("start", gulp.series("build", "connect-sync"));
