<?php

	switch ($type){
		case "1":
			echo "<span class='label label-satgreen'>WT <i class='glyphicon-right_arrow'></i> TRACC</span>";
		break;
		case "10":
			echo "<span class='label label-satgreen'>VT <i class='glyphicon-right_arrow'></i> PRACC</span>";
		break;
		case "4":
			echo "<span class='label label-red'>WT <i class='glyphicon-left_arrow'></i> TRACC</span>";
		break;
		case "40":
			echo "<span class='label label-red'>VT <i class='glyphicon-left_arrow'></i> PRACC</span>";
		break;
		
	};

?>