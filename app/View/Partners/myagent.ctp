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
					My Agents / Affilliates
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
							<th><div class="text-right">Commission $</div></th>
							<th><div class="text-center">Downline</div></th>
							<th>Dashboard</th>
							<th>Operations</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($MT_ACC as $acc): ?>
						<tr>
							<td>
								<button class="btn btn-mini btn-info" data-placement="right" title="" rel="tooltip" data-original-title="Agent Since <?php echo $acc['Mt4User']['REGDATE'];?>">
									<i class="icon-exclamation-sign"></i>
								</button>
								<a class="btn btn-mini " data-placement="right" title="" rel="tooltip" data-original-title=" Agents #<?php echo $acc['Mt4User']['LOGIN'];?>" href="<?php echo SITE_URL;?>partners/myagent_history/process:<?php echo $acc['Mt4User']['LOGIN']?>" >
									<?php echo $acc['Mt4User']['NAME'];?>
								</a>
							</td>
							<td><?php echo $acc['Mt4User']['EMAIL'];?></td>
							<td><?php echo $acc['Mt4User']['PHONE'];?></td>
							<td><div class="text-right"><span class="label label-lime"><?php echo number_format($acc['Mt4User']['BALANCE'], 2, '.', '');?></span></div></td>
							<td><div class="text-center"><span class="badge badge-warning"><?php $TotalDownline = $this->requestAction('partners/kiraAccBawahAff/agent:'.$acc['Mt4User']['LOGIN'].'') ; echo $TotalDownline;?></span></div></td>
							<td>
								<?php 	
								$accstatus = $this->requestAction('partners/checkDashboardStatus/pass:'.$acc['Mt4User']['EMAIL']);
								#debug($accstatus);
									if(!empty($accstatus)){
										$email = base64_encode($acc['Mt4User']['EMAIL']);
										echo "<a href='".SITE_URL."partners/myclient_profile/kunci:".$email."/siapa:".$var['User']['username']."' class='btn btn-mini btn-green'>View Detail</a>";
									} else {
										echo "<span class=\"label label-lightred\">Inactive</span>";
									}
								?>
							</td>
							<td>
								<a href="<?php echo SITE_URL;?>partners/myagent_history/process:<?php echo $acc['Mt4User']['LOGIN']?>" class="btn btn-mini btn-grey" rel="tooltip" title="Transactions History" data-toggle="modal"><i class="glyphicon-table"></i> </a>

								<a href="#popup-coming-soon" class="btn btn-mini btn-darkblue" rel="tooltip" title="Trading Account Setting" data-toggle="modal"><i class="icon-cogs"></i> </a>
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