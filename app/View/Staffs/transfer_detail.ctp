<?php 
	#debug($var);
 	#debug($userDetails);
	#debug($TranDetails);
 ?>

<div class="row-fluid">
	<div class="span4">
		<div class="box box-color blue box-small box-bordered">
			<div class="box-title">
				<h3><i class="icon-user"></i> Client Details</h3>
			</div>
			<div class="box-content">
				<div class="row-fluid">
					<div class="span4">
						<img alt="<?php echo h($userDetails['User']['first_name'].' '.$userDetails['User']['last_name']); ?>" src="<?php echo $this->Image->resize('img/'.IMG_DIR, $userDetails['UserDetail']['photo'], 100, null, true) ?>">
					</div>
					<div class="span8">
						<b><?php echo h($userDetails['User']['first_name'].' '.$userDetails['User']['last_name']); ?></b>
						<p><i class="glyphicon-e-mail"></i> <?php echo h($userDetails['User']['email']);?></p>
						<?php if(!empty($userDetails['UserDetail']['cellphone'])){ ?>
						<p><i class="icon-phone"></i> <?php echo h($userDetails['UserDetail']['cellphone']);?></p>
						<?php } ?>
						<span class="time">
							<small>Registered on <?php echo $this->Time->format('jS F Y',$userDetails['User']['created'],null, null); ?></small>
						</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="span8">
		<!-- Transaction Details -->
		<div class="box box-color satblue box-small box-bordered nopadding">
			<div class="box-title">
				<h3><i class="icon-reorder"></i> Transaction Details</h3>
			</div>
			<div class="box-content">
				<!-- Type | Status | Amount | Source | Source balance-->
				<table class="table table-hover table-nomargin table-condensed table-bordered">
					<thead>
						<tr>
							<th>Type</th>
							<th>Status</th>
							<th>Tracc</th>
							<th>Amount</th>
							<th>Wallet</th>
							<th>Wallet Balance</th>
							<th>Operation</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<?php
									$type = $TranDetails['VaultTransaction']['type'];
									echo $this->element('requestVaultTransType', array('type' => $type));
								?>
							</td>
							<td>
								<?php
									$status = $TranDetails['VaultTransaction']['status'];
									echo $this->element('requestVaultStatLabel', array('status' => $status));
								?>
							</td>
							<td><?php echo $TranDetails['VaultTransaction']['tracc_no'];?></td>
							<td><?php echo $this->Number->Currency($TranDetails['VaultTransaction']['jumlah'], '$ ');?></td>
							<td><?php echo $TranDetails['Vault']['id'];?></td>
							<td><?php echo $this->Number->Currency($TranDetails['Vault']['acc_1'], 'IK$ ');?></td>
							<td>
								<div class="btn-group">
									<?php if($status != 3){?>
									<a class="btn btn-inverse dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-cog"></i> Update Status <span class="caret"></span></a>
									<ul class="dropdown-menu dropdown-warning">
										<?php
											/*switch ($type) {
												case '1':
													echo $this->element('StaffTransStatus_type', array('status' => $status, 'TranDetails' => $TranDetails, 'type' => $type));
													break;
												case '4':
													echo $this->element('StaffTransStatus_type4', array('status' => $status, 'TranDetails' => $TranDetails));
													break;
												
												default:
													echo "";
													break;
											}*/

											echo $this->element('StaffTransStatus_type', array('status' => $status, 'TranDetails' => $TranDetails, 'type' => $type));
											
											#echo $this->element('StaffTransStatus.type4');
										?>
										
									</ul>
									<?php }else{ ?>
										<a class="btn btn-success" href="#"><i class="icon-cog"></i> View Account </a>
									<?php }?>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

		<!-- Comments Details -->
		<div class="box box-small box-bordered">
			<div class="box-title">
				<h3><i class="icon-comments"></i> Transaction Comments</h3>
			</div>
			<div class="box-content nopadding scrollable" data-height="350" data-start="bottom" data-visible="true">
				<ul class="messages">
					<li class="left">
						<div class="image">
							<img alt="<?php echo h($userDetails['User']['first_name'].' '.$userDetails['User']['last_name']); ?>" src="<?php echo $this->Image->resize('img/'.IMG_DIR, $userDetails['UserDetail']['photo'], 84, null, true) ?>">
						</div>
						<div class="message">
							<span class="caret"></span>
							<span class="name"><?php echo h($userDetails['User']['first_name'].' '.$userDetails['User']['last_name']); ?></span>
							<p>Request for transfer created.</p>
							<span class="time">
								<span data-livestamp="<?php echo $TranDetails['VaultTransaction']['created'];?>"></span>
							</span>
						</div>
					</li>
					<!-- //VaultTransactionComment start
						* if $TranDetails['Vault']['user_id'] == $TranDetails['VaultTransactionComment']['user_id'] -> add class left else staff / partner -> right class
					-->
					<?php foreach($TranDetails['VaultTransactionComment'] as $TranComment): 

						if($TranDetails['Vault']['user_id'] == $TranComment['user_id']){
							echo "<li class='left'>";
						}else{
							echo "<li class='right'>";
						}

						$userInfo = $this->requestAction('staffs/requestUserInfo', array('uid' => $TranComment['user_id']));
						#debug($userInfo);
					?>
						<div class="image">
							<img alt="<?php echo h($userInfo['User']['first_name'].' '.$userInfo['User']['last_name']); ?>" src="<?php echo $this->Image->resize('img/'.IMG_DIR, $userInfo['UserDetail']['photo'], 84, null, true) ?>">
						</div>
						<div class="message">
							<span class="caret"></span>
							<span class="name"><?php echo h($userInfo['User']['first_name'].' '.$userInfo['User']['last_name']); ?></span>
							<p><?php echo (__($TranComment['comment']));?></p>
							<span class="time">
								<span data-livestamp="<?php echo $TranComment['created'];?>"></span>
							</span>
						</div>
					</li>
				<?php endforeach; ?>
					<li class="insert">
						<?php echo $this->Form->create('Staff', array('action' => 'updateTranComment','class'=> 'form-messages')); ?>
						<!--form method="POST" action="#" class='form-messages'-->
							<div class="text">
								<?php
									echo $this->Form->hidden('user_id', array('value' => $var['User']['id']));
									echo $this->Form->hidden('vault_transaction_id', array('value' => $TranDetails['VaultTransaction']['id']));
									echo $this->Form->input('comment', array('type' => 'text', 'placeholder' => 'Insert comment here !', 'class' => 'input-block-level', 'div' => false, 'label' => false));
								?>
							</div>
							<div class="submit">
								<?php
									echo $this->Form->button('<i class="icon-share-alt"></i>', array('type' => 'submit'));
								?>
							</div>
						<?php echo $this->Form->end();?>
						<!--/form-->
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>