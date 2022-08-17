<?php

namespace App\Courses\Controllers;

use App\Courses\Quizzes\Models\Quiz;
use App\Courses\Requests\CreateCourseContentRequest;
use App\Courses\Requests\UpdateCourseContentRequest;
use App\Courses\Services\CourseContentService;
use App\Courses\Services\CourseService;
use App\Courses\Services\QuizService;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CourseContentController extends Controller
{
    public function __construct(
        private CourseContentService $courseContentService,
        private CourseService $courseService,
    )
    {

    }

    public function edit($courseId, $sectionId): View
    {
        $course = $this->courseService->getCourse($courseId);
        $this->authorize('update', [$course]);
        $section = $this->courseContentService->getContent($courseId, $sectionId);
        return view('pages.courses.sections.edit', compact('section', 'courseId'));
    }

    public function update(UpdateCourseContentRequest $request, $courseId, $sectionId): RedirectResponse
    {
        $course = $this->courseService->getCourse($courseId);
        $this->authorize('update', [$course]);
        $validated = $request->validated();
        $this->courseContentService->update($validated, $courseId, $sectionId);
        return redirect()->route('courses.edit', [$courseId]);
    }

    public function store(CreateCourseContentRequest $request, $courseId): RedirectResponse
    {
        $this->authorize('create', [auth()->user()]);
        $validated = $request->validated();
        $sectionId = $this->courseContentService->store($validated, $courseId);
        return redirect()->route('courses.edit.section', [$courseId, $sectionId]);
    }

    public function destroy($courseId, $sectionId): RedirectResponse
    {
        $course = $this->courseService->getCourse($courseId);
        $this->authorize('delete', [$course]);
        $this->courseContentService->destroy($courseId, $sectionId);
        return redirect()->route('courses.edit', [$courseId]);
    }
}