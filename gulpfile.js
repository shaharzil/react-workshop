// Less configuration
var gulp = require('gulp');
var less = require('gulp-less');
var path = require('path');

// gulp.task('less', function() {
//     gulp.src('*.less')
//         .pipe(less())
//         .pipe(gulp.dest(function(f) {
//             return f.base;
//         }))
// });

gulp.task('less', function () {
  return gulp.src('./less/**/*.less')
    .pipe(less({
      paths: [ path.join(__dirname, 'less', 'includes') ]
    }))
    .pipe(gulp.dest('./css'));
});

gulp.task('default', function() {
    gulp.watch('less/*.less', ['less']);
})