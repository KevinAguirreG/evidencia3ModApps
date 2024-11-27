@extends('layouts.app', [
	'title' => __('cloud_files.title_show'), 
])

@section('content')
<div class="report-container p-3">
	<div class="row">
		<div class="col-sm-12 col-md-6 offset-md-3">
			<br>
			<div class="card card-info">
				<div class="card-header">
					<div class="row">
						<div class="col-sm-12 col-md-6 card-title">@lang('cloud_files.title_show')</div>
						<div class="col-sm-12 col-md-6 text-right">
							<a href="{{ route('cloud_files.index') }}">
								<i class="fas fa-long-arrow-alt-left"></i>
							</a>
						</div>
					</div>
				</div>
				<div class="card-body">
					
					<div class="row">
						<div class="col-sm-4 offset-sm-1 text-end">@lang('cloud_files.id')</div>
						<div class="col-sm-6">{{ $cloud_file->id }}</div>
					</div>
					<div class="row">
						<div class="col-sm-4 offset-sm-1 text-end">@lang('cloud_files.cloud_dir_id')</div>
						<div class="col-sm-6">{{ $cloud_file->cloud_dir_id }}</div>
					</div>
					<div class="row">
						<div class="col-sm-4 offset-sm-1 text-end">@lang('cloud_files.description')</div>
						<div class="col-sm-6">{{ $cloud_file->description }}</div>
					</div>
					<div class="row">
						<div class="col-sm-4 offset-sm-1 text-end">@lang('cloud_files.file_path')</div>
						<div class="col-sm-6">{{ $cloud_file->file_path }}</div>
					</div>
					<div class="row">
						<div class="col-sm-4 offset-sm-1 text-end">@lang('cloud_files.notes')</div>
						<div class="col-sm-6">{{ $cloud_file->notes }}</div>
					</div>
					<div class="row">
						<div class="col-sm-4 offset-sm-1 text-end">@lang('cloud_files.is_active')</div>
						<div class="col-sm-6">{{ $cloud_file->is_active }}</div>
					</div>
					<div class="row">
						<div class="col-sm-4 offset-sm-1 text-end">@lang('cloud_files.created_by')</div>
						<div class="col-sm-6">{{ $cloud_file->created_by }}</div>
					</div>
					<div class="row">
						<div class="col-sm-4 offset-sm-1 text-end">@lang('cloud_files.updated_by')</div>
						<div class="col-sm-6">{{ $cloud_file->updated_by }}</div>
					</div>
					<div class="row">
						<div class="col-sm-4 offset-sm-1 text-end">@lang('cloud_files.created_at')</div>
						<div class="col-sm-6">{{ $cloud_file->created_at }}</div>
					</div>
					<div class="row">
						<div class="col-sm-4 offset-sm-1 text-end">@lang('cloud_files.updated_at')</div>
						<div class="col-sm-6">{{ $cloud_file->updated_at }}</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection