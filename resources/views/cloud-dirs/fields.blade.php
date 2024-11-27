<!-- @include("crud-maker.components.form-row", ["params" => [
	[
		"name" => "cloud_dir_id",
		"id" => "cloud_dir_id",
		"class" => "form-select",
		"entity" => "cloud_dirs",
		"type" => "select",
		"defaultValue" => old("cloud_dir_id") ?? ($cloud_dir->cloud_dir_id ?? ""),
		"elements" => $cloudDirs ?? [],
	]
]]) -->
<!-- @include("crud-maker.components.form-row", ["params" => [
	[
		"name" => "user_id",
		"id" => "user_id",
		"class" => "form-select",
		"entity" => "cloud_dirs",
		"type" => "select",
		"defaultValue" => old("user_id") ?? ($cloud_dir->user_id ?? ""),
		"required" => true,
		"elements" => $users ?? [],
	]
]]) -->
@include("crud-maker.components.form-row", ["params" => [
	[
		"name" => "name",
		"id" => "name",
		"class" => "form-control",
		"entity" => "cloud_dirs",
		"type" => "text",
		"defaultValue" => old("name") ?? ($cloud_dir->name ?? ""),
		"required" => true,
	]
]])
<!-- @include("crud-maker.components.form-row", ["params" => [
	[
		"name" => "url",
		"id" => "url",
		"class" => "form-control",
		"entity" => "cloud_dirs",
		"type" => "text",
		"defaultValue" => old("url") ?? ($cloud_dir->url ?? ""),
		"required" => true,
	]
]])
@include("crud-maker.components.form-row", ["params" => [
	[
		"name" => "notes",
		"id" => "notes",
		"class" => "form-control",
		"entity" => "cloud_dirs",
		"type" => "textarea",
		"defaultValue" => old("notes") ?? ($cloud_dir->notes ?? ""),
	]
]]) -->
<input id="user_id" name="user_id" type="hidden" value="{{$user->id}}" />
<input id="cloud_dir_id" name="cloud_dir_id" type="hidden" value="{{$fatherDir->id ?? null}}" />
