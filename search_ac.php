<?php
	include 'mylink.php';	
	?>
	<?php
	include 'mydb.php';
	?>

<div id="tabs-3">
<div class="row">
	<div class="col-xs-12 col-sm-12">
		<div class="box" >
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

						<!--select sms receiver-->
						<div class="form-group has-feedback">															
							 <div class="col-sm-4">
							 <select class="form-control" id="search_cat"  name="search_cat">
									<option value="">Select Search Type</option>
									<option value="All">All</option> 
									<option value="division">Division</option> 
									<option value="district">District</option> 
									<option value="contact">Contact No</option>
 
								</select>
							 </div>
								<div class="col-sm-3">
								<input type="text" class="form-control" id="typedata" name="" disabled>
								<input type="text" class="form-control" id="typedataall" name="" disabled>

								<?php
									$query = mysql_query("SELECT * FROM `ticket_dev`.`divisions`");

								?>
								<select class="form-control" name="division_view" id="division_view">
								<option value="">Select A divisions</option>
								<?php while($row = mysql_fetch_assoc($query)){?>
									<option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></option>

								<?php } ?>
								</select>


								</select>  
								<?php
								 $query2 = mysql_query("SELECT * FROM `ticket_dev`.`districts`");
								?>
								<select class="form-control" name="district_view" id="district_view">
								<option value="">Select A district</option>
								<?php while($row1 = mysql_fetch_assoc($query2)){?>
									<option value="<?php echo $row1['name']; ?>"><?php echo $row1['name']; ?></option>

								<?php } ?>
								</select>

							</div>

							<div class="col-sm-3">
								<select class="form-control select2"  name="designation_search_type" id="designation_search_type">
									<option value="">Search By</option> 
									<option value="চেয়ারম্যান">চেয়ারম্যান</option> 
									<option value="সদস্য">সদস্য</option> 
									<option value="সচিব">সচিব</option> 
								</select>
							</div>
					

							<div class="col-sm-2">
								<button type="button" class="btn btn-primary btn-label-left" onclick="searchData();">
									<span><i class="fa fa-share"></i>  Search  </span> 
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
<script
  src="https://code.jquery.com/jquery-3.6.3.min.js"
  integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
  crossorigin="anonymous"></script>
<script type="text/javascript">

function searchData() {
    let search_cat = $('#search_cat').val();
    let typedata = $('#typedata').val();
    let division_view = $('#division_view').val();
	let district_view = $('#district_view').val();
	let designation_search_type = $('#designation_search_type').val();

	


    $.ajax({
      url:'search_ac_process.php',
      type:'POST',
      data: {
        search_cat:search_cat,
        typedata:typedata,
        division_view:division_view,
		district_view:district_view,
		designation_search_type:designation_search_type,


      },
      success: function (result) {
        $('#data_container').html(result);
        console.log(result);
      }
    });
  }

$('#division_view').hide();
$('#district_view').hide();
$('#typedataall').hide();
$('#search_cat').change( function(){
    var search_cat = $('#search_cat').val();
	if (search_cat == 'division') {
      $('#typedata').hide();
      $('#typedataall').hide();
	  $('#district_view').hide();
      $('#division_view').show();
	}else if(search_cat == 'district'){
	  $('#typedata').hide();
      $('#typedataall').hide();
      $('#division_view').hide();
	  $('#district_view').show();

	}else if(search_cat == 'contact'){
	  $('#typedataall').hide();
	  $('#typedata').removeAttr('disabled');
      $('#typedata').css("display","block");
      $('#division_view').hide();
	  $('#district_view').hide();
	}
  });
</script>