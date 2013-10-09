<div class="row-fluid">
	<div class="span12">
		<div class="box-bordered box-content">
			<hr>
			<div class="invoice-info">
				<div class="invoice-name">
					IK Financial Market Corp. Ltd.
					<div class="pull-right">
						<button class="btn btn-mini btn-satblue">PRINT INVOICE</button>
					</div>
				</div>
				<div class="invoice-from">
					<span>Service Provider :</span>
					<strong>IK Financial Market Corp. Ltd.</strong>
					<address>
						1 Northumberland Avenue <br>
						Trafalgar Square London, WC2N <br>
						5BW United Kingdom <br>
						<abbr title="Call Us">Hotline:</abbr> +44 20 0333 1513 <br>
						<abbr title="SMS">SMS:</abbr> +44 20 0333 1513
					</address>
				</div>
				<div class="invoice-to">
					<span>Client</span>
					<strong><?php echo $var['User']['first_name']." ".$var['User']['last_name'];?> </strong>
					<address>
						<abbr title="Email">Email:</abbr> <?php echo $var['User']['email'];?> <br>
					</address>
				</div>
				<div class="invoice-infos">
					<table>
						<tr>
							<th>Date:</th>
							<td><?php echo "";?></td>
						</tr>
						<tr>
							<th>Invoice #:</th>
							<td></td>
						</tr>
						<tr>
							<th>Account:</th>
							<td>IKW<?php echo $vaultSiapa;?></td>
						</tr>
					</table>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span12">
					<div class="invoice-desc">
						<p><b>Note:</b> In accordance with the agreement between <b>IK Financial Market Corp. Ltd.</b> and <b><?php echo $var['User']['first_name']." ".$var['User']['last_name'];?></b>, the
		payment for the replenishment of account <b>IKW<?php echo $vaultSiapa;?></b>, is paid at rate <b><?php echo $amount_request;?> USD</b> (one hundred dollars). Invoice is valid within 3 (three) business days.
		</p>
					</div>
				</div>
			</div>
			<table class="table table-striped table-invoice">
				<thead>
					<tr>
						<th>Item</th>
						<th>Price</th>
						<th>Qty</th>
						<th class='tr'>Total</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class='name'>The payment for invoice <?php echo $invoiceID;?> #</td>
						<td class='price'>$amount-due</td>
						<td class='qty'>1</td>
						<td class='total'>$amount-due</td>
					</tr>
					<tr>
						<td colspan="3"></td>
						<td class='taxes'>
							<p>
								<span class="light">Subtotal</span>
								<span>$450.00</span>
							</p>
							<p>
								<span class="light">Tax(10%)</span>
								<span>$45.00</span>
							</p>
							<p>
								<span class="light">Total</span>
								<span class="totalprice">
									$495.00
								</span>
							</p>
						</td>
					</tr>
				</tbody>
			</table>
			<div class="invoice-payment">
				<span>Payment methods</span>
				<p>This payment should be transferred to the following bank account:</p>
			</div>
		</div>
	</div>
</div>