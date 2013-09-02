<?php
	switch ($status){
		case 1:
		echo "<span class='label label-orange'>NEW</span>";
		break;
		case 2:
		echo "<span class='label label-satblue'>PENDING</span>";
		break;
		case 3:
		echo "<span class='label label-satgreen'>APPROVE</span>";
		break;
		case 4:
		echo "<span class='label label-red'>DECLINE</span>";
		break;
	};
?>