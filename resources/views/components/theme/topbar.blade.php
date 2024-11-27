<header id="page-topbar">
	<div class="navbar-header">
		<div class="d-flex">
			<!-- LOGO -->
			<div class="navbar-brand-box">
				<div id="logo">
					<a href="index" class="logo logo-dark">
						<span class="logo-sm">
							<img src="{{ asset('/images/logo.png') }}" alt="" height="22">
						</span>
						<span class="logo-lg">
							<img src="{{ asset('/images/logo.png') }}" alt="" height="17">
						</span>
					</a>
				</div>
			</div>

			<button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
				<i class="fa fa-fw fa-bars"></i>
			</button>
		</form>
	</div>

	<div class="d-flex">
		{{-- User section --}}
		<div class="dropdown d-inline-block">
			<button type="button" class="btn header-item noti-icon waves-effect d-table" id="page-header-user-dropdown"
			data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<span class="d-table-cell align-middle">{{ auth()->user()->getFullName() }}</span>
				<i class="bx bx-cog bx-spin d-table-cell align-middle"></i>
			</button>
			<div class="dropdown-menu dropdown-menu-end">
				<a class="dropdown-item text-danger" href="javascript:void();" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">@lang('translation.Logout')</span></a>
				<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
					@csrf
				</form>
			</div>
		</div>
	</div>
</div>
</header>
