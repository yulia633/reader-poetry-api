<?php

use App\Controllers\Api\ApiController;

$app->group('/api', function () {
    $this->get('/texts/{service}', ApiController::class . ':show');
});
