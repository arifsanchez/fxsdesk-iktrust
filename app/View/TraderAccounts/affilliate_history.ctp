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
		'update' => '#updateTradeHistory',
		'evalScripts' => true,
		'before' => $this->Js->get('#busy-indicator')->effect('fadeIn', array('buffer' => false)),
		'complete' => $this->Js->get('#busy-indicator')->effect('fadeOut', array('buffer' => false))
	));
}
?>

<div class="row-fluid">
	<div class="span12">
		<div class="box box-color grey box-bordered" id="updateTradeHistory">
			<?php if(!empty($downlines)){ ?>
			<div class="row-fluid">
				<div class="span12">
					<table class="table table-hover table-nomargin table-condensed table-bordered">
						<thead>
							<tr>
								<th>Account Name</th>
								<th>Email</th>
								<th>$ (Now)</th>
								<th>$ (Yesterday)</th>
							</tr>
						</thead>
						<tbody>
							<td>
								<?php 	
									echo $nama_trader;
								?>
							</td>
							<td>
								<?php 	
									echo $email_trader;
								?>
							</td>
							<td><div class="text-center">
								<span class="label label-red"><?php echo $this->Number->Currency($bakiAcc, 'IK$ ');?></span>
							</div></td>
							<td><div class="text-center">
								<span class="label label-red"><?php echo $this->Number->Currency($bakiSemalam, 'IK$ ');?></span>
							</div></td>
						</tbody>
					</table>
					<p><b>Agent Downline</b></p>
					<p>
				    <?php foreach($downlines as $downline):?>
				    <?php #debug($downline);?>
				    	<a data-content="<?php echo $downline['Mt4User']['NAME'];?>, <?php echo $downline['Mt4User']['EMAIL'];?>, <?php echo $downline['Mt4User']['PHONE'];?>, <?php echo $downline['Mt4User']['CITY'];?>, <?php echo $this->Number->Currency($downline['Mt4User']['BALANCE'],'$ ');?>
				    	" data-placement="bottom" title="" rel="popover" class="btn btn-lime btn-mini" href="#" data-original-title="Account No# <?php echo $downline['Mt4User']['LOGIN'];?>">
				    		<span class=""><?php echo $downline['Mt4User']['LOGIN'];?></span>
				    	</a>
				    	
				    <?php endforeach; ?>
				    </p>
				</div>
			</div>
			<?php } ?>
			<div class="box-title">
				<div class="actions">
					<a href="<?php echo SITE_URL;?>TraderAccounts/affilliate/acc:<?php echo $MT_ACC['Mt4User']['LOGIN'];?>" class="btn" rel="tooltip" title="My Affilliate Account Overview"><i class="icon-briefcase"></i> Back to affilliate overview</a>
				</div>
			</div>
			<div class="box-content nopadding">

				<table class="table table-hover table-nomargin table-condensed table-bordered">
					<thead>
						<?php if(empty($MT_TRANSACT)){ echo "<tr><blockquote>Your affilliate account is fresh without any transaction. Start promoting your affilliate link and earn great rewards today .</blockquote></tr>";} else {?> 
						<tr>
							<th>Deal #</th>
							<th>Date Time</th>
							<th>Transactions</th>
							<th><div class="text-right">Amount US$</div></th>
						</tr>
						<?php } ?>
					</thead>
					<tbody>
						<?php foreach($MT_TRANSACT as $Transaction): ?>
						<tr>
							<td>
								<?php echo $Transaction['Mt4Trade']['TICKET'];?>

							</td>
							<td>
								<?php echo $this->Time->nice($Transaction['Mt4Trade']['OPEN_TIME']);?>
							</td>
							<td>
								<?php

								$type = $Transaction['Mt4Trade']['CMD'];
								$lot = $Transaction['Mt4Trade']['VOLUME'] / 100;

									//	Order type: 0 - BUY, 1 - SELL, 2 - BUY LIMIT, 3 - SELL LIMIT, 4 - BUY STOP, 5 - SELL STOP, 6 - BALANCE, 7 - CREDIT
									switch ($type){
										case "0":
										echo "<span class=\"label label-green\">BUY</span>&nbsp;<span class=\"label label-magenta\">".$Transaction['Mt4Trade']['SYMBOL']."</span>&nbsp;<span class=\"label label-lightgrey\">".$lot." lot</span>";
										break;
										case "1":
										echo "<span class=\"label label-red\">SELL</span>&nbsp;<span class=\"label label-magenta\">".$Transaction['Mt4Trade']['SYMBOL']."</span>&nbsp;<span class=\"label label-lightgrey\">".$lot." lot</span>";
										break;
										case "2":
										echo "<span class=\"label label-green\">BUY LIMIT</span>&nbsp;<span class=\"label label-magenta\">".$Transaction['Mt4Trade']['SYMBOL']."</span>&nbsp;<span class=\"label label-lightgrey\">".$lot." lot</span>";
										break;
										case "3":
										echo "<span class=\"label label-red\">SELL LIMIT</span>&nbsp;<span class=\"label label-magenta\">".$Transaction['Mt4Trade']['SYMBOL']."</span>&nbsp;<span class=\"label label-lightgrey\">".$lot." lot</span>";
										break;
										case "4":
										echo "<span class=\"label label-green\">BUY STOP</span>&nbsp;<span class=\"label label-magenta\">".$Transaction['Mt4Trade']['SYMBOL']."</span>&nbsp;<span class=\"label label-lightgrey\">".$Transaction['Mt4Trade']['COMMENT']."</span>";
										break;
										case "5":
										echo "<span class=\"label label-red\">SELL STOP</span>&nbsp;<span class=\"label label-magenta\">".$Transaction['Mt4Trade']['SYMBOL']."</span>&nbsp;<span class=\"label label-lightgrey\">".$Transaction['Mt4Trade']['COMMENT']."</span>";
										break;
										case "6":
										echo "<span class=\"label label-blue\">Commissions</span>&nbsp;<span class=\"label label-magenta\">".$Transaction['Mt4Trade']['SYMBOL']."</span>&nbsp;<span class=\"label label-lightgrey\">".$Transaction['Mt4Trade']['COMMENT']."</span>";
										break;
										case "7":
										echo "<span class=\"label label-orange	\">IK Credit</span>";
										break;
										default:
										echo $type;
										break;
									};
								?>
							</td>
							<td>
								<div class="text-right">
									<b>
									<?php 
										$jumlah = number_format($Transaction['Mt4Trade']['PROFIT'], 2, '.', '');
										if(strpos($jumlah,'-') === FALSE){
											echo $jumlah;
										} else {
											echo "<span style='color:red'>".$jumlah."</span>";
										}
									?>
									</b>
								</div>
							</td>
							
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				<?php echo $this->element('trader.dashboard.pagination'); ?>
			</div>
		</div>
	</div>
</div>