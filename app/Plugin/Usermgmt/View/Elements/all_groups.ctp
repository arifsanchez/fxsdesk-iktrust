<?php #https://github.com/arifsanchez/usermanagement_plugin ;?>
<?php echo $this->Search->searchForm('UserGroup', array('legend' => false, 'updateDivId' => 'updateGroupIndex')); ?>
<?php echo $this->element('Usermgmt.paginator', array('useAjax' => true, 'updateDivId' => 'updateGroupIndex')); ?>

<table class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th><?php echo $this->Paginator->sort('UserGroup.id', __('Group Id')); ?></th>
			<th><?php echo $this->Paginator->sort('UserGroup.name', __('Name')); ?></th>
			<th><?php echo $this->Paginator->sort('UserGroup.alias_name', __('Alias Name')); ?></th>
			<th><?php echo __('Parent Group');?></th>
			<th><?php echo __('Description');?></th>
			<th><?php echo __('Allow Registration');?></th>
			<th><?php echo __('Created');?></th>
			<th><?php echo __('Action');?></th>
		</tr>
	</thead>
	<tbody>
<?php   if(!empty($userGroups)) {
			$page = $this->request->params['paging']['UserGroup']['page'];
			$limit = $this->request->params['paging']['UserGroup']['limit'];
			$i=($page-1) * $limit;
			foreach ($userGroups as $row) {
				echo "<tr>";
				echo "<td>".$row['UserGroup']['id']."</td>";
				echo "<td>".$row['UserGroup']['name']."</td>";
				echo "<td>".$row['UserGroup']['alias_name']."</td>";
				echo "<td>";
				if($row['UserGroup']['parent_id'] >0) {
					echo $allGroups[$row['UserGroup']['parent_id']];
				}
				echo "</td>";
				echo "<td>".nl2br($row['UserGroup']['description'])."</td>";
				echo "<td>";
				if ($row['UserGroup']['allowRegistration']) {
					echo __('Yes');
				} else {
					echo __('No');
				}
				echo"</td>";
				echo "<td>".date('d-M-Y',strtotime($row['UserGroup']['created']))."</td>";
				echo "<td class='action'>";
					echo $this->Html->link($this->Html->image(SITE_URL.'usermgmt/img/edit.png', array('alt' => __('Edit'), 'title' => __('Edit Group'))), array('controller'=>'UserGroups', 'action'=>'editGroup', $row['UserGroup']['id'], 'page'=>$page), array('escape'=>false));

					if ($row['UserGroup']['id']!=1) {
						echo $this->Form->postLink($this->Html->image(SITE_URL.'usermgmt/img/delete.png', array('alt' => __('Delete'), 'title' => __('Delete Group'))), array('controller'=>'UserGroups', 'action' => 'deleteGroup', $row['UserGroup']['id']), array('escape' => false, 'confirm' => __('Are you sure you want to delete this group? Delete it your own risk')));
					}
				echo "</td>";
				echo "</tr>";
			}
		} else {
			echo "<tr><td colspan=6><br/><br/>".__('No Data')."</td></tr>";
		} ?>
	</tbody>
</table>
<?php if(!empty($userGroups)) { echo $this->element('Usermgmt.pagination', array("totolText" => __('Number of Groups'))); } ?>