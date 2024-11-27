
<!-- @include("crud-maker.components.form-row", ["params" => [
	[
		"name" => "cloud_dir_id",
		"id" => "cloud_dir_id",
		"class" => "form-select",
		"entity" => "cloud_files",
		"type" => "select",
		"defaultValue" => old("cloud_dir_id") ?? ($cloud_file->cloud_dir_id ?? ""),
		"required" => true,
		"elements" => $cloudDirs ?? [],
	]
]]) -->
@include("crud-maker.components.form-row", ["params" => [
	[
		"name" => "description",
		"id" => "description",
		"class" => "form-control",
		"entity" => "cloud_files",
		"type" => "text",
		"defaultValue" => old("description") ?? ($cloud_file->description ?? ""),
	]
]])
<!-- @include("crud-maker.components.form-row", ["params" => [
	[
		"name" => "file_path",
		"id" => "file_path",
		"class" => "form-control",
		"entity" => "cloud_files",
		"type" => "text",
		"defaultValue" => old("file_path") ?? ($cloud_file->file_path ?? ""),
		"required" => true,
	]
]]) -->
<!-- @include("crud-maker.components.form-row", ["params" => [
	[
		"name" => "notes",
		"id" => "notes",
		"class" => "form-control",
		"entity" => "cloud_files",
		"type" => "textarea",
		"defaultValue" => old("notes") ?? ($cloud_file->notes ?? ""),
	]
]]) -->
<input id="cloud_file_id" name="cloud_file_id" type="hidden" value="{{$cloud_file->id}}" />

