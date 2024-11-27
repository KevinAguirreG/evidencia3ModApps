@extends('crud-maker.layouts.index', [
	'title' => __('cloud_files.title_index'), 
	'entity' => 'cloud_files', 
	'form' => 'cloudFile',
])

@section('datatable')
@foreach ($cloud_dir->cloudFiles as $key => $file)
				<div class="col col-xl-3">
					<div class="card" style="width: 18rem;">
						<div class="row">
							<div class="col-9 text-center">
								<a href="{{route('cloud_files.show', $file->id)}}" style="">
									<i class="fa-solid fa-file fa-10x card-img-top p-2" style="fa-folder:hover {transition: color 0.5s ease; color: yellow}"></i>
								</a>
							</div>
							<div class="col-3">
									@php
									$params = [
										"entity_source" => 'cloud_files',
										"entity" => 'cloud_files',
										"id" => $file->id,
										"saveAditionals" => "reloadDatatable",
										"isDatatable" => false,
									];
									@endphp

									<button class="btn mt-1"  onclick="showQuickAddModal('{{base64_encode(json_encode($params))}}')">
										<i class="fa-solid fa-2x fa-pencil " style="color: blue;"></i>
									</button>
								
									<button class="btn mt-1 " onclick="showDeleteModal('cloud_files', {{ $file->id }}, null, false)">
									<i class="fa-solid fa-trash fa-2x" style="color: red;" ></i>
									</button>

							</div>
						</div>


						<div class="card-body">
							<h5 class="card-title">{{$file->description}}</h5>
							<p class="card-text">Última modificación: {{$file->updated_at}}</p>
						</div>
					</div>
				</div>
			@endforeach
	{{ $dataTable->table(["width" => "100%"]) }}
@endsection