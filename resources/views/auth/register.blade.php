@extends('layouts.form')
@section('card')
    @component('components.card')
        @slot('title')
            @lang('Inscription')
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
        <form method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}
            @include('partials.form-group', [
                'title' => __('Nom'),
                'type' => 'text',
                'name' => 'name',
                'required' => true,
                ])
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
            @include('partials.form-group', [
                'title' => __('Confirmation du mot de passe'),
                'type' => 'password',
                'name' => 'password_confirmation',
                'required' => true,
                ])
            @component('components.button')
                @lang('Inscription')
            @endcomponent
        </form>
    @endcomponent
@endsection
