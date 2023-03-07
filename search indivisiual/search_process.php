<?php
include 'mylink.php';
?>
<?php
include 'mydb.php';
include 'myfunction.php';
?>
<script src="js/jquery.min.js"></script>
<?php

$designation_search_type = $_POST['designation_search_type'];
$division_search_type = $_POST['division_search_type'];
$district_search_type = $_POST['district_search_type'];
$data_type_search = $_POST['data_type_search'];




$dev_sql = "SELECT * FROM `ticket_dev`.`divisions` WHERE `id` = '".$division_search_type."'";
$result=mysql_query($dev_sql);
$row = mysql_fetch_assoc($result);

$division_name = $row['name'];


 $dis_sql = "SELECT * FROM `ticket_dev`.`districts` WHERE `division_id` = '".$district_search_type."'";
 $dis_query=mysql_query($dis_sql);
 $row = mysql_fetch_assoc($dis_query);

 $dis_name = $row['name'];



if ($designation_search_type != 'emptyDesi') {
	if ($data_type_search != 'emptyData' && $division_search_type != 'emptyDiv') {
		$sql = "SELECT * FROM asterisk.contact_person_number WHERE designation LIKE '%$designation_search_type%' AND contact LIKE '%$data_type_search%' AND division LIKE '%$division_name%' AND district LIKE '%$dis_name%'";
	} elseif ($division_search_type != 'emptyDiv') {
		$sql = "SELECT * FROM asterisk.contact_person_number WHERE designation LIKE '%$designation_search_type%' AND division LIKE '%$division_name%' AND district LIKE '%$dis_name%'";
	} elseif ($data_type_search != 'emptyData') {
		$sql = "SELECT * FROM asterisk.contact_person_number WHERE designation LIKE '%$designation_search_type%' AND contact LIKE '%$data_type_search%'";
	}else if($designation_search_type != 'emptyDesi'){
		echo $sql = "SELECT * FROM asterisk.contact_person_number WHERE designation LIKE '%$designation_search_type%'";

	}
} else {
	if ($data_type_search != 'emptyData' && $division_search_type != 'emptyDiv') {
		$sql = "SELECT * FROM asterisk.contact_person_number WHERE contact LIKE '%$data_type_search%' AND division LIKE '%$division_name%' AND district LIKE '%$dis_name%'";
	} elseif ($division_search_type != 'emptyDiv') {
	    $sql = "SELECT * FROM asterisk.contact_person_number WHERE division LIKE '%$division_name%' AND district LIKE '%$dis_name%'";
	} elseif ($data_type_search != 'emptyData') {
		// $division_search_type='';
		// $designation_search_type='';
		$sql = "SELECT * FROM asterisk.contact_person_number WHERE contact LIKE '%$data_type_search%'";
	}
}

$result = mysql_query($sql);

?>


<table id="customers">

		<tr>
			<th scope="col">ID</th>
			<th scope="col">Name</th>
			<th scope="col">Designation</th>
			<th scope="col">Contact</th>
			<th scope="col">Office Contact</th>
			<th scope="col">Email</th>
			<th scope="col">Address</th>
			<th scope="col">Division</th>
			<th scope="col">District</th>
			<th scope="col">Thana</th>
		</tr>
		<?php
		$i = 1;
		while ($row = mysql_fetch_array($result)) {
			$date = explode(" ", $row['date']);
		?>
			<tr>
				<td><?php echo $row['id'] ?></td>
				<td><?php echo $row['name'] ?></td>
				<td><?php echo  $row['designation'] ?></td>
				<td><?php echo  $row['contact'] ?></td>
				<td><?php echo  $row['office_contact'] ?></td>
				<td><?php echo  $row['email'] ?></td>
				<td><?php echo  $row['address'] ?></td>
				<td><?php echo  $row['division'] ?></td>
				<td><?php echo  $row['district'] ?></td>
				<td><?php echo  $row['thana'] ?></td>
			</tr>
		<?php $i++;
		} ?>
</table>