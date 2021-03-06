@extends('account.layouts.default')

@section('account.content')
    <div class="panel panel-default">
        <div class="panel-body">
            @if(auth()->user()->twoFactorEnabled())
                <p>Two factor authentication is enabled</p>
                <form action="{{ route('account.twofactor.destroy') }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-primary">Disable</button>
                </form>
            @else
                @if(auth()->user()->twoFactorPendingVerification())
                    <form action="{{ route('account.twofactor.verify') }}" method="POST">
                        {{ csrf_field() }}

                        <div class="form-group{{$errors->has('token') ? ' has-error' : ''}}">
                            <label for="token" class="control-label">Verification token</label>
                            <input type="text" name="token" id="token" class="form-control">

                            @if ($errors->has('token'))
                                <span class="help-block">
                                    {{ $errors->first('token') }}
                                </span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Verify</button>
                    </form>

                    <hr>

                    <form action="{{ route('account.twofactor.destroy') }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-default">Cancel verification</button>
                    </form>
                @else
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
                @endif
            @endif
        </div>
    </div>
@endsection
