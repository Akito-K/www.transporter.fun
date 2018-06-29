//var nic = 'html';
var nic = 'html';
var wan = 'html/assets';

// gulp
var gulp = require('gulp');
// webpack
var webpack = require('webpack-stream');
var webpackConfig = require('./webpack.config.js');
var del = require('del');
// sass
var sass = require('gulp-sass');

// webpack
var TS_SRC = './ts/*.ts';
var JS_DEST = nic+'/js/dest/';

gulp.task('clean', function() {
    del([JS_DEST]);
});

gulp.task('webpack', function () {
    return gulp.src([TS_SRC])
        .pipe(webpack(webpackConfig))
        .pipe(gulp.dest(JS_DEST));
});


// sass
gulp.task('sass', function() {
    return gulp.src([
        nic+'/css/scss/*.scss',
        wan+'/sass/*.scss'
    ])
    .pipe(sass({outputStyle: 'expanded'}).on('error', sass.logError))
//    .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
    .pipe(gulp.dest(nic+'/css/dest'));
});


// watch
gulp.task('watch', function() {
    gulp.watch(TS_SRC, ['webpack']);
    gulp.watch([
        wan+'/sass/mixins/*.scss',
        wan+'/sass/page/*.scss',
        wan+'/sass/parts/*.scss',
        wan+'/sass/*.scss',
        wan+'/sass/add/page/*.scss',
        wan+'/sass/add/mixins/*.scss',
        wan+'/sass/add/*.scss',

        nic+'/css/scss/*.scss',
        nic+'/css/scss/admin/*.scss',
        nic+'/css/scss/mypage/*.scss',
        nic+'/css/scss/common/*.scss',
        nic+'/css/scss/owner/*.scss',
        nic+'/css/scss/carrier/*.scss',

    ], ['sass']);
});

gulp.task('default', ['webpack', 'sass', 'watch']);
//gulp.task('default', ['sass', 'watch']);

