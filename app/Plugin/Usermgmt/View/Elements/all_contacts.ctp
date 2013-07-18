<?php #https://github.com/arifsanchez/usermanagement_plugin ;?>
<?php echo $this->Search->searchForm('UserContact', array('legend' => false, 'updateDivId' => 'updateContactIndex')); ?>
<?php echo $this->element('Usermgmt.paginator', array('useAjax' => true, 'updateDivId' => 'updateContactIndex')); ?>

<table class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th><?php echo __('SL');?></th>
			<th><?php echo $this->Paginator->sort('UserContact.name', __('Name')); ?></th>
			<th><?php echo $this->Paginator->sort('UserContact.email', __('Email')); ?></th>
			<th><?php echo $this->Paginator->sort('UserContact.phone', __('Contact No')); ?></th>
			<th><?php echo __('Requirement');?></th>
			<th><?php echo __('Reply Message');?></th>
			<th><?php echo $this->Paginator->sort('UserContact.created', __('Date')); ?></th>
			<th><?php echo __('Action');?></th>
		</tr>
	</thead>
	<tbody>
<?php   if (!empty($userContacts)) {
			$page = $this->request->params['paging']['UserContact']['page'];
			$limit = $this->request->params['paging']['UserContact']['limit'];
			$i=($page-1) * $limit;
			foreach ($userContacts as $row) {
				$i++;
				echo "<tr>";
				echo "<td>".$i."</td>";
				echo "<td>".h($row['UserContact']['name'])."</td>";
				echo "<td>".h($row['UserContact']['email'])."</td>";
				echo "<td>".h($row['UserContact']['phone'])."</td>";
				echo "<td>".nl2br($row['UserContact']['requirement'])."</td>";
				echo "<td>".$row['UserContact']['reply_message']."</td>";
				echo "<td>".date('d-M-Y',strtotime($row['UserContact']['created']))."</td>";
				echo "<td class='action'>";
					echo $this->Html->link($this->Html->image(SITE_URL.'usermgmt/img/mail-reply.png', array('alt' => __('Send Reply'), 'title' => __('Send Reply'))), array('controller'=>'UserEmails', 'action'=>'sendReply', $row['UserContact']['id'], 'page'=>$page), array('escape'=>false));
				echo "</td>";
				echo "</tr>";
			}
		} else {
			echo "<tr><td colspan=8><br/><br/>".__('No Data')."</td></tr>";
		} ?>
	</tbody>
</table>
<?php if(!empty($userContacts)) { echo $this->element('Usermgmt.pagination', array("totolText" => __('Number of Enquiries'))); } ?>