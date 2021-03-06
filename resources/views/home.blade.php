@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-3">
        <passport-clients class="col-md-8"></passport-clients>
    </div>
    <div class="row justify-content-center mt-3">
        <passport-personal-access-tokens class="col-md-8"></passport-personal-access-tokens>
    </div>
    <div class="row justify-content-center mt-3">
        <passport-authorized-clients class="col-md-8"></passport-authorized-clients>
    </div>
</div>
@endsection