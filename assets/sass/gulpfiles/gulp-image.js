const setting = require('./gulp-settings');
const build = require('./gulp-require');

module.exports = {
    OutImage: () => {
        return (
            build.gulp
                .src(setting.images.importPath.common)
                .pipe(build.plumber())
                .pipe(build.gulp.dest(setting.images.exportPath.common))
        );
    },

    ImageMini: () => {
        //合并上方的输出路径，以便优化图片大小
        // var imgPath = build.concatArray(
        //     setting.images.exportPath.common,
        // );
        var imgPath = [
            setting.images.exportPath.common,
        ];

        var R = imgPath.map(function (element) {
            return build.gulp
                .src(element + '*')
                .pipe(
                    build.imagemin([
                        build.imagemin.gifsicle({interlaced: true}),
                        build.imagemin.jpegtran({progressive: true}),
                        build.imagemin.optipng({optimizationLevel: 5}),
                        build.imagemin.svgo({
                            plugins: [
                                {
                                    removeViewBox: false,
                                    collapseGroups: true
                                }
                            ]
                        })
                    ], {verbose: true})
                )
                .pipe(build.gulp.dest(element));
        });

        return build.merge(R);

    }
};