@extends('layouts.form')
@section('card')
    @component('components.card')
        @slot('title')
            @lang('Connexion')
        @endslot
        <div class="row">
            <div class="col-md-6 text-center">
                <a class="btn btn-primary center-block" href="{{ route('social', ['provider' => 'facebook']) }}">
                    @lang('Connexion avec Facebook')
                </a>
            </div>
            <div class="col-md-6 text-center">
                <a class="btn btn-primary center-block" href="{{ route('social', ['provider' => 'google']) }}">
                    @lang('Connexion avec Google+')
                </a>
            </div>
        </div>

        <form method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            @include('partials.form-group', [
                'title' => __('Adresse email'),
                'type' => 'email',
                'name' => 'email',
                'required' => true,
                ])
            @include('partials.form-group', [
                'title' => __('Mot de passe'),
                'type' => 'password',
                'name' => 'password',
                'required' => true,
                ])
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="custom-control-label" for="remember"> @lang('Se rappeler de moi')</label>
            </div>
            @component('components.button')
                @lang('Connexion')
            @endcomponent
            <a class="btn btn-link" href="{{ route('password.request') }}">
                @lang('Mot de passe oublié ?')
            </a>
        </form>
    @endcomponent
@endsection
