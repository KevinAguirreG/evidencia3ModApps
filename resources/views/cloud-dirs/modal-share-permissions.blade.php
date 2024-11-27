<div class="modal" id="sharepermissionModal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		{{ Form::open(['method' => 'delete', 'name' => 'sharepermissionForm', 'id' => 'sharepermissionForm']) }}
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">
					@lang('share_folder')
				</h5>
				<button type="button" class="btn btn-default" data-bs-dismiss="modal" aria-label="Close">
					<span aria-hidden="true"><i class="mdi mdi-window-close icon-edit font-size-18"></i></span>
				</button>
			</div>
			<div class="modal-body">
				@if ( isset($params) )
					<div class="alert alert-warning">
						{!! $dataTable->table(["width" => "100%"]) !!}
					</div>
				@endif
			</div>
			@if($footer ?? true)
				<div class="modal-footer">
					{{ Form::button(__("Cancel"), ["class" => "btn btn-danger", "data-bs-dismiss" => "modal"]) }}
					{{ Form::button(__("delete"), ["class" => "btn btn-primary button-delete"]) }}
				</div>
			@endif
		</div>
		{{ Form::close() }}
	</div>
</div>