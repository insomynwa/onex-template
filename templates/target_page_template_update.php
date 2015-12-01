<?php
	
	$target_id = $_GET['id'];
	$type = $_GET['type'];
	$page_template = sanitize_text_field($_POST['page-template']);
	$success = false;

	if(isset($_POST['page-update-submit'])){

		if($page_template == $attributes['template_id'] ){
			$success = true;
			$message = "Tidak ada pembaharuan yang dilakukan.";
		}else{
			$onex_page_template_obj = new Onex_Page_Template();

			$data = array(
				'page_template' => $page_template,
			);
			$message = $onex_page_template_obj->UpdateTargetPageTemplate($type, $target_id, $data);
			$success = true;
		}
	}
?>
<div class="wrap">

<?php if($_POST['page-update-submit'] && $success ) { ?>
	<div class="updated">
		<p><?php echo $message; ?></p>
	</div>
<?php } else { ?>
	<?php if($_POST['page-update-submit'] && !$success ): ?>
	<div class="updated">
		<p><?php echo $message; ?></p>
	</div>
	<?php endif; ?>
	<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
		<p>Nama<br />
			<strong><?php echo $attributes['nama_target']; ?></strong>
		</p>
		<p>Template<br />
			<?php $content = onex_get_page_template(); ?>
			<?php if( !is_null($content) ): ?>
			<select name="page-template">
				<?php for ($i=0; $i < sizeof($content); $i++ ): ?>
				<option value="<?php echo $content[$i]->id_template; ?>" <?php if( $content[$i]->id_template == $attributes['template_id'] ) echo "selected='selected'"; ?> ><?php echo $content[$i]->nama_template; ?></option>
				<?php endfor; ?>
			</select>
			<?php endif; ?>
		</p>
		<p>
			<input type="submit" name="page-update-submit" value="Update" />
		</p>
	</form>
<?php } ?>
	<a href="<?php echo admin_url('admin.php?page=onex-page-template'); ?>">kembali ke Daftar Template </a>
</div>