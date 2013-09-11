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
		<div class="box box-color grey box-bordered" id="updateNetworklisting">
			<div class="box-title">
				<h3>
					Registered Partner Accounts
				</h3>
			</div>
			<div class="box-content nopadding">
				<table class="table table-hover table-nomargin table-bordered usertable">
					<?php if(!empty($MT_ACC)){ ;?>
					<thead>
						<tr>
							<th>Account Number</th>
							<th>Email</th>
							<th>Phone</th>
							<th><div class="text-right"><?php echo $this->Paginator->sort('Mt4User.BALANCE', __('Balance')); ?></div></th>
							<th>Downline</th>
							<th>Dashboard</th>
							<th>Operations</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($MT_ACC as $acc): ?>
						<tr>
							<td>
								<button class="btn btn-info" data-placement="right" title="" rel="tooltip" data-original-title="Agent since <?php echo $acc['Mt4User']['REGDATE'];?>">
									<i class="icon-exclamation-sign"></i>
								</button>
								<a class="btn" href="<?php echo SITE_URL;?>staffs/partner_history/process:<?php echo $acc['Mt4User']['LOGIN']?>" >
									<?php echo $acc['Mt4User']['LOGIN'];?>
								</a>
							</td>
							<td><b><?php echo ucwords(strtolower($acc['Mt4User']['NAME']));?></b><br/><?php echo $acc['Mt4User']['EMAIL'];?></td>
							<td><?php echo $acc['Mt4User']['PHONE'];?></td>
							<td><div class="text-right"><span class="label label-lime"><?php echo $this->Number->Currency($acc['Mt4User']['BALANCE'], '$');?></span></div></td>
							<td><div class="text-center"><span class="badge badge-warning"><?php $TotalDownline = $this->requestAction('partners/kiraAccBawahAff/agent:'.$acc['Mt4User']['LOGIN'].'') ; echo $TotalDownline;?></span></div></td>
							<td>
								<?php 	
								$accstatus = $this->requestAction('partners/checkDashboardStatus/pass:'.$acc['Mt4User']['EMAIL']);
								#debug($accstatus);
									if(!empty($accstatus['User']['partnertag'])){
										$email = base64_encode($acc['Mt4User']['EMAIL']);
										echo "<a href='".SITE_URL."staffs/partner_history/process:".$acc['Mt4User']['LOGIN']."' class='btn btn-mini btn-green'>Active</a>";
									} else {
										echo "<a href='".SITE_URL."staffs/partner_history/process:".$acc['Mt4User']['LOGIN']."' class='btn btn-mini btn-red'>Inactive</a>";
									}
								?>
							</td>
							<td>
								<a href="<?php echo SITE_URL;?>staffs/partner_history/process:<?php echo $acc['Mt4User']['LOGIN']?>" class="btn btn-mini btn-grey" rel="tooltip" title="Transactions History" data-toggle="modal"><i class="glyphicon-table"></i> </a>

								<a href="#popup-coming-soon" class="btn btn-mini btn-darkblue" rel="tooltip" title="Trading Account Setting" data-toggle="modal"><i class="icon-cogs"></i> </a>
								<?php
								if(!empty($accstatus['User']['id'])){
									echo $this->Html->link("Edit",
										array('plugin' => 'usermgmt','controller'=>'Users', 'action'=>'editUser', $accstatus['User']['id']),
										array('class'=> 'btn btn-mini btn-orange',)
									);
								} else {
									echo "";
								}
								?>
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