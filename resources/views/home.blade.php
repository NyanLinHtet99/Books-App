@extends('layouts.app')

@section('content')
    <div class="container">
        <x-profile.window></x-profile.window>
        <div class="row justify-content-center">
            <div class="col-8">
                <x-books.index></x-books.index>
            </div>
        </div>
    </div>
@endsection
