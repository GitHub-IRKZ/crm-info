#################################################################
# Composer зависимости											#
#################################################################
COMPOSER_VERSION=latest

composer-install:
	docker run --rm \
	--network host \
	--volume $(CURDIR):${HOME} \
	--volume ${HOME}/.ssh:${HOME}/.ssh:ro \
	--volume /etc/passwd:/etc/passwd:ro \
	--volume /etc/group:/etc/group:ro \
	--volume $(CURDIR)/auth.json:/home/composer/.composer/auth.json:ro \
	--user ${shell id -u}:$(shell id -g) \
	--env HOME=${HOME} \
	--env COMPOSER_HOME=${HOME} \
	--workdir ${HOME}  \
	--interactive \
	composer:${COMPOSER_VERSION} \
	composer install --ignore-platform-reqs --no-interaction --prefer-dist --no-scripts

composer-update:
	make composer-cmd CMD="update --ignore-platform-reqs --no-interaction --prefer-dist --no-scripts"

composer-require:
	make composer-cmd CMD="require ${p} --ignore-platform-reqs --no-interaction --prefer-dist --no-scripts"

composer-remove:
	make composer-cmd CMD="remove ${p}"

composer-du:
	make composer-cmd CMD="dump-autoload --ignore-platform-reqs --no-interaction --no-scripts"

composer-cmd:
	docker run --rm \
	--network host \
	--volume $(CURDIR):${HOME} \
	--volume ${HOME}/.ssh:${HOME}/.ssh:ro \
	--volume /etc/passwd:/etc/passwd:ro \
	--volume /etc/group:/etc/group:ro \
	--volume $(CURDIR)/auth.json:/home/composer/.composer/auth.json:ro \
	--user ${shell id -u}:$(shell id -g) \
	--env HOME=${HOME} \
	--env COMPOSER_HOME=${HOME} \
	--workdir ${HOME}  \
	--interactive \
	composer:${COMPOSER_VERSION} \
	composer ${CMD}
