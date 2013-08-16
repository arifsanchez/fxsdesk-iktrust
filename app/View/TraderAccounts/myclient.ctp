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
					Clientbase
				</h3>
				<div class="actions">
					<a href="#popup-coming-soon" class="btn" data-toggle="modal" title="Register Client Live Account"><i class="icon-fire"></i> Create Live Account</a>
					<a href="#popup-coming-soon" class="btn" data-toggle="modal" title="Register  Client Demo Account"><i class="glyphicon-shield"></i> Create Demo Account</a>
				</div>
			</div>
			<div class="box-content nopadding">
				<table class="table table-hover table-nomargin table-bordered usertable">
					<?php if(!empty($MT_ACC)){ ;?>
					<thead>
						<tr>
							<th>Account Number</th>
							<th>Email</th>
							<th>Phone $</th>
							<th>Country</th>
							<th class='hidden-480'>Operations</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($MT_ACC as $acc): ?>
						<tr>
							<td>
								<a class="btn" href="<?php echo SITE_URL;?>TraderAccounts/overview/acc:<?php echo $acc['Mt4User']['LOGIN'];?>" >
									<?php echo $acc['Mt4User']['NAME'];?>
								</a>
							</td>
							<td><?php echo $acc['Mt4User']['EMAIL'];?></td>
							<td><?php echo $acc['Mt4User']['PHONE'];?></td>
							<td><?php echo $acc['Mt4User']['COUNTRY'];?></td>
							<td class='hidden-480'>

								<a href="#popup-coming-soon" class="btn btn-magenta" rel="tooltip" title="Email Client" data-toggle="modal"><i class="icon-envelope-alt"></i> Sent Email</a>
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