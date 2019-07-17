# Lou Pélou

## Installation
```bash
git clone https://github.com/lescadev/loupelou.git
```
```bash
composer install
```
> Modification du .env.local :
```
DATABASE_URL=mysql://root:root@127.0.0.1:3333/sf_lou_pelou
```
```bash
cd dockerSetup
```
```bash
docker-compose up -d
```
```bash
cd ..
```
```bash
php bin/console migrate
```
```bash
php bin/console doctrine:fixtures:load
```
```bash
php bin/console server:run
```

## Décharger les conteneurs Docker
```bash
cd dockerSetup
```
```bash
docker-compose down
```
