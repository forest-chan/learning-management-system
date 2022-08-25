<?php

namespace App\Courses\Services;

use App\Courses\Models\AssignableCourse;
use App\Courses\Models\Course;
use App\Users\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CourseService
{
    public function getCourse($id): Model
    {
        return Course::with('content.type')->find($id);
    }

    public function getAssignments($searchParam = ''): BelongsToMany
    {
        return auth()->user()
                     ->assignedCourses()
                     ->withCount('assignedUsers')
                     ->orderByDesc('course_id')
                     ->search($searchParam);
    }

    public function getOwn($searchParam = ''): HasMany
    {
        return auth()->user()
                     ->courses()
                     ->withTrashed()
                     ->withCount('assignedUsers')
                     ->orderByDesc('course_id')
                     ->search($searchParam);
    }

    public function getAll(): Collection
    {
        return Course::withCount('assignedUsers')->get();
    }

    public function assign($userId, $courseId): AssignableCourse
    {
        return AssignableCourse::firstOrCreate([
            'student_id' => $userId,
            'course_id' => $courseId,
        ]);
    }

    public function assignMany($emails, $courseId)
    {
        $ids = User::query()->whereIn('email', $emails)->get()->pluck('user_id');
        $assignData = [];
        foreach ($ids as $id) {
            $assignData[] = ['student_id' => $id, 'course_id' => $courseId];
        }
        return AssignableCourse::upsert($assignData, ['student_id', 'course_id']);
    }

    public function deduct($userId, $courseId): bool
    {
        return AssignableCourse::where([
            ['course_id', '=', $courseId],
            ['student_id', '=', $userId],
        ])->delete();
    }

    public function getUnassignedUsers($searchParam, $courseId): Builder
    {
        $users = User::whereDoesntHave('assignableCourses', function(Builder $query) use ($courseId) {
            $query->where('course_id', '=', $courseId);
        });

        return $users->orderByDesc('user_id')
                     ->search($searchParam);
    }

    public function getAssignedUsers($searchParam, $courseId): BelongsToMany
    {
        $users = $this->getCourse($courseId)->assignedUsers();

        return $users->orderByDesc('user_id')
                     ->search($searchParam);
    }

    public function update($courseId, $validated): bool
    {
        $course = $this->getCourse($courseId);
        return $course->update($validated);
    }

    public function store($validated): Course
    {
        $validated['author_id'] = auth()->id();
        return Course::create($validated);
    }

    public function destroy($courseId): bool
    {
        return Course::where([
            ['course_id', '=', $courseId],
            ['author_id', '=', auth()->id()],
        ])->delete();
    }

    public function restore($courseId): bool
    {
        return Course::where([
            ['course_id', '=', $courseId],
            ['author_id', '=', auth()->id()],
        ])->restore();
    }
}
