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
			<div class="box-title">
				<h3>
					Trading Account History
				</h3>
				<div class="actions">
					<a href="<?php echo SITE_URL;?>TraderAccounts/overview/acc:<?php echo $MT_ACC['Mt4User']['LOGIN'];?>" class="btn btn-mini" rel="tooltip" title="Trading Account Overview"><i class="icon-briefcase"></i> Back to account overview</a>
				</div>
			</div>
			<div class="box-content nopadding">
				<table class="table table-hover table-nomargin">
					<thead>
						<tr>
							<th>Deal #</th>
							<th>Open Time<br/>Close Time</th>
							<th>Transactions</th>
							<th>Open Price<br/>Close Price</th>
							<th>Amount US$</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($MT_TRANSACT as $Transaction): ?>
						<tr>
							<td>
								<?php echo $Transaction['Mt4Trade']['TICKET'];?>

							</td>
							<td>
								<?php echo $Transaction['Mt4Trade']['OPEN_TIME'];?>
								<br/>
								<?php echo $Transaction['Mt4Trade']['CLOSE_TIME'];?>
							</td>
							<td>
								<?php

								$type = $Transaction['Mt4Trade']['CMD'];
								$lot = $Transaction['Mt4Trade']['VOLUME'] / 100;

									switch ($type){
										case "0":
										echo "<span class=\"label label-red\">SELL</span>&nbsp;<span class=\"label label-satgreen\">".$Transaction['Mt4Trade']['SYMBOL']."</span>&nbsp;<span class=\"label label-lightgrey\">".$lot." lot</span>";
										break;
										case "1":
										echo "<span class=\"label label-green\">BUY</span>&nbsp;<span class=\"label label-satgreen\">".$Transaction['Mt4Trade']['SYMBOL']."</span>&nbsp;<span class=\"label label-lightgrey\">".$lot." lot</span>";
										break;
										case "5":
										echo "<span class=\"label label-red\">[-] Balance</span>&nbsp;<span class=\"label label-satgreen\">".$Transaction['Mt4Trade']['SYMBOL']."</span>&nbsp;<span class=\"label label-lightgrey\">".$Transaction['Mt4Trade']['COMMENT']."</span>";
										break;
										case "6":
										echo "<span class=\"label label-blue\">[+] Balance</span>&nbsp;<span class=\"label label-satgreen\">".$Transaction['Mt4Trade']['SYMBOL']."</span>&nbsp;<span class=\"label label-lightgrey\">".$Transaction['Mt4Trade']['COMMENT']."</span>";
										break;
										case "7":
										echo "<span class=\"label label-orange	\">IK Credit</span>";
										break;
									};
								?>
							</td>
							<td>
								<?php if($Transaction['Mt4Trade']['OPEN_PRICE'] == "0"){ ;?>
									&nbsp;
								<?php } else {
									echo $Transaction['Mt4Trade']['OPEN_PRICE'];
									echo "<br/>";
									echo $Transaction['Mt4Trade']['CLOSE_PRICE'];
								};?>
							<td>
								<div class="text-right">
									<b><?php echo number_format($Transaction['Mt4Trade']['PROFIT'], 2, '.', '');?></b>
								</div>
							</td>
							
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				<?php
				if(!isset($totolText)) {
					$totolText=__('Total Records');
				}
				?>
				<div class="pagination pagination-right">
					<ul>
				<?php
						echo "<li><span>".$this->Paginator->counter(array('format' => $totolText.' %count%'))."</span></li>";
						$firstP=$this->Paginator->first(__('First'), array('tag' => 'li'));
						if(!empty($firstP)) {
							echo $firstP;
						} else {
							echo "<li class='disabled'><span>First</span></li>";
						}
						if($this->Paginator->hasPrev()) {
							echo $this->Paginator->prev(__('Previous'), array('tag' => 'li'));;
						} else {
							echo "<li class='disabled'><span>Previous</span></li>";
						}
						echo $this->Paginator->numbers(array('separator'=>'', 'tag' => 'li', 'currentTag'=>'span'));
						if($this->Paginator->hasNext()) {
							echo $this->Paginator->next(__('Next'), array('tag' => 'li'));;
						} else {
							echo "<li class='disabled'><span>Next</span></li>";
						}
						$lastP=$this->Paginator->last(__('Last'), array('tag' => 'li'));
						if(!empty($lastP)) {
							echo $lastP;
						} else {
							echo "<li class='disabled'><span>Last</span></li>";
						}
						echo "<li><span>".$this->Paginator->counter(array('format' => __('Page %s of %s', '%page%', '%pages%')))."</span></li>";
						echo "<li><span style='padding-top: 3px;height:21px;width:21px'>".$this->Html->image(SITE_URL.'usermgmt/img/loading-circle.gif', array('id' => 'busy-indicator', 'style'=>'display:none;'))."</span></li>";
				?>
					</ul>
				</div>
				<?php echo $this->Js->writeBuffer();  ?>
			</div>
		</div>
	</div>
</div>