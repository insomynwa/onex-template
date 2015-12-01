<?php

class Onex_Page_Template{

	private $template_table_name;
	private $katdel_table_name;

	function __construct(){
		$this->template_table_name = "onex_template";
		$this->katdel_table_name = "onex_kategori_delivery";
	}

	public function GetPageTemplate(){
		global $wpdb;

		$attributes = null;

		if($wpdb->get_var("SELECT COUNT(*) FROM $this->template_table_name") > 0){
			
			$attributes = $wpdb->get_results(
									$wpdb->prepare(
										"SELECT t.* FROM $this->template_table_name t",
										null
									)
								);
		}

		return $attributes;

	}

	public function GetPageTemplateById($id){
		global $wpdb;

		$row = 
			$wpdb->get_row(
				$wpdb->prepare(
					"SELECT * FROM $this->template_table_name WHERE id_template = %d",
					$id
				), ARRAY_A
			);
		$attributes = $row;
		return $attributes;
	}

	public function GetTargetPageTemplate(){
		global $wpdb;

		$attributes = null;

		$attributes = 
				array(
					'katdel' => $wpdb
					                ->get_results(
										$wpdb->prepare(
											"SELECT kd.id_kat_del, kd.kategori, t.nama_template FROM $this->katdel_table_name kd
											 LEFT JOIN $this->template_table_name t
											 ON kd.template_id=t.id_template",
											 null
										)
									),
				);

		return $attributes;
	}

	public function GetTargetTableData( $type, $id){
		global $wpdb;

		$target_table_name;
		$target_name_field_name;
		$target_id_field_name;

		switch( $type){
			case 'kd':
				$target_table_name = $this->katdel_table_name;
				$target_id_field_name = "id_kat_del";
				$target_name_field_name = "kategori";
				break;
		}

		if($wpdb->get_var( "SHOW TABLES LIKE '$target_table_name'") == $target_table_name){
			$row = 
				$wpdb->get_row(
					$wpdb->prepare(
						"SELECT $target_id_field_name AS id_target, $target_name_field_name AS nama_target, template_id
						FROM $target_table_name 
						WHERE $target_id_field_name = %d",
						$id
					), ARRAY_A
				);
			$attributes = $row;
			//var_dump($attributes);

		}else{
			$attributes = null;
		}
		return $attributes;
	}

	public function UpdateTargetPageTemplate( $type, $id, $data){
		global $wpdb;

		$target_table_name;
		$target_id_field_name;

		switch( $type){
			case 'kd':
				$target_table_name = $this->katdel_table_name;
				$target_id_field_name = "id_kat_del";
				break;
		}

		if ($wpdb->update(
			$target_table_name,
			array( 'template_id' => $data['page_template']),
			array( $target_id_field_name => $id),
			array( '%d'),
			array( '%d')
			) )
		{
			return "Berhasil diperbaharui.";
		}else{
			return "Gagal memperbaharui.";
		}
	}

	public function UpdatePageTemplate( $id, $data){
		global $wpdb;

		$result = array(
					'status' => false,
					'message' => ''
				);

		if($wpdb->update(
			$this->template_table_name,
			array(
				'nama_template' => $data['template_nama']
			),
			array('id_template' => $id),
			array('%s'),
			array('%d')
		)){
			$result['status'] = true;
			$result['message'] = 'Template berhasil diperbaharui.';
		}else{
			$result['status'] = true;
			$result['message'] = 'Tidak ada pembaharuan template.';
		}

		return $result;
	}

	public function AddPageTemplate($data){
		global $wpdb;

		$result['status'] = false;
		$result['message'] = 'Gagal menambah page template';
		//$table_kat_del_name = "onex_kategori_delivery";
		if($wpdb->insert(
			$this->template_table_name,
			array(
				'nama_template' => $data['template_nama']
			),
			array('%s')
		)){
			$result['status'] = true;
			$result['message'] = 'Berhasil menambah template.';
		}

		return $result;
	}

}

?>