#Sistema de control de registros medicos de enfermeria

Sistema de control de registros medicos de enfermeria para el Instituto Tecnologico Superior de Poza Rica

##Estructura del proyecto
```
Sistema Enfermeria
├─ assets
│  ├─ css
│  ├─ fonts
│  ├─ img
│  ├─ js
│  ├─ scss
│  └─ vendor
│     ├─ bootstrap
├─ composer.json
├─ composer.lock
├─ config
├─ Controllers
├─ db
│  └─ BaseDeDatos.sql
├─ documentation
│  └─ Excel
├─ info.php
├─ README.md
├─ vendor
│  ├─ autoload.php
│  ├─ composer
└─ views

```

##Descripcion de las carpetas

* **assets**: contiene todo el contenido de estilos css, imagenes y scripts necesarios para la correcta ejecucion y visualizacion de la pagina.-
* **config**: contiene el archivo de la configuracion de la conexion ala base de datos en postgresql-
* **Controllers**: contiene toda la logica y funcionalidades del programa, asi como consultas a la base de datos y manejo de los datos que se muestran en el proyecto.-
* **db**: contiene el archivo .sql de la estructura de la base de datos.-
* **documentacion**: contiene los distintos archivos de la documentacion del proyecto.-
* **views**: contiene las plantillas html o php de las vistas de las distintas paginas del programa.-
* **vendor**: Carpeta generada automáticamente por Composer para las dependencias externas.-

##Instalacion del proyecto

Para la correcta instalacion del proyecto son necesarias estas dos caracteristricas:

-PHP
-Composer
-GIT
-Postgresql

En la terminal dirigete a la ruta donde se instalara el proyecto e ingresa el siguiente comando:

```git clone```

Una vez instalado el paquete dirigete y abre el siguiente archivo:

```/config/conexion.php```

y edita los valores de la conexion a tu base de datos.

Una vez que tienes todo los paquetes correctamente instalados, abre una terminal en la carpeta raiz del proyecto y ejecuta el siguiente comando:

```php -S localhost:8000```

Una vez que el comando se este ejecutando correctamente dirigete al navegador e ingresa a la siguiente ruta para ingresar al sistema:

[localhost:8000/views/Login.php]
