<?php

 include 'config.php';

if(isset($_POST['ACTION']))  {  $ACTION = $_POST['ACTION'];  }  else if(isset($_GET['ACTION']))  {  $ACTION = $_GET['ACTION'];  } else  {  $ACTION = "";  }

if(isset($_POST['ccg_nam']))  {  $ccg_nam = $_POST['ccg_nam'];  }  else if(isset($_GET['ccg_nam']))  {  $ccg_nam = $_GET['ccg_nam'];  } else  {  $ccg_nam = "";  }
if(isset($_POST['ccg_sur']))  {  $ccg_sur = $_POST['ccg_sur'];  }  else if(isset($_GET['ccg_sur']))  {  $ccg_sur = $_GET['ccg_sur'];  } else  {  $ccg_sur = "";  }
if(isset($_POST['ccg_mob']))  {  $ccg_mob = $_POST['ccg_mob'];  }  else if(isset($_GET['ccg_mob']))  {  $ccg_mob = $_GET['ccg_mob'];  } else  {  $ccg_mob = "";  }
if(isset($_POST['prob_mun']))  {  $prob_mun = $_POST['prob_mun'];  }  else if(isset($_GET['prob_mun']))  {  $prob_mun = $_GET['prob_mun'];  } else  {  $prob_mun = "";  }
if(isset($_POST['prob_category']))  {  $prob_category = $_POST['prob_category'];  }  else if(isset($_GET['prob_category']))  {  $prob_category = $_GET['prob_category'];  } else  {  $prob_category = "";  }
if(isset($_POST['prob_subcategory']))  {  $prob_subcategory = $_POST['prob_subcategory'];  }  else if(isset($_GET['prob_subcategory']))  {  $prob_subcategory = $_GET['prob_subcategory'];  } else  {  $prob_subcategory = "";  }
if(isset($_POST['prob_sub_sub_category']))  {  $prob_sub_sub_category = $_POST['prob_sub_sub_category'];  }  else if(isset($_GET['prob_sub_sub_category']))  {  $prob_sub_sub_category = $_GET['prob_sub_sub_category'];  } else  {  $prob_sub_sub_category = "";  }
if(isset($_POST['prob_priority']))  {  $prob_priority = $_POST['prob_priority'];  }  else if(isset($_GET['prob_priority']))  {  $prob_priority = $_GET['prob_priority'];  } else  {  $prob_priority = "";  }
if(isset($_POST['description']))  {  $description = $_POST['description'];  }  else if(isset($_GET['description']))  {  $description = $_GET['description'];  } else  {  $description = "";  }
if(isset($_POST['GPS']))  {  $GPS = $_POST['GPS'];  }  else if(isset($_GET['GPS']))  {  $GPS = $_GET['GPS'];  } else  {  $GPS = "";  }
if(isset($_POST['street_number']))  {  $street_number = $_POST['street_number'];  }  else if(isset($_GET['street_number']))  {  $street_number = $_GET['street_number'];  } else  {  $street_number = "";  }
if(isset($_POST['route']))  {  $route = $_POST['route'];  }  else if(isset($_GET['route']))  {  $route = $_GET['route'];  } else  {  $route = "";  }
if(isset($_POST['locality']))  {  $locality = $_POST['locality'];  }  else if(isset($_GET['locality']))  {  $locality = $_GET['locality'];  } else  {  $locality = "";  }
if(isset($_POST['postal_code']))  {  $postal_code = $_POST['postal_code'];  }  else if(isset($_GET['postal_code']))  {  $postal_code = $_GET['postal_code'];  } else  {  $postal_code = "";  }
if(isset($_POST['country']))  {  $country = $_POST['country'];  }  else if(isset($_GET['country']))  {  $country = $_GET['country'];  } else  {  $country = "";  }
if(isset($_POST['administrative_area_level_1']))  {  $administrative_area_level_1 = $_POST['administrative_area_level_1'];  }  else if(isset($_GET['administrative_area_level_1']))  {  $administrative_area_level_1 = $_GET['administrative_area_level_1'];  } else  {  $administrative_area_level_1 = "";  }
if(isset($_POST['client_reference_number']))  {  $client_reference_number = $_POST['client_reference_number'];  }  else if(isset($_GET['client_reference_number']))  {  $client_reference_number = $_GET['client_reference_number'];  } else  {  $client_reference_number = "";  }
if(isset($_POST['saps_station']))  {  $saps_station = $_POST['saps_station'];  }  else if(isset($_GET['saps_station']))  {  $saps_station = $_GET['saps_station'];  } else  {  $saps_station = "";  }
if(isset($_POST['saps_case_number']))  {  $saps_case_number = $_POST['saps_case_number'];  }  else if(isset($_GET['saps_case_number']))  {  $saps_case_number = $_GET['saps_case_number'];  } else  {  $saps_case_number = "";  }










if($ACTION == "")
{

?>

<html>
<head>
<title>Siyaleader Ports Case Capture</title>
<meta charset="utf-8" / http-equiv="X-UA-Compatible" content="IE=edge" />
<link rel="stylesheet" type="text/css" href="incl/animate.css">
<link rel="stylesheet" type="text/css" href="css/token-input.css" >
<link rel="stylesheet" type="text/css" href="incl/siyaleader_ports.css">
<link rel="stylesheet" href="incl/font-awesome.min.css">
<script type="text/javascript" src="incl/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.tokeninput.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
<script type="text/javascript">

	/*
	var placeSearch, autocomplete;
    var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
      };*/

</script>

<script type="text/javascript" src="incl/siyaleader_ports_functions.js"></script>
<!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBwXS96_uM6y-6ZJZhSJGE87pO-qxpDp-Q&libraries=places&callback=initAutocomplete"
        async defer></script> -->
<!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBwXS96_uM6y-6ZJZhSJGE87pO-qxpDp-Q&libraries=geometry,places&callback=initAutocomplete"></script> -->

<script language=javascript>

String.prototype.toTitleCase = function(){
var smallWords = /^(a|an|and|as|at|but|by|en|for|if|in|nor|of|on|or|per|the|to|vs?\.?|via)$/i;
return this.replace(/[A-Za-z0-9\u00C0-\u00FF]+[^\s-]*/g, function(match, index, title){
if (index > 0 && index + match.length !== title.length &&
  match.search(smallWords) > -1 && title.charAt(index - 2) !== ":" &&
  (title.charAt(index + match.length) !== '-' || title.charAt(index - 1) === '-') &&
  title.charAt(index - 1).search(/[^\s-]/) < 0) {
  return match.toLowerCase();
}

if (match.substr(1).search(/[A-Z]|\../) > -1) {
  return match;
}

return match.charAt(0).toUpperCase() + match.substr(1);
});
};

function checkInput(ob)
			{
							var invalidChars = /[^0-9]/gi
								 if(invalidChars.test(ob.value))
												{
        										ob.value = ob.value.replace(invalidChars,"");
  										}
			}

function toSentenceCase (val)
		{
					str = val;
					temp_arr = str.split('.');
					for (i = 0; i < temp_arr.length; i++)
							{
									temp_arr[i]=temp_arr[i].trim()
									temp_arr[i] = temp_arr[i].charAt(0).toUpperCase() + temp_arr[i].substr(1).toLowerCase();
							}
				str=temp_arr.join('. ') + '.';
				return str;
		}



</script>
</head>

<body ONLOAD="setCaptureBorder('#ffffff');document.getElementById('captureForm').reset();document.getElementById('ccg_nam').focus;" TEXT="#ffffff" LINK="#ffffff" VLINK="#ffffff" ALINK="#ffffff" style="margin:0;overflow:hidden;margin-bottom:0;margin-left:0;margin-right:0;margin-top:0">

<center>
<form id="captureForm" action="case_capture.php" method="post" style="margin:0px;padding:0px;">
<input type=hidden name=ACTION value="SUBMITCASE">
<input type="hidden" name="repID" id="repID">
<input type="hidden" name="addressbook" id="addressbook">

<table id="captureContainer" border=0 cellpadding=4 cellspacing=0 style="font: 11pt 'Arial';color:#ffffff;border-collapse:collapse;border:1px solid #ffffff">
		<tr>
			<td valign=top align=center nowrap style="font: 11pt 'Arial';color:#FFFFFF">
				GPS COORDINATES
			</td>
		</tr>

		<tr>
			<td valign=top nowrap style="font: 11pt 'Arial';color:#FFFFFF">
				<input class="GPSField" type="text" id="GPS" name="GPS" title="GPS Coordinates" onfocus="this.blur()">
			</td>
		</tr>

		<tr>
			<td valign=top align=center style="font: 11pt 'Arial';color:#FFFFFF">
				SEARCH CLIENT<br><input class="formField" type="text" id="cellphone" name="cellphone" title='client' onfocus="this.blur()">
			</td>
		</tr>

		<tr style="font: 11pt 'Arial';color:#ffffff">

			<td valign=middle>
				<input type=text class="formField" id="name" name="name" style="text-align:center" placeholder="Client's First Name" onchange="this.value = this.value.toTitleCase()" disabled>
			</td>
		</tr><tr style="font: 11pt 'Arial';color:#ffffff">

			<td valign=middle>
				<input type=text class="formField" id="surname" name="surname" style="text-align:center" placeholder="Client's Surname" onchange="this.value = this.value.toTitleCase()" disabled>
			</td>Client
		</tr>
		<tr style="font: 11pt 'Arial';color:#ffffff">

			<td valign=middle>
				<input type=text class="formField" id="mobile" name="mobile" style="text-align:center" placeholder="Client's Contact Number" onkeyup="checkInput(this)" disabled>
			</td>
		</tr>

		
		

		<tr>
	        
	        <td class="">
	        	<input class="formField" id="street_number" type="text" name="street_number" disabled="false" style="text-align:center" placeholder="Street Number"></input>
	        </td>
	       
      	</tr>


		<tr>
	        
	        <td colspan="2">
	        	<input class="formField" id="route" name="route" type="text" disabled="false" style="text-align:center" placeholder="Road"></input>
	        </td>
      	</tr>

      <tr>
	        
	        <td colspan="3">
	        	<input class="formField" id="locality" name="locality" type="text" disabled="false" style="text-align:center" placeholder="City"></input>
	        </td>
      </tr>

      <tr>
        <td class="">
        	<input class="formField" id="administrative_area_level_1" type="text" name="administrative_area_level_1" disabled="false" style="text-align:center" placeholder="State"></input>
        </td>
        
        
      </tr>


       <tr>
        
        <td class="">
        	<input class="formField" id="postal_code" name="postal_code"  type="text" disabled="false" disabled="true" style="text-align:center" placeholder="Zip code"></input>
        </td>
      </tr>
      <tr>
        
        <td class="" colspan="3">
        	<input class="formField" id="country" disabled="false" style="text-align:center" placeholder="Country" type="text"></input>
        </td>
      </tr>

      <tr>
        
        <td class="" colspan="3">
        	<input class="formField" id="client_reference_number" disabled="false" style="text-align:center" placeholder="Client Reference Number" type="text"></input>
        </td>
      </tr>

      <tr>     
        <td class="" colspan="3">
        	<input class="formField" id="saps_station" disabled="false" style="text-align:center" placeholder="SAPS Station" type="text"></input>
        </td>
      </tr>

      <tr>        
        <td class="" colspan="3">
        	<input class="formField" id="saps_case_number" disabled="false" style="text-align:center" placeholder="SAPS Case Number" type="text"></input>
        </td>
      </tr>






		<!-- <tr style="font: 11pt 'Arial';color:#ffffff">
		
			<td valign=middle>
				<select class="formField" id="province" name="province">
					<option id="#ffffff" value=""> Please select ...
					<?php
					$provinceSql    = "select id, name from provinces order by name asc";
					$provinceResult = mysqli_query($connectionID, $provinceSql) or die ("Couldn't query precinct/municipalities DB ... ...");
					while($row = mysqli_fetch_row($provinceResult))
						{
							echo "<option id='" .$row[0]. "' value='" .$row[0]. "'> " .$row[1];
						}
					?>
				</select>
			</td>
		</tr> -->

		<!-- <tr style="font: 11pt 'Arial';color:#ffffff">
		
			<td valign=middle>
				<select class="formField" id="district" name="district" >
				</select>
			</td>
		</tr> -->

		<!-- <tr style="font: 11pt 'Arial';color:#ffffff">
		
			<td valign=middle>
				<select class="formField" id="municipality" name="municipality" >
				</select>
			</td>
		</tr> -->

	<!-- 	<tr style="font: 11pt 'Arial';color:#ffffff">
	
		<td valign=middle>
			<select class="formField" id="ward" name="ward" >
			</select>
		</td>
	</tr> -->

	<!-- 	<tr style="font: 11pt 'Arial';color:#ffffff">
	
		<td valign=middle>
			<input type=text class="formField" id="area" name="area" style="text-align:center" placeholder="Area" >
		</td>
	</tr> -->


		<tr style="font: 11pt 'Arial';color:#ffffff">

			<td valign=middle>
				<select class="formField" id="case_type" name="case_type" style="text-align:center">
					<option id="#ffffff" value=""> Please select Case Type
					<?php
					$catSql = "select * from cases_types order by name asc";
					$catResult = mysqli_query($connectionID, $catSql) or die ("Couldn't query categories DB ... ...");
					while($row = mysqli_fetch_row($catResult))
						{
							echo "<option id='" .$row[5]. "' value='" .$row[0]. "'> " .$row[2];
						}
					?>
				</select>
			</td>
		</tr>
		<tr style="font: 11pt 'Arial';color:#ffffff">

			<td valign=middle>
				<select class="formField" id="case_sub_type" name="case_sub_type" style="text-align:center">
				</select>
			</td>
		</tr>

		
		<tr style="font: 11pt 'Arial';color:#ffffff">
			<td valign=middle>
			 	<textarea name="description" id="description" class="formField" wrap="physical" style="resize:none;height:100px;text-align:center" placeholder="Case details ..." onchange="this.value=toSentenceCase(this.value)"></textarea>
			</td>
		</tr>

	</table>

	<input type=hidden name="prob_priority" id="prob_priority" value="Urgent">
	<input type=hidden name="severity" id="severity" value="5">
</form>

</body>


</html>

<?php
}
?>

<?php


if($ACTION == "SUBMITCASE")
{

	$repID  = $_POST['repID'];

if ($repID > 0) {


}
else {


	$addressbook = 0;
	$email       = $cellphone."@siyaleader.net";


	$sqlt = "
				INSERT
					INTO
						`users`
								(
									`name`,
									`surname`,
									`email`,
									`cellphone`,
									`role`,
									`created_at`

								)  values (

									'$name',
									'$surname',
									'$email',
									'$cellphone',
									'5',	
									'1',
									 NOW()

								)
            ";


    $res       = mysqli_query($connectionID, $sqlt) or die ("Couldn't insert into Users table ... ...");
	$repID     = mysqli_insert_id($connectionID);


}




	$sql = "
				INSERT
					INTO
						`cases`
								(

									`category`,
									`sub_category`,
									`sub_sub_category`,
									`priority`,
									`description`,
									`precinct`,
									`gps_lng`,
									`gps_lat`,
									`created_at`,
									`user`,
									`department`,
									`status`,
									`reporter`,
									`addressbook`,
									`client_reference_number`,
									`saps_station`,
									`saps_case_number`,
									`street_number`,
									`route`,
									`locality`,
									`postal_code`,
									`country`,
									`administrative_area_level_1`


								)  values (

									'$category',
									'$sub_category',
									'$sub_sub_category',
									'$priority',
									'$description',
									'$precinct',
									'$gps_lng',
									'$gps_lat',
									 NOW(),
									 '$user',
									 '$department',
									 '$status',
									 '$repID',
									 '$addressbook',
									 '$saps_station',
									 '$saps_case_number',
									 '$street_number',
									 '$route',
									 '$locality',
									 '$postal_code',
									 '$country',
									 '$administrative_area_level_1',
									 '$client_reference_number'

								)
            ";

	$result    = mysqli_query($connectionID, $sql) or die ("Couldn't insert into problems table ... ...");
	$newCaseId = mysqli_insert_id($connectionID);

	if($prob_category == "Maintenance (Civil)")  {  $imageCategory = "mc";   $infoBoxBorder = "#ffff00";   }
	if($prob_category == "Maintenance (Electrical)")  {  $imageCategory = "me";   $infoBoxBorder = "#ff33a6";  }
	if($prob_category == "Maintenance (Mechanical)")  {  $imageCategory = "ma";   $infoBoxBorder = "#fe940b";  }
	if($prob_category == "Maintenance (Marine)")  {  $imageCategory = "mm";   $infoBoxBorder = "#333dc7";  }
	if($prob_category == "House Keeping")  {  $imageCategory = "hk";   $infoBoxBorder = "#00ee00";  }
	if($prob_category == "Traffic Management")  {  $imageCategory = "tr";  $infoBoxBorder = "#0a0c28";  }
	if($prob_category == "Environment")  {  $imageCategory = "en";   $infoBoxBorder = "#009000";  }
	if($prob_category == "Health")  {  $imageCategory = "he";   $infoBoxBorder = "#0df1ff";  }
	if($prob_category == "Port Operations Centre")  {  $imageCategory = "po";   $infoBoxBorder = "#e1e1e1";  }
	if($prob_category == "Property")  {  $imageCategory = "pr";   $infoBoxBorder = "#999999";  }
	if($prob_category == "Safety-Risk-Fire")  {  $imageCategory = "sr";   $infoBoxBorder = "#ff0000";  }
	if($prob_category == "Security")  {  $imageCategory = "se";   $infoBoxBorder = "#8a1ec7";  }

	$newMarkerImage = "markers/" .$imageCategory. "_pen.png";
?>


<html>
<head>
<title>Case Capture Submission</title>
<script language=javascript>

var boxContent = "<div style='width:250px;height:200px;overflow-y:auto;overflow-x:hidden'>";
boxContent += "<table border=0 style='color:#ffd40e;width:235px' cellpadding=2 cellspacing=0>";
boxContent += "<tr><td align='left' valign='top' nowrap><B>Case No :</B></td><td align='left'><?php echo $newCaseId; ?></td></tr>";
boxContent += "<tr><td align='left' valign='top' nowrap><B>GPS :</B></td><td align='left'><?php echo $GPS; ?></td></tr>"; // GPS coll
boxContent += "<tr><td align='left' valign='top' nowrap><B>Submitted :</B></td><td align='left'><?php echo date('Y-m-d H:i:s'); ?></td></tr>"; // submit_date coll
boxContent += "<tr><td align='left' valign='top' nowrap><B>Priority :</B></td><td align='left'><?php echo $prob_priority; ?></td></tr>"; // prob_priority coll
boxContent += "<tr><td align='left' valign='top' nowrap><B>Category :</B></td><td align='left'><?php echo $prob_category; ?></td></tr>"; // prob_category coll
boxContent += "<tr><td align='left' valign='top' nowrap><B>Status :</B></td><td align='left'>Pending</td></tr>"; // status coll
boxContent += "<tr><td align='left' valign='top' nowrap><B>Province :</B></td><td align='left'>KZN</td></tr>"; // Province coll
boxContent += "<tr><td align='left' valign='top' nowrap><B>Port :</B></td><td align='left'>Durban</td></tr>"; // District coll
boxContent += "<tr><td align='left' valign='top' nowrap><B>Precinct :</B></td><td align='left'><?php echo $prob_mun; ?></td></tr>";  // Municipality coll
boxContent += "<tr><td align='left' valign='top' nowrap><B>Reporter :</B></td><td align='left'><?php echo $ccg_nam. ' ' .$ccg_sur; ?></td></tr>";  // ccg_nam + ccg_sur
boxContent += "<tr><td align='left' valign='top' nowrap><B>Position :</B></td><td align='left'><?php echo $Position; ?></td></tr>";  // ccg_pos
boxContent += "<tr><td align='left' valign='top' nowrap><B>Contact No :</B></td><td align='left'><?php echo $ccg_mob; ?></td></tr>";  // ccg_mob
boxContent += "<tr><td align='left' valign='top' nowrap><B>Description :</B></td><td align='left'><?php echo $description; ?></td></tr>";  // prob_exp
boxContent += "<tr><td align='left' valign='top' nowrap><B>Last Activity :</B></td><td align='left'><?php echo date('Y-m-d H:i:s'); ?></td></tr>";  // Last person to have interacted on CMC
boxContent += "</table>";
boxContent += "</div>";
boxContent += "<table width=100% height=50 border=0 cellpadding=0 cellspacing=0><tr>";
boxContent += "<td align='center' valign='bottom'><a href='#' onclick='alert(\"Work in progress ... Watch this space ...\")'><img src='images/icon_trash.png' title='Remove Case' onmouseover='updateToolTip(\"Request for this case to be removed ...\")' onmouseout='updateToolTip(\"\")'></a></td>";
boxContent += "<td align='center' valign='bottom'><a href='#' onclick='alert(\"Work in progress ... Watch this space ...\")'><img src='images/icon_join.png' title='Combine Duplicate Case' onmouseover='updateToolTip(\"Combine this duplicated case with another ...\")' onmouseout='updateToolTip(\"\")'></a></td>";
boxContent += "<td align='center' valign='bottom'><a href='#' onclick='alert(\"Work in progress ... Watch this space ...\")'><img src='images/icon_weather.png' title='Weather Conditions' onmouseover='updateToolTip(\"View weather conditions for this case ...\")' onmouseout='updateToolTip(\"\")'></a></td>";
boxContent += "<td align='center' valign='bottom'><a href='#' onclick='alert(\"Work in progress ... Watch this space ...\")'><img src='images/icon_refer.png' title='Refer Case' onmouseover='updateToolTip(\"Refer this case to someone ...\")' onmouseout='updateToolTip(\"\")'></a></td>";
boxContent += "<td align='center' valign='bottom'><a href='#' onclick='showPhoto(\"\",\"<?php echo $infoBoxBorder; ?>\");killMenu();killLayerMenu()'><img id='photoIcon' src='images/icon_photo.png' title='View Photo' onmouseover='updateToolTip(\"View this case photo ...\")' onmouseout='updateToolTip(\"\")'></a></td>";
boxContent += "<td align='center' valign='bottom'><a href='#' onclick='killMenu();killLayerMenu();document.all.cmcFrame.src=\"http://www.siyaleader.co.za:8080/siyaleader-dbnports/live/CaseRequest/index.php?type=app&caller=&case=<?php echo $newCaseId; ?>&user=13&action=api&apiKey=52bd43d37ed62eb4c226e31841bc03dc\";showCMC()'><img src='images/icon_interact.png' title='Case Interaction' onmouseover='updateToolTip(\"Open this case in the Case Management Console ...\")' onmouseout='updateToolTip(\"\")'></a></td>";
boxContent += "</tr></table>";

</script>

</head>
<body ONLOAD="parent.captureSuccess('<?php echo $newCaseId; ?>','<?php echo $newMarkerImage; ?>','<?php echo $GPS; ?>','<?php echo $infoBoxBorder; ?>','<?php echo $imageCategory; ?>',boxContent);location='case_capture.php';" TEXT="#ffffff" LINK="#ffffff" VLINK="#ffffff" ALINK="#ffffff" style="margin:0;overflow:hidden;margin-bottom:0;margin-left:0;margin-right:0;margin-top:0">

<!-- ONLOAD="location='case_capture.php'" -->

</body>

</html>







<?php
}
?>



