<?php #https://github.com/arifsanchez/usermanagement_plugin ;?>
<?php echo $this->Search->searchForm('UserEmailSignature', array('legend' => false, 'updateDivId' => 'updateUserEmailSignatureIndex')); ?>
<?php echo $this->element('Usermgmt.paginator', array('useAjax' => true, 'updateDivId' => 'updateUserEmailSignatureIndex')); ?>

<table class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th><?php echo __('SL');?></th>
			<th><?php echo $this->Paginator->sort('UserEmailSignature.signature_name', __('Signature Name')); ?></th>
			<th><?php echo __('Signature');?></th>
			<th><?php echo $this->Paginator->sort('UserEmailSignature.created', __('Created')); ?></th>
			<th><?php echo __('Action');?></th>
		</tr>
	</thead>
	<tbody>
<?php   if (!empty($userEmailSignatures)) {
			$page = $this->request->params['paging']['UserEmailSignature']['page'];
			$limit = $this->request->params['paging']['UserEmailSignature']['limit'];
			$i=($page-1) * $limit;
			foreach ($userEmailSignatures as $row) {
				$i++;
				echo "<tr>";
				echo "<td>".$i."</td>";
				echo "<td>".$row['UserEmailSignature']['signature_name']."</td>";
				echo "<td>".$row['UserEmailSignature']['signature']."</td>";
				echo "<td>".date('d-M-Y',strtotime($row['UserEmailSignature']['created']))."</td>";
				echo "<td class='action'>";
					echo $this->Html->link($this->Html->image(SITE_URL.'usermgmt/img/edit.png', array('alt' => __('Edit Signature'), 'title' => __('Edit Signature'))), array('controller'=>'UserEmailSignatures', 'action'=>'edit', $row['UserEmailSignature']['id'], 'page'=>$page), array('escape'=>false));

					echo $this->Form->postLink($this->Html->image(SITE_URL.'usermgmt/img/delete.png', array('alt' => __('Delete Signature'), 'title' => __('Delete Signature'))), array('controller'=>'UserEmailSignatures', 'action' => 'delete', $row['UserEmailSignature']['id']), array('escape' => false, 'confirm' => __('Are you sure you want to delete this signature?')));
				echo "</td>";
				echo "</tr>";
			}
		} else {
			echo "<tr><td colspan=6><br/><br/>".__('No Data')."</td></tr>";
		} ?>
	</tbody>
</table>
<?php if(!empty($userEmailSignatures)) { echo $this->element('Usermgmt.pagination', array("totolText" => __('Number of Signatures'))); } ?>