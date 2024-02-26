# Sudespacho
Sudespacho en Symfony 6


# Descripción
El presente proyecto es una prueba de habilidad técnica.

# Requerimientos
- PHP = 8.3.2
- mysql >= 8.1
- Symfony >= 6.1
- Composer >= 2.7
- git >= 2.33.1

# Instalación

Para una correcta instalación siga los siguientes pasos.

- Clone el proyecto usando la instrucción "git clone urlProyecto" en la ubicación destinada para el mismo.
- Ubíquese en la carpeta "sudespacho-test" usando la consola cliente que prefiera y ejecute "composer install".
- Configure la conexión a su base de datos modificando el archivo ".env" ubicado en la carpeta "sudespacho-test", de la siguiente forma.

> * DATABASE_HOST: Host de su base de datos.
> * DATABASE_USER: Nombre de usuario de su base de datos.
> * DATABASE_PASSWORD: Contraseña de su base de datos.
> * DATABASE_PORT: Puerto asignado a su base de datos.
> * DATABASE_NAME: Nombre de la base de datos a usar.

- Configure la conexión a su base de datos de pruebas modificando el archivo ".env.test" ubicado en la carpeta "sudespacho-test", de la siguiente forma.

> * DATABASE_HOST: Host de su base de datos.
> * DATABASE_USER: Nombre de usuario de su base de datos.
> * DATABASE_PASSWORD: Contraseña de su base de datos.
> * DATABASE_PORT: Puerto asignado a su base de datos.
> * DATABASE_NAME: Nombre de la base de datos a usar.

- Ubíquese en la carpeta "sudespacho-test" usando la consola cliente que prefiera y ejecute los siguientes comandos:

> * php bin/console db:cf start  "Este comando crea todas las configuraciones necesarias para poner en marcha el proyecto"

# Ejecución

Para ejecutar el proyecto en ambiente local Realice las siguientes acciones:

- ubicarse en la carpeta "sudespacho-test/public" y ejecute el comando "php -S localhost:8050" usando la consola cliente que prefiera y en navegador escribir la URL "http://localhost:8050/".