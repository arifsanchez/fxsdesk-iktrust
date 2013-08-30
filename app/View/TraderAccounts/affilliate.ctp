<?php #Page for listing out traders with affilliate account ?>

<?php echo $this->element('popup.feature.comingsoon');?>

<div class="row-fluid">
	<div class="span12">
		<div class="box box-color grey box-bordered">
			<div class="box-title">
				<h3>
					Affilliate Accounts
				</h3>
				<div class="actions">
					<a href="#popup-coming-soon" class="btn" data-toggle="modal" title="Register Agent Account"><i class="icon-fire"></i> New Agent Account</a>
				</div>
			</div>
			<div class="box-content nopadding">
				<table class="table table-hover table-nomargin table-bordered usertable">
					<?php if(!empty($MT_ACC)){ ;?>
					<thead>
						<tr>
							<th>Agent Number</th>
							<th>Leverage</th>
							<th>Balance $</th>
							<th>Credit $</th>
							<th>Trade Status</th>
							<th>Account Maturity</th>
							<th>Operations</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($MT_ACC as $acc): ?>
						<tr>
							<td>
								<button class="btn btn-info" data-placement="right" title="" rel="tooltip" data-original-title="<?php echo $acc['Mt4User']['GROUP'];?>">
									<i class="icon-exclamation-sign"></i>
								</button>
								<a class="btn" href="<?php echo SITE_URL;?>TraderAccounts/affilliate_history/acc:<?php echo $acc['Mt4User']['LOGIN'];?>" >
									<?php echo $acc['Mt4User']['LOGIN'];?>
								</a>
							</td>
							<td>1:<?php echo $acc['Mt4User']['LEVERAGE'];?></td>
							<td><?php echo number_format($acc['Mt4User']['BALANCE'], 2, '.', '');?></td>
							<td><?php echo number_format($acc['Mt4User']['CREDIT'], 2, '.', '');?></td>
							<td>
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
							<td><span data-livestamp="<?php echo $acc['Mt4User']['REGDATE'];?>"</span></td>
							<td>
								<a href="<?php echo SITE_URL;?>TraderAccounts/affilliate_history/acc:<?php echo $acc['Mt4User']['LOGIN'];?>" class="btn btn-grey" rel="tooltip" title="Transactions History"><i class="glyphicon-table"></i> Transactions</a>

								<a href="#popup-coming-soon" class="btn btn-darkblue" rel="tooltip" title="Affilliate Promotion Tools" data-toggle="modal"><i class="icon-comments-alt"></i> Promo Tools</a>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
					<?php } else { 
						echo "<tr><td>Sorry, you do not have any affilliate account under this email address.</tr></td>";
					};?>
				</table>
			</div>
		</div>
	</div>
</div>