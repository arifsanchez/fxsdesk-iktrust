<?php
/*
Cakephp 2.x User Management Premium Version (a product of Ektanjali Softwares Pvt Ltd)
Website- http://ektanjali.com
Plugin Demo- http://umpremium.ektanjali.com
Author- Chetan Varshney (The Director of Ektanjali Softwares Pvt Ltd)
Plugin Copyright No- 11498/2012-CO/L

UMPremium is a copyrighted work of authorship. Chetan Varshney retains ownership of the product and any copies of it, regardless of the form in which the copies may exist. This license is not a sale of the original product or any copies.

By installing and using UMPremium on your server, you agree to the following terms and conditions. Such agreement is either on your own behalf or on behalf of any corporate entity which employs you or which you represent ('Corporate Licensee'). In this Agreement, 'you' includes both the reader and any Corporate Licensee and Chetan Varshney.

The Product is licensed only to you. You may not rent, lease, sublicense, sell, assign, pledge, transfer or otherwise dispose of the Product in any form, on
a temporary or permanent basis, without the prior written consent of Chetan Varshney.

The Product source code may be altered (at your risk)

All Product copyright notices within the scripts must remain unchanged (and visible).

If any of the terms of this Agreement are violated, Chetan Varshney reserves the right to action against you.

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Product.

THE PRODUCT IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE PRODUCT OR THE USE OR OTHER DEALINGS IN THE PRODUCT.
*/
?>
<?php echo $this->Search->searchForm('User', array('legend' => false, 'updateDivId' => 'updateUserIndex')); ?>
<?php echo $this->element('Usermgmt.paginator', array('useAjax' => true, 'updateDivId' => 'updateUserIndex')); ?>

<table class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th><?php echo __('SL');?></th>
			<th><?php echo $this->Paginator->sort('User.id', __('User Id')); ?></th>
			<th><?php echo $this->Paginator->sort('User.first_name', __('Name')); ?></th>
			<th><?php echo $this->Paginator->sort('User.username', __('Username')); ?></th>
			<th><?php echo $this->Paginator->sort('User.email', __('Email')); ?></th>
			<th><?php echo __('Groups(s)');?></th>
			<th><?php echo $this->Paginator->sort('User.email_verified', __('Email Verified')); ?></th>
			<th><?php echo $this->Paginator->sort('User.active', __('Status')); ?></th>
			<th><?php echo $this->Paginator->sort('User.created', __('Created')); ?></th>
			<th style="width:150px;"><?php echo __('Action');?></th>
		</tr>
	</thead>
	<tbody>
<?php   if (!empty($users)) {
			$page = $this->request->params['paging']['User']['page'];
			$limit = $this->request->params['paging']['User']['limit'];
			$i=($page-1) * $limit;
			foreach ($users as $row) {
				$i++;
				echo "<tr id='rowId".$row['User']['id']."'>";
				echo "<td>".$i."</td>";
				echo "<td>".$row['User']['id']."</td>";
				echo "<td>".h($row['User']['first_name'])." ".h($row['User']['last_name'])."</td>";
				echo "<td>".h($row['User']['username'])."</td>";
				echo "<td>".h($row['User']['email'])."</td>";
				echo "<td>".h($row['UserGroup']['name'])."</td>";
				echo "<td id='emailVerified".$row['User']['id']."'>";
				if ($row['User']['email_verified']==1) {
					echo __('Yes');
				} else {
					echo __('No');
				}
				echo"</td>";
				echo "<td id='activeInactive".$row['User']['id']."'>";
				if ($row['User']['active']==1) {
					echo __('Active');
				} else {
					echo __('Inactive');
				}
				echo"</td>";
				echo "<td>".date('d-M-Y',strtotime($row['User']['created']))."</td>";
				$loadingImg = '<img src="'.SITE_URL.'usermgmt/img/loading-circle.gif">';
				echo "<td class='action'>";
					echo $this->Html->link($this->Html->image(SITE_URL.'usermgmt/img/view.png', array('alt' => __('View'), 'title' => __('View User'))), array('controller'=>'Users', 'action'=>'viewUser', $row['User']['id'], 'page'=>$page), array('escape'=>false));

					echo $this->Html->link($this->Html->image(SITE_URL.'usermgmt/img/edit.png', array('alt' => __('Edit'), 'title' => __('Edit User'))), array('controller'=>'Users', 'action'=>'editUser', $row['User']['id'], 'page'=>$page), array('escape'=>false));

					echo $this->Html->link($this->Html->image(SITE_URL.'usermgmt/img/password.png', array('alt' => __('Change Password'), 'title' => __('Change Password'))), array('controller'=>'Users', 'action'=>'changeUserPassword', $row['User']['id'], 'page'=>$page), array('escape'=>false));

					if ($row['User']['id']!=1 && strtolower($row['User']['username']) !='admin') {
						if ($row['User']['active']==0) {
							$activeInactiveImg = $this->Html->image(SITE_URL.'usermgmt/img/dis-approve.png', array('alt' => __('Make Active'), 'title' => __('Make Active')));
						} else {
							$activeInactiveImg = $this->Html->image(SITE_URL.'usermgmt/img/approve.png', array('alt' => __('Make Inactive'), 'title' => __('Make Inactive')));
						}
						echo $this->Js->link($activeInactiveImg, array('action' => 'makeActiveInactive', $row['User']['id']), array('escape' => false, 'before'=>"var targetId = event.currentTarget.id; $('#'+targetId).html('".$loadingImg."');", 'success'=>"var targetId = event.currentTarget.id; if(data) { $('#'+targetId).html(data); }"));
					}
					if ($row['User']['id']!=1 && strtolower($row['User']['username']) !='admin') {
						if ($row['User']['email_verified']==0) {
							echo $this->Js->link($this->Html->image(SITE_URL.'usermgmt/img/email-verify.png', array('alt' => __('Verify Email'), 'title' => __('Verify Email'))), array('action' => 'verifyEmail', $row['User']['id']), array('escape' => false, 'confirm' => __('Are you sure you want to verify email of this user?'), 'before'=>"var targetId = event.currentTarget.id; $('#'+targetId).html('".$loadingImg."');", 'success'=>"var targetId = event.currentTarget.id; $('#'+targetId).html(data);"));
						}
					}
					if ($row['User']['id']!=1 && strtolower($row['User']['username']) !='admin') {
						echo $this->Js->link($this->Html->image(SITE_URL.'usermgmt/img/delete.png', array('alt' => __('Delete'), 'title' => __('Delete User'))), array('action' => 'deleteUser', $row['User']['id']), array('escape' => false, 'confirm' => __('Are you sure you want to delete this user?'), 'before'=>"var targetId = event.currentTarget.id; $('#'+targetId).html('".$loadingImg."');", 'success'=>"var targetId = event.currentTarget.id; if(data=='1') { $('#rowId".$row['User']['id']."').hide('slow', function(){ $(this).remove(); }); } else { $('#'+targetId).html(data); }"));
					}
					echo $this->Html->link($this->Html->image(SITE_URL.'usermgmt/img/view-permission.png', array('alt' => __('View Permissions'), 'title' => __('View Permissions'))), array('controller'=>'Users', 'action'=>'viewUserPermissions', $row['User']['id'], 'page'=>$page), array('escape'=>false));

					echo $this->Html->link($this->Html->image(SITE_URL.'usermgmt/img/send_mail.png', array('alt' => __('Send Mail'), 'title' => __('Send Mail'))), array('controller'=>'UserEmails', 'action'=>'sendToUser', $row['User']['id'], 'page'=>$page), array('escape'=>false));

				echo "</td>";
				echo "</tr>";
			}
		} else {
			echo "<tr><td colspan=10><br/><br/>".__('No Data')."</td></tr>";
		} ?>
	</tbody>
</table>
<?php if(!empty($users)) { echo $this->element('Usermgmt.pagination', array("totolText" => __('Number of Users'))); } ?>