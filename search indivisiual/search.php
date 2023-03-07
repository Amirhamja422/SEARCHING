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
								<div class="col-sm-2">
									<select class="form-control select2" name="designation_search_type" id="designation_search_type">
										<option value="">Search- By</option>
										<option value="চেয়ারম্যান">চেয়ারম্যান</option>
										<option value="সদস্য">সদস্য</option>
										<option value="সচিব">সচিব</option>
									</select>
								</div>

								<div class="col-sm-3">
									<select class="form-control" id="division_search_type" name="division_search_type">
										<?php
										$query = mysql_query("SELECT * FROM `ticket_dev`.`divisions`");

										?>
										<option value="">Select A divisions</option>
										<?php while ($row = mysql_fetch_assoc($query)) { ?>
											<option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>

										<?php } ?>
									</select>
								</div>


								<div class="col-sm-3">
									<select class="form-control select2" name="district_search_type" id="district_search_type">
										<option value="">District Type</option>

									</select>
								</div>


								<div class="col-sm-2">
									<input type="text" class="form-control" id="data_type_search" name="data_type_search">
								</div>


								<div class="col-sm-2">
									<button type="button" class="btn btn-primary btn-label-left" onclick="searchData();">
										<span><i class="fa fa-share"></i> Search </span>
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
	$("#division_search_type").change(function() {
		var division = $("#division_search_type").val();
		$('#designation_search_type').val('');
		$('#data_type_search').val('');
		$('#district_search_type').val('');
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

	function searchData() {
		let designation_search_type = $('#designation_search_type').val();
		let division_search_type = $('#division_search_type').val();
		let district_search_type = $('#district_search_type').val();
		let data_type_search = $('#data_type_search').val();

		if (designation_search_type == '') {
			designation_search_type = 'emptyDesi'
		}
		if (division_search_type == '') {
			division_search_type = 'emptyDiv'
		}
		if (district_search_type == '') {
			district_search_type = 'emptyDis'
		}
		if (data_type_search == '') {
			data_type_search = 'emptyData'
		}

		$.ajax({
			url: 'search_ac_process.php',
			type: 'POST',
			data: {
				division_search_type: division_search_type,
				district_search_type: district_search_type,
				data_type_search: data_type_search,
				designation_search_type: designation_search_type
			},
			success: function(result) {
				console.log(result);

				$('#data_container').html(result);
			}
		});

	}


 	$("#designation_search_type").change(function() {
		var division = $("#division_search_type").val();
		// let district_search_type = $('#district_search_type').val('');
		// let data_type_search = $('#data_type_search').val('');



	    // $('#designation_search_type').val('');
		// $('#division_search_type').val('');
		// $('#data_type_search').val('');	
	
	});

</script>