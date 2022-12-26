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





