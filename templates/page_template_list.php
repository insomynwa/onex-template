<div class="wrap">
	<p>
		<h2>Page Template</h2>
		<a href="<?php echo admin_url('admin.php?page=onex-page-template-tambah'); ?>">Tambah</a>
		<table>
			<tr><th>No</th>
				<th>Template</th>
				<th></th>
			</tr>
			<?php 
				$nmr = 1;
				if( count($attributes['page_template']) > 0 ): ?>
				<?php foreach($attributes['page_template'] as $template ): ?>
					<tr>
						<td><?php echo $nmr; ?></td>
						<td><?php echo $template->nama_template; ?></td>
						<td>
							<a href='<?php echo admin_url('admin.php?page=onex-page-template-update&id='. $template->id_template); ?>'>Update</a>
						</td>
					</tr>
					<?php $nmr += 1; ?>
				<?php endforeach; ?>
			<?php endif; ?>
		</table>
	</p>
	<p>
		<h2>Jenis Delivery</h2>
		<table>
			<tr><th>No</th>
				<th>Jenis Delivery</th>
				<th>Template</th>
				<th></th>
			</tr>
			<?php 
				$nmr = 1;
				if( count($attributes['target_page']['katdel']) > 0 ): ?>
				<?php foreach($attributes['target_page']['katdel'] as $katdel ): ?>
					<tr>
						<td><?php echo $nmr; ?></td>
						<td><?php echo $katdel->kategori; ?></td>
						<td><?php echo $katdel->nama_template; ?></td>
						<td>
							<a href='<?php echo admin_url('admin.php?page=onex-target-page-template-update&type=kd&id='. $katdel->id_kat_del); ?>'>Update</a>
						</td>
					</tr>
					<?php $nmr += 1; ?>
				<?php endforeach; ?>
			<?php endif; ?>
		</table>
	</p>
</div>