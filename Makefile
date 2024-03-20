setup\:app:
	sh scripts/setup-microservice.sh

run-test:
	./vendor/bin/sail shell -c "php artisan test --parallel"

run-test-coverage:
	./vendor/bin/sail shell -c "./vendor/bin/pest --coverage"

start:
	./vendor/bin/sail up -d

stop:
	./vendor/bin/sail stop

