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
$division_search_type = rtrim($division_search_type);

$district_search_type = $_POST['district_search_type'];

if ($division_search_type == 'Select A division Type') {
	$division_search_type = '';
}

if ($district_search_type == 'Select District') {
	$district_search_type = '';
}

if ($designation_search_type != '' && $division_search_type != '') {
	if ($district_search_type == '') {
		$sql = "SELECT * FROM asterisk.contact_person_number WHERE designation LIKE '%$designation_search_type%' AND division LIKE '%$division_search_type%'";
	} else {
		$sql = "SELECT * FROM asterisk.contact_person_number WHERE designation LIKE '%$designation_search_type%' AND division LIKE '%$division_search_type%' AND district LIKE '%$district_search_type%'";
	}
} else if ($designation_search_type != '') {
	$sql = "SELECT * FROM asterisk.contact_person_number WHERE designation LIKE '%$designation_search_type%'";
} else if ($division_search_type != '') {
	if ($district_search_type == '') {
		$sql = "SELECT * FROM asterisk.contact_person_number WHERE division LIKE '%$division_search_type%'";
	} else {
		$sql = "SELECT * FROM asterisk.contact_person_number WHERE division LIKE '%$division_search_type%' AND district LIKE '%$district_search_type%'";
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
		<!-- <th scope="col">Thana</th> -->
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
			<!-- <td><?php echo  $row['thana'] ?></td> -->
		</tr>
	<?php $i++;
	} ?>
</table>