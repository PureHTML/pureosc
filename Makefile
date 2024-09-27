# vim: set tabstop=8 softtabstop=8 noexpandtab:
.PHONY: help
help: ## Displays this list of targets with descriptions
	@grep -E '^[a-zA-Z0-9_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}'

.PHONY: static-code-analysis
static-code-analysis: vendor ## Runs a static code analysis with phpstan/phpstan
	vendor/bin/phpstan analyse --configuration=phpstan-default.neon.dist --memory-limit=-1

.PHONY: static-code-analysis-baseline
static-code-analysis-baseline: check-symfony vendor ## Generates a baseline for static code analysis with phpstan/phpstan
	includes/vendor/bin/phpstan analyze --configuration=phpstan-default.neon.dist --generate-baseline=phpstan-default-baseline.neon --memory-limit=-1

.PHONY: tests
tests: vendor
	includes/vendor/bin/phpunit tests

.PHONY: vendor
vendor: composer.json composer.lock ## Installs composer dependencies
	composer install

.PHONY: cs
cs: ## Update Coding Standards
	includes/vendor/bin/php-cs-fixer fix --config=.php-cs-fixer.dist.php --diff --verbose

clean:
	rm -rf vendor composer.lock db/cephoenix.sqlite src/*/*dataTables*

migration:
	cd src ; ../vendor/bin/phinx migrate -c ../phinx-adapter.php ; cd ..

sysmigration:
	cd src ; /usr/bin/phinx migrate -c /usr/lib/cephoenix/phinx-adapter.php ; cd ..

seed:
	cd src ; ../vendor/bin/phinx seed:run -c ../phinx-adapter.php ; cd ..

autoload:
	composer update

demodata:
	cd src ; ../vendor/bin/phinx seed:run -c ../phinx-adapter.php ; cd ..

newmigration:
	read -p "Enter CamelCase migration name : " migname ; cd src ; ../vendor/bin/phinx create $$migname -c ../phinx-adapter.php ; cd ..

newseed:
	read -p "Enter CamelCase seed name : " migname ; cd src ; ../vendor/bin/phinx seed:create $$migname -c ./phinx-adapter.php ; cd ..

dbreset:
	sudo rm -f db/cephoenix.sqlite
	echo > db/cephoenix.sqlite
	chmod 666 db/cephoenix.sqlite
	chmod ugo+rwX db
	

demo: dbreset migration demodata


dimage:
	docker build -t vitexsoftware/cephoenix .

demoimage:
	docker build -f Dockerfile.demo -t vitexsoftware/cephoenix-demo .

demorun:
	docker run  -dit --name cephoenixDemo -p 8282:80 vitexsoftware/cephoenix-demo
	firefox http://localhost:8282?login=demo\&password=demo


drun: dimage
	docker run  -dit --name MultiServersetup -p 8080:80 vitexsoftware/cephoenix
	firefox http://localhost:8080?login=demo\&password=demo

vagrant: packages
	vagrant destroy -f
	mkdir -p deb
	debuild -us -uc
	mv ../cephoenix-*_$(currentversion)_all.deb deb
	mv ../cephoenix_$(currentversion)_all.deb deb
	cd deb ; dpkg-scanpackages . /dev/null | gzip -9c > Packages.gz; cd ..
	vagrant up
	sensible-browser http://localhost:8080/cephoenix?login=demo\&password=demo

release:
	echo Release v$(nextversion)
	docker build -t vitexsoftware/cephoenix:$(nextversion) .
	dch -v $(nextversion) `git log -1 --pretty=%B | head -n 1`
	debuild -i -us -uc -b
	git commit -a -m "Release v$(nextversion)"
	git tag -a $(nextversion) -m "version $(nextversion)"
	docker push vitexsoftware/cephoenix:$(nextversion)
	docker push vitexsoftware/cephoenix:latest

baseline:
	phpstan analyse --level 7   --configuration phpstan.neon   src/ --generate-baseline

phpunit:
	vendor/bin/phpunit -c tests/configuration.xml tests/

daemon:
	export $(grep -v '#' .env | xargs) && cd lib && php -f ./daemon.php

testimage:
	podman build -f tests/Containerfile . -t docker.io/vitexsoftware/cephoenix-probe

testimagex:
	docker buildx build -f tests/Containerfile . --push --platform linux/arm/v7,linux/arm64/v8,linux/amd64 --tag docker.io/vitexsoftware/cephoenix-probe


packages:
	debuild -us -uc

# Use phpcs to reformat code to PSR12
codingstandards:
	phpcbf --colors --standard=PSR12 --extensions=php --ignore=vendor/ src/ 

