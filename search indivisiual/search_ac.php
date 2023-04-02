<?php
include 'mylink.php';
?>
<?php
include 'mydb.php';
?>

<div id="tabs-3">
	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<div class="box">
				<div class="box-header">
					<div class="box-name">
						<i class="fa fa-search"></i>
						<span>Search Contact Information</span>
						<input type="hidden" class="form-control" id="this_id" name="this_id" value="<?php echo $this_id;  ?>">
						&nbsp;&nbsp;&nbsp;
						<i class="fa fa-mobile-phone fa-1x"></i>
						<span><?php echo $phone; ?> </span>
					</div>

				</div>
				<div class="box-content" style="padding-top: 0px; padding-bottom: 0px;">
					<form id="defaultForm" method="post" action="" class="form-horizontal" style="padding: 0px; margin: 0px;">
						<fieldset>

							<div class="form-group has-feedback">
								<div class="col-sm-4">
									<select class="form-control select2" name="designation_search_type" id="designation_search_type">
									<?php
										$query = mysql_query("SELECT DISTINCT(designation) FROM `asterisk`.`contact_person_number`");

										?>
										<option value="">Search By Designation</option>
										<?php while ($row = mysql_fetch_assoc($query)) { ?>
											<option value="<?php echo $row['designation']; ?>"><?php echo $row['designation']; ?></option>

										<?php } ?>
									</select>
								</div>

								<div class="col-sm-4">
									<select class="form-control" id="division_search_type" name="division_search_type">
										<?php
										$query = mysql_query("SELECT * FROM `ticket_dev`.`divisions`");

										?>
										<option value="">Select A division Type</option>
										<?php while ($row = mysql_fetch_assoc($query)) { ?>
											<option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>

										<?php } ?>
									</select>
								</div>


								<div class="col-sm-3">
									<select class="form-control select2" name="district_search_type" id="district_search_type">
										<option value="">Select A District  Type</option>

									</select>
								</div>




								<div class="col-sm-1">
								<button type="button" class="btn btn-xs btn-primary btn-label-left" onclick="searchData();" style="margin: -2px;margin-left: -16px;">										<span><i class="fa fa-share"></i> Search </span>
									</button>
								</div>
							</div>
						</fieldset>

					</form>
				</div>

			</div>
		</div>

	</div>
</div>

<div id="data_container" style="overflow-x:auto;"></div>
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script type="text/javascript">

	function searchData() {
		let designation_search_type = $('#designation_search_type').val();
		let division_search_type =  $("#division_search_type option:selected" ).text();
		let district_search_type =  $("#district_search_type option:selected" ).text();

		$.ajax({
			url: 'search_ac_process.php',
			type: 'POST',
			data: {
				division_search_type: division_search_type,
				district_search_type: district_search_type,
				designation_search_type: designation_search_type
			},
			success: function(result) {
				console.log(result);

				$('#data_container').html(result);
			}
		});

	}

	$("#division_search_type").change(function() {
		var division = $("#division_search_type").val();
		$.ajax({
			url: 'district.php',
			type: 'POST',
			data: {
				division: division,
			},
			success: function(result) {
				$('#district_search_type').html(result);
			}
		});
	});







</script>