<?php
	$template_nama = $_POST['template-nama'];
	//$success = false;

	if(isset($_POST['template-tambah-save'])){
		if(!is_null($template_nama) && ! empty($template_nama) && $template_nama!="" ){
			$onex_page_template_obj = new Onex_Page_Template();
			$data = array(
				'template_nama' => sanitize_text_field($_POST['template-nama']),
			);
			$result = $onex_page_template_obj->AddPageTemplate($data);
			$message = $result['message'];
		}else{
			$message = "Kolom Nama harus diisi";
		}
	}
?>

<div class="wrap">
	<?php if(isset($message)): ?>
	<div class="updated"><p><?php echo $message; ?></p></div>
	<?php endif; ?>
	<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
		<p>Nama File Template<br />
			<input type="text" name="template-nama" />
		</p>
		<p>
			<!-- <input type="submit" name="distributor-tambah-cancel" value="Batal" /> -->
			<input type="submit" name="template-tambah-save" value="Tambah" />
		</p>
	</form>
	<a href="<?php echo admin_url('admin.php?page=onex-page-template'); ?>">kembali ke Daftar Template</a>
</div>