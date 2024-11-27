<!-- @include("crud-maker.components.form-row", ["params" => [
	[
		"name" => "cloud_dir_id",
		"id" => "cloud_dir_id",
		"class" => "form-select",
		"entity" => "cloud_share_permissions",
		"type" => "select",
		"defaultValue" => old("cloud_dir_id") ?? ($cloud_share_permission->cloud_dir_id ?? ""),
		"required" => true,
		"elements" => $cloudDirs ?? [],
	]
]]) -->
@include("crud-maker.components.form-row", ["params" => [
	[
		"name" => "user_id",
		"id" => "user_id",
		"class" => "form-select",
		"entity" => "cloud_share_permissions",
		"type" => "select",
		"defaultValue" => old("user_id") ?? ($cloud_share_permission->user_id ?? ""),
		"required" => true,
		"elements" => $users ?? [],
	]
]])
@include("crud-maker.components.form-row", ["params" => [
	[
		"name" => "delete_permission",
		"id" => "delete_permission",
		"class" => "form-check",
		"entity" => "cloud_share_permissions",
		"type" => "checkbox",
		"defaultValue" => old("delete_permission") ?? ($cloud_share_permission->delete_permission ?? ""),
        "checked" => ($isEdit ?? false) ? ($cloud_share_permission->delete_permission == 1 ? true : false) : true,
		"required" => true,
	]
]])
@include("crud-maker.components.form-row", ["params" => [
	[
		"name" => "upload_permission",
		"id" => "upload_permission",
		"class" => "form-check",
		"entity" => "cloud_share_permissions",
		"type" => "checkbox",
		"defaultValue" => old("upload_permission") ?? ($cloud_share_permission->upload_permission ?? ""),
        "checked" => ($isEdit ?? false) ? ($cloud_share_permission->upload_permission == 1 ? true : false) : true,
		"required" => true,
	]
]])

<input id="cloud_dir_id" name="cloud_dir_id" type="hidden" value="{{$params['parent']}}" />

