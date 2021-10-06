dup:
	docker-compose up -d
install:
	docker exec -itu www-data php80 composer install
run:
	docker exec -itu www-data php80 vendor/bin/codecept run $(cest) --debug --html
