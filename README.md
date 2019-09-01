#Prueba Técnica Logikoss

- Clonar este proyecto

Se probará en un ambiente con `PHP7.2`, `MySql5.7` bd `laravel` , user `root` pass `secret`  y se ejecutarán los siguientes comandos

```bash
git clone project
```
```bash
cp .env.example .env
```
```bash
composer install
```
```bash
php artisan key:generate
```
```bash
php artisan storage:link
```
```bash
php artisan migrate
```
```bash
npm install
```
```bash
npm run dev
```
- Al finalizar subir el proyecto a un repositorio publico en tu cuenta de github.

- Correr con docker con el siguiente comando

```bash
$ docker-compose up -d
```
- Verificar el puerto donde esta corriendo MySQL

```bash
$ docker inspect -f '{{.Name}} - {{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' $(docker ps -aq)
```