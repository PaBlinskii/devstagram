LOG Desarrollo Devstagram LARAVEL 9 - JPDT - Pantoni

-- Instalando Docker Desktop
-- Empezar en Paso 4 en el link: https://learn.microsoft.com/es-mx/windows/wsl/install-manual#step-4---download-the-linux-kernel-update-package
-- Abrir PowerShell como admin y ejecutar el comando:
wsl --set-default-version 2

-- despues ejecutar el comando wsl --list --online || wsl -l -o para ver la lista de Dist. Linux

-- Instalando Ubuntu:
wsl --install -d Ubuntu

-- Configurando usuario: pantoni y contraseña: root123
-- Al instalar todo si sale error desinstalar Docker Desktop, instalar de nuevo y reiniciar y funcionara.
-- abrir powershell o cualquier ventana de comandos escribir wsl para entrar en modo linux

-- instalando laravel con Docker o Composer con el siguiente comando:

curl -s https://laravel.build/devstagram | bash

composer create-project laravel/laravel devstagram

-- Comienza a instalar un chirril de cosas
-- antes se usaba php artisan ahora tambien se usa esto para entrar a Sail:
-- con este comando se arrancan los servicios de Sail

./vendor/bin/sail up

-- Crear un alias para no usar el comando anterior... hay que subir los permisos con el siguiente comando

sudo nano ~/.bashrc

--modificamos el archivo hasta abajo de "if ! shopt -oq poxis; then" y le escribimos

alias sail="./vendor/bin/sail up"

-- Ctrl X para Salir y Y para guardar cambios y salir, ahora ejecutamos esto para guardar y refrescar:

source ~/.bashrc

-- ahora instalamos php8.1 o superior y la guardamos en el C: , despues configuramos el path de entorno
-- abrimos php.ini o php.development y le sacamos copia y lo renombramos por php.ini y descomentamos lo siguiente

extensiones: curl, fileinfo, gd, mysqli, pdo_mysql, openssl

-- las clases abstractas no se pueden instanciar, solo se pueden extender con otras 
-- métodos estaticos no requieren una instancia
-- metodos y propiedades estaticas: no requieren instanciarse y para acceder a sus valores en lugar de this se usa self()
-- Iniciamos git init en la carpeta del proyecto devstagram
git init
git add .
git commit -m "primer vistazo"
git branch -M main
git remote add origin https://github.com/PaBlinskii/devstagram.git
git push -u origin main

-- Usamos la guia https://tailwindcss.com/docs/guides/laravel#mix
-- Instalamos Tailwind CSS con el siguiente comando
npm install -D tailwindcss postcss autoprefixer

-- creamos nuestro archivo config de tailwindcss y lo modificamos
npx tailwindcss init

