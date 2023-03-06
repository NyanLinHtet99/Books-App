@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-dismissible fade show mb-2" role="alert">
                                {{ $message }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            <img src="{{ Storage::url('avatars/' . auth()->user()->info->image) }}"
                                class="mb-2 rounded-border" style="width:100px;height:100px;">
                        @endif

                        {{-- <x-profile></x-profile> --}}
                        <x-profilewindow></x-profilewindow>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
