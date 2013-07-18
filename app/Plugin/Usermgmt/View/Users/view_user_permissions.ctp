<?php #https://github.com/arifsanchez/usermanagement_plugin ;?>

<div class="um-panel">
	<div class="um-panel-header">
		<span class="um-panel-title">
			<?php echo __('Site Permissions for %s', $name) ?>
		</span>
		<span class="um-panel-title-right">
			<?php $page= (isset($this->request->params['named']['page'])) ? $this->request->params['named']['page'] : 1; ?>
			<?php echo $this->Html->link(__('Back', true), array('action'=>'index', 'page'=>$page));?>
		</span>
	</div>
	<div class="um-panel-content">
		<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th><?php echo __('SL');?></th>
					<th><?php echo __('Controller');?></th>
					<th><?php echo __('Action');?></th>
					<th><?php echo __('Group(s)');?></th>
					<th><?php echo __('Operation');?></th>
				</tr>
			</thead>
			<tbody>
		<?php   if (!empty($permissions)) {
					$i=0;
					foreach ($permissions as $row) {
						$i++;
						echo "<tr>";
						echo "<td>".$i."</td>";
						echo "<td>".$row['controller']."</td>";
						echo "<td>".$row['action']."</td>";
						echo "<td>".$row['group']."</td>";
						echo "<td class='action'>";
							echo "<a href='".$this->Html->url('/permissions/?c='.$row['index'])."'><img src='".SITE_URL."usermgmt/img/edit.png' border='0' alt='".__('Change')."' title='".__('Change')."'></a>";
						echo "</td>";
						echo "</tr>";
					}
				} else {
					echo "<tr><td colspan=5><br/><br/>".__('No Data')."</td></tr>";
				} ?>
			</tbody>
		</table>
	</div>
</div>