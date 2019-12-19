"use strict";
/************************************************************************************/
// Load Basic plugins
const gulp = require("gulp");
const sass = require("gulp-sass");
const concat = require('gulp-concat');
const php = require('gulp-connect-php');
const browsersync = require("browser-sync").create();
const autoprefixer = require("autoprefixer");
const cssnano = require("cssnano");
const minify = require('gulp-minify');
const clean = require("gulp-clean");
const rename = require("gulp-rename");
const imagemin = require("gulp-imagemin");
const newer = require("gulp-newer");
const plumber = require("gulp-plumber");
const postcss = require("gulp-postcss");
const merge = require("merge-stream");
const setting = require('./gulp-settings');
module.exports = {
    gulp: gulp,
    sass: sass,
    concat: concat,
    browsersync: browsersync,
    autoprefixer: autoprefixer,
    cssnano: cssnano,
    minify: minify,
    rename: rename,
    imagemin: imagemin,
    newer: newer,
    plumber: plumber,
    postcss: postcss,
    merge: merge,
    clean: (list) => {
        return gulp
            .src(list, {read: false, allowEmpty: true})
            .pipe(clean());
    },
    concatArray: function (arr1, arr2, arr3) {
        if (arguments.length <= 1) {
            return false;
        }
        var concat_ = function (arr1, arr2) {
            var arr = arr1.concat();
            for (var i = 0; i < arr2.length; i++) {
                arr.indexOf(arr2[i]) === -1 ? arr.push(arr2[i]) : 0;
            }
            return arr;
        };
        var result = concat_(arr1, arr2);
        for (var i = 2; i < arguments.length; i++) {
            result = concat_(result, arguments[i]);
        }
        return result;
    },
    php: () => {
        php.server({base: setting.root, port: setting.port, keepalive: true});
    },
    browserSync_start: function browserSync(done) {
        browsersync.init({
            //在setting修改成真实域名
            proxy: setting.server,
            //proxy  : setting.server,
            baseDir: setting.root,
            open: true,
            notify: false,
        });
        done();
    },
    browserSync_reload: function browserSyncReload(done) {
        browsersync.reload();
        done();
    },
};
