@component('components.header')
@endcomponent

@component('components.aside')
@endcomponent


<div class="container">
    <div class="create">
        <div class="create__container classic-box mrauto">
            <div class="create__title h2 mb30">Create Account</div>
            <form method="post" action="{{ route('users') }}" class="create__form form">
                @csrf

                @if ($errors->has('surname'))
                    <div class="alert alert-danger">
                        <ul>@foreach($errors->get('surname') as $message)<li>{{$message}}</li>@endforeach</ul>
                    </div>
                @endif
                <input name="surname" value="{{ old('surname') }}" type="text" placeholder="Surname" class="create__input col-input input" required>

                @if ($errors->has('name'))
                    <div class="alert alert-danger">
                        <ul>@foreach($errors->get('name') as $message)<li>{{$message}}</li>@endforeach</ul>
                    </div>
                @endif
                <input name="name" value="{{ old('name') }}" type="text" placeholder="Name" class="create__input col-input input" required>

                @if ($errors->has('patronymic'))
                    <div class="alert alert-danger">
                        <ul>@foreach($errors->get('patronymic') as $message)<li>{{$message}}</li>@endforeach</ul>
                    </div>
                @endif
                <input name="patronymic" value="{{ old('patronymic') }}" type="text" placeholder="Patronymic (optional)" class="create__input col-input input">

                @if ($errors->has('email'))
                    <div class="alert alert-danger">
                        <ul>@foreach($errors->get('email') as $message)<li>{{$message}}</li>@endforeach</ul>
                    </div>
                @endif
                <input name="email" value="{{ old('email') }}" type="email" placeholder="E-mail" class="create__input col-input input" required>

                @if ($errors->has('password'))
                    <div class="alert alert-danger">
                        <ul>@foreach($errors->get('password') as $message)<li>{{$message}}</li>@endforeach</ul>
                    </div>
                @endif
                <input name="password" type="password" placeholder="Password" class="create__input col-input input" required>

                @if ($errors->has('password_confirmation'))
                    <div class="alert alert-danger">
                        <ul>@foreach($errors->get('password_confirmation') as $message)<li>{{$message}}</li>@endforeach</ul>
                    </div>
                @endif
                <input name="password_confirmation" type="password" placeholder="Confirm password" class="create__input col-input input" required>

                <button type="submit" class="create__button rounded-red-button button">Create</button>
            </form>

        </div>
    </div>
</div>
@component('components.footer')
@endcomponent
