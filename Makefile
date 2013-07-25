all:
	composer install

test:
	phpunit --bootstrap tests/bootstrap.php tests
