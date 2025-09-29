import setting from './gulp-settings.js';
import build from './gulp-require.js';

export default {
    cleanFiles: [
        setting.js.exportPath.common + '**/*.debug.js',
    ],
    commonJs: () => {
        return (
            build.gulp
                .src(setting.js.importPath.common)
                .pipe(build.plumber())
                .pipe(build.concat('common.js'))
                .pipe(build.minify(
                    {
                        ext: {
                            src: '.debug.js',
                            min: '.min.js'
                        },
                        ignoreFiles: ['.combo.js', '.min.js', '-min.js']
                    }
                ))
                .pipe(build.gulp.dest(setting.js.exportPath.common))
        );
    },
    footJs: () => {
        return (
            build.gulp
                .src(setting.js.importPath.foot)
                .pipe(build.minify(
                    {
                        ext: {
                            src: '.debug.js',
                            min: '.min.js'
                        },
                        ignoreFiles: ['.combo.js', '.min.js', '-min.js']
                    }
                ))
                .pipe(build.gulp.dest(setting.js.exportPath.foot))
        );
    },

};
