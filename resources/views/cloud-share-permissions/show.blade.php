@extends('layouts.app', [
	'title' => __('cloud_share_permissions.title_show'), 
])

@section('content')
<div class="report-container p-3">
	<div class="row">
		<div class="col-sm-12 col-md-6 offset-md-3">
			<br>
			<div class="card card-info">
				<div class="card-header">
					<div class="row">
						<div class="col-sm-12 col-md-6 card-title">@lang('cloud_share_permissions.title_show')</div>
						<div class="col-sm-12 col-md-6 text-right">
							<a href="{{ route('cloud_share_permissions.index') }}">
								<i class="fas fa-long-arrow-alt-left"></i>
							</a>
						</div>
					</div>
				</div>
				<div class="card-body">
					
					<div class="row">
						<div class="col-sm-4 offset-sm-1 text-end">@lang('cloud_share_permissions.id')</div>
						<div class="col-sm-6">{{ $cloud_share_permission->id }}</div>
					</div>
					<div class="row">
						<div class="col-sm-4 offset-sm-1 text-end">@lang('cloud_share_permissions.cloud_dir_id')</div>
						<div class="col-sm-6">{{ $cloud_share_permission->cloud_dir_id }}</div>
					</div>
					<div class="row">
						<div class="col-sm-4 offset-sm-1 text-end">@lang('cloud_share_permissions.user_id')</div>
						<div class="col-sm-6">{{ $cloud_share_permission->user_id }}</div>
					</div>
					<div class="row">
						<div class="col-sm-4 offset-sm-1 text-end">@lang('cloud_share_permissions.delete_permission')</div>
						<div class="col-sm-6">{{ $cloud_share_permission->delete_permission }}</div>
					</div>
					<div class="row">
						<div class="col-sm-4 offset-sm-1 text-end">@lang('cloud_share_permissions.upload_permission')</div>
						<div class="col-sm-6">{{ $cloud_share_permission->upload_permission }}</div>
					</div>
					<div class="row">
						<div class="col-sm-4 offset-sm-1 text-end">@lang('cloud_share_permissions.notes')</div>
						<div class="col-sm-6">{{ $cloud_share_permission->notes }}</div>
					</div>
					<div class="row">
						<div class="col-sm-4 offset-sm-1 text-end">@lang('cloud_share_permissions.is_active')</div>
						<div class="col-sm-6">{{ $cloud_share_permission->is_active }}</div>
					</div>
					<div class="row">
						<div class="col-sm-4 offset-sm-1 text-end">@lang('cloud_share_permissions.created_by')</div>
						<div class="col-sm-6">{{ $cloud_share_permission->created_by }}</div>
					</div>
					<div class="row">
						<div class="col-sm-4 offset-sm-1 text-end">@lang('cloud_share_permissions.updated_by')</div>
						<div class="col-sm-6">{{ $cloud_share_permission->updated_by }}</div>
					</div>
					<div class="row">
						<div class="col-sm-4 offset-sm-1 text-end">@lang('cloud_share_permissions.created_at')</div>
						<div class="col-sm-6">{{ $cloud_share_permission->created_at }}</div>
					</div>
					<div class="row">
						<div class="col-sm-4 offset-sm-1 text-end">@lang('cloud_share_permissions.updated_at')</div>
						<div class="col-sm-6">{{ $cloud_share_permission->updated_at }}</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection