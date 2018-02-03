@extends('account.layouts.default')

@section('account.content')
    <div class="panel panel-default">
        <div class="panel-body">
            <form action="" method="POST">
                {{ csrf_field() }}

            </form>
        </div>
    </div>
@endsection
