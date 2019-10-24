// Importerar diverse metoder från Gulp
const {src, dest, series, parallel, watch} = require('gulp');

// Importerar paketet "gulp-sass" för att konvertera sass/scss till vanlig css
const sass = require('gulp-sass');

// Importerar paketet "gulp-sourcemaps" som fixar sourcemaps för att lättare hitta vart kod är skriven
const sourcemaps = require('gulp-sourcemaps');




const files = {
    sassPath: 'admin/scss/*.scss',
}



function sassTask() {
    return src(files.sassPath)
        .pipe(sourcemaps.init())
        .pipe(sass({
            outputStyle: 'compressed'
        }).on('error', sass.logError))
        .pipe(sourcemaps.write('./maps'))
        .pipe(dest('admin/css'))
}


exports.default = function() {
    watch('admin/scss', sassTask)
};