<?php

	if (isset($_POST['ItemsSortInfo']) & isset($_POST['SortingValue']))
	{
		$ST = $_POST['SortingValue'];
		$ISI = $_POST['ItemsSortInfo'];
		switch($ST)
		{
			case "Name":
				asort($ISI);
			break;
			case "BtL":
				arsort($ISI);
			break;
			case "LtB":
				asort($ISI);
			break;
		}
		$Keys = array_keys($ISI);
		echo (implode(",", $Keys));
	}
	else
	{
		echo 'Error: corruptedData';
	}


?>