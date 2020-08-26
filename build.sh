#!/usr/bin/env bash

environment=$1

# This will return true if a variable is unset or set to the empty string ("").
if [ -z "$environment" ]; then
	environment="docker"
fi

# Npm Install
npm install

# Composer update self-update
php composer.phar self-update

# Composer install
php composer.phar update

# Run phinx migrations
php ./vendor/bin/phinx migrate -e "$environment" --configuration=phinx_$environment.yml

# Init ACL rules in database
/usr/bin/curl --request POST /usr/bin/curl  -H "Accept: application/json" -H 'Content-Type: application/json' -H 'id: WebHook' -H 'secret: 92f61352b9' -H 'token: $2a$08$txAip6bksvCBAh94LsNjuutuFcAUBSvBlqyqN1lEVcZl6rm2P69M6' https://api-wbc.fomazov.name/webhook/acl_rewrite

# Init router rules in database
/usr/bin/curl --request POST /usr/bin/curl  -H "Accept: application/json" -H 'Content-Type: application/json' -H 'id: WebHook' -H 'secret: 92f61352b9' -H 'token: $2a$08$txAip6bksvCBAh94LsNjuutuFcAUBSvBlqyqN1lEVcZl6rm2P69M6' https://api-wbc.fomazov.name/webhook/route_rewrite

# Compile api docs
node ./node_modules/apidoc/bin/apidoc -i ./app/routes/ -o ./public/documentation/ -t ./docs/template/

exit 0