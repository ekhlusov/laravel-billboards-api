.PHONY: clean stop start start-dev

.PHONY: shell shell-dev shell-node shell-phpunit

.PHONY: phpunit logs fixperm node-install

stop:
	@docker-compose stop

fixperm:	
	@bash scripts/fix-perm.sh

logs:
	@docker-compose logs

clean: stop
	@bash scripts/rm-runtime.sh
	@bash scripts/clean-images.sh

start:
	@docker-compose up -d nginx

phpunit:
	@docker-compose run --rm phpunit

pgdump:
	@bash scripts/pg-dump.sh

pgrestore:
	@bash scripts/pg-restore.sh

start-dev:
	@docker-compose stop php
	@docker-compose stop nginx
	@docker-compose up -d nginx-dev

node-install:
	@docker-compose run --rm node npm install
	@docker-compose run --rm node bower install

shell-node:
	@docker-compose run --rm node sh

shell:
	@bash scripts/get-shell.sh

shell-dev:
	@bash scripts/get-dev-shell.sh

shell-phpunit:
	@docker-compose run --rm phpunit sh

scheduler-run:
	@bash scripts/run-scheduler.sh

scheduler-run-dev:
	@bash scripts/run-scheduler-dev.sh