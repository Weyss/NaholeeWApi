# NaholeeWApi

Application web pour ma femme, utilisant une API.
Cette application permettra de lister les films/series qui seront :
  * A voir
  * Vu

## Environnement de développement

### Pré-requis
  * pHp 8.0.13
  * Composer
  * Symfony CLI
  * Doctrine Fixtures
  * Faker pHp
  * pHpUnit
  * Panther

## Lancer l'environnement de développement

### Création du projet
```bash 
symfony new project_name --version=5.4 --full
symfony serve -d
```

### Récupération du projet
```bash
https://github.com/Weyss/NaholeeWApi.git
composer install
composer self:update
```

## Ajouter des fixtures
```bash
composer require --dev orm-fixture
composer require fzaninotto/faker
```

## Lancer des tests
### Installation des tests
#### Test unitaire & fonctionnel
```bash
symfony php bin/phpunit
```
#### Test E2E
```bash
composer req --dev symfony/panther
vendor/bin/bdi detect drivers <folder_directory>
```

### Lancement tests unitaire et fonctionnel
```bash 
symfony php bin/phpunit
```

### Lancement tests E2E
```bash
env PANTHER_NO_HEADLESS=1 symfony php bin/phpunit
```

### Coverage Code
```bash
XDEBUG_MODE=coverage symfony php bin/phpunit --coverage-html <folder_directory>
```