/*******************************************\
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],
/*******************************************\

-- vamos a resources/css/app.css y colocamos lo siguiente:
@tailwind base;
@tailwind components;
@tailwind utilities;

-- modificamos el app.blade.php, y ahora vamos a crear un controlador
php artisan make:controller RegisterController

-- Para crear un controlador con carpeta se usa \\:
php artisan make:controller Auth\\RegisterController
 _________________________
|"get toma dos parametros"|
|_________________________|

-- en el controlador si hacemos un dd() y queremos acceder a un campo individual usamos:
dd($request->get('username'));

-- Si queremos las validaciones en español clonamos este git:
git clone https://github.com/MarcoGomesr/laravel-validation-en-espanol.git resources/lang/es

-- en el controlador si hacemos un dd() y queremos acceder a un campo individual usamos:
dd($request->get('username'));

-- Si queremos las validaciones en español clonamos este git:
git clone https://github.com/MarcoGomesr/laravel-validation-en-espanol.git resources/lang/es
___________________________
"Retomar Proyecto Github"  |
composer install           |
npm install                |
generar .env               |
php artisan key:generate   |
hp artisan migrate         |
hp artisan migrate:refresh |
php artisan migrate:fresh  |
___________________________|
-- terminamos de editar el register.blade.php y creamos la tabla de username:
php artisan make:migration add_username_to_users_table

-- asignamos en la tabla de username el metodo unique para que no permita repetidos
Schema::table('users', function (Blueprint $table) {
$table->string('username')->unique();

-- Ejecutamos un rollback y despues migramos para que los cambios surtan efecto
php artisan migrate:rollback --step=1
php artisan migrate:refresh

-- Modificaremos el request para añadirle el metodo slug para evitar los espacios

$request->request->add(['username' => Str::slug($request->username)]);

-- Creación del Controller para Posts y Login
php artisan make:controller PostController
php artisan make:controller LoginController

-- Modificamos las rutas del /muro en web.php

-- Modificamos el LoginController.php
-- el método back() nos redirecciona a un link anterior desde el controlador hacia la vista
-- con @auth podemos autenticar desde blade, y @guest para los no autenticados para mostrar diferente
-- Creamos otro controlador de para cerrar sesión

php artisan make:controller LogoutController

-- En web.php podemos cambiarle la configuracion get a post al controlador para usar @csrf y dar seguridad

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

-- Modificamos la ruta posts usando route model binding para usar el modelo con la ruta y generar link con username
Route::get('/{user:username}', [PostController::class, 'index'])->name('posts.index');

-- Para poder centrar la información del usuario usamos las clases en este div
<div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center md:items-start py-10">

-- Creación y modificación de posts/create.blade.php y asignación de auth()->user()->username, para evitar errores
-- Instalación de Dropzone para drag and drop archivos
npm install --save dropzone

-- Problema al configurar dropzone, no salió igual al video... 
-- Crear controlador para imagen
php artisan make:controller ImagenController

-- Modificamos ImagenController para configurarlo
-- Instalamos InterventionImage para procesar las imagenes
composer require intervention/image

-- Para configurar Intervention hay que ir a /config/app.php y asignar la ruta en providers

**--In the $providers array add the service providers for this package.--**
	Intervention\Image\ImageServiceProvider::class

**--Add the facade of this package to the $aliases array.--**
'Image' => Intervention\Image\Facades\Image::class

-- Almacenando imagenes en el servidor, modificamos ImagenController.php para eso
-- Creando modelos Post y migracion tabla posts

php artisan make:model Post
php artisan make:migration create_posts_table

-- Se puede crear todo esto en una sola linea
php artisan make:model --migration --factory Post

-- modificamos la tabla post y la migramos, modificamos el factory post
-- Usamos TINKER un CLI de Laravel para interactuar con la App y BD
php artisan tinker
$usuario = User::find(4)
App\Models\Post::factory()

-- Realizamos el llenado de datos con el siguiente comando desde tinker
Post::factory()->times(200)->create();

-- Ahora realizamos un rollback para probarlo
php artisan migrate:rollback --step=1
php artisan migrate
php artisan tinker
Post::factory()->times(200)->create();

-- Terminamos de configurar el resource/app.js para las imagenes de dropzone el value en el input hidden
-- Creando las relaciones entre usuario y post en User.php

	-- Relación User.php normal un usuario tiene post
	return $this->hasMany(Post::class);

	-- Relación Post.php inversa, varios post tienen un usuario
	return $this->belongsTo(User::class)->select(['name', 'username']);

-- Modificando el dashboard para mostrar los posts y añadiendole estilos
-- Agregando Tailwind a la paginación (Desde v3 hay que especificar los componentes JIT) en tailwind.config.js

    "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",

-- Routing para las publicaciones al darle clic a una imagen
-- Mejorando la estructura de las URL's, para eso pasamos dos valores al route

Route::get('/{user:username}/posts/{post}', [PostController::class, 'show'])->name('posts.show');

-- También tenemos que pasarle un array con las variables en la vista

 <a href="{{ route('posts.show', ['post' => $post, 'user' => $user ])}}">

-- Le agregamos al post el titulo y el time con este magnifico código
	{{ $post->created_at->diffForHumans() }}

-- link de Carbon para formatear fechas y hora
https://carbon.nesbot.com/docs/



*****************************************************************************************