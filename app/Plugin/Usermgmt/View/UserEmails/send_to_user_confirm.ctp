<?php echo $this->element('Usermgmt.dashboard'); ?>
<script type="text/javascript">
	function validateForm() {
		if (!confirm('Are you sure, you want to send this email?')) {
			return false;
		}
		return true;
	}
</script>
<div class="um-panel">
	<div class="um-panel-header">
		<span class="um-panel-title">
			<?php echo __('Confirm Sending Email to').' '.$name ?>
		</span>
		<span class="um-panel-title-right">
			<?php echo $this->Html->link(__('Edit', true), array('action'=>'sendToUser/'.$userId));?>
		</span>
	</div>
	<div class="um-panel-content">
		<?php echo $this->Form->create('UserEmail', array('action'=>'sendToUser/'.$userId.'/confirm', 'onSubmit'=>'return validateForm()')); ?>
		<table class="table" style="width:auto">
			<tr>
				<th>To</th>
				<td><?php echo $data['UserEmail']['to'];?></td>
			</tr>
			<tr>
				<th>CC Email(s)</th>
				<td><?php echo $data['UserEmail']['cc_to']; ?></td>
			</tr>
			<tr>
				<th>From Name</th>
				<td><?php echo $data['UserEmail']['from_name']; ?></td>
			</tr>
			<tr>
				<th>From Email</th>
				<td><?php echo $data['UserEmail']['from_email']; ?></td>
			</tr>
			<tr>
				<th>Email Subject</th>
				<td><?php echo $data['UserEmail']['subject']; ?></td>
			</tr>
			<tr>
				<th>Email Message</th>
				<td>
				<?php 
					$message = '';
					if(!empty($template['UserEmailTemplate']['header'])) {
						$message .= nl2br($template['UserEmailTemplate']['header'])."<br/><br/>";
					}
					$message .= $data['UserEmail']['message'];
					if(!empty($signature['UserEmailSignature']['signature'])) {
						$message .= "<br/>".$signature['UserEmailSignature']['signature'];
					}
					if(!empty($template['UserEmailTemplate']['footer'])) {
						$message .= "<br/>".nl2br($template['UserEmailTemplate']['footer']);
					}
					echo $message;
				?>
				</td>
			</tr>
		</table>
		<div class="um-button-row">
			<?php echo $this->Form->Submit('Send Mail', array('class'=>'btn btn-primary')); ?>
		</div>
		<?php echo $this->Form->end(); ?>
	</div>
</div>