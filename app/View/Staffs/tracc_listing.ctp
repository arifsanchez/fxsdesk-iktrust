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
		<div class="box box-color box-small blue box-bordered" id="updateNetworklisting">
			<div class="box-title">
				<h3>
					Registered Trading Accounts
				</h3>
				<div class="actions">
					<style>
					    #custom-search-form {
					    margin:0;
					    margin-top: 5px;
					    padding: 0;
					    }
					    #custom-search-form .search-query {
					    padding-right: 3px;
					    padding-right: 4px \9;
					    padding-left: 3px;
					    padding-left: 4px \9;
					    /* IE7-8 doesn't have border-radius, so don't indent the padding */
					    margin-bottom: 0;
					    -webkit-border-radius: 3px;
					    -moz-border-radius: 3px;
					    border-radius: 3px;
					    }
					    #custom-search-form button {
					    border: 0;
					    background: none;
					    /** belows styles are working good */
					    padding: 2px 5px;
					    margin-top: 2px;
					    position: relative;
					    left: -28px;
					    /* IE7-8 doesn't have border-radius, so don't indent the padding */
					    margin-bottom: 0;
					    -webkit-border-radius: 3px;
					    -moz-border-radius: 3px;
					    border-radius: 3px;
					    }
					    .search-query:focus + button {
					    z-index: 3;
					    }
				    </style>
				    <?php echo $this->Form->create('Staff', array('action' => 'cariTracc'), array('class' => 'form-search form-horizontal pull-right'));
				    	echo "<div class='controls'><div class='input-prepend'>";
				    	echo $this->Form->input('tracc_no', array(
							'label' => false,
							'data-rule-required' => 'true',
							'data-rule-number' => 'true',
							'placeholder' => 'Trading Acc No',
							'class' => 'input-medium',
							'div' => false,
							'after' => "<span class='add-on'><i class='icon-search'></i></span>"
						));
				    	echo "</div></div>";
				    	echo $this->Form->submit();
						echo $this->Form->end();
					?>
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
								<a class="btn" href="<?php echo SITE_URL;?>Staffs/tracc_history/process:<?php echo $acc['Mt4User']['LOGIN'];?>" data-placement="right" title="" rel="tooltip" data-original-title="<?php echo $acc['Mt4User']['NAME'];?>" >
									<?php echo $acc['Mt4User']['LOGIN'];?>
								</a>
							</td>
							<td>1:<?php echo $acc['Mt4User']['LEVERAGE'];?></td>
							<td><?php echo $this->Number->currency($acc['Mt4User']['BALANCE'], '');?></td>
							<td><?php echo $this->Number->currency($acc['Mt4User']['CREDIT'], '');?></td>
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
							<td><span data-livestamp="<?php echo $acc['Mt4User']['REGDATE'];?>"></span></td>
							<td>
								<a href="<?php echo SITE_URL;?>Staffs/tracc_history/process:<?php echo $acc['Mt4User']['LOGIN'];?>" class="btn btn-grey" rel="tooltip" title="Transactions History"><i class="glyphicon-table"></i> Transactions</a>

								<a href="#popup-coming-soon" class="btn btn-darkblue" rel="tooltip" title="Trading Account Setting" data-toggle="modal"><i class="icon-cogs"></i> Setting</a>
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