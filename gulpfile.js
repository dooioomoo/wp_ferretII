"use strict";

import build from './assets/sass/gulpfiles/gulp-require.js';
// 引入配置
import setting from './assets/sass/gulpfiles/gulp-settings.js';
import sassTask from './assets/sass/gulpfiles/gulp-sass.js';
import jsTask from './assets/sass/gulpfiles/gulp-javascript.js';
import imgMini from './assets/sass/gulpfiles/gulp-image.js';

// 基本清理
const cleanJs = () => {
    return build.clean(jsTask.cleanFiles);
};
const cleanCss = () => {
    return build.clean(sassTask.cleanFiles);
};
/**
 * 监控函数
 */
const watchs = () => {
    /**
     * 基本框架管理
     */
    var common = [
        setting.sassPath + 'include/**/*',
    ];
    // 监控全局基础css框架更改
    build.gulp.watch(common, build.gulp.series(sassTask.commonToCss, cleanCss));
    // 监控themes目录下任何文件修改
    build.gulp.watch([
        setting.sassPath + 'front/**/*',
        setting.sassPath + 'admin/**/*',
    ],
        build.gulp.series(
            sassTask.createCss,
        ));
    //监控js修改
    build.gulp.watch(
        setting.sassPath + 'js/**/*',
        build.gulp.series(
            jsTask.commonJs,
            jsTask.footJs,
            cleanJs
        ));

    build.gulp.watch([
        setting.cssPath + '**/*',
        setting.jsPath + '**/*',
        setting.imagesPath + '**/*',
        './**/*.php',
    ], build.browserSync_reload);
};


const defaultTask = build.gulp.series(
    build.gulp.series(
        sassTask.commonToCss,
        sassTask.createCss,
        cleanCss,
    ),
    build.gulp.series(
        jsTask.commonJs,
        jsTask.footJs,
        cleanJs,
    ),
);
export const imagesMini = imgMini.ImageMini;
// exports.watch = build.gulp.series(defaultTask, build.gulp.parallel(watch, build.php, build.browserSync_start));
export const watch = build.gulp.series(defaultTask, build.gulp.parallel(watchs, build.browserSync_start));
export default defaultTask;
