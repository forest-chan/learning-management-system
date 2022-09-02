<?php

namespace App\Courses\Helpers;

use TinCan;
use App\Users\Models\User;
use Illuminate\Database\Eloquent\Model;

class StatementBuilderTinCan
{
    /**
     * Simple builder for xAPI statements
     *
     * @return TinCan\Statement $compiledStatement
     */
    public static function assemblyStatement(User $user, string $verb, Model $course, mixed $section = null): TinCan\Statement
    {
        $actor = new TinCan\Agent([
                'account' => [
                    'homePage' => 'http://course-zone.org',
                    'name' => "$user->user_id",
                ],
            ]
        );

        $verb = new TinCan\Verb(
            ['id' => 'http://adlnet.gov/expapi/verbs/'. $verb,
                'display' => [
                    'en-US' => $verb,
                ]]
        );

        $compiledStatement = [
            'actor' => $actor,
            'verb' => $verb,
        ];

        $activity = new TinCan\Activity(
            ['id' => 'http://course-zone.org/courses/' . $course->course_id]
        );

        if ($section) {
            $activity = new TinCan\Activity(
                ['id' => 'http://course-zone.org/sections/' . $section->item_id]
            );
            $context = new TinCan\Context([
                "contextActivities" => [
                    "parent" => [
                        "objectType" => "Activity",
                        "id" => "http://course-zone.org/courses/$course->course_id",
                    ],
                ],
            ]);
            $compiledStatement['context'] = $context;
        }
        $compiledStatement['object'] = $activity;

        $statement = new TinCan\Statement($compiledStatement);

        return $statement;
    }
}
