const { src, dest, watch , parallel } = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const autoprefixer = require('autoprefixer');
const postcss    = require('gulp-postcss')
const sourcemaps = require('gulp-sourcemaps')
const cssnano = require('cssnano');
const concat = require('gulp-concat');
const terser = require('gulp-terser-js');
const rename = require('gulp-rename');
const notify = require('gulp-notify');
const sharp = require('sharp');
const through2 = require('through2');
const path = require('path');

const paths = {
    scss: 'src/scss/**/*.scss',
    js: 'src/js/**/*.js',
    imagenes: 'src/img/**/*'
}

// css es una función que se puede llamar automaticamente
function css() {
    return src(paths.scss)
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(postcss([autoprefixer(), cssnano()]))
        // .pipe(postcss([autoprefixer()]))
        .pipe(sourcemaps.write('.'))
        .pipe( dest('./build/css') );
}


function javascript() {
    return src(paths.js)
      .pipe(sourcemaps.init())
      .pipe(concat('bundle.js')) // final output file name
      .pipe(terser())
      .pipe(sourcemaps.write('.'))
      .pipe(rename({ suffix: '.min' }))
      .pipe(dest('./build/js'))
}

function imagenes() {
    return src(paths.imagenes)
        .pipe(through2.obj(function(file, _, callback) {
            if (file.isNull()) {
                return callback(null, file);
            }
            
            if (file.isStream()) {
                return callback(new Error('Streaming not supported'));
            }
            
            const ext = path.extname(file.path).toLowerCase();
            
            // Solo procesar imágenes
            if (!['.jpg', '.jpeg', '.png', '.gif', '.svg'].includes(ext)) {
                return callback(null, file);
            }
            
            // SVG no necesita optimización con Sharp, solo copiarlo
            if (ext === '.svg') {
                return callback(null, file);
            }
            
            // Optimizar imagen con Sharp
            let sharpInstance = sharp(file.contents);
            
            // Configuraciones según el tipo de imagen
            if (ext === '.jpg' || ext === '.jpeg') {
                sharpInstance = sharpInstance.jpeg({ 
                    quality: 85, 
                    progressive: true 
                });
            } else if (ext === '.png') {
                sharpInstance = sharpInstance.png({ 
                    quality: 85, 
                    compressionLevel: 6 
                });
            } else if (ext === '.gif') {
                // Para GIF, solo copiamos sin modificar
                return callback(null, file);
            }
            
            sharpInstance
                .toBuffer()
                .then(buffer => {
                    file.contents = buffer;
                    callback(null, file);
                })
                .catch(err => {
                    console.error('Error optimizing image:', file.path, err.message);
                    callback(null, file); // Continuar con el archivo original si hay error
                });
        }))
        .pipe(dest('build/img'))
        .pipe(notify({ message: 'Imagen Completada'}));
}

function versionWebp() {
    return src(paths.imagenes)
        .pipe(through2.obj(function(file, _, callback) {
            if (file.isNull()) {
                return callback(null, file);
            }
            
            if (file.isStream()) {
                return callback(new Error('Streaming not supported'));
            }
            
            const ext = path.extname(file.path).toLowerCase();
            
            // Solo convertir jpg, jpeg y png a WebP
            if (!['.jpg', '.jpeg', '.png'].includes(ext)) {
                return callback(); // No pasar el archivo, solo ignorarlo
            }
            
            // Cambiar extensión a .webp
            const parsedPath = path.parse(file.path);
            const webpPath = path.join(parsedPath.dir, parsedPath.name + '.webp');
            
            sharp(file.contents)
                .webp({ 
                    quality: 80,
                    effort: 4,
                    progressive: true
                })
                .toBuffer()
                .then(buffer => {
                    // Crear nuevo archivo con contenido WebP
                    const webpFile = file.clone();
                    webpFile.contents = buffer;
                    webpFile.path = webpPath;
                    
                    callback(null, webpFile);
                })
                .catch(err => {
                    console.error('Error converting to WebP:', file.path, err.message);
                    callback(); // No pasar archivo si hay error
                });
        }))
        .pipe(dest('build/img'))
        .pipe(notify({ message: 'WebP Completado'}));
}


function watchArchivos() {
    watch( paths.scss, css );
    watch( paths.js, javascript );
    watch( paths.imagenes, imagenes );
    watch( paths.imagenes, versionWebp );
}
  
exports.default = parallel(css, javascript,  imagenes, versionWebp, watchArchivos );