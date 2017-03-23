<?php

include '../config.php';

$Action = $_GET['Action'];

if($Action == "getDistricts")
	{
		$Province = $_GET['Province'];
		$sql = "
					SELECT
					    `id`,
						`name`
					FROM
						`districts`
					WHERE
						`province` = '{$Province}'

					ORDER by `name` ASC
				";
		$result = mysqli_query($connectionID, $sql) or die ("Couldn't query districts ... ...");

		$districts = array();
		while($row = mysqli_fetch_row($result))
			{
				$districts[$row[0]]=array($row[1]);
			}
		print json_encode($districts);
	}

if($Action == "getMunicipalities")
	{
		$district = $_GET['district'];
		$sql         = "
							SELECT
							    `id`,
								`name`
							FROM
								`municipalities`
							WHERE
								`district` = '{$district}'

							ORDER by `name` ASC
						";
		$result      = mysqli_query($connectionID, $sql) or die ("Couldn't query municipalities ... ...");
		$municipalities  = array();
		while($row = mysqli_fetch_row($result))
		{
			$municipalities[$row[0]]=array($row[1]);
		}
		print json_encode($municipalities);
	}

	if($Action == "getWards")
	{
		$municipality = $_GET['municipality'];
		$sql         = "
							SELECT
							    `id`,
								`name`
							FROM
								`wards`
							WHERE
								`municipality` = '{$municipality}'

							ORDER by `name` ASC
						";
		$result = mysqli_query($connectionID, $sql) or die ("Couldn't query wards ... ...");
		$wards  = array();
		while($row = mysqli_fetch_row($result))
		{
			$wards[$row[0]]=array($row[1]);
		}
		print json_encode($wards);
	}

		if($Action == "getSubType")
	{
		$case_type = $_GET['case_type'];
		$sql         = "
							SELECT
							    `id`,
								`name`
							FROM
								`cases_sub_types`
							WHERE
								`case_type` = '{$case_type}'

							ORDER by `name` ASC
						";
		$result = mysqli_query($connectionID, $sql) or die ("Couldn't query cases sub types ... ...");
		$cases_sub_types  = array();
		while($row = mysqli_fetch_row($result))
		{
			$cases_sub_types[$row[0]]=array($row[1]);
		}
		print json_encode($cases_sub_types);
	}



?>
