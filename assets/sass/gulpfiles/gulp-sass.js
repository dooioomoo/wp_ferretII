import settings from './gulp-settings.js';
import build from './gulp-require.js';

export default {
    cleanFiles: [
        settings.clearFolder,
    ],
    commonToCss: () => {
        var exportPath = settings.sass.exportPath.common;
        return build.gulp
            .src(settings.sass.importPath.common)
            .pipe(build.plumber())
            .pipe(build.sass({ outputStyle: "expanded" }))
            .pipe(build.concat('common.css'))
            .pipe(build.gulp.dest(settings.clearFolder))
            .pipe(build.rename({ suffix: ".min" }))
            .pipe(build.postcss([build.autoprefixer(), build.cssnano()]))
            .pipe(build.gulp.dest(exportPath));
    },
    createCss: () => {
        var importPath = settings.sass.importPath.allCss,
            exportPath = settings.sass.exportPath.allCss;
        return build.gulp
            .src(importPath)
            .pipe(build.sass({ outputStyle: "expanded" }))
            .pipe(build.gulp.dest(exportPath))
            .pipe(build.postcss([build.cssnano()]))
            .pipe(build.gulp.dest(exportPath));
    },
    WebFonts: () => {
        return build.gulp
            .src(config.webfonts.importPath)
            .pipe(build.plumber())
            .pipe(build.gulp.dest(config.webfonts.exportPath))
    },
};
