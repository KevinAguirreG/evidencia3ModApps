@foreach($menus as $key => $menu)
	<li>
		<a href="{{ $menu["viewname_id"] == NULL ? 'javascript: void(0);' : route($menu['link']) }}" class="waves-effect">
			{!! $menu["icon"] !!}
			<span key="t-dashboards">
				{{-- @lang($menu["name"].".title_index") --}}
				@if(Lang::has("sidebar.".$menu["name"]))
					@lang("sidebar.".$menu["name"])
				@else
					@lang($menu["name"].".title_index")
				@endif
			</span>
		</a>

		@if(!empty($menu["submenus"]))
		<ul class="sub-menu" aria-expanded="false">
			@include('components.theme.sidebar-menus', ["menus" => $menu["submenus"]])
		</ul>
		@endif
	</li>
@endforeach

