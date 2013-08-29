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
		<div class="box box-color satblue box-bordered" id="updateTradeHistory">
			<div class="row-fluid">
				<div class="span2">
					<p><b>Account Balance</b></p>
					<p><span class="label label-red"><?php echo $this->Number->Currency($bakiAcc, 'IK$ ');?></span></p>
				</div>
				<div class="span10">
				<?php if(!empty($downlines)){ ?>
				
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
				
				<?php } ?>
				</div>
			</div>
			<div class="box-title">
				<h3>
					Agent Transactions History
				</h3>
			</div>
			<div class="box-content nopadding">
				<table class="table table-hover table-nomargin table-condensed table-bordered">
					<thead>
						<?php 
							if(empty($agentPost)){ 
								echo "<tr><blockquote>There is 0 Transaction History at the moment.</blockquote></tr>";
							} else {?> 
						<tr>
							<th><?php echo $this->Paginator->sort('Mt4Trade.TICKET', __('Post Info')); ?></th>
							<th>Transactions</th>
							<th>Comment</th>
							<th>Date / Time</th>
							<th><div class="text-right">Amount US$</div></th>
						</tr>
						<?php } ?>
					</thead>
					<tbody>
						<?php foreach($agentPost as $Transaction): ?>
						<tr>
							<td>
								<?php echo $Transaction['Mt4Trade']['TICKET'];?>
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
										echo "<span class=\"label label-green\">BUY STOP</span>&nbsp;<span class=\"label label-magenta\">".$Transaction['Mt4Trade']['SYMBOL']."</span>&nbsp;";
										break;
										case "5":
										echo "<span class=\"label label-red\">SELL STOP</span>&nbsp;<span class=\"label label-magenta\">".$Transaction['Mt4Trade']['SYMBOL']."</span>&nbsp;\"";
										break;
										case "6":
										echo "<span class=\"label label-orange\">Balance</span>&nbsp;<span class=\"label label-magenta\">".$Transaction['Mt4Trade']['SYMBOL']."</span>&nbsp;";
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
								<span class="label label-lightgrey"><?php echo $Transaction['Mt4Trade']['COMMENT'];?></span>
							</td>
							<td>
								<?php
									echo $this->Time->nice($Transaction['Mt4Trade']['OPEN_TIME']);
								;?>
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