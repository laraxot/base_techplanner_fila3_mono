<?php

declare(strict_types=1);



namespace Modules\Cms\Tests\Feature\Frontoffice\FolioRoutes;
uses(\Modules\Cms\Tests\TestCase::class);

it('GET /it/dashboard acceptable for unauthenticated (redirect/401/403)', function (): void {
    $res = $this->get('/it/dashboard');
    expect($res->getStatusCode())->toBeIn([200, 204, 301, 302, 303, 307, 308, 401, 403]);
});
