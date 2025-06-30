import { src, dest, watch, series } from 'gulp';
import dartSass from 'sass';
import gulpSass from 'gulp-sass';
import terser from 'gulp-terser';

// Configure gulp-sass with the Dart Sass compiler
const sass = gulpSass(dartSass);

export function js() {
  return src('src/js/app.js')
    .pipe(terser())
    .pipe(dest('build/js'));
}

export function css() {
  return src('src/scss/app.scss', { sourcemaps: true })
    .pipe(
      sass({ 
        outputStyle: 'compressed'
      }).on('error', sass.logError)
    )
    .pipe(dest('build/css', { sourcemaps: '.' }));
}

export function dev() {
  watch('src/scss/**/*.scss', css);
  watch('src/js/**/*.js', js);
}

export default series(js, css, dev);