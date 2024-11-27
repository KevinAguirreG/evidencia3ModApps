{{-- Este componente agrega un row con multiples label e input en un formulario normal de agregar o editar --}}
<div class="row mb-3">
	@php 
		$cols = $cols ?? count($params);
		$displayInline = $displayInline ?? $cols > 1 ? true : false;
	@endphp
	@for ($i = 0; $i < $cols; $i++)
		@if(isset($params[$i]))
			@php 
				$isRequired = $params[$i]["required"] ?? false;
				if (isset($params[$i]["label"]) && $params[$i]["label"] == false) {
					$showLabel = false;
				} else {
					$showLabel = true;
					$label = $params[$i]["customLabel"] ?? __($params[$i]["translations"] ?? $params[$i]["entity"].".".$params[$i]["name"]);
					$label .= $isRequired ? '<span class="required">*</span>' : '';
				}
			@endphp
			<div class="col-12 col-md-{{ $displayInline ? (12 / floatval($cols)) : 12 }}">
				{{-- The content --}}
				<div class="row {{ $params[$i]["name"] }}_container" style="display: {{ $params[$i]["display"] ?? "flex" }};">
					@if($showLabel ?? true)
						<label for="{{ $params[$i]["name"] }}" class="col-12 col-md-{{ $displayInline ? 5 : 12 }} control-label">
							{!! $label !!}
						</label>
					@endif
					<div class="col-12 col-md-{{ $displayInline ? ($showLabel ?? true ? 7 : 12) : 12 }}">
						@include('crud-maker.components.field-add', ['params' => $params[$i]])
					</div>
				</div>
				{{-- The content --}}
			</div>
		@endif
	@endfor
</div>
