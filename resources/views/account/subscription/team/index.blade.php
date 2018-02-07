@extends('account.layouts.default')

@section('account.content')
    <div class="panel panel-default">
        <div class="panel-body">
            <form action="{{ route('account.subscription.team.update') }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}

                <div class="form-group{{$errors->has('name') ? ' has-error' : ''}}">
                    <label for="name" class="control-label">Current password</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $team->name) }}">

                    @if ($errors->has('name'))
                        <span class="help-block">
							{{ $errors->first('name') }}
						</span>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
