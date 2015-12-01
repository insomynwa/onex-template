<?php
	//var_dump($attributes);
	$template_id = $_GET['id'];
	if( isset($_POST['template-update-submit']) ){
		$template_nama = sanitize_text_field($_POST['template-nama']);

		if( $template_nama != "" ){
			$data = array(
					'template_nama' => $template_nama
				);

			$onex_page_template_obj = new Onex_Page_Template();
			$result = $onex_page_template_obj->UpdatePageTemplate($template_id, $data);
		}else{
			$result['status'] = false;
			$result['message'] = 'Masih ada kolom yang belum diisikan.';
		}
	}
?>
<div class="wrap">
	<?php if(isset($result)): ?>
	<div class="updated">
		<p><?php echo $result['message']; ?></p>
	</div>
	<?php endif; ?>
	<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
		<p>Nama <strong>*</strong><br />
			<input type="text" name="template-nama" value="<?php if(isset($result)) { if( !$result['status'] ) echo $template_nama; }else{ echo $attributes['nama_template']; } ?>" />
		</p>
		<p>
			<input type="submit" name="template-update-submit" value="Simpan" />
		</p>
	</form>
	<a href="<?php echo admin_url('admin.php?page=onex-page-template'); ?>">kembali ke Daftar Template</a>
</div>