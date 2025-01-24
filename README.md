# Cantina La Pineda

## Instrucciones

Copia el archivo .env.example y pon estos parametros:
```
DB_CONNECTION=pgsql
DB_HOST=postgres
DB_PORT=5432
DB_DATABASE=cantina
DB_USERNAME=postgres
DB_PASSWORD=postgres
```
Para descargar las dependencias:
```bash
composer install

npm install && npm run build
```
Y para migrar la base de datos:
```bash
php artisan migrate 
```
