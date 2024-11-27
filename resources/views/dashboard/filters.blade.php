<div class="filters">
	<form action="#">
		<div class="row">
			<div class="col-6">
				@include('crud-maker.components.field-add', ['params' =>
					[
						"name" => "initial_date",
						"id" => "initial_date",
						"class" => "form-control",
						"entity" => "inventories",
						"type" => "date",
						"defaultValue" => $_GET["initial_date"] ?? null,
					]
				])
			</div>
			<div class="col-6">
				@include('crud-maker.components.field-add', ['params' => 
					[
						"name" => "final_date",
						"id" => "final_date",
						"class" => "form-control",
						"entity" => "inventories",
						"type" => "date",
						"defaultValue" => $_GET["final_date"] ?? null,
					]
				])
			</div>
		</div>
		<div class="row">
			<div class="col-12 text-center">
				<button type="button" class="btn btn-secondary" onclick="clearFilters(this)">@lang('Clear filters')</button>
				<button type="submit" class="btn btn-primary">@lang('Search')</button>
			</div>
		</div>
	</form>
</div>