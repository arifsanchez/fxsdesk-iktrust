<?php #https://github.com/arifsanchez/usermanagement_plugin ;?>
<?php echo $this->Search->searchForm('Content', array('legend' => false, 'updateDivId' => 'updateContentIndex')); ?>
<?php echo $this->element('Usermgmt.paginator', array('useAjax' => true, 'updateDivId' => 'updateContentIndex')); ?>

<table class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th><?php echo __('SL');?></th>
			<th><?php echo $this->Paginator->sort('Content.page_name', __('Page Name')); ?></th>
			<th><?php echo $this->Paginator->sort('Content.url_name', __('Url Name')); ?></th>
			<th><?php echo $this->Paginator->sort('Content.page_title', __('Page Title')); ?></th>
			<th><?php echo __('Page Link');?></th>
			<th><?php echo $this->Paginator->sort('Content.created', __('Created')); ?></th>
			<th><?php echo __('Action');?></th>
		</tr>
	</thead>
	<tbody>
<?php   if (!empty($contents)) {
			$page = $this->request->params['paging']['Content']['page'];
			$limit = $this->request->params['paging']['Content']['limit'];
			$i=($page-1) * $limit;
			foreach ($contents as $row) {
				$i++;
				echo "<tr>";
				echo "<td>".$i."</td>";
				echo "<td>".$row['Content']['page_name']."</td>";
				echo "<td>".$row['Content']['url_name']."</td>";
				echo "<td>".$row['Content']['page_title']."</td>";
				echo "<td><a href='".SITE_URL.'contents/'.$row['Content']['url_name']."'>".SITE_URL.'contents/'.$row['Content']['url_name']."</a></td>";
				echo "<td>".date('d-M-Y',strtotime($row['Content']['created']))."</td>";
				echo "<td class='action'>";
					echo $this->Html->link($this->Html->image(SITE_URL.'usermgmt/img/view.png', array('alt' => __('View Page'), 'title' => __('View Page'))), array('controller'=>'Contents', 'action'=>'viewPage', $row['Content']['id'], 'page'=>$page), array('escape'=>false));

					echo $this->Html->link($this->Html->image(SITE_URL.'usermgmt/img/edit.png', array('alt' => __('Edit Page'), 'title' => __('Edit Page'))), array('controller'=>'Contents', 'action'=>'editPage', $row['Content']['id'], 'page'=>$page), array('escape'=>false));

					echo $this->Form->postLink($this->Html->image(SITE_URL.'usermgmt/img/delete.png', array('alt' => __('Delete Page'), 'title' => __('Delete Page'))), array('controller'=>'Contents', 'action' => 'deletePage', $row['Content']['id']), array('escape' => false, 'confirm' => __('Are you sure you want to delete this page?')));
				echo "</td>";
				echo "</tr>";
			}
		} else {
			echo "<tr><td colspan=7><br/><br/>".__('No Data')."</td></tr>";
		} ?>
	</tbody>
</table>
<?php if(!empty($contents)) { echo $this->element('Usermgmt.pagination', array("totolText" => __('Number of Pages'))); } ?>