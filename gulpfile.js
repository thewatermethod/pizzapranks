/*
	Open command prompt as administrator

	cd YOUR-THEME-DIRECTORY
    npm install gulp fs bootstrap@4.0.0-beta.2 postcss-discard-duplicates gulp-autoprefixer gulp-clean gulp-concat gulp-uglify gulp-sourcemaps run-sequence gulp-sass pump gulp-csslint gulp-postcss postcss precss --save-dev
    */

//these are all the modules that you installed above
var gulp = require('gulp'),
	clean = require('gulp-clean'),
	concat = require('gulp-concat'),
	uglify = require('gulp-uglify'),
	sourcemaps = require('gulp-sourcemaps'),
	runSequence = require('run-sequence'),
	sass = require( 'gulp-sass' ), 
	pump = require('pump'),
	autoprefixer = require('autoprefixer'),
    csslint = require('gulp-csslint'),
    cssnano = require('cssnano'),
    discardDuplicates = require('postcss-discard-duplicates'), 
	postcss = require('gulp-postcss'),
	transpile  = require('gulp-es6-module-transpiler'),
	babel = require('gulp-babel');
	
gulp.task( 'compile-bootstrap', function() { 
	return gulp.src('node_modules/bootstrap/scss/bootstrap.scss')
		.pipe( sass({ outputStyle: 'expanded' }).on('error', sass.logError) )
		.pipe( gulp.dest('scss/') )
});	

// this task builds and minifies the sass into css for the theme
gulp.task( 'build-sass', function(){
    var plugins = [
        autoprefixer({browsers: ['last 1 version']}),
        cssnano(),     
        discardDuplicates(),
    ];

	return gulp.src([ 'scss/*.scss', 'scss/*.css', ])
		.pipe( sourcemaps.init() )
		.pipe( concat( 'compiled.scss') )
        .pipe( sass({ outputStyle: 'expanded' }).on('error', sass.logError) )
        .pipe( postcss( plugins ) ) 
		.pipe( sourcemaps.write() )		
		.pipe( gulp.dest('css/') ) 
});


gulp.task('concat-js', function(cb) { 
	pump([
		gulp.src(['js/masonry.pkgd.min.js', 'js/main.js']),
		concat('compiled.js'),
		uglify(),
		gulp.dest('js/') 
	], 
	cb
	);
});

gulp.task('vendor-js', function (cb) {
 	pump([
		gulp.src(['node_modules/jquery/dist/jquery.slim.min.js','node_modules/popper.js/dist/umd/popper.min.js','node_modules/bootstrap/dist/js/bootstrap.js']),
        gulp.dest('js/')
    ],
    cb
  );
});

// runs all the build processes
gulp.task('compile', function(){
	runSequence(
		'compile-bootstrap',
		'build-sass',
		'concat-js',		
		'vendor-js'
	);
});


// runs all the processes
gulp.task( 'default', function(){
	runSequence( 'compile');
});