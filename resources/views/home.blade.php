@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h4>Welcome, {{ auth()->user()->email }}</h4>
        </div>
    </div>
</div>
@endsection
