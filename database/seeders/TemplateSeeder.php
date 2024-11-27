<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Template;

use App\Traits\UploadTrait;

class TemplateSeeder extends Seeder
{
	use UploadTrait;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Template::create([
            "name" => "Light Theme", 
            "data" => json_encode([
                "id" => "1",
				"name" => "Light Theme",
                "logo" => "",
                "general_header_background_color" => "#FFFFFF", 
                "general_header_font_color" => "#74788D", 
                "general_header_font" => "Arial, Helvetica, sans-serif",
                "general_menu_position" => "left",
                "general_menu_background_color" => "#005691", 
                "general_menu_font_color" => "#A6B0CF", 
				"general_menu_font_hover_color" => "#ffffff", 
                "general_menu_font" => "Arial, Helvetica, sans-serif",
                "general_menu_icons" => "on",
                "general_body_background_color" => "#F8F8FB",
                "general_body_font_color" => "#495057",
                "general_body_font" => "Arial, Helvetica, sans-serif",
                "general_footer_background_color" => "#F2F2F5",
                "general_footer_font_color" => "#74788D",
                "general_footer_font" => "Arial, Helvetica, sans-serif",
				"general_header_font_id" => "3",
				"general_menu_font_id" => "2",
				"general_body_font_id" => "2",
				"general_footer_font_id" => "4",
				"datatables_header_backround_color"=>  "100,100,100",
				"datatables_header_font_color"=>  "#F8F8FB",
				"datatables_edit_font_color"=>  "##2d5da0",
				"datatables_delete_font_color"=>  "##F56B6A",
				"datatables_add_background_color"=>  "#2d5da0",
				"datatables_add_font_color"=>  "#F8F8FB"
			])
        ]);
		Template::create([
            "name" => "Dark Theme", 
            "data" => json_encode([
                "id" => "2",
				"name" => "Dark Theme",
				"logo" => "",
				"general_header_background_color" => "#ffffff",
				"general_header_font_color" => "#74788d",
				"general_header_font" => "'Times New Roman', Times, serif",
				"general_menu_position" => "left",
				"general_menu_background_color" => "#1a1a1a",
				"general_menu_font_color" => "#a6b0cf",
				"general_menu_font" => "Arial, Helvetica, sans-serif",
				"general_menu_icons" => "on",
				"general_body_background_color" => "#ebebeb",
				"general_body_font_color" => "#303030",
				"general_body_font" => "Arial, Helvetica, sans-serif",
				"general_footer_background_color" => "#d9d9d9",
				"general_footer_font_color" => "#5c0000",
				"general_footer_font" => "'Courier New', Courier, monospace",
				"general_menu_font_hover_color" => "#ffffff",
				"general_header_font_id" => "3",
				"general_menu_font_id" => "2",
				"general_body_font_id" => "2",
				"general_footer_font_id" => "4",
				"datatables_header_backround_color"=>  "100,100,100",
				"datatables_header_font_color"=>  "#ffffff",
				"datatables_edit_font_color"=>  "#2d5da0",
				"datatables_delete_font_color"=>  "#5c0000",
				"datatables_add_background_color"=>  "#579c5b",
				"datatables_add_font_color"=>  "#ffffff"
            ])
        ]);

        $this->addFirstTemplateJson();
    }

    private function addFirstTemplateJson()
    {
        $template = Template::first();
        $this->uploadJson(json_decode($template->data), "uploads/templates/template");
    }
}
