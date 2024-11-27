@extends('layouts.app', [
	'title' => __('cloud_share_permissions.title_add'), 
])

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<input type="hidden" id="route" value="cloud_share_permissions" />
			<div class="card card-info">
				<div class="card-header">
					<div class="row">
						<div class="col-12 card-title">@lang('cloud_share_permissions.title_add')</div>
					</div>
				</div>

				{{ Form::open(['id' => 'cloudSharePermission-create', 'route' => "cloud_share_permissions.store", 'method' => 'POST']) }}
					@include('crud-maker.components.session-alerts')
					<div class="message-container"></div>
					
					<div class="card-body">
						@include("cloud-share-permissions.fields")
					</div>
					<div class="card-footer">
						<div class="row">
							<div class="col-sm-10 col-lg-4 offset-lg-8 text-end">
								<button type="submit" class="btn btn-primary">@lang('Save')</button>
								<a href="{{ route('cloud_share_permissions.index') }}">
									<button type="button" class="btn btn-secondary">@lang('Cancel')</button>
								</a>
							</div>
						</div>
					</div>
				{{ Form::close() }}
			</div>
		</div>
	</div>
</div>
@endsection