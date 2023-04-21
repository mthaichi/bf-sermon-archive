const gulp = require('gulp');
const rename = require('gulp-rename');
const path = require('path');
const replace = require('gulp-replace');

// ルートディレクトリ名を取得する
const getRootDirectoryName = () => {
  const path = require('path');
  const currentDirectory = process.cwd();
  const rootDirectory = path.parse(currentDirectory).name;
  return rootDirectory;
};

// ルートディレクトリの bf-ga4-tag-installer.php を [ルートディレクトリ名].php に変更する。
gulp.task('rename', function() {
  const rootDirectory = getRootDirectoryName();
  return gulp.src('./bf-ga4-tag-installer.php')
    .pipe(rename(function(path) {
      path.basename = rootDirectory;
    }))
    .pipe(gulp.dest('./'));
});

// inc/ba-ga4-tag-installer のディレクトリ名を [ルートディレクトリ名] に変更する。
gulp.task('replace-dirname', function() {
  const rootDirectory = getRootDirectoryName();
  return gulp.src(['./inc/bf-ga4-tag-installer/**/*'])
    .pipe(rename(function(path) {
      path.dirname = path.dirname.replace('ba-ga4-tag-installer', rootDirectory);
    }))
    .pipe(gulp.dest('./inc/'));
});

// inc/ba-ga4-tag-installer内のクラス名を変数指定して同ディレクトリのすべてのファイルで置換する。
gulp.task('replace-classname', function() {
  const rootDirectory = getRootDirectoryName();
  const className = 'NewClassName'; // ここに変数名を指定する
  return gulp.src('./inc/bf-ga4-tag-installer/**/*.php')
    .pipe(replace(/class\s+[A-Za-z0-9_]+\s+/g, 'class ' + className + ' '))
    .pipe(gulp.dest('./inc/bf-ga4-tag-installer/'));
});

// 上記タスクをまとめて実行する。
gulp.task('default', gulp.series('rename', 'replace-dirname', 'replace-classname'));


gulp.task('dist', (done) => {
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
	files.pipe(gulp.dest("dist/bf-ga4-tag-installer"));
	done();
  });