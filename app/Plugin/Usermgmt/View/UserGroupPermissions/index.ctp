<?php echo $this->Html->script(array('/usermgmt/js/umupdate.js?q='.QRDN)); ?>
<div class="um-panel">
	<div class="um-panel-header">
		<span class="um-panel-title">
			<?php echo __('Parent Group Permissions') ?>
		</span>
		<span class="um-panel-title">
			<?php echo $this->Html->link(__('View Matrix', true), '/permissionGroupMatrix');?>
		</span>
		<span class="um-panel-title-right">
			<?php echo $this->Html->link(__('Sub Group Permissions', true), '/subPermissions');?>
		</span>
		<span class="um-panel-title-right">
			<?php echo __('Select Controller');?>
			<?php echo $this->Form->input('controller', array('type'=>'select', 'div'=>false, 'options'=>$allControllers, 'selected'=>$c, 'label'=>false, 'onchange'=>"window.location='".SITE_URL."permissions/?c='+(this).value"));?>
		</span>
	</div>
	<div class="um-panel-content">
<?php   if (!empty($controllers)) { ?>
			<input type="hidden" id="BASE_URL" value="<?php echo SITE_URL;?>">
			<input type="hidden" id="groups" value="<?php echo $groups;?>">
			<table class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th><?php echo __("Controller");?></th>
						<th><?php echo __("Action");?></th>
						<th><?php echo __("Permission");?></th>
						<th style='width:125px'><?php echo __("Operation");?></th>
					</tr>
				</thead>
				<tbody>
	<?php
			$k=1;
			foreach ($controllers as $key=>$value) {
				if (!empty($value)) {
					for ($i=0; $i<count($value); $i++) {
						if (isset($value[$i])) {
							$action=$value[$i];
							echo $this->Form->create();
							echo $this->Form->hidden('controller',array('id'=>'controller'.$k,'value'=>$key));
							echo $this->Form->hidden('action',array('id'=>'action'.$k,'value'=>$action));
							echo "<tr>";
							echo "<td>".$key."</td>";
							echo "<td>".$action;
							if(!empty($funcDesc[$key][$action])) {
								echo "<br/><span style='color:red;font-size:10px;font-style:italic'>".$funcDesc[$key][$action]."</span>";
							}
							echo "</td>";
							echo "<td>";
							foreach ($user_groups as $user_group) {
								$ugname=$user_group['name'];
								$ugname_alias=$user_group['alias_name'];
								if (isset($value[$action][$ugname_alias]) && $value[$action][$ugname_alias]==1) {
									$checked=true;
								} else {
									$checked=false;
								}
								echo $this->Form->input($ugname,array('id'=>$ugname_alias.$k,'type'=>'checkbox','checked'=>$checked));
							}
							echo "</td>";
							echo "<td>";
							echo $this->Form->button('Update', array('type'=>'button', 'name'=>$k,'onClick'=>'javascript:update_fields('.$k.');', 'class'=>'btn btn-primary'));
							echo "<div id='updateDiv".$k."' align='right' style='display: inline;'>&nbsp;</div>";
							echo "</td>";
							echo "</tr>";
							echo $this->Form->end();
							$k++;
						}
					}
				}
			} ?>
			</tbody>
		</table>
<?php   }   ?>
	</div>
</div>