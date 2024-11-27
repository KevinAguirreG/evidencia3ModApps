@extends('layouts.app', [
	'title' => __('warehouses.title_index'), 
	'entity' => 'warehouses', 
	'form' => 'warehouse',
])

@section('content')
    <div class="container">
        <div class="row">
            {{-- <div class="col col-md-6 col-xl-4">
                <img src="{{asset("images/nubeVoladora2.gif")}}" alt="gif de la nube voladora de dragon ball" style="width:auto;height:350px;">
            </div> --}}
            <div class="col text-center">
                <h3 style="font-family: Saiyan-Sans; font-size: 65px">Nube Voladora Muy Pronto</h3>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        @font-face {
            font-family: Saiyan-Sans;
            src: url({{asset('fonts/saiyan_sans/Saiyan-Sans.ttf')}});
        }
    </style>
@endpush