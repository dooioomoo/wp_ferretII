"use strict";
/************************************************************************************/
// Load Basic plugins
import gulp from 'gulp';
import dartSass from "sass";
import gulpSass from 'gulp-sass';
const sass = gulpSass(dartSass);
import concat from 'gulp-concat';
import php from 'gulp-connect-php';
import browsersync from "browser-sync";
import autoprefixer from "autoprefixer";
import cssnano from "cssnano";
import minify from 'gulp-minify';
import clean from "gulp-clean";
import rename from "gulp-rename";
import imagemin from "gulp-imagemin";
import newer from "gulp-newer";
import plumber from "gulp-plumber";
import postcss from "gulp-postcss";
import merge from "merge-stream";
import setting from './gulp-settings.js';


export default {
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
            .src(list, { read: false, allowEmpty: true })
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
        php.server({ base: setting.root, port: setting.port, keepalive: true });
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
