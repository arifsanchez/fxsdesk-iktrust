<?php #https://github.com/arifsanchez/usermanagement_plugin ;?>

<div class="um-panel">
	<div class="um-panel-header">
		<span class="um-panel-title">
			<?php echo __('Page Detail') ?>
		</span>
		<?php $page= (isset($this->request->params['named']['page'])) ? $this->request->params['named']['page'] : 1; ?>
		<span class="um-panel-title-right">
			<?php echo $this->Html->link(__('Back', true), array('action'=>'index', 'page'=>$page));?>
		</span>
		<span class="um-panel-title-right">
			<?php echo $this->Html->link(__('Edit', true), array('action'=>'editPage', $pageId, 'page'=>$page));?>
		</span>
	</div>
	<div class="um-panel-content">
<?php if (!empty($pageDetail)) { ?>
		<table class="table table-striped table-bordered">
			<tbody>
				<tr>
					<td><strong><?php echo __('Page Name');?></strong></td>
					<td><?php echo h($pageDetail['Content']['page_name'])?></td>
				</tr>
				<tr>
					<td><strong><?php echo __('Url Name');?></strong></td>
					<td><?php echo h($pageDetail['Content']['url_name'])?></td>
				</tr>
				<tr>
					<td><strong><?php echo __('Page Link');?></strong></td>
					<td><a href='<?php echo SITE_URL.'contents/'.$pageDetail['Content']['url_name']?>'><?php echo SITE_URL.'contents/'.$pageDetail['Content']['url_name']?></a></td>
				</tr>
				<tr>
					<td><strong><?php echo __('Page Title');?></strong></td>
					<td><?php echo h($pageDetail['Content']['page_title'])?></td>
				</tr>
				<tr>
					<td><strong><?php echo __('Page Content');?></strong></td>
					<td><?php echo $pageDetail['Content']['page_content']?></td>
				</tr>
				<tr>
					<td><strong><?php echo __('Created');?></strong></td>
					<td><?php echo $pageDetail['Content']['created']?></td>
				</tr>
				<tr>
					<td><strong><?php echo __('Modified');?></strong></td>
					<td><?php echo $pageDetail['Content']['modified']?></td>
				</tr>
			</tbody>
		</table>
<?php } ?>
	</div>
</div>