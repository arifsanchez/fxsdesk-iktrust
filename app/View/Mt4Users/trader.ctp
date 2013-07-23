<div class="row-fluid">
	<div class="span12">
		<div class="box box-color box-bordered">
			<div class="box-title">
				<h3>
					<i class="icon-table"></i>
					All traders
				</h3>
			</div>
			<div class="box-content nopadding">
				<table class="table table-hover table-nomargin">
					<thead>
						<tr>
							<th><?php echo $this->Paginator->sort('TRADERS ID'); ?></th>
							<th><?php echo $this->Paginator->sort('NAME'); ?></th>
							<th><?php echo $this->Paginator->sort('COUNTRY'); ?></th>
							<th><?php echo $this->Paginator->sort('LEVERAGE'); ?></th>
							<th><?php echo $this->Paginator->sort('AGENT_ACCOUNT'); ?></th>
							<th><?php echo $this->Paginator->sort('BALANCE'); ?></th>
							<th>Operations</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($mt4Users as $mt4User): ?>
						<tr>
							<td><?php echo h($mt4User['Mt4User']['LOGIN']); ?></td>
							<td><?php echo h($mt4User['Mt4User']['NAME']); ?></td>
							<td><?php echo h($mt4User['Mt4User']['COUNTRY']); ?></td>
							<td><?php echo h($mt4User['Mt4User']['LEVERAGE']); ?></td>
							<td><?php echo h($mt4User['Mt4User']['AGENT_ACCOUNT']); ?></td>
							<td><?php echo h($mt4User['Mt4User']['BALANCE']); ?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				<div class="table-pagination">
					<p align="center" class="alert alert-error">
						<?php
							echo $this->Paginator->counter(array(
							'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
							));
						?>	
					</p>
					
					<a href="#"><?php echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled')); ?></a>
					<a href="#"><?php echo $this->Paginator->numbers(array('separator' => '')); ?></a>
					<a href="#"><?php echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled')); ?></a>
					
				</div>
			</div>
		</div>
	</div>
</div>