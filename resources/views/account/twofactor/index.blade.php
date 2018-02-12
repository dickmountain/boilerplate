@extends('account.layouts.default')

@section('account.content')
    <div class="panel panel-default">
        <div class="panel-body">
            <form action="{{ route('account.twofactor.store') }}" method="POST">
                {{ csrf_field() }}

                <div class="form-group{{$errors->has('dial_code') ? ' has-error' : ''}}">
                    <label for="dial_code" class="control-label">Dial code</label>
                    <select name="dial_code" class="form-control">
                        @foreach($countries as $country)
                            <option value="{{ $country->dial_code }}">{{ $country->name }} (+{{ $country->dial_code }})</option>
                        @endforeach
                    </select>

                    @if ($errors->has('dial_code'))
                        <span class="help-block">
							{{ $errors->first('dial_code') }}
						</span>
                    @endif
                </div>

                <div class="form-group{{$errors->has('phone_number') ? ' has-error' : ''}}">
                    <label for="phone_number">Phone number</label>
                    <input type="text" name="phone_number" id="phone_number" class="form-control">
                    @if ($errors->has('phone_number'))
                        <span class="help-block">
							{{ $errors->first('phone_number') }}
						</span>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Enable</button>
            </form>
        </div>
    </div>
@endsection
