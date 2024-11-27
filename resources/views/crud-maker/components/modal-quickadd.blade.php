@php $model = ${$modelName ?? Str::singular($params["entity"])}; @endphp
<div class="modal {{ $params["entity"] ?? 'modal' }}-modal" data-bs-backdrop="static" tabindex="-1" role="dialog">
	<div class="modal-dialog {{ $modalSize ?? ''  }}" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">
					{{ __(($params["translations"] ?? $params["entity"]).'.title_'.($model === null ? 'add' : 'edit')) }}
				</h5>
				<button type="button" class="btn btn-default" data-bs-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				@if($model === null)
					{{ Form::open(['id' => $params["entity"].'-quickmodal', 'route' => $params["entity"].'.store']) }}
				@else
					{{ Form::open(['id' => $params["entity"].'-quickmodal', 'route' => [$params["entity"].'.update', $model->id], 'method' => 'POST']) }}
					@method('PUT')
					<input type="hidden" name="id" value="{{ $model->id }}">
				@endif
				<div class="message-container"></div>
				@include(($params['resource'] ?? str_replace('_', '-', $params['entity'])) . '.fields', ["isEdit" => ($model === null ? false : true)])
				{{ Form::close() }}
			</div>
			<div class="modal-footer">
				@if($params["aditionalButtons"] ?? false)
					{!! $params["aditionalButtons"] !!}
				@endif

				@if($params["customSave"] ?? false)
					@php $paramsSave = ["onclick" => $params["customSave"]."('".base64_encode(json_encode($params))."')"]; @endphp
				@else
					@php $paramsSave = ["onclick" => "saveQuickAdd('".base64_encode(json_encode($params))."')"]; @endphp
				@endif
				{{ Form::button(__("Save"), array_merge(["id" => "btnSave", "class" => "btn btn-primary"], $paramsSave)) }}
				{{ Form::button(__("Cancel"), ["id" => "btnCancel", "class" => "btn btn-secondary", "data-bs-dismiss" => "modal"]) }}
			</div>
		</div>
	</div>
</div>