# blog_symfony

### Setup

1. Build the container
```
docker-compose up -d --build
```
2. Access the container
```
docker-compose exec php bash
```
3. Setup the project
```
composer install
```
4. Prepare files of Encore Webpack
```
yarn install
yarn build
```
5. Analyse the code
```
vendor/bin/phpstan analyse -c phpstan.neon -l 9 src
vendor/bin/php-cs-fixer fix
vendor/bin/phpunit tests
```

Look at '/api/doc' route to see available endpoints