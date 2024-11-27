@if(session()->has('message') || session()->has('error') || $errors->any())
	<div class="alert {{ session()->has('message') ? 'alert-info' : 'alert-danger' }} dismissible">
		<div class="row">
			<div class="col-1 p-0" style="width: 32px!important;">
				<button type="button" class="btn btn-default" data-bs-dismiss="alert" aria-label="Close">
					<i class="fa-solid fa-xmark"></i>
				</button>
			</div>
			<div class="col-11 d-flex align-items-center">
				@if(session()->has('message'))
					{!! session()->get('message') !!}
				@endif
				@if(session()->has('error'))
					{!! session()->get('error') !!}
				@endif
				@if ($errors->any())
				<ul>
					@foreach ($errors->all() as $error)
						<li>{!! $error !!}</li>
					@endforeach
				</ul>
				@endif
			</div>
		</div>
	</div>
@endif