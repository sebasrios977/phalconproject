<?php
/**
 * Local variables
 * @var \Phalcon\Mvc\Micro $app
 */

/**
 * Add your routes here
 */
$app->get('/', function () {
    echo $this['view']->render('index');
});

$app->get('/countries', [
    new CountriesController(),
    'getAction',
]);

$app->post('/countries', [
    new CountriesController(),
    'createAction',
]);

$app->put('/countries/{id}', [
    new CountriesController(),
    'updateAction',
]);

$app->delete('/countries/{id}', [
    new CountriesController(),
    'deleteAction',
]);

/**
 * Not found handler
 */
$app->notFound(function () use($app) {
    $app->response->setStatusCode(404, "Not Found")->sendHeaders();
    echo $app['view']->render('404');
});
