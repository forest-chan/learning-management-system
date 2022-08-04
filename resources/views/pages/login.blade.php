@component('components.header')
@endcomponent

<div class="welcome">
    <div class="welcome__container">
        <div class="welcome__logo logo h2">
            CourseZone
        </div>
        <div class="welcome__title h2">
            Sign In
        </div>

        <form action="{{ url('/users') }}" class="welcome__form form">
            <input type="text" placeholder="Login" class="welcome__input input">
            <input type="text" placeholder="Password" class="welcome__input input">
            <p class="welcome__text">Not registered?&nbsp<a href="{{ url('/register') }}">Register</a></p>
            <button type="submit" class="welcome__button rounded-red-button button">Sign in</button>
        </form>

    </div>
</div>

@component('components.footer')
@endcomponent
