# Installation
- git clone git@github.com:kalinin-k-a/testtm.git
- docker-compose up -d
- docker exec -it tm_php composer install
- docker exec -it tm_php php bin/console doctrine:migration:migrate

# Unit Tests
- docker exec -it tm_php php bin/phpunit

# Usage
- docker exec -it tm_php php bin/console app:test

In the beginning enter your session_id to resume previously incompleted test or leave it empty to begin a new one. 
After you see a question, enter your answers numbers separated by "," or " " and press Enter.
when the test is finished, your results are listed with a mark Correct or Incorrect. 




