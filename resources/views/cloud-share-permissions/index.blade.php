@extends('crud-maker.layouts.index', [
	'title' => __('cloud_share_permissions.title_index'), 
	'entity' => 'cloud_share_permissions', 
	'form' => 'cloudSharePermission',
])

@section('datatable')
	{{ $dataTable->table(["width" => "100%"]) }}
@endsection