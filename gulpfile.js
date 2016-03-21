var gulp     = require('gulp');
var del      = require('del');
var cssmin   = require('gulp-cssmin');
var rename   = require('gulp-rename');
var sequence = require('gulp-sequence');

gulp.task('rm', function() {
	return del(['dist']);
});

gulp.task('cp', function() {
	return gulp.src('src/**/*')
		.pipe(gulp.dest('dist'));
});

gulp.task('compresscss', function() {
	return gulp.src('src/css/*.css')
		.pipe(cssmin())
		.pipe(rename({suffix: '.min'}))
		.pipe(gulp.dest('dist/css'));
});

gulp.task('build', sequence('rm', 'cp', ['compresscss']));
