<div class="row">
	@if ($adjust ?? false)
		<div class="col-12 col-md-8 offset-md-2 col-lg-4 offset-lg-4">
	@else
		<div class="col-12">
	@endif
		
		
		@if ($toggleButton ?? false)
		<a data-bs-toggle="collapse" href="#datatable-filters" role="button" aria-expanded="false" aria-controls="collapseExample">
			<button class="btn btn-primary" type="button">
				@lang('Advanced filters')
			</button>
		</a>
		@endif

		<div class="row datatable-filters collapse @if (!$collapsed ?? true) show @endif" id="datatable-filters">
			<div class="col">
				@php 
					$rowNumber = 1;
					$type = $type ?? 'datatable';
				@endphp
				@if($type != 'datatable')
					<input type="hidden" id="filterSource" value="{{ $filterSource }}">
				@endif
				<div class="row">
					@foreach($rows as $row)
						<div class="{{ $inline ?? false ? "col-4" : "col-12" }}">
							<div class="form-group mb-1">
								<div class="row align-items-center">
									<label for="{{ $row["id"] ?? $row["name"] }}" class="col-sm-4 control-label text-end fw-bold">
										{{ __(($translations ?? $entity).".".($row["id"] ?? $row["name"])) }}
									</label>
									<div class="col-sm-8">
									@if(isset($row["fields"]))
										@foreach($row["fields"] as $field)
											@include('crud-maker.components.field-add', getParams($field, $type, $entity))
										@endforeach
									@else
										@include('crud-maker.components.field-add', getParams($row, $type, $entity))
									@endif
									</div>
								</div>
							</div>
						</div>
						@php $rowNumber++; @endphp
					@endforeach
				</div>
				
				<div class="row mt-3">
					<div class="col text-center">
						<button type="button" class="btn btn-danger" onclick="clearFilters('{{ $type }}')">{{ __('Clear filters') }}</button>
						<button type="button" class="btn btn-primary" onclick="filterData('{{ $type }}')">{{ __('Search') }}</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@php
function getParams($param, $type, $entity) {
	return [
		"params" => array_merge($param, [
			"class" => ($param["class"] ?? "form-control")." ".$type."-filter",
			"entity" => $entity,
		]),
	];
}
@endphp