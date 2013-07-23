<div class="box-title">
	<h3>
		<?php if(!empty($page_title)){
			echo "<i class=".$page_title['icon']."></i>";
			echo $page_title['icon'];
		} else {
			echo "<i class=\"icon-bar-chart\"></i>";
			echo ucwords(strtolower($this->params['action']));
		};?>
	</h3>
</div>