<?php

namespace App\Courses\Helpers;

use TinCan;
use App\Users\Models\User;
use Illuminate\Database\Eloquent\Model;

class ClientTinCan
{
    const LAUNCHED = 'launched';
    const PASSED = 'passed';
    const FAILED = 'failed';
    const COMPLETED = 'completed';

    /**
     * Simple sender xAPI statements
     *
     * @return TinCan\LRSResponse $response
     */
    public static function sendStatement(User $user, string $verb, Model $course, mixed $section = null): string|int
    {
        $tokenHeader = ['Authorization' => config('services.lrs.token')];
        $domainLRS = config('services.lrs.domain');

        $lrs = new TinCan\RemoteLRS();
        $lrs->setEndpoint($domainLRS . '/api/xAPI');
        $lrs->setHeaders($tokenHeader);

        $statement = StatementBuilderTinCan::assemblyStatement($user, $verb, $course, $section);
        $response = $lrs->saveStatements([$statement]);

        if ($response->success)
            return $response->httpResponse["_content"];

        return $response->httpResponse["status"];
    }
}
