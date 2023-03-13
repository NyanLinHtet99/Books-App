@extends('layouts.app')
@section('content')
    <div class="container mt-2">

        <div class="row d-flex justify-content-center">

            <div class="col-7">

                <div class="card p-3 py-4">
                    <div class="text-center">
                        <img src="{{ Storage::url('avatars/' . $user->info->image) }}" width="100" class="rounded-circle">
                    </div>
                    <div class="text-center mt-3">
                        <h5 class="mt-2 mb-0">{{ $user->name }}</h5>
                        <div class="px-4 mt-1">
                            <p class="fonts">{{ $user->info->bio }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-8">
                <x-books.index></x-books.index>
            </div>
        </div>
    </div>
@endsection
