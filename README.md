# NaholeeWApi

Application web pour ma femme, utilisant une API fourni par le site TMDB
Elle permettra de lister les films/series qui seront :
  * A voir
  * Vu
-----
## Environnement de développement
  * Symfony 5.4
  * pHp 8.0.13
  * Composer
  * Symfony CLI
  * Doctrine Fixtures
  * Faker pHp
  * pHpUnit
  * Panther

## Récupération du projet
Pour récupérer le projet:  
```bash
git clone https://github.com/Weyss/NaholeeWApi.git
```
Ou bien se rendre sur la page Git du projet : [NaholeeWApi](https://github.com/Weyss/NaholeeWApi.git).

Et n'oublier pas n'installer les _dépendances_ :
```bash
composer install
```
Dans le doute, vous pouvez les mettre à jour :
```bash
composer self:update
```
## Fixtures
Le projet utilise le système de [Fixture](https://symfony.com/bundles/DoctrineFixturesBundle/current/index.html) afin d'avoir un jeu de données
qui permettront de tester ce dernier.

Le choix s'est porté sur [fzaninotto/faker](https://fakerphp.github.io/).

## Lancer des tests
### Liens utiles
Voici des liens permettants de se familariser avec les tests : 
	- [Documetation Symfony](https://symfony.com/doc/5.4/testing.html#types-of-tests)
	- [Documentation pHpUnit](https://phpunit.readthedocs.io/en/9.5/) 
	- [Documentation Panther](https://github.com/symfony/panther)
### Test unitaire & fonctionnel
```bash
symfony php bin/phpunit --filter <nom_du_fichier_de_test> --testdox
```
### Test E2E
```bash
env PANTHER_NO_HEADLESS=1 symfony php bin/phpunit
```
### Coverage Code
```bash
XDEBUG_MODE=coverage symfony php bin/phpunit --coverage-html <folder_directory>
```