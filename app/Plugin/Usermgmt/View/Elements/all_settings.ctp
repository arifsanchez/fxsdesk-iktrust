<?php #https://github.com/arifsanchez/usermanagement_plugin ;?>
<?php echo $this->Search->searchForm('UserSetting', array('legend' => false, 'updateDivId' => 'updatePermissionIndex')); ?>
<?php echo $this->element('Usermgmt.paginator', array('useAjax' => true, 'updateDivId' => 'updatePermissionIndex')); ?>

<table class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th><?php echo __('Sr. No.');?></th>
			<th><?php echo __('Setting Name');?></th>
			<th><?php echo __('Setting Value');?></th>
			<th style="width:75px;"><?php echo __('Action');?></th>
		</tr>
	</thead>
	<tbody>
<?php   if(!empty($userSettings))   {
			$page = $this->request->params['paging']['UserSetting']['page'];
			$limit = $this->request->params['paging']['UserSetting']['limit'];
			$i=($page-1) * $limit;
			foreach ($userSettings as   $row) {
				$i++;
				echo "<tr>";
				echo "<td>".$i."</td>";
				echo "<td>".h($row['UserSetting']['name_public'])."</td>";
				echo "<td>";
				if ($row['UserSetting']['type']=='input') {
					echo h($row['UserSetting']['value']);
				} elseif($row['UserSetting']['type']=='checkbox') {
					if(!empty($row['UserSetting']['value'])) {
						echo __('Yes');
					} else {
						echo __('No');
					}
				}
				echo"</td>";
				echo "<td class='action'>";
					echo $this->Html->link($this->Html->image(SITE_URL.'usermgmt/img/edit.png', array('alt' => __('Edit'), 'title' => __('Edit'))), array('controller'=>'UserSettings', 'action'=>'editSetting', $row['UserSetting']['id'], 'page'=>$page), array('escape'=>false));
				echo "</td>";
				echo "</tr>";
			}
		} else {
			echo "<tr><td colspan=4><br/><br/>".__('No Data')."</td></tr>";
		} ?>
	</tbody>
</table>
<?php if(!empty($userSettings)) { echo $this->element('Usermgmt.pagination', array("totolText" => __('Number of Settings'))); } ?>