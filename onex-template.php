<?php
/**
*
* Plugin Name: One Express Template Setting
* Version: 1.0
* Author: Hamba Allah
*
*/
?>
<?php

include_once('onex-page-template.php');
class Onex_Template_Setting_Plugin{

	private $onex_page_template_obj;

	function __construct(){
		$this->onex_page_template_obj = new Onex_Page_Template();
		add_action('admin_menu', array( $this, 'createMenu') );
	}

	public static function plugin_activated(){

	}

	function createMenu(){
		add_menu_page(
			'One Express Page Template',
			'One Express Page Template',
			'manage_options',
			'onex-page-template',
			array( $this, 'RenderPageTemplate')
		);

		add_submenu_page(
			null,
			'Page Template Tambah',
			'Page Template Tambah',
			'manage_options',
			'onex-page-template-tambah',
			array( $this, 'RenderPageTemplateTambah')
		);

		add_submenu_page(
			null,
			'Page Template Update',
			'Page Template Update',
			'manage_options',
			'onex-page-template-update',
			array( $this, 'RenderPageTemplateUpdate')
		);

		add_submenu_page(
			null,
			'Target Page Template Update',
			'Target Page Template Update',
			'manage_options',
			'onex-target-page-template-update',
			array( $this, 'RenderTargetPageTemplateUpdate')
		);
	}

	function RenderPageTemplate(){
		$attributes['page_template'] = $this->onex_page_template_obj->GetPageTemplate();
		$attributes['target_page'] = $this->onex_page_template_obj->GetTargetPageTemplate();
		//var_dump($attributes);
		return $this->getHtmlTemplate( 'templates/', 'page_template_list', $attributes);
	}

	function RenderPageTemplateTambah(){
		return $this->getHtmlTemplate(  'templates/', 'page_template_tambah', $attributes);
	}

	function RenderPageTemplateUpdate(){
		$attributes = $this->onex_page_template_obj->GetPageTemplateById($_GET['id']);

		return $this->getHtmlTemplate( 'templates/', 'page_template_update', $attributes);
	}

	function RenderTargetPageTemplateUpdate(){
		$attributes = $this->onex_page_template_obj->GetTargetTableData($_GET['type'], $_GET['id']);
		//var_dump($attributes);

		return $this->getHtmlTemplate( 'templates/', 'target_page_template_update', $attributes);
	}

	private function getHtmlTemplate( $location, $template_name, $attributes = null ){
		if(! $attributes) $attributes = array();

		ob_start();
		require( $location . $template_name . '.php');
		$html = ob_get_contents();
		ob_end_clean();
		echo $html;
	}
}

function onex_get_page_template(){
	$onex_page_template_obj = new Onex_Page_template();
	$content = $onex_page_template_obj->GetPageTemplate();
	return $content;
}

$onex_template_setting_plugin_obj = new Onex_Template_Setting_Plugin();

register_activation_hook( __FILE__, array( 'Onex_Template_Setting_Plugin', 'plugin_activated') );

?>