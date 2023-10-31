### side-notes:
- refactoring iterations are done in one commit
- `\ArrayAccess` can be used instead of `GameCollection` but don't want to lose the contract

### set-up
```shell
docker compose up -d
docker exec app-php composer install
```

### test
```shell
docker exec app-php vendor/bin/phpunit tst --testdox
```
