
# WBC test project REST API component

## Build Steps:

```bash
# Will run npm install
# Will run composer install
# Will run phinx migrations
# Will compile api docs
$ sh build.sh
```

## ACL
ACL data is located in database at following tables:
```bash
wbc_acl_resource
wbc_acl_role
wbc_acl_access_list
wbc_acl_resource_access
wbc_acl_role_inherit
```
In docker environment this data populated  in accordance with ./app/config/acl_allow_list.php. 
So, if you want to add some permissions do it in the file. If you want remove some permission you must previously truncate all ACL data from database:
```bash
TRUNCATE wbc_acl_resource;
TRUNCATE wbc_acl_role;
TRUNCATE wbc_acl_access_list;
TRUNCATE wbc_acl_resource_access;
TRUNCATE wbc_acl_role_inherit;
```
After that you may run API by any route to repopulate ACL data to database.

Populating method located here - ./app/library/Acl/Adapter/Database.php
Mainly all ACL resources - Controllers and permissions - Actions. And access control is happening in ./app/global/Security.php. 
But you can use follow construction in any place of your controllers:
```bash
if ($this->access->isAllowed('CustomResourceName', 'checked_operation_name')){
    // do something ...
}
```
acl_allow_list.php should contain something like this:
```
'utAdmin' => array(
        'WBC\Controllers\ClientController' => [
            'deleteById'
        ],
        'CustomResourceName' => ['checked_operation_name']
    )
```
#### Init ACL
After execute ACL's migrations database contains data that allow to call init ACL method in API. How to init: 
```
/usr/bin/curl --request POST /usr/bin/curl  -H "Accept: application/json" -H 'Content-Type: application/json' -H 'id: %brokerName%' -H 'secret: %brokerSecret%' -H 'token: %token%' https://api-wbc.fomazov.name/webhook/acl_rewrite
```

* %token% must belong to utRobot role

Using:
```bash
vagrant ssh -c '/usr/bin/curl --request POST /usr/bin/curl -H "Accept: application/json" -H "Content-Type: application/json" -H "id: WebHook" -H "secret: 92f61352b9" -H "token: `$2a$08$txAip6bksvCBAh94LsNjuutuFcAUBSvBlqyqN1lEVcZl6rm2P69M6`" https://api-wbc.fomazov.name/webhook/acl_rewrite'
```

## Routes

#### Init router
How to init (sample on local environment): 
```
/usr/bin/curl --request POST /usr/bin/curl  -H "Accept: application/json" -H 'Content-Type: application/json' -H 'id: %brokerName%' -H 'secret: %brokerSecret%' -H 'token: %token%' https://api-wbc.fomazov.name/webhook/route_rewrite
```

* %hubToken% must belong to utRobot role

Using:
```bash
vagrant ssh -c '/usr/bin/curl --request POST /usr/bin/curl -H "Accept: application/json" -H "Content-Type: application/json" -H "id: WebHook" -H "secret: 92f61352b9" -H "token: `$2a$08$txAip6bksvCBAh94LsNjuutuFcAUBSvBlqyqN1lEVcZl6rm2P69M6`" https://api-wbc.fomazov.name/webhook/route_rewrite'
```

## Migrations

Phinx: [Documentation](http://docs.phinx.org/en/latest/)

```bash
# Commands Examples:
# The Create Command
# is used to create a new migration file.
$ php ./vendor/bin/phinx create CreateTableName --configuration=phinx_docker.yml
# The Migrate Command
# runs all of the available migrations
$ php ./vendor/bin/phinx migrate -e docker --configuration=phinx_docker.yml
# The Rollback Command
# is used to undo previous migrations executed by Phinx
$ php ./vendor/bin/phinx rollback -e docker --configuration=phinx_docker.yml
```

Executing queries with the given database prefix.
Also in this case use Up and Down methods.

    $tableAdapter = new Phinx\Db\Adapter\TablePrefixAdapter($this->getAdapter());
    $tableName = $tableAdapter->getAdapterTableName('client');
    $this->execute(sprintf("ALTER TABLE %s MODIFY password VARCHAR(60)", $tableName));
    $this->execute(sprintf("ALTER TABLE %s MODIFY token VARCHAR(60)", $tableName));

## Phalcon (Developer Tools)
```bash
phalcon model docker_change_email_request --namespace="WBC\Models" --get-set
```

## Apidoc

#### RESTful web API Documentation Generator

Documentation:
```
http://apidocjs.com/
```


Url for docker environment should be:
```
https://api-wbc.fomazov.name/documentation
```

Using:
```
node node_modules/apidoc/bin/apidoc -i ./app/routes/ -o ./public/documentation/ -t ./docs/template/
```

## Locale setup
Folder structure for gettext:
```bash
app\
-locale\
-- en\
--- LC_MESSAGES\
---- wbc.po
---- wbc.mo
```

This script must be executed always after source code modification. (Two files will be regenerated wbc.po and wbc.mo. Data will be merged.) 
```bash

cd /var/www/wbc-api/; echo '' > ./app/locale/en/LC_MESSAGES/messages.po; find . -type f \( -iname '*.php' -o -iname '*.volt' \) | xgettext -L PHP -f - --force-po -j -p ./app/locale/en/LC_MESSAGES; msgmerge -N ./app/locale/en/LC_MESSAGES/wbc.po ./app/locale/en/LC_MESSAGES/messages.po > ./app/locale/en/LC_MESSAGES/new.po; mv ./app/locale/en/LC_MESSAGES/new.po ./app/locale/en/LC_MESSAGES/wbc.po; rm ./app/locale/en/LC_MESSAGES/messages.po; msgfmt ./app/locale/en/LC_MESSAGES/wbc.po -o ./app/locale/en/LC_MESSAGES/wbc.mo; cd /var/www/wbc-api/; echo '' > ./app/locale/ru/LC_MESSAGES/messages.po; find . -type f \( -iname '*.php' -o -iname '*.phtml' \) | xgettext -L PHP -f - --force-po -j -p ./app/locale/ru/LC_MESSAGES; msgmerge -N ./app/locale/ru/LC_MESSAGES/wbc.po ./app/locale/ru/LC_MESSAGES/messages.po > ./app/locale/ru/LC_MESSAGES/new.po; mv ./app/locale/ru/LC_MESSAGES/new.po ./app/locale/ru/LC_MESSAGES/wbc.po; rm ./app/locale/ru/LC_MESSAGES/messages.po; msgfmt ./app/locale/ru/LC_MESSAGES/wbc.po -o ./app/locale/ru/LC_MESSAGES/wbc.mo;
```


Using:
```
setlocale(LC_MESSAGES, 'ru_RU.utf8'); // установка локали, на языке которой ф-ция _('') должна возвращать перевод
$localeDomain = 'wbc';
bindtextdomain($localeDomain, BASE_PATH . "/app/locale");
textdomain($localeDomain);
bind_textdomain_codeset($localeDomain, 'UTF-8');
// далее везде по коду
$translated_text = _('Text to translate'); // $translated_text = "Текст для перевода"
```