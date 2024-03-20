setup\:app:
	sh scripts/setup-microservice.sh

run-test:
	./vendor/bin/sail shell -c "php artisan test"

start:
	./vendor/bin/sail up -d

stop:
	./vendor/bin/sail stop

