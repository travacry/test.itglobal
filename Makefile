check_phpstan:
	vendor/bin/phpstan analyse --level=9 src/

check_csfixer:
	vendor/bin/php-cs-fixer fix src/

check_phpstan_tests:
	vendor/bin/phpstan analyse --level=9 tests/

check_csfixer_tests:
	vendor/bin/php-cs-fixer fix tests/

configuration_phpunit:
	vendor/bin/phpunit --generate-configuration

run_unit_tests:
	vendor/bin/phpunit --configuration tests/phpunit.xml --testsuite unit


run_integration_tests:
	vendor/bin/phpunit --configuration tests/phpunit.xml --testsuite integration

reset_autoload:
	composer dump-autoload

reset_autoload_dev:
	composer dump-autoload --dev