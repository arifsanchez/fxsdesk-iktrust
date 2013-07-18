<?php #https://github.com/arifsanchez/usermanagement_plugin ;?>
<?php echo $this->Search->searchForm('UserEmailTemplate', array('legend' => false, 'updateDivId' => 'updateUserEmailTemplateIndex')); ?>
<?php echo $this->element('Usermgmt.paginator', array('useAjax' => true, 'updateDivId' => 'updateUserEmailTemplateIndex')); ?>

<table class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th><?php echo __('SL');?></th>
			<th><?php echo $this->Paginator->sort('UserEmailTemplate.template_name', __('Template Name')); ?></th>
			<th><?php echo __('Header');?></th>
			<th><?php echo __('Footer');?></th>
			<th><?php echo $this->Paginator->sort('UserEmailTemplate.created', __('Created')); ?></th>
			<th><?php echo __('Action');?></th>
		</tr>
	</thead>
	<tbody>
<?php   if (!empty($userEmailTemplates)) {
			$page = $this->request->params['paging']['UserEmailTemplate']['page'];
			$limit = $this->request->params['paging']['UserEmailTemplate']['limit'];
			$i=($page-1) * $limit;
			foreach ($userEmailTemplates as $row) {
				$i++;
				echo "<tr>";
				echo "<td>".$i."</td>";
				echo "<td>".$row['UserEmailTemplate']['template_name']."</td>";
				echo "<td>".nl2br($row['UserEmailTemplate']['header'])."</td>";
				echo "<td>".nl2br($row['UserEmailTemplate']['footer'])."</td>";
				echo "<td>".date('d-M-Y',strtotime($row['UserEmailTemplate']['created']))."</td>";
				echo "<td class='action'>";
					echo $this->Html->link($this->Html->image(SITE_URL.'usermgmt/img/edit.png', array('alt' => __('Edit Template'), 'title' => __('Edit Template'))), array('controller'=>'UserEmailTemplates', 'action'=>'edit', $row['UserEmailTemplate']['id'], 'page'=>$page), array('escape'=>false));

					echo $this->Form->postLink($this->Html->image(SITE_URL.'usermgmt/img/delete.png', array('alt' => __('Delete Template'), 'title' => __('Delete Template'))), array('controller'=>'UserEmailTemplates', 'action' => 'delete', $row['UserEmailTemplate']['id']), array('escape' => false, 'confirm' => __('Are you sure you want to delete this template?')));
				echo "</td>";
				echo "</tr>";
			}
		} else {
			echo "<tr><td colspan=6><br/><br/>".__('No Data')."</td></tr>";
		} ?>
	</tbody>
</table>
<?php if(!empty($userEmailTemplates)) { echo $this->element('Usermgmt.pagination', array("totolText" => __('Number of Templates'))); } ?>