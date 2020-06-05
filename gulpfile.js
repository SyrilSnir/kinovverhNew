/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
const { src, dest,series, watch } = require('gulp');
const sass = require('gulp-sass');
const rename = require('gulp-rename');
const cleanCSS = require('gulp-clean-css');
const gcmq = require('gulp-group-css-media-queries');
const autoprefixer = require('gulp-autoprefixer');

function first(done) {
    console.log('Preved');
    done();
}

function buildDevelopment(done) {
    return src('web/index-dev.php')
            .pipe(rename('index.php'))
            .pipe(dest('web/'));
    done();
}

function buildProduction(done) {
    return src('web/index-prod.php')
            .pipe(rename('index.php'))
            .pipe(dest('web/'));
    done();
}

function moveJs() {
    return src('dist/js/**/*.js')
            .pipe(rename({ extname : '.min.js'}))
            .pipe(dest('templates/rosspetsmash_2019/js/'));
}
function stylesCompile() {
    return src('src/styles/global.scss')
            .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
            .pipe(gcmq())
            .pipe(autoprefixer({
                overrideBrowserslist: ['last 2 versions'],
                cascade: false
            })) 
            .pipe(cleanCSS({
                level: 2
            }))
            .pipe(rename('main.css'))
            .pipe(dest("web/css/"));      
}
function bootstrapCompile() {
        return src('src/styles/bootstrap.scss')
            .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
            .pipe(gcmq())
            .pipe(autoprefixer({
                overrideBrowserslist: ['last 2 versions'],
                cascade: false
            })) 
            .pipe(cleanCSS({
                level: 2
            }))
            .pipe(rename('bootstrap.css'))
            .pipe(dest("web/css/"));
}
function watches() {
watch('src/styles/**/*.scss',{events: 'all' },function(done){
        stylesCompile();
        bootstrapCompile();
        done();
    });

watch('dist/js/**/*.js',{events: 'all' },function(done){
    moveJs();
    done();
});
}
exports.default = watches;
exports.prod = buildProduction;
exports.dev = buildDevelopment;
    
/*
 * 
exports.default = series (
        move,
        stylesCompile
        );*/
        exports.first = first;
        //exports.move = move;

