const { watch, src, series , dest} = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const autoprefixer = require('gulp-autoprefixer');
const replace = require('gulp-replace');
const sourcemaps = require('gulp-sourcemaps');
const zip = require('gulp-zip');
const gulp = require("gulp");
const fs = require('fs');
const yargs = require('yargs');
const cssbeautify = require('gulp-beautify');
const gulpif = require("gulp-if");
const cleanCSS = require("gulp-clean-css");
const PRODUCTION = yargs.argv.prod;
var rename = require("gulp-rename");
const webpack = require('webpack-stream');
var webpack2 = require('webpack');



const paths = {
    styles: {
        src : ['assets/scss/**/*.scss'],
        dest: 'assets/css'
    },
    scripts: {
        src : ['assets/js/bundle.js', 'assets/js/elementor.js'],
        dest: 'assets/js'
    },
    package: {
        src : ['**/*', '!node_modules{,/**}', '!src{,/**}', '!packaged{,/**}'],
        dest: 'packaged'
    }
};

function buildStyles() {
    return gulp.src(paths.styles.src)
        .pipe(sass().on('error', sass.logError))
        .pipe(gulpif(PRODUCTION, cleanCSS()))
        .pipe(autoprefixer({cascade: false}))
        .pipe(rename('style.min.css'))
        .pipe(gulp.dest(paths.styles.dest))
};
function buildStyles_pd() {
    return gulp.src(paths.styles.src)
        .pipe(sass().on('error', sass.logError))
        .pipe(gulpif(PRODUCTION, cleanCSS()))
        .pipe(autoprefixer({cascade: false}))
        .pipe(cleanCSS())
        .pipe(purgecss({
            content: ['**/*.php']
        }))
        .pipe(rename('main.min.css'))
        .pipe(gulp.dest(paths.styles.dest));
};




function watchTask () {
   [
    watch(paths.styles.src, buildStyles, buildStyles_pd),
   ]
}

exports.buildStyles_pd = buildStyles_pd;
exports.buildStyles = buildStyles;

exports.default = series(buildStyles, watchTask, buildStyles_pd);
