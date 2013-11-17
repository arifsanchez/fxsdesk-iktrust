<div class="row-fluid">
	<div class="span12">
		<div class="box box-color satblue box-bordered" id="updateTradeHistory">
			<table class="table table-hover table-nomargin table-condensed table-bordered">
				<thead>
					<tr>
						<th><div class="text-center">Overall (Loss / Profit)<br/>Since April 2013</div></th>
						<th><div class="text-center">Last Month (Loss / Profit)
							<br/>
							<?php echo date('F',strtotime('Last Month'));?>
						</div></th>
						<th><div class="text-center">Last Week (Loss / Profit)
							<br/>
							<?php echo date('d/m/y',strtotime('Last Week Monday')).' - '.date('d/m/y',strtotime('Last Week Friday'));?>
						</div></th>
					</tr>
				</thead>
				<tbody>
					<td>
						<div class="text-center">
							<h4>
								<?php echo $this->Number->currency($OverallLOSS, 'IK$ '); ?>
								&nbsp;|&nbsp;
								<?php echo $this->Number->currency($OverallPROFIT, 'IK$ '); ?>
							</h4>
						</div>
					</td>

					<td>
						<div class="text-center">
							<h4>
								<?php echo $this->Number->currency($OverallLastMonthLOSS, 'IK$ '); ?>
								&nbsp;|&nbsp;
								<?php echo $this->Number->currency($OverallLastMonthPROFIT, 'IK$ '); ?>
							</h4>
						</div>
					</td>

					<td>
						<div class="text-center">
							<h4>
								<?php echo $this->Number->currency($OverallLastWeekLOSS, 'IK$ '); ?>
								&nbsp;|&nbsp;
								<?php echo $this->Number->currency($OverallLastWeekPROFIT, 'IK$ '); ?>
							</h4>
						</div>
					</td>
				</tbody>
			</table>
		</div>
		<br/>
		<div class="box box-color satblue box-bordered" id="updateTradeHistory">
			<table class="table table-hover table-nomargin table-condensed table-bordered">
				<thead>
					<tr>
						<th><div class="text-center">Monday (Loss / Profit)<br/>
							<?php echo date('d/m/y',strtotime('Last Monday'));?></div></th>
						<th><div class="text-center">Tuesday (Loss / Profit)<br/>
							<?php echo date('d/m/y',strtotime('Last Tuesday'));?></div></th>
						<th><div class="text-center">Wednesday (Loss / Profit)<br/>
							<?php echo date('d/m/y',strtotime('Last Wednesday'));?></div></th>
						<th><div class="text-center">Thursday (Loss / Profit)<br/>
							<?php echo date('d/m/y',strtotime('Last Thursday'));?></div></th>
						<th><div class="text-center">Friday (Loss / Profit)<br/>
							<?php echo date('d/m/y',strtotime('Last Friday'));?></div></th>
					</tr>
				</thead>
				<tbody>
					<td>
						<div class="text-center">
							<small>
								<?php echo $this->Number->currency($LastMondayLOSS, 'IK$ '); ?>
								&nbsp;|&nbsp;
								<?php echo $this->Number->currency($LastMondayPROFIT, 'IK$ '); ?>
							</small>
						</div>
					</td>
					<td>
						<div class="text-center">
							<small>
								<?php echo $this->Number->currency($LastTuesdayLOSS, 'IK$ '); ?>
								&nbsp;|&nbsp;
								<?php echo $this->Number->currency($LastTuesdayPROFIT, 'IK$ '); ?>
							</small>
						</div>
					</td>
					<td>
						<div class="text-center">
							<small>
								<?php echo $this->Number->currency($LastWednesdayLOSS, 'IK$ '); ?>
								&nbsp;|&nbsp;
								<?php echo $this->Number->currency($LastWednesdayPROFIT, 'IK$ '); ?>
							</small>
						</div>
					</td>
					<td>
						<div class="text-center">
							<small>
								<?php echo $this->Number->currency($LastThursdayLOSS, 'IK$ '); ?>
								&nbsp;|&nbsp;
								<?php echo $this->Number->currency($LastThursdayPROFIT, 'IK$ '); ?>
							</small>
						</div>
					</td>
					<td>
						<div class="text-center">
							<small>
								<?php echo $this->Number->currency($LastFridayLOSS, 'IK$ '); ?>
								&nbsp;|&nbsp;
								<?php echo $this->Number->currency($LastFridayPROFIT, 'IK$ '); ?>
							</small>
						</div>
					</td>
				</tbody>
			</table>
		</div>

		<div class="box box-color satblue box-bordered" id="updateTradeHistory">
			<div class="box-title">
				<div class="pull-left">
					<a class="btn  btn-red" href="<?php echo SITE_URL;?>Staffs/report_close_order_today">Today</a>
					<a class="btn  btn-red" href="<?php echo SITE_URL;?>Staffs/report_close_order_yesterday">Yesterday</a>
					<a class="btn  btn-green" href="<?php echo SITE_URL;?>Staffs/report_close_order_overall">Overall</a>
				</div>
				<div class="actions">
				</div>
			</div>
		</div>
	</div>
</div>