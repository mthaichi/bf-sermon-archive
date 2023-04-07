const gulp = require('gulp')

gulp.task('dist', function (done) {
	const files = gulp.src(
	  [
		'./**/*.php',
		'./**/*.txt',
		'./**/*.css',
		'./**/*.png',
		'./**/*.jpg',
		'./**/*.jpeg',
		'./**/*.svg',
		'./**/*.json',
		'./**/*.js',
		'./assets/**',
		'./inc/**',
		'./build/**',
		"./vendor/**",
		"!./.vscode/**",
		"!./bin/**",
		"!./dist/**",
		"!./node_modules/**/*.*",
		"!./tests/**",
		"!./dist/**",
	  ], {
		base: './'
	  }
	)
	files.pipe(gulp.dest("dist/bf-favorite-patterns"));
	done();
  });