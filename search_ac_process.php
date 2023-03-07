<?php
include 'mylink.php';
?>
<?php
include 'mydb.php';
include 'myfunction.php';
?>
<script src="js/jquery.min.js"></script>
<?php

$search_cat =$_POST['search_cat'];
$typedata =$_POST['typedata'];
$division_view =$_POST['division_view'];
$district_view =$_POST['district_view'];
$designation_search_type =$_POST['designation_search_type'];




if ($search_cat != '') {
	$phoneNumber = $search_cat;
}

?>

<table class="table table-striped">
	<thead>
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
	</thead>
	<tbody>
		<?php
		$i = 1;
		if ($search_cat=='division') {
			$sql = mysql_query("SELECT * FROM `asterisk`.`contact_person_number` WHERE `division`='$division_view'");

		}else if($search_cat=='district'){
			$sql = mysql_query("SELECT * FROM `asterisk`.`contact_person_number` WHERE `district`='$district_view'");

		}else if($search_cat=='contact'){
			$sql = mysql_query("SELECT * FROM `asterisk`.`contact_person_number` WHERE `contact`='$typedata'");

		}else if($search_cat=='All'){
			$sql = mysql_query("SELECT * FROM `asterisk`.`contact_person_number`");

		}
		else{
			$sql = mysql_query("SELECT * FROM `asterisk`.`contact_person_number` WHERE `designation` like '$designation_search_type'");
            echo "SELECT * FROM `asterisk`.`contact_person_number` WHERE `designation` in  '$designation_search_type'";
		}
		while ($row = mysql_fetch_array($sql)) {
			$date = explode(" ", $row['date']);
		?>
			<tr>
				<th scope="row">1</th>
				<td><?php echo $row['id']?></td>
				<td><?php echo $row['name']?></td>
				<td><?php echo  $row['designation'] ?></td>
				<td><?php echo  $row['contact'] ?></td>
				<td><?php echo  $row['office_contact'] ?></td>
				<td><?php echo  $row['email'] ?></td>
				<td><?php echo  $row['address'] ?></td>
				<td><?php echo  $row['division'] ?></td>
				<td><?php echo  $row['district'] ?></td>
				<td><?php echo  $row['thana'] ?></td>


			</tr>

		<?php
			$i++;
		}
		?>
	</tbody>
</table>