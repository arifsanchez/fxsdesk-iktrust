<?php 
	echo $this->element('popup.feature.comingsoon'); //call a href #popup-coming-soon
?>

<?php
if(!isset($updateDivId)) {
	$updateDivId="updateIndex";
}
$ajax=true;
if(isset($useAjax) && !$useAjax) {
	$ajax=false;
}
if($ajax) {
	$this->Paginator->options(array(
		'update' => '#updateNetworklisting',
		'evalScripts' => true,
		'before' => $this->Js->get('#busy-indicator')->effect('fadeIn', array('buffer' => false)),
		'complete' => $this->Js->get('#busy-indicator')->effect('fadeOut', array('buffer' => false))
	));
}
?>

<div class="row-fluid">
	<div class="span12">
		<div class="box box-color box-small blue box-bordered" id="updateNetworklisting">
			<div class="box-title">
				<h3>
					Registered Staff Accounts
				</h3>
			</div>
			<div class="box-content nopadding">
				<table class="table table-hover table-nomargin table-bordered usertable">
					<thead>
						<tr>
							<th><?php echo __('Photo');?></th>
							<th class="sorting"><?php echo $this->Paginator->sort('User.first_name', __('Personal Info')); ?></th>
							<th class="sorting"><?php echo $this->Paginator->sort('User.email', __('Contact')); ?></th>
							<th>Status</th>
							<th>Last Login</th>
						</tr>
					</thead>
					<tbody>
					<?php if(!empty($users)) {
							foreach ($users as $row) {
								#debug($row); die();
								#$i++;
								echo "<tr id='rowId".$row['User']['id']."'>";
								#echo "<td>".$i."</td>";
								#echo "<td>".$row['User']['id']."</td>";
								echo "<td><img src='".$this->Image->resize('img/'.IMG_DIR, $row['UserDetail']['photo'], 60, 60, true)."'></td>";
								echo "<td>".h($row['User']['first_name'])." ".h($row['User']['last_name']);
									if($row['User']['fb_id'] == null){
										echo "<br/><a class='btn btn-mini btn-blue' href='".SITE_URL."Staffs/client_profile/name:".h($row['User']['username'])."'>".h($row['User']['username'])."</a><br/>";
									} else {
										echo "<br/><a class='btn btn-mini btn-blue ' href='".SITE_URL."Staffs/client_profile/name:".h($row['User']['username'])."'>".h($row['User']['username'])."</a>&nbsp;<a href='https://facebook.com/".h($row['User']['username'])."'><i class='icon-facebook-sign'></i></a><br/>";
									}
									echo "<i class='icon-flag'></i> ".date('d/m/Y',strtotime($row['User']['created']));
								echo "</td>";
								
								echo "<td>".h($row['User']['email']);
									echo "<br/>".h($row['UserDetail']['cellphone'])."</td>";
								echo "</td>";
								
								echo "<td id='activeInactive".$row['User']['id']."'>";
							
								if ($row['User']['active']==1) {
									echo "<span class=\"label label-satgreen\">Active</span>";
								} else {
									echo "<span class=\"label label-lightred\">Disable</span>";
								}

								if ($row['User']['email_verified']==1) {
									echo "<span class='label label-satgreen'><i class='icon-envelope-alt'></i></span>";
								} else {
									echo "<span class='label label-red'><i class='icon-envelope-alt'></i></span>";
								}
								echo "</td>";

								echo "<td>";
									echo $this->Time->nice($row['User']['last_login']);
								echo "</td>";

								echo "</tr>";
							}
						} else {
							echo "<tr><td colspan=10><br/><br/>".__('No Data')."</td></tr>";
						} ?>
					</tbody>
					
				</table>
				<?php echo $this->element('trader.dashboard.pagination'); ?>
			</div>
		</div>
	</div>
</div>