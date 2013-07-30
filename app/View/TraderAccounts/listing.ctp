<?php echo $this->element('popup.feature.comingsoon');?>

<div class="row-fluid">
	<div class="span12">
		<div class="box box-color lightred box-bordered">
			<div class="box-title">
				<h3>
					Trading Accounts
				</h3>
				<div class="actions">
					<a href="#popup-coming-soon" class="btn btn-mini" data-toggle="modal" title="Register Live Account"><i class="icon-fire"></i> Open Live Account</a>
					<a href="#popup-coming-soon" class="btn btn-mini" data-toggle="modal" title="Register Demo Account"><i class="glyphicon-shield"></i> Open Demo Account</a>
				</div>
			</div>
			<div class="box-content nopadding">
				<table class="table table-hover table-nomargin table-bordered usertable">
					<?php if(!empty($MT_ACC)){ ;?>
					<thead>
						<tr>
							<th>Account Number</th>
							<th>Leverage</th>
							<th>Balance $</th>
							<th>Credit $</th>
							<th class='hidden-350'>Trade Status</th>
							<th class='hidden-1024'>Account Maturity</th>
							<th class='hidden-480'>Operations</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($MT_ACC as $acc): ?>
						<tr>
							<td>
								<button class="btn btn-info" data-placement="right" title="" rel="tooltip" data-original-title="<?php echo $acc['Mt4User']['GROUP'];?>">
									<i class="icon-exclamation-sign"></i>
								</button>
								<a class="btn" href="<?php echo SITE_URL;?>TraderAccounts/overview/acc:<?php echo $acc['Mt4User']['LOGIN'];?>" >
									<?php echo $acc['Mt4User']['LOGIN'];?>
								</a>
							</td>
							<td>1:<?php echo $acc['Mt4User']['LEVERAGE'];?></td>
							<td><?php echo number_format($acc['Mt4User']['BALANCE'], 2, '.', '');?></td>
							<td><?php echo number_format($acc['Mt4User']['CREDIT'], 2, '.', '');?></td>
							<td class='hidden-350'>
								<?php 	
								$accstatus = $acc['Mt4User']['ENABLE'];

									switch ($accstatus){
										case "1":
										echo "<span class=\"label label-satgreen\">Active</span>";
										break;
										default:
										echo "<span class=\"label label-lightred\">Disable</span>";
									};
								?>
							</td>
							<td class='hidden-1024'><span data-livestamp="<?php echo $acc['Mt4User']['REGDATE'];?>"</span></td>
							<td class='hidden-480'>
								<a href="<?php echo SITE_URL;?>TraderAccounts/overview/acc:<?php echo $acc['Mt4User']['LOGIN'];?>" class="btn btn-blue" rel="tooltip" title="Trading Account Overview"><i class="icon-briefcase"></i> Manage</a>


								<a href="<?php echo SITE_URL;?>TraderAccounts/history/acc:<?php echo $acc['Mt4User']['LOGIN'];?>" class="btn btn-grey" rel="tooltip" title="Transactions History"><i class="glyphicon-table"></i> Transactions</a>

								<a href="#popup-coming-soon" class="btn btn-darkblue" rel="tooltip" title="Trading Account Setting" data-toggle="modal"><i class="icon-cogs"></i> Setting</a>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
					<?php } else { 
						echo "<tr><td>Congratulations on your trader dashboard account opening. Please proceed creating a new trading account.</tr></td>";
					};?>
				</table>
			</div>
		</div>
	</div>
</div>