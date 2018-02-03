<ul class="nav nav-pills nav-stacked">
    <li class="{{ return_if(on_page('account'), 'active') }}"><a href="{{ route('account.index') }}">Account overview</a></li>
    <li class="{{ return_if(on_page('account/profile'), 'active') }}"><a href="{{ route('account.profile.index') }}">Profile</a></li>
    <li class="{{ return_if(on_page('account/password'), 'active') }}"><a href="{{ route('account.password.index') }}">Change password</a></li>
</ul>

<hr>

@subscribed
    <ul class="nav nav-pills nav-stacked">
        @subscription_not_cancelled
            <li class=""><a href="{{ route('account.subscription.cancel.index') }}">Cancel subscription</a></li>
            <li class=""><a href="{{ route('account.subscription.change.index') }}">Change plan</a></li>
        @endsubscription_not_cancelled

        @subscription_cancelled
            <li class=""><a href="{{ route('account.subscription.resume.index') }}">Resume subscription</a></li>
        @endsubscription_cancelled

        <li class=""><a href="{{ route('account.subscription.card.index') }}">Update card</a></li>
    </ul>
@endsubscribed