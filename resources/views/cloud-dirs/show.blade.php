@extends('layouts.app', [
	'title' => __('cloud_dirs.title_show'), 
])
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.0/dropzone.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.2/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.0/dropzone.js"></script>
@php
	$owner = $cloud_dir->User->id == $user->id;
@endphp
@if ($owner || $sharedPermissions)

	@section('content')
		<div id="message" class="row  flex-shrink-0 flex-row ">
			<div class="col-12">
				<div class="message-container"></div>
				@include('crud-maker.components.session-alerts')
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 col-md-6 card-title">
				<h3 class="pl-3">{!! $cloud_dir->name !!}</h3>
			</div>
			<div class="col-sm-12 col-md-6 text-end">
				<a href="{{ $cloud_dir->CloudDir->name == 'root' ? route('cloud_dirs.index') : route('cloud_dirs.show', $cloud_dir->cloud_dir_id) }}">
					<i class="fas fa-long-arrow-alt-left fa-xl pt-2"></i>
				</a>
			</div>
		</div>

		@if ($owner || $sharedPermissions->upload_permission == true)
			<!-- Drag and drop -->
			<form method="POST" action="{{route('cloud_dirs.fileStore')}}" enctype="multipart/form-data" class="dropzone" id="dropzone">
					<input id="cloud_dir_id" name="cloud_dir_id" type="hidden" value="{{$cloud_dir->id}}" />
					
				@csrf
			</form> 
			<!-- Btn para cargar archivos -->
			<div class="text-end">
				<button class="btn btn-primary" type="button" id="process" onclick="processQueue()">
					Subir archivos
				</button>  
			</div>
		@endif

		<br>

		<div class="">
			<div class="row">
				<div class="col-6">
						<form class="d-flex p-0 mt-3 gap-2 " action="{{ route('cloud_dirs.show', $cloud_dir->id ) }}" method="GET">
							<input name="search" id="search" style="height: 35px;" type="text" class="form-control w-50"
								placeholder="Buscar">
							<button class="btn btn-primary">Buscar</button>
						</form>
				</div>
				<div class="col-2 offset-4 my-2 text-end">
					<!-- Btn para crear una nueva carpeta -->
					@if ($owner || $sharedPermissions->upload_permission == true)
						@php
							$params = [
								"entity_source" => 'cloud_dirs',
								"entity" => 'cloud_dirs',
								"id" => null,
								"father_id" => $cloud_dir->id,
								"saveAditionals" => "reloadDatatable",
								"isDatatable" => false,
							];
						@endphp

						<button class="btn btn-primary mt-2"  onclick="showCreateFolderModal('{{base64_encode(json_encode($params))}}')">
							Agregar carpeta
						</button>
					@endif
				</div>
				@foreach ($cloud_dirs as $key => $dir)
					<div class="col col-xl-3">
						<div class="card" style="width: 18rem;">
							<div class="row">
								<div class="col-9 text-center">
									<a href="{{route('cloud_dirs.show', $dir->id)}}" style="">
										<i class="fa-solid fa-folder fa-10x card-img-top p-2"></i>
									</a>
								</div>
								<div class="col-3">
									@if ($owner)
										<!-- Compatir -->
										<a class="btn mt-1"  target="_blank"  href="{{route('cloud_share_permissions.indexParam', ['parent' => $dir->id])}}">
											<i class="fa-solid fa-share fa-2x link-success"></i>
										</a>

										<!-- Editar -->
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
											<i class="fa-solid fa-2x fa-pencil link-primary" ></i>
										</button>
									@endif
									@if ($owner || $sharedPermissions->delete_permission == true)
										<!-- Eliminar -->
										<button class="btn mt-1 " onclick="showDeleteModal('cloud_dirs', {{ $dir->id }}, null, false)">
										<i class="fa-solid fa-trash fa-2x link-danger" ></i>
										</button>
									@endif
								</div>
							</div>


							<div class="card-body">
								<h5 class="card-title" style="font-size: 18px;">{{$dir->name}}</h5>
								<p class="card-text">Última modificación: {{$dir->updated_at}}</p>
								@if (auth()->user()->id != $dir->created_by)
									<p class="card-text">Creado por: {{$dir->CreatedBy->name}}</p>
								@endif
							</div>
						</div>
					</div>
				@endforeach
				<!-- Archivos  -->
				@foreach ($cloud_files as $key => $file)
					<div class="col col-xl-3">
						<div class="card" style="width: 18rem;">
							<div class="row">
								<div class="col-9 text-center">
									<a href="{{route('cloud_files.downloadCloudFile', $file->id)}}" style="">
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

										<!-- Editar -->
										 @if ($owner)
											<button class="btn mt-1"  onclick="showQuickAddModal('{{base64_encode(json_encode($params))}}')">
												<i class="fa-solid fa-2x fa-pencil link-primary"></i>
											</button> 
										 @endif
										
										@if ($owner || $sharedPermissions->delete_permission == true)
											<!-- Eliminar -->
											<button class="btn mt-1 " onclick="showDeleteModal('cloud_files', {{ $file->id }}, null, false)">
											<i class="fa-solid fa-trash fa-2x link-danger" ></i>
											</button>
										@endif
								</div>
							</div>


							<div class="card-body">
								<h5 class="card-title" style="font-size: 18px;">{{$file->description}}</h5>
								<p class="card-text">Última modificación: {{$file->updated_at}}</p>
								@if (auth()->user()->id != $file->created_by)
									<p class="card-text">Creado por: {{$file->CreatedBy->name}}</p>
								@endif
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
		@include('crud-maker.components.modal-delete')

	@endsection
@endif


<script type="text/javascript">
	Dropzone.options.dropzone =
	{
		//Mensaje que se muestra en el recuadro
		dictDefaultMessage: "Suelta los archivos aquí",
		//Mensaje para eliminar archivos
		dictRemoveFile: "Eliminar archivo",
		//Mensaje de cancelar la subida de archivo
		dictCancelUpload: "Cancelar carga",
		//Mensaje de aviso de cancelar subida de archivo
		dictCancelUploadConfirmation: "¿Estás seguro que deseas cancelar la subida del archivo?",
		//Si se pueden subir múltiples archivos
		uploadMultiple: true,
		//Cuantos archivos se suben de forma paralela
		parallelUploads: 10,
		//Máximo del tamaño de los archivos en MB
		maxFilesize: 64,
		//Hacemos que los archivos no se suban automaticamente
		autoProcessQueue: false,

		init: function()
            {
                thisDropzone = this;
            },

		addRemoveLinks: true,
		timeout: 60000,
		success: function(file, response) {
			console.log(response);
			//Al completar la subida de archivos se hace lo siguiente
			thisDropzone.on("queuecomplete", function (file) {
                    alert("Los archivos se han subido correctamente");
					location.reload();
                });

		},
		error: function(file, response){
			return false;
		}
	};

	function processQueue(){
		thisDropzone.processQueue();
	}
	
	</script>