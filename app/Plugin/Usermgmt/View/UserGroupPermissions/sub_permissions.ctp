<?php #https://github.com/arifsanchez/usermanagement_plugin ;?>
<?php echo $this->Html->script(array('/usermgmt/js/umupdate.js?q='.QRDN)); ?>

<div class="um-panel">
	<div class="um-panel-header">
		<span class="um-panel-title">
			<?php echo __('Sub Group Permissions') ?>
		</span>
		<span class="um-panel-title">
			<?php echo $this->Html->link(__('View Matrix', true), '/permissionSubGroupMatrix');?>
		</span>
		<span class="um-panel-title-right">
			<?php echo __('Controller');?>
			<?php echo $this->Form->input('controller', array('type'=>'select', 'div'=>false, 'options'=>$allControllers, 'selected'=>$c, 'label'=>false, 'onchange'=>"window.location='".SITE_URL."subPermissions/?g=".$group_id."&c='+(this).value"))?>
		</span>
		<span class="um-panel-title-right">
			<?php echo __('Get Sub Groups of');?>
			<?php echo $this->Form->input('controller', array('type'=>'select', 'div'=>false, 'options'=>$parentGroups, 'selected'=>$group_id, 'label'=>false, 'onchange'=>"window.location='".SITE_URL."subPermissions/?g='+(this).value"))?>
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
							$url=$key."/".$action;
							foreach ($subGroups as $subGroup) {
								$ugname=$subGroup['name'];
								$ugname_alias=$subGroup['alias_name'];
								$inherit='';
								if (isset($value[$action][$ugname_alias]) && $value[$action][$ugname_alias]==1) {
									$checked=true;
								} else if(isset($value[$action][$ugname_alias]) && $value[$action][$ugname_alias]==0) {
									$checked=false;
								} else {
									$inherit='(Inherit)';
									if(isset($finalPermissions[$url]) && $finalPermissions[$url]['allowed']==1) {
										$checked=true;
									} else {
										$checked=false;
									}
								}
								echo $this->Form->input($ugname, array('id'=>$ugname_alias.$k, 'type'=>'checkbox', 'checked'=>$checked, 'label'=>false, 'div'=>false, 'style'=>'margin: 3px 4px'));
								echo " <label style='width:auto;display: inline;' for='".$ugname_alias.$k."'>".$ugname."</label>";
								echo " <span style='color:green'>".$inherit."</span><br/>";
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