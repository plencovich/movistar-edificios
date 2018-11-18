var gulp = require('gulp'),
  concat = require('gulp-concat'),
  uglify = require('gulp-uglify'),
  minifycss = require('gulp-clean-css'),
  header = require('gulp-header')
  replace = require('gulp-replace');

var banner = ['/**',
  ' * !!! WARNING !!!',
  ' * Este archivo se genera automaticamente.',
  ' * No lo edite porque perderá los cambios la próxima vez que se compile!',
  ' *',
  ' *',
  ' * TESTING - Update: ${new Date().getFullYear()}-${new Date().getMonth()+1}-${new Date().getDate()} ${new Date().getHours()}:${new Date().getMinutes()}',
  ' *',
  ' **/\n',
  ''
].join('\n');

gulp.task('minify-back', ['all-js-backend', 'all-css-backend']);

gulp.task('all-js-backend', function () {
  gulp.src([
    './resources/backend/plugins/pace/pace.min.js',
    './resources/backend/plugins/jquery/jquery-2.2.4.js',
    './resources/backend/plugins/bootstrap/js/bootstrap.js',
    './resources/backend/plugins/metisMenu/metisMenu.min.js',
    './resources/backend/plugins/slimscroll/jquery.slimscroll.js',
    './resources/backend/plugins/ladda/spin.min.js',
    './resources/backend/plugins/ladda/ladda.min.js',
    './resources/backend/plugins/sweetalert2/sweetalert2.js',
    './resources/backend/js/swal.custom.js',
    './resources/backend/plugins/footable/js/footable.js',
    './resources/backend/plugins/icheck/js/icheck.min.js',
    './resources/backend/js/init.icheck.min.js',
    './resources/backend/plugins/jasny/js/jasny-bootstrap.js',
    './resources/backend/plugins/dataTables/jquery.datatables.min.js',
    './resources/backend/plugins/dataTables/datatables.bootstrap.min.js',
    './resources/backend/plugins/dataTables/datatables.responsive.min.js',
    './resources/backend/plugins/dataTables/datatables.lang.esp.js',
    './resources/backend/plugins/datedropper/js/datedropper.js',
    './resources/backend/js/form.delete.js',
    './resources/backend/js/form.moderate.js',
    './resources/backend/js/form.submit.js',
    './resources/backend/js/form.user.js',
    './resources/backend/js/form.building.js',
    './resources/backend/js/modal.picture.js',
    './resources/backend/js/location.place.js',
    './resources/backend/js/main.js'
  ],
  {base: './'})
  .pipe(uglify())
  .pipe(concat('./public_html/assets/js/bundle.js'))
  .pipe(header(banner))
  .pipe(gulp.dest('./'))
});

gulp.task('all-css-backend', function () {
  gulp.src([
    './resources/backend/plugins/bootstrap/css/bootstrap.css',
    './resources/backend/plugins/font-awesome/css/font-awesome.css',
    './resources/backend/plugins/animate/animate.css',
    './resources/backend/plugins/ladda/ladda-themeless.min.css',
    './resources/backend/plugins/sweetalert2/sweetalert2.css',
    './resources/backend/plugins/footable/css/footable.css',
    './resources/backend/plugins/icheck/css/grey.css',
    './resources/backend/plugins/jasny/css/jasny-bootstrap.css',
    './resources/backend/plugins/dataTables/datatables.bootstrap.min.css',
    './resources/backend/plugins/dataTables/datatables.responsive.min.css',
    './resources/backend/plugins/datedropper/css/datedropper.css',
    './resources/backend/css/backend.css',
    './resources/backend/css/custom.css'
  ],
  {base: './'})
  .pipe(replace("/*!", "/*"))
  .pipe(minifycss({
    level: 2,
    rebase: false
  }))
  .pipe(concat('./public_html/assets/css/styles.min.css'))
  .pipe(header(banner))
  .pipe(gulp.dest('./'))
});
