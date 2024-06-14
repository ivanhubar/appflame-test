.PHONY: start

start:
	docker compose up -d
	docker-compose exec -T php bash -c "composer install"
	docker-compose exec -T php bash -c "php artisan migrate"