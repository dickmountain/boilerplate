@extends('account.layouts.default')

@section('account.content')
    <div class="panel panel-default">
        <div class="panel-body">
            <form action="{{ route('account.subscription.resume.store') }}" method="POST">
                {{ csrf_field() }}
                <p>Confirm subscription resuming:</p>
                <button type="submit" class="btn btn-primary">Resume</button>
            </form>
        </div>
    </div>
@endsection
