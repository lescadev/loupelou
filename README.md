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
## Configuration de SwiftMailer
```bash
composer install
```
à mettre dans le .env.local
MAILER_URL=gmail://username:password@localhost?encryption=tls&auth_mode=oauth
gmail crée pour le test :
username = anthonam0 
password = GkAd9k4G8
le compte qui reçoit l'alerte d'inscription est celui de l'escadev.
