@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Subscription</div>

                <div class="panel-body">
                    <form id="payment-form" class="form-horizontal" method="POST" action="{{ route('subscription.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('plan') ? ' has-error' : '' }}">
                            <label for="plan" class="col-md-4 control-label">Plan</label>

                            <div class="col-md-6">
                                <select name="plan" id="plan" class="form-control">
                                    @foreach($plans as $plan)
                                        <option
                                            value="{{ $plan->gateway_id}}"
                                            {{ request('plan') === $plan->slug || old('plan') === $plan->slug ? 'selected="selected"' : '' }}>
                                                {{ $plan->name }} (${{ $plan->price }})
                                        </option>
                                    @endforeach
                                </select>

                                @if ($errors->has('plan'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('plan') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('coupon') ? ' has-error' : '' }}">
                            <label for="coupon" class="col-md-4 control-label">Coupon code</label>

                            <div class="col-md-6">
                                <input id="coupon" type="text" class="form-control" name="coupon" value="{{ old('coupon') }}">

                                @if ($errors->has('coupon'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('coupon') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button id="pay" type="submit" class="btn btn-primary">
                                    Pay
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
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
            	let $form = $('#payment-form')

                $('#pay').prop('disabled', true)

            	$('<input>').attr({
                    type: 'hidden',
                    name: 'token',
                    value: token.id
                }).appendTo($form)

                $form.submit();
            }
        })

        $('#pay').click(function(e){
        	e.preventDefault();

        	handler.open({
                name: 'Homestead Test',
                description: 'Membership',
                currency: 'usd',
                key: '{{ config('services.stripe.key') }}',
                email: '{{ auth()->user()->email }}'
            })
        })
    </script>
@endsection