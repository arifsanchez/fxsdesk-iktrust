<?php #https://github.com/arifsanchez/usermanagement_plugin ;?>
<?php echo $this->Search->searchForm('UserEmail', array('legend' => false, 'updateDivId' => 'updateUserEmailIndex')); ?>
<?php echo $this->element('Usermgmt.paginator', array('useAjax' => true, 'updateDivId' => 'updateUserEmailIndex')); ?>

<table class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th><?php echo __('SL');?></th>
			<th><?php echo $this->Paginator->sort('UserEmail.type', __('Type')); ?></th>
			<th><?php echo __('Groups(s)');?></th>
			<th><?php echo $this->Paginator->sort('UserEmail.from_name', __('From Name')); ?></th>
			<th><?php echo $this->Paginator->sort('UserEmail.from_email', __('From Email')); ?></th>
			<th><?php echo $this->Paginator->sort('UserEmail.subject', __('Subject')); ?></th>
			<th><?php echo $this->Paginator->sort('User.first_name', __('Sent By')); ?></th>
			<th><?php echo $this->Paginator->sort('UserEmail.is_email_sent', __('Sent?')); ?></th>
			<th><?php echo $this->Paginator->sort('UserEmail.created', __('Date Sent')); ?></th>
			<th style="width:150px;"><?php echo __('Action');?></th>
		</tr>
	</thead>
	<tbody>
<?php   if (!empty($userEmails)) {
			$page = $this->request->params['paging']['UserEmail']['page'];
			$limit = $this->request->params['paging']['UserEmail']['limit'];
			$i=($page-1) * $limit;
			foreach ($userEmails as $row) {
				$i++;
				$trclass='';
				if ($row['UserEmail']['is_email_sent']==0) {
					$trclass='error';
				}
				echo "<tr class='".$trclass."'>";
				echo "<td>".$i."</td>";
				echo "<td>";
				if($row['UserEmail']['type']=='USERS') {
					echo "Selected Users";
				} else if($row['UserEmail']['type']=='GROUPS') {
					echo "Group Users";
				} else {
					echo "Manual Emails";
				}
				echo "</td>";
				echo "<td>";
				if(!empty($row['UserEmail']['user_group_id'])) {
					echo $row['UserEmail']['group_name'];
				} else {
					echo "N/A";
				}
				echo "</td>";
				echo "<td>".$row['UserEmail']['from_name']."</td>";
				echo "<td>".$row['UserEmail']['from_email']."</td>";
				echo "<td>".$row['UserEmail']['subject']."</td>";
				echo "<td>".$row['User']['first_name'].' '.$row['User']['last_name']."</td>";
				echo "<td>";
				if ($row['UserEmail']['is_email_sent']==1) {
					echo __('Yes');
				} else {
					echo __('No');
				}
				echo"</td>";
				echo "<td>".date('d-M-Y', strtotime($row['UserEmail']['created']))."</td>";
				echo "<td class='action'>";
					echo $this->Html->link($this->Html->image(SITE_URL.'usermgmt/img/view.png', array('alt' => __('View'), 'title' => __('View Full Email & Recipients'))), array('action'=>'view', $row['UserEmail']['id'], 'page'=>$page), array('escape'=>false));
				echo "</td>";
				echo "</tr>";
			}
		} else {
			echo "<tr><td colspan=10><br/><br/>".__('No Data')."</td></tr>";
		} ?>
	</tbody>
</table>
<?php if(!empty($userEmails)) { echo $this->element('Usermgmt.pagination', array("totolText" => __('Number of Records'))); } ?>