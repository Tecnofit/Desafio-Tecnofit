# YOFIT
> Gestão dos meus treinos com acompanhamento diário
 

# Como subir o ambiente local com Docker?

```bash
sh .bin/exec.sh
```

docker exec yofit_php composer require ramsey/uuid

"test.unit.modules.gym.coverage": "vendor/bin/phpunit --colors=always --coverage-html public/coverage/unit --coverage-clover target/unit/coverage.xml --coverage-text='target/unit/coverage.txt' --log-junit target/unit/report.xml"

### Tests

docker exec yofit_php composer test.integration.modules.gym

docker exec yofit_php composer test.unit.modules.gym
