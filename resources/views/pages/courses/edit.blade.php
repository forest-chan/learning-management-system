@component('components.header')
@endcomponent

@component('components.aside')
@endcomponent

<div class="container">
    <div class="edit flex">
        <div class="edit__container edit__container-course classic-box mrauto">
            <div class="edit__title h2 mb30">Edit Course</div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="post" action="{{ route('courses.update', ['id' => $course->course_id]) }}" class="edit__form form">
                @csrf
                @method('patch')
                <input name="course_id" value="{{ old('course_id') ?? $course->course_id }}" type="hidden" class="edit__input col-input input">
                <input name="title" value="{{ old('title') ?? $course->title }}" class="edit__input col-input input">
                <textarea name="description" class="edit__input col-input input h150">{{ old('description') ?? $course->description }}</textarea>
                <button type="submit" class="edit__button rounded-black-button button mb15">Save changes</button>
            </form>

            <button type="submit" class="edit__button rounded-black-button button mb15">
                <a href="{{ route('courses.edit.assignments', ['id' => $course->course_id]) }}" >Assign students</a>
            </button>
            <button class="edit__button rounded-red-button button mb15" onclick="document.getElementById('delete-modal-<?= $course->course_id  ?>').style.display = 'flex'">
                Delete
            </button>

        </div>
        <div class="edit__container edit__container-course classic-box">
            <div class="edit__title h2 mb30">Create course section</div>
            <form method="post" action="{{ route('courses.create.section', ['id' => $course->course_id]) }}" class="edit__form form">
                @csrf
                @method('post')
                <input name="sectionTitle" placeholder="Section title" value="{{ old('sectionTitle') }}" type="text" class="edit__input col-input input">
                <select class="select mb20" name="type" id="">
                    <option value="article">Article</option>
                    <option value="youtubeVideoLink">YouTube video</option>
                    <option value="test">Test</option>
                </select>
                <button type="submit" class="edit__button rounded-black-button button mb15">Create section</button>
            </form>
        </div>
    </div>
    <div class="edit">
        <div class="edit__container edit__container-course classic-box mrauto">
            <div class="edit__title h2 mb30">
                Course sections
            </div>
            <table class="users__table">
                <thead>
                <tr class="users__tr users__tr_head">
                    <th class="users__td">Type</th>
                    <th class="users__td">Title</th>
                    <th class="users__td"></th>
                </tr>
                </thead>
                <tbody>
                    @forelse($course->content as $element)
                                <tr class="users__tr">
                                    <th class="users__td">{{ $element['type'] }}</th>
                                    <th class="users__td">{{ $element['title'] }}</th>
                                    <th class="users__td">
                                        <a class="table-action-button table-edit-button" href="{{ route('courses.edit.section', ['id' => $course->course_id, 'section_id' => $element['section_id']]) }}"><i class="fas fa-pen"></i></a>
                                        <button class="table-action-button table-delete-button" onclick="document.getElementById('delete-modal-<?= $element['section_id'] ?>').style.display = 'flex'">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </th>
                                </tr>

                                <div class="modal" id="delete-modal-{{ $element['section_id'] }}">
                                    <div class="modal-box">
                                        <p class="modal-text modal-text-delete mb20 mr20">You sure to <span>delete</span> course section {{ $element['title'] }}?</p>

                                        <div class="modal-buttons">
                                            <form class="table-action-form" action="{{ route('courses.destroy.section', ['id' => $course->course_id, 'section_id' => $element['section_id']]) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <input name="user_id" type="hidden" value="{{ $course->course_id }}">
                                                <button type="submit" class="table-action-button confirm-button">Confirm</button>
                                            </form>
                                            <button onclick="document.getElementById('delete-modal-<?= $element['section_id'] ?>').style.display = 'none'" class="table-action-button cancel-button">Cancel</button>
                                        </div>

                                    </div>
                                </div>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>



<div class="modal" id="delete-modal-{{ $course->course_id }}">
    <div class="modal-box">
        <p class="modal-text modal-text-delete mb20 mr20">You sure to <span>delete</span> course: "{{ $course->title }}"?</p>
        <div class="modal-buttons">
            <form class="table-action-form" action="{{ route('courses.delete', ['id' => $course->course_id]) }}" method="post">
                @csrf
                @method('delete')
                <input name="user_id" type="hidden" value="{{ $course->course_id }}">
                <button type="submit" class="table-action-button confirm-button">Confirm</button>
            </form>
            <button onclick="document.getElementById('delete-modal-<?= $course->course_id ?>').style.display = 'none'" class="table-action-button cancel-button">Cancel</button>
        </div>

    </div>
</div>

@component('components.footer')
@endcomponent
