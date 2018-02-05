@extends('account.layouts.default')

@section('account.content')
    <div class="panel panel-default">
        <div class="panel-body">
            <form action="{{ route('account.subscription.card.store') }}" method="POST" id="card-form">
                {{ csrf_field() }}
                <p>You can change a card for future payments.</p>
                <button id="update" type="submit" class="btn btn-primary">Change</button>
            </form>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="https://checkout.stripe.com/checkout.js"></script>
    <script>
		let handler = StripeCheckout.configure({
			key: '{{ config('services.stripe.key') }}',
			locale: 'auto',
			token: function(token){
				let $form = $('#card-form')

				$('#update').prop('disabled', true)

				$('<input>').attr({
					type: 'hidden',
					name: 'token',
					value: token.id
				}).appendTo($form)

				$form.submit();
			}
		})

		$('#update').click(function(e){
			e.preventDefault();

			handler.open({
				name: 'Homestead Test',
				currency: 'usd',
				key: '{{ config('services.stripe.key') }}',
				email: '{{ auth()->user()->email }}',
                panelLabel: 'Update card'
			})
		})
    </script>
@endsection
