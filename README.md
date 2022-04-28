# mia-newsletter-mezzio

1. Incluir libreria:
```bash
composer require agencycoda/mia-newsletter-mezzio
```
2. Incluir rutas:
```php
$app->route('/mia-newsletter/add', [\Mia\Newsletter\Handler\ListHandler::class], ['POST', 'OPTIONS', 'HEAD'], 'mia_newsletter.add');

$app->route('/mia-newsletter/fetch/{id}', [\Mia\Auth\Handler\AuthHandler::class, \Mia\Newsletter\Handler\FetchHandler::class], ['GET', 'OPTIONS', 'HEAD'], 'mia_newsletter.fetch');
$app->route('/mia-newsletter/list', [\Mia\Auth\Handler\AuthHandler::class, \Mia\Newsletter\Handler\ListHandler::class], ['POST', 'OPTIONS', 'HEAD'], 'mia_newsletter.list');
$app->route('/mia-newsletter/remove/{id}', [\Mia\Auth\Handler\AuthHandler::class, new \Mia\Auth\Middleware\MiaRoleAuthMiddleware([MIAUser::ROLE_ADMIN]), \Mia\Newsletter\Handler\RemoveHandler::class], ['GET', 'DELETE', 'OPTIONS', 'HEAD'], 'mia_newsletter.remove');
$app->route('/mia-newsletter/save', [\Mia\Auth\Handler\AuthHandler::class, new \Mia\Auth\Middleware\MiaRoleAuthMiddleware([MIAUser::ROLE_ADMIN]), \Mia\Newsletter\Handler\SaveHandler::class], ['POST', 'OPTIONS', 'HEAD'], 'mia_newsletter.save');
```