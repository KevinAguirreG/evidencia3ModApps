@extends('layouts.app')
@section('content')
	<div class="row">
		<div class="col-12 col-xxl-6 offset-xxl-3">
			@include('dashboard.filters')
		</div>
	</div>
	<br />
	<br />
	<div class="row">
		<div class="col-12 col-xxl-6">
			@include('dashboard.chart-container', ["data" => $charts["sellings"]])
		</div>
		<div class="col-12 col-xxl-6">
			@include('dashboard.chart-container', ["data" => $charts["buyings"]])
		</div>
	</div>
	<br />
	<br />
	<div class="row">
		<div class="col-12 col-xxl-6">
			@include('dashboard.chart-container', ["data" => $charts["inventories"]])
		</div>
		<div class="col-12 col-xxl-6">
			@include('dashboard.table-inventory-criticals', compact('inventories'))
		</div>
	</div>
@endsection

@push('scripts')
<script>
$(function() {
	$(".dashboard-chart").each(function (index, el) {
		window.drawChart(JSON.parse($(el).find(".data").val()));
	});

	window.clearFilters = (param) => {
		let form = $(param).closest("form");
		$(form).find("input").val("");
		$(form).trigger("submit");
	}
});
</script>
@endpush