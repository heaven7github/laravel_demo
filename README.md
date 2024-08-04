# Laravel Demo projekt

## Telepítési előfeltételek
- Docker
- Docker Compose
- Host gépen a 1433 és 8000 portok elérhetővé tétele a Docker számára (vagy a `docker-compose.yml` fájlban a portok átírása)

**_Megjegyzés:_**  A telepítési útmutató `Ubuntu 20` alatt lett kipróbálva

## Telepítés
1. `db-data` mappa létrehozása a projekt főkönytárában és 10001 felhasználóhoz rendelés
```bash
mkdir db-data && sudo chown 10001 db-data
```
Ismert hiba az `mcr.microsoft.com/mssql/server` Docker image-ben:
https://stackoverflow.com/questions/65601077/unable-to-run-sql-server-2019-docker-with-volumes-and-get-error-setup-failed-co
Mac hiba (Known Issues cím alatt):
https://hub.docker.com/r/microsoft/mssql-server
###

3. `.env.example` fájl átnevezése `.env`-re
4. Docker Compose build futtatása
```bash
docker compose build
```
5. Docker Compose elindítása
```bash
docker compose up
```

6. Laravel adatbázis létrehozása valamilyen adatbáziskezelő program segítségével az alábbi paranccsal:
```sql
create database laravel
```

7. Composer telepítés
```bash
docker compose run api composer install
```

8. Migrációk lefutattása
A migrációk lefutattása előtt vagy belépünk az `api` service-be, vagy a `docker compose` parancssal együtt futattjuk le

Api service-be való belépés:
```bash
docker compose exec -it api bash
```
Majd a service-ben az alábbi parancsot kiadni:
```bash
php artisan migrate
```
Vagy a `docker compose`-al eggyütt futtatni:
```bash
docker compose run api php artisan migrate
```

# Hibakeresés
1. A service-ek log kimenetén
2. A `src/storage/logs/laravel.log` fájlban

# Leállítás
```bash
docker compose down
```
