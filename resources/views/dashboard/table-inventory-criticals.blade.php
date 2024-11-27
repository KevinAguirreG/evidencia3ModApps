<div class="row">
	<div class="col-12 text-center">
		<h5>{{ $inventories["title"] }}</h5>
	</div>
</div>

<div class="row">
	<div class="col-12">
		<table class="table inventories-table">
			<thead>
				<tr>
					<th></th>
					<th>@lang('inventories.product_name')</th>
					<th>@lang('inventories.amount')</th>
					<th>@lang('inventories.amount_sold')</th>
					<th>@lang('inventories.avg_sold')</th>
					<th>@lang('inventories.inventory_months')</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($inventories["data"] as $inventory)
				<tr class="{{ $inventory->is_critical ? 'bg-red flashing' : ''}}" style="{{ $inventory->is_critical ? 'background-color: red !important;' : ''}}">
					<td class="{{ $inventory->is_critical ? 'text-white' : '' }}"><i class="{{$inventory->is_critical ? 'fa-solid fa-exclamation' : ''}}"></i></td>
					<td class="{{ $inventory->is_critical ? 'text-white' : '' }}">{{ $inventory->product->name }}</td>
					<td class="{{ $inventory->is_critical ? 'text-white' : '' }}">{{ $inventory->amount }}</td>
					<td class="{{ $inventory->is_critical ? 'text-white' : '' }}">{{ $inventory->amount_sold ?? 0 }}</td>
					<td class="{{ $inventory->is_critical ? 'text-white' : '' }}">{{ $inventory->avg_sold ?? 0 }}</td>
					<td class="{{ $inventory->is_critical ? 'text-white' : '' }}">{{ $inventory->inventory_months ?? 0 }}</td>
					<!-- <td class="{{ $inventory->is_critical ? 'text-danger' : '' }}">{{ $inventory->inventory_months ?? 0 }}</td> -->
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

<style>

	.flashing {
  
		animation: parpadea-animation 0.7s steps(5, start) infinite;
		-webkit-animation: parpadea-animation 0.7s steps(5, start) infinite;
}

	@keyframes parpadea-animation {
	to {
		visibility: hidden;
	}
	}
	@-webkit-keyframes parpadea-animation {
	to {
		visibility: hidden;
	}
	}
</style>


@push('scripts')
<script>
$(function() {
	$(".inventories-table").dataTable({
		'pageLength': 15,
		'dom': 'frtip',
		'serverSide': false,
		'processing': true,
		'responsive': true,
		'stateSave': true,
		'drawCallback': function() { customizeDatatable() },
	});
});
</script>
@endpush