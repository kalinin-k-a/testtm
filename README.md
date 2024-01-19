- git clone 
- docker-compose up -d
- docker exec -it tm_php php bin/console doctrine:migration:migrate

- docker exec -it tm_php php bin/console app:test


todo 
- сделать контейнер не висячим
-  заинжектить интерфейсы реп
- сделать презентер рзультата
- разделить на юзкейсы екзекютор

