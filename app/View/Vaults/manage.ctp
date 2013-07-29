<div class="row-fluid">
	<div class="span7">
		<div class="box green box-small box-bordered">
			<div class="box-title">
				<h3>
					<i class="icon-money"></i>
					Wallet Balance
				</h3>
			</div>
			<div class="box-content">

				<div class="row-fluid">
					<div class="span9">
						<center>
							<h1>IK$ <?php echo number_format($MT_ACC['Mt4User']['BALANCE'], 2, '.', '');?></h1>
						</center>
					</div>

					<div class="span3">
						<a class="btn-block btn btn-satgreen " href="#">+</a>
						<a class="btn-block btn btn-lightred " href="#">-</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="span5">
		<div class="box box-bordered">
			<div class="box-title">
				<h3>
					<i class="icon-money"></i>
					Trading Account Funding
				</h3>
			</div>
			<div class="box-content">
				<a class="btn-block btn btn-satgreen " href="#">Wallet <i class="icon-circle-arrow-right"></i> Trading Account</a>
				<a class="btn-block btn btn-lightred " href="#">Trading Account <i class="icon-circle-arrow-left"></i> Wallet</a>
			</div>
		</div>
	</div>
</div>