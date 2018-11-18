![Plenco](https://cdn.plen.co/assets/images/plencovich.png)

## Movistar

### Edificios

#### Initiated 05.2018

#### Finished 06.2018

### Instalación

1. Clonar Repositorio
2. Acceder a la carpeta donde fue clonado y ejecutar `composer install`

3. Configurar el `ENVIRONMENT` según corresponda para `development` o `production` dentro de la carpeta `/public_html/app/config` y setear en el archivo `/public_html/.htaccess` el host para cargar automaticamente el `ENVIRONMENT` de `production`, modificar la linea `SetEnvIf Host speedy.com.ar$ CI_ENV=production`

4. Configurar la base de datos, el archivo en blanco se encuentra en `/sql/db.sql` es el inicial. Si se agregan cambios, utilizar un formato que identifique la fecha de modificación y referencia, ejemplo: `2018-05-18-Update_General.sql`

5. Configurar los datos de conexion de la base de datos en `/public_html/app/config/{ENVIRONMENT}/database.php`

6. Configurar los datos de conexion de la cuenta de email en `/public_html/app/config/{ENVIRONMENT}/information.php` y también el `APP_FOLDER` según corresponda.

### ASSETS

#### Sólo para el ENVIRONMENT de `development`

Se debe Utilizar Gulp para minificar y concatenar archivos `css` y `js`.

Se utilizan los paquetes:

	- gulp
	- gulp-concat
	- gulp-concat
	- gulp-uglify
	- gulp-clean-css
	- gulp-header
	- gulp-replace

> Instalar los módulos con `npm link {nombre del paquete}` esto se realiza por única vez.

Cada vez que se modifiquen los archivos `css` y `js`, se deberá ejecutar `gulp` indicando la tarea `minify-back`para generar los archivos minificados y concatenados.

El comando a ejecutar sería: `gulp minify-back`

Cualquier archivo `css` `js` o `plugin` que desee agregar, deberá configurarse en `/gulpfile.js` para incorporarlo en el `bundle`

Los archivos `bundle` que son generados por `gulp` se guardan en `/public_html/assets/css` y `/public_html/assets/js`, que luego se debe subir a `production` manualmente si es que utilizan FTP o bien via `git` si hay un repositorio `bare` configurado para realizar `push`

### Resources

Las modificaciones de `css` y `js` deberán realizarse sobre los archivos ubicados en `/resources/backend`.

Las imágenes y las fuentes deberán guardarse en `/public_html/assets/images` y `/public_html/assets/fonts`

**Template Back-End**

Demo [Inspinia](http://wrapbootstrap.com/preview/WB0R5L90S)
