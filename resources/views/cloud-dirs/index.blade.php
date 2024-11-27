@extends('crud-maker.layouts.index', [
	'title' => __('cloud_dirs.title_index'), 
	'entity' => 'cloud_dirs', 
	'form' => 'cloudDir',
])



@section('datatable')
	<div class="">
		<div class="row">
			<div class="col-6">
					<form class="d-flex p-0 mt-3 gap-2 " action="{{ route('cloud_dirs.index') }}" method="GET">
						<input name="search_folder" id="search_folder" style="height: 35px;" type="text" class="form-control w-50"
							placeholder="Buscar">
						<button class="btn btn-primary">Buscar</button>
					</form>
			</div>
			<div class="col-2 offset-4 my-2">
				@php
					$params = [
						"entity_source" => 'cloud_dirs',
						"entity" => 'cloud_dirs',
						"father_id" => $rootDir->id,
						"saveAditionals" => "reloadDatatable",
						"isDatatable" => false,
					];
				@endphp

				<button class="btn btn-primary mt-2"  onclick="showCreateFolderModal('{{base64_encode(json_encode($params))}}')">
					Agregar carpeta
				</button>
			</div>
		</div>
		<div class="row">
			@foreach ($cloud_dirs  as $key => $dir )
			<div class="col col-xl-3">
				<div class="card" style="width: 18rem;">
					<div class="row">
						<div class="col-9 text-center">
							<a href="{{route('cloud_dirs.show', $dir->id)}}" style="">
								<i class="fa-solid fa-folder fa-10x card-img-top p-2"></i>
							</a>
						</div>
						<div class="col-3">
								<a class="btn mt-1" target="_blank" href="{{route('cloud_share_permissions.indexParam', ['parent' => $dir->id])}}">
									<i class="fa-solid fa-share fa-2x link-success"></i>
								</a>

								@php
								$params = [
									"entity_source" => 'cloud_dirs',
									"entity" => 'cloud_dirs',
									"id" => $dir->id,
									"saveAditionals" => "reloadDatatable",
									"isDatatable" => false,
								];
								@endphp

								<button class="btn mt-1"  onclick="showQuickAddModal('{{base64_encode(json_encode($params))}}')">
									<i class="fa-solid fa-2x fa-pencil link-primary"></i>
								</button>
							
								<button class="btn mt-1 " onclick="showDeleteModal('cloud_dirs', {{ $dir->id }}, null, false)">
								<i class="fa-solid fa-trash fa-2x link-danger" ></i>
								</button>

						</div>
					</div>


					<div class="card-body">
						<h5 class="card-title" style="font-size: 18px;">{{$dir->name}}</h5>
						<p class="card-text">Última modificación: {{$dir->updated_at}}</p>
					</div>
				</div>
			</div>
			
			@endforeach
			
		</div>
		<div class="row">
			<div class="d-flex justify-content-end pe-3">
				 <!-- Pagination Links -->
				 {{ $cloud_dirs->links() }}
			</div>
		</div>
		<div class="row">
			<div class="col-12 col-md-10">
				<h3 class="pl-3">Carpetas Compartidas</h3>
			</div>
		</div>
		<div class="row pb-2">
			<div class="col-6">
					<form class="d-flex p-0 mt-3 gap-2 " action="{{ route('cloud_dirs.index') }}" method="GET">
						<input name="search_shared_folder" id="search_folder" style="height: 35px;" type="text" class="form-control w-50"
							placeholder="Buscar">
						<button class="btn btn-primary">Buscar</button>
					</form>
			</div>
		</div>
		<div class="row">
		@foreach ($sharedDirs?? [] as $key => $dir )
			<div class="col col-xl-3">
				<div class="card" style="width: 18rem;">
					<div class="row">
						<div class="col-9 text-center">
							<a href="{{route('cloud_dirs.show', $dir->id)}}" style="">
								<i class="fa-solid fa-folder fa-10x card-img-top p-2" style="fa-folder:hover {transition: color 0.5s ease; color: yellow}"></i>
							</a>
						</div>
						<div class="col-3">
								<!-- Btn de compartir -->
								<!-- <a class="btn mt-1"  href="{{route('cloud_share_permissions.indexParam', ['parent' => $dir->id])}}">
									<i class="fa-solid fa-share fa-2x link-danger"></i>
								</a> -->

								<!-- Btn de editar la carpeta -->
								<!-- @php
								$params = [
									"entity_source" => 'cloud_dirs',
									"entity" => 'cloud_dirs',
									"id" => $dir->id,
									"saveAditionals" => "reloadDatatable",
									"isDatatable" => false,
								];
								@endphp -->

								<!-- <button class="btn mt-1"  onclick="showQuickAddModal('{{base64_encode(json_encode($params))}}')">
									<i class="fa-solid fa-2x fa-pencil link-primary"></i>
								</button> -->
							
								<!-- Btn de eliminar la carpeta -->
								<!-- <button class="btn mt-1 " onclick="showDeleteModal('cloud_dirs', {{ $dir->id }}, null, false)">
								<i class="fa-solid fa-trash fa-2x" style="color: red;" ></i>
								</button> -->

						</div>
					</div>


					<div class="card-body">
						<h5 class="card-title" style="font-size: 18px;">{{$dir->name}}</h5>
						<p class="card-text mb-1">Dueño de la carpeta: {{$dir->User->name}}</p>
						<p class="card-text">Última modificación: {{$dir->updated_at}}</p>
					</div>
				</div>
			</div>
			
			@endforeach
		</div>
		<div class="d-flex justify-content-end">
			<div class="col">
				 <!-- Pagination Links -->
				 {{ $sharedDirs->links() }}
			</div>
		</div>
	</div>

	<!-- @include('cloud-dirs.modal-share-permissions')
	{{ $dataTable->table(["width" => "100%"]) }} -->
@endsection