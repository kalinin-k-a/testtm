# Installation
- git clone
- docker-compose up -d
- docker exec -it tm_php composer install
- docker exec -it tm_php php bin/console doctrine:migration:migrate

# Unit Tests
- docker exec -it tm_php php bin/phpunit

# Usage
- docker exec -it tm_php php bin/console app:test




