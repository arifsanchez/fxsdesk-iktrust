<?php #https://github.com/arifsanchez/usermanagement_plugin ;?>

<div class="um-panel">
	<div class="um-panel-header">
		<span class="um-panel-title">
			<?php echo __('Edit Setting') ?>
		</span>
		<span class="um-panel-title-right">
			<?php $page= (isset($this->request->params['named']['page'])) ? $this->request->params['named']['page'] : 1; ?>
			<?php echo $this->Html->link(__('Back', true), array('action'=>'index', 'page'=>$page));?>
		</span>
	</div>
	<div class="um-panel-content">
		<?php echo $this->Form->create('UserSetting', array()); ?>
		<?php echo $this->Form->hidden('id'); ?>
		<div class="um-form-row">
			<label><?php echo $this->data['UserSetting']['name_public'];?></label>
			<div>
			<?php   if($this->data['UserSetting']['type']=='checkbox') {
						echo $this->Form->input('value', array('type'=>'checkbox', 'label' => false, 'div' => false));
					} else {
						echo $this->Form->input('value', array('label' => false, 'div' => false, 'class'=>'span6'));
					}
				?>
			</div>
		</div>
		<div class="um-button-row">
			<?php echo $this->Form->Submit('Update Setting', array('class'=>'btn btn-primary')); ?>
		</div>
		<?php echo $this->Form->end(); ?>
	</div>
</div>