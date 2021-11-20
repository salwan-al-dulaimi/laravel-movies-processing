@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div>
                    <div class="card-header">{{ __('Profile') }}</div>

                    <div class="card-body">



                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ $user->name }}</label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ $user->email }}</label>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a class="btn btn-primary" href="{{ route('user.edit', ['user' => $user->id]) }}">
                                    {{ __('Edit') }}
                                </a>
                                {{-- <button type="submit" class="btn btn-primary">
                                        {{ __('Edit') }}
                                    </button> --}}
                                {{-- <button type="submit" class="btn btn-primary">
                                        {{ __('Reset Password') }}
                                    </button>

                                    <button type="file" class="btn btn-primary btn-floating" multiple>
                                        <i class="fas fa-upload"></i>
                                    </button> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
