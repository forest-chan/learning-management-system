@component('components.header')
@endcomponent

@component('components.aside')
@endcomponent
<div class="container">
    <div class="users">
        <div class="users__title h1">
            Students
            <div class="users__after-title-links">
                <a href="{{ url('/users/create') }}" class="users__title-link">
                    <i class="fas fa-plus"></i>
                </a>
            </div>
            <form action="/users" method="get" class="users__form-search">
                <input placeholder="Search" type="text" class="users__input-search">
                <button class="users__button-search"><i class="fas fa-search"></i></button>
            </form>
        </div>
        <table class="users__table classic-box">
            <thead>
                <tr class="users__tr users__tr_head">
                    <th class="users__td">ID</th>
                    <th class="users__td">E-mail</th>
                    <th class="users__td">Surname</th>
                    <th class="users__td">Name</th>
                    <th class="users__td">Patronymic</th>
                    <th class="users__td"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $key => $user)
                    <tr class="users__tr">
                        <th class="users__td">{{ $user->user_id }}</th>
                        <th class="users__td">{{ $user->email }}</th>
                        <th class="users__td">{{ $user->surname }}</th>
                        <th class="users__td">{{ $user->name }}</th>
                        <th class="users__td">{{ $user->patronymic }}</th>
                        <th class="users__td">
                            <a class="table-action-button table-show-button" href="/users/{{ $user->id }}"><i class="fas fa-eye"></i></a>
                            <a class="table-action-button table-edit-button" href="/users/{{ $user->id }}/edit"><i class="fas fa-pen"></i></a>
                            <a class="table-action-button table-delete-button" href="/users/{{ $user->id }}/delete"><i class="fas fa-trash"></i></a>
                        </th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@component('components.footer')
@endcomponent