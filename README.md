web-class
=========

web class resource

## Doctrine

### Generate models

Generate models from yaml files

```
php packages/bin/doctrine orm:generate-entities src 
```

And generate proxies

```
php packages/bin/doctrine orm:generate-proxies
```

### Update DB

Create DB

```
php packages/bin/doctrine orm:schema-tool:create
```

Drop tables

```
php packages/bin/doctrine orm:schema-tool:drop --force
```

update tables

```
php packages/bin/doctrine orm:schema-tool:update --force
```

Generate sqls

```
php packages/bin/doctrine orm:schema-tool:create --dump-sql
php packages/bin/doctrine orm:schema-tool:drop --dump-sql
php packages/bin/doctrine orm:schema-tool:update --dump-sql
```