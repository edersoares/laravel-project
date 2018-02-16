@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">Generate Token</div>

                <div class="card-body">

                    <form method="POST" action="{{ route('tokens.generate') }}">

                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">Token</label>
                            <div class="col-md-6">
                                <input class="form-control" type="text" value="{{ $token or old('token') }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Generate Token
                                </button>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
