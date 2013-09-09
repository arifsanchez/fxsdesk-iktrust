<?php echo $this->element('popup.feature.comingsoon');?>

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
		<div class="box box-color blue box-bordered" id="updateNetworklisting">
			<div class="box-title">
				<h3>
					Clientele
				</h3>
				<div class="actions">
					<?php echo $this->element('partner.carianClientEmail');?>
				</div>
			</div>
			<div class="box-content nopadding">
				<table class="table table-hover table-nomargin table-bordered usertable">
					<?php if(!empty($MT_ACC)){ ;?>
					<thead>
						<tr>
							<th>Account Number</th>
							<th>Email</th>
							<th>Phone</th>
							<th>Country</th>
							<th>Dashboard Account</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($MT_ACC as $acc): ?>
						<tr>
							<?php 	
								$accstatus = $this->requestAction('partners/checkDashboardStatus/pass:'.$acc['Mt4User']['EMAIL']);
								#debug($accstatus);
									if(!empty($accstatus)){
										$email = base64_encode($acc['Mt4User']['EMAIL']);
										$name = "<a href='".SITE_URL."partners/myclient_profile/kunci:".$email."/siapa:".$var['User']['username']."' class='btn btn-mini btn-blue'>".strtoupper($acc['Mt4User']['NAME'])."</a>";
										$button = "<a href='".SITE_URL."partners/myclient_profile/kunci:".$email."/siapa:".$var['User']['username']."' class='btn btn-mini btn-green'>View Profile</a>";
									} else {
										$name = "<span class='label label-info'>".strtoupper($acc['Mt4User']['NAME'])."</span>";
								
										$button = "<span class='label label-red'>Not registered</span>";
									}
								?>
							<td>
								<?php echo $name;?>
							</td>
							<td><?php echo strtolower($acc['Mt4User']['EMAIL']);?></td>
							<td><?php echo $acc['Mt4User']['PHONE'];?></td>
							<td><?php echo $acc['Mt4User']['COUNTRY'];?></td>
							<td>
								<?php echo $button;?>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
					<?php } else { 
						echo "<tr><td>Congratulations on your partner account opening. Please proceed acquiring a new client trading account.</tr></td>";
					};?>
				</table>
				<?php echo $this->element('trader.dashboard.pagination'); ?>
			</div>
		</div>
	</div>
</div>