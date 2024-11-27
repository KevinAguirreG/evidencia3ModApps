@extends('layouts.login')

@section('header')
	<div id="logo" class="text-center">
		<img src="{{ asset('/images/logo.png') }}" alt="" height="50">
	</div>
@endsection
@section('body')
	<div class="text-center">
		<h4 class="pb-1">
			@lang('auth.login_title')
		</h4>
		<h6 class="pb-2">
			@lang('auth.login_subtitle')
		</h6>
	</div>

	@include('auth.login-fields')
@endsection
@section('footer')
	<p class="pt-4 text-center">
		@if (Route::has('register'))
			@lang('auth.register_label')
			<a class="app-link" href="{{ route('register') }}">
				<i class='bx bxs-lock-alt'></i>
				@lang('auth.register_link')
			</a>
		@endif
	</p>
@endsection