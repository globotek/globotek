/*------------------------------------
 MODULES
 ------------------------------------*/
var gulp        = require('gulp'),
    del         = require('del'),
    sass        = require('gulp-sass'),
    watch       = require('gulp-watch'),
    sync        = require('browser-sync').create(),
    reload      = sync.reload,
    sequence    = require('run-sequence'),
    autoprefix  = require('gulp-autoprefixer'),
    sourcemaps  = require('gulp-sourcemaps'),
    minify_css  = require('gulp-clean-css'),
    minify_svg  = require('gulp-svgmin'),
    svg_symbols = require('gulp-svg-symbols'),
    concat      = require('gulp-concat'),
    uglify      = require('gulp-uglify');


/*------------------------------------
 GLOBAL VARS
 ------------------------------------*/
var THEMES = ['globotek'];
var PLUGINS = [];

var PROJECT_DIRECTORIES = {
	themes: THEMES,
	plugins: PLUGINS
};

gulp.task('default', function () {

	gulp.task('browser_sync', function () {

		sync.init({
			https: false,
			open: true,
			reloadDelay: 50
		});

	});

	

	for (var PROJECT_TYPE in PROJECT_DIRECTORIES) {

		PROJECT_DIRECTORIES[PROJECT_TYPE].forEach(function (PROJECT_DIRECTORY) {

			var SOURCE              = PROJECT_TYPE + '/' + PROJECT_DIRECTORY + '/',
			    PROJECT_SCSS        = SOURCE + 'scss/project/**/*.scss',
			    PROJECT_SVG         = SOURCE + 'svg/*.svg',
			    PROJECT_SCRIPTS     = SOURCE + 'scripts',
			    DESTINATION         = '../wp-content/' + PROJECT_TYPE + '/' + PROJECT_DIRECTORY,
			    DESTINATION_CSS     = DESTINATION + '/css',
			    DESTINATION_SVG     = DESTINATION + '/images/svg',
			    DESTINATION_SCRIPTS = DESTINATION + '/scripts',
			    DESTINATION_PHP     = DESTINATION + '/**/*.php';

			console.log(PROJECT_SCSS);
			console.log(PROJECT_SVG);


			gulp.task('process_scss', function () {

				return gulp.src(PROJECT_SCSS)
					.pipe(sass().on('error', sass.logError))
					.pipe(sourcemaps.init())
					.pipe(autoprefix({
						browsers: ['last 2 versions'],
						cascade: false
					}))
					.pipe(minify_css())
					.pipe(sourcemaps.write('.'))
					.pipe(gulp.dest(DESTINATION_CSS))
					.pipe(sync.reload({
						stream: true
					}));

			});


			gulp.task('process_svg', function () {

				return gulp.src(PROJECT_SVG)
				//.pipe(minify_svg())
					.pipe(svg_symbols())
					.pipe(gulp.dest(DESTINATION_SVG));

			});


			gulp.task('delete_svg_css', function () {

				del(DESTINATION_SVG + '/*.css', {force: true});

			});

			gulp.task('process_script_libraries', function () {

				var sources = [
					'global/scripts/lib/*.js'
				];

				return gulp.src(sources)
					.pipe(concat('lib.js'))
					//.pipe(uglify())
					.pipe(gulp.dest(DESTINATION_SCRIPTS));

			});


			gulp.task('process_scripts', function () {

				var sources = [
					'global/scripts/_helpers.js',
					PROJECT_SCRIPTS + '/modules/*.js',
					PROJECT_SCRIPTS + '/app.js'
				];

				gulp.start('process_script_libraries');

				return gulp.src(sources)
					.pipe(sourcemaps.init())
					.pipe(concat('app.js'))
					//.pipe(uglify())
					.pipe(sourcemaps.write('.'))
					.pipe(gulp.dest(DESTINATION_SCRIPTS));

			});


			sequence('process_scss', 'process_svg', 'delete_svg_css', 'process_scripts', function () {

				gulp.watch(PROJECT_SCSS, ['process_scss']);

				gulp.watch(PROJECT_SVG, ['process_svg', 'delete_svg_css']);

				gulp.watch(PROJECT_SCRIPTS + '/**/*.js', ['process_scripts']).on('change', reload);

				gulp.watch(DESTINATION_PHP).on('change', reload);

			});

		});

	}
	gulp.start('browser_sync');
});

