check_phpstan:
	vendor/bin/phpstan analyse --level=9 src/App

check_csfixer:
	vendor/bin/php-cs-fixer fix src/App