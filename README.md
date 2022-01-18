# NaholeeWApi

Application web pour ma femme, utilisant une API.
Cette application permettra de lister les films/series qui seront :
  * A voir
  * Vu
  * En cours

## Environnement de développement

### Pré-requis
  * pHp 8.0.13
  * Composer
  * Symfony CLI
  * pHpUnit
  * Doctrine Fixtures
  * Faker pHp

## Lancer l'environnement de développement

```bash 
symfony new project_name --version=5.4 --full
symfony serve -d
symfony php bin/phpunit
```
## Ajouter des fixtures

```bash
composer require --dev orm-fixture
composer require fzaninotto/faker
```

## Lancer des tests

```bash 
symfony php bin/phpunit --filter <test> --testdox
XDEBUG_MODE=coverage symfony php bin/phpunit --coverage-html <folder_directory>
```