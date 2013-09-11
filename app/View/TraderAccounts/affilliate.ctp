<?php #Page for listing out traders with affilliate account ?>

<?php echo $this->element('popup.feature.comingsoon', array('msg' => '1'));?>

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
							<th>Balance $</th>
							<th>Agent Since</th>
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
							<td><?php echo $this->Number->Currency($acc['Mt4User']['BALANCE'], 'IK$ ');?></td>
							<td><span data-livestamp="<?php echo $acc['Mt4User']['REGDATE'];?>"</span></td>
							<td>
								<a href="<?php echo SITE_URL;?>TraderAccounts/affilliate_history/acc:<?php echo $acc['Mt4User']['LOGIN'];?>" class="btn btn-grey" rel="tooltip" title="Transactions History"><i class="glyphicon-table"></i> Transactions</a>

								<a href="#popup-coming-soon" class="btn btn-lime" rel="tooltip" title="Check All Downline" data-toggle="modal"><i class="icon-comments-alt"></i> Reffered Client</a>

								<a href="#popup-coming-soon" class="btn btn-darkblue" rel="tooltip" title="Affilliate Promotion Tools" data-toggle="modal"><i class="icon-comments-alt"></i> Promo Tools</a>
								
								
								<a href="#popup-coming-soon" class="btn btn-red" rel="tooltip" title="Withdraw Affilliate Commissions" data-toggle="modal"><i class="icon-comments-alt"></i> Cash Out</a>
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