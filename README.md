# Lou Pélou

## Installation
> Clône du dépôt Git :
```bash
git clone https://github.com/lescadev/loupelou.git
```
> Installation des dépendances PHP :
```bash
composer install
```
> Modification du .env.local :
```
DATABASE_URL=mysql://root:root@127.0.0.1:3333/sf_lou_pelou
```
> Montage des conteneurs Docker :
```bash
cd dockerSetup
```
```bash
docker-compose up -d
```
```bash
cd ..
```
> Lancement des migrations Symfony :
```bash
php bin/console migrate
```
> Chargement des données par défaut dans la BDD :
```bash
php bin/console doctrine:fixtures:load
```
> Lancement du serveur interne Symfony :
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
