@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @guest

                    @else
                        <div class="alert alert-success">
                        <b>App Token</b> :  Bearer {{ Auth::user()->api_token}}
                        </div>
                    @endguest

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
