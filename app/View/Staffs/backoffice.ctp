<?php 
	#echo pr($var);
?>

<div class="row-fluid">
	<div class="span6">
		<!-- Servicing Traders -->
		<div class="box box-color box-bordered">
			<div class="box-title">
				<h3>
					<i class="icon-th-large"></i>
					Service for Traders
				</h3>
			</div>
			<div class="box-content">
				<ul class="stats">
					<li class="blue">
						<a href="<?php echo SITE_URL;?>Users/index">
							<i class="icon-user"></i>
							<div class="details">
								<span class="big">567</span>
								<span>Clients</span>
							</div>
						</a>
					</li>
					
					<li class="satgreen">
						<a href="<?php echo SITE_URL;?>Vaults/deposit_all">
							<i class="icon-money"></i>
							<div class="details">
								<span class="big">567</span>
								<span>Deposit</span>
							</div>
						</a>
					</li>

					<li class="red">
						<a href="<?php echo SITE_URL;?>Vaults/withdrawal_all">
							<i class="icon-money"></i>
							<div class="details">
								<span class="big">567</span>
								<span>Withdraw</span>
							</div>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>

	<div class="span6">
		<!-- Servicing Partners -->
		<div class="box box-color red box-bordered">
			<div class="box-title">
				<h3>
					<i class="icon-th-large"></i>
					Service for Partners
				</h3>
			</div>
			<div class="box-content">
				<ul class="stats">
					<li class="lightgrey">
						<a href="<?php echo SITE_URL;?>Users/index">
							<i class="icon-group"></i>
							<div class="details">
								<span class="big">23</span>
								<span>Partners</span>
							</div>
						</a>
					</li>
					
					<li class="lime">
						<a href="<?php echo SITE_URL;?>Partner/purchasing_all">
							<i class="icon-shopping-cart"></i>
							<div class="details">
								<span class="big">567</span>
								<span>Sales</span>
							</div>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>