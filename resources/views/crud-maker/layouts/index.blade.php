@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-12">
			<input type="hidden" id="allowAdd" value="{{ $allowAdd ?? false }}">
			<input type="hidden" id="allowEdit" value="{{ $allowEdit ?? false }}">
			<input type="hidden" id="entity" value="{{ $entity }}">
			<input type="hidden" id="form" value="{{ $form }}">
			@yield('data')

			<div class="row pt-4">
				<div class="col-12 col-md-10">
					<h3 class="pl-3">{{ $title }}</h3>
				</div>
				@if ($back ?? false)
				<div class="col-12 col-md-2 text-end pr-4">
					<a href="{{ $back }}">
						<button type="button" class="btn btn-primary"><i class="fa-solid fa-arrow-left-long"></i></button>
					</a>
				</div>
				@endif
			</div>
			{{-- <hr class="line"> --}}
			<div class="row ">
				<div class="col-12 px-4">
					@yield('filters')
				</div>
			</div>
			<div id="message" class="row  flex-shrink-0 flex-row ">
				<div class="col-12">
					<div class="message-container"></div>
					@include('crud-maker.components.session-alerts')
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					@yield('datatable')
				</div>
			</div>
		</div>
	</div>

	@include('crud-maker.components.modal-delete')
@endsection
@push('scripts')
	{{ $dataTable ?? false ? $dataTable->scripts() : '' }}
	<script>
		$(function() {
			if ($(".custom-add-button")[0] != "") {
				//Limpiar manualmente el filtro
				window.LaravelDataTables[$("#entity").val()+"-table"].search("").draw();
				window.isModal = true;
				$(".custom-add-button").html(getAddButton());
			}
		})
	</script>
	@stack('customScripts')
@endpush