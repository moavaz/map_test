<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('layouts/common_css'); ?>
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 col-md-offset-4">
				<h1>
					maps and people
					<!-- HTML -->
					
				</h1>
			</div>
			<div class="col-md-6">
				<h1>
					<button type="button" id="ct-btn" class="btn btn-sm btn-primary" data-toggle="modal">Add new customer</button>
				</h1>
				<div id="chartdiv"></div>
			</div>	

			<div class="col-md-6">	
				<!-- BEGIN EXAMPLE TABLE PORTLET-->
				<div class="portlet box green">
					<div class="portlet-title">

						<div class="actions">
							<div class="btn-group">

								<a class="btn btn-sm btn-primary"  id="search"><i class="glyphicon glyphicon-pencil"></i> Search</a>

							</div>
						</div>



						<div class="caption">
							<i class="fa fa-globe"></i>Customers </div>
							<div class="tools"> </div>
						</div>
						<div class="portlet-body">

							

							<form id="date_form" class="form-horizontal" method="post">
								<div class="form-body">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-md-5 col-form-label"><strong>Sale From Date</strong></label>
												<div class="col-md-6">
													<input name="from_date" id="from_date" placeholder="yyyy-mm-dd" class="form-control datepicker" type="text">
													<span class="help-block"></span>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-md-5 col-form-label"><strong>Sale To Date</strong></label>
												<div class="col-md-6">
													<input name="to_date" id="to_date" placeholder="yyyy-mm-dd" class="form-control datepicker" type="text">
													<span class="help-block"></span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</form>

							<table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="example" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th class="all">Customer Name</th>
										<th class="min-phone-l">Monthly charges</th>
										<!-- <th class="desktop"> Project Type</th>  -->
										<th class="desktop">Sms charges</th>
										<th class="desktop">Server charges </th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->    
				</div>  
			</div>
		</div>
		<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h3 class="modal-title" id="exampleModalLabel">Add customer</h3>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form id="ct-form" action="" method="post" autocomplete="off" enctype="multipart/form-data">
							<div class="form-group">
								<label for="ct_name">Customer Name</label>
								<input type="text" class="form-control" id="ct_name" aria-describedby="emailHelp" placeholder="Enter customer name"
								name="ct_name" required>
							</div>
							<div class="form-group">
								<label for="ct_monthly">Monthly charges</label>
								<input type="text" class="form-control" id="ct_monthly" aria-describedby="emailHelp" placeholder="Enter customer monthly charges" name="ct_monthly" required>
							</div><div class="form-group">
								<label for="ct_sms">Sms charges</label>
								<input type="text" class="form-control" id="ct_sms" aria-describedby="emailHelp" placeholder="Enter customer sms charges" name="ct_sms" required>
							</div><div class="form-group">
								<label for="ct_server">Server charges</label>
								<input type="text" class="form-control" id="ct_server" aria-describedby="emailHelp" placeholder="Enter customer server charges" name="ct_server" required>
							</div>
							<div class="form-group">
								<label for="name">
								Customer Picture</label>
								<input type="file"  id="image" name="ct_image"  required >
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary">Save changes</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<?php $this->load->view('layouts/common_js'); ?>
		<script type="text/javascript">
			var from_date = 'null';
			var to_date = 'null';
			$(document).ready(function(){  

				function urlReload(){						//reload acording to date
    // alert(encodeURI(cust))
    table.ajax.url("<?php echo site_url('HomeController/getAllCustomersDatatables')?>/"+from_date+"/"+to_date).load();
    var amount=0;
    $('#table tbody tr td:nth-child(4)').each( function(){
      //add item to array
      if ($.isNumeric($(this).text())) {
      	amount += parseInt($(this).text());
      }
  });
    $("#total_amount").val(amount);
}

$("#search").on("click",function(){  			//search functions
	from_date = 'null';
	to_date = 'null';
	if($("#from_date").val() != ''){
		from_date = $("#from_date").val();
	}
	if($("#to_date").val() != ''){
		to_date = $("#to_date").val();
	}
	if((from_date == 'null' && to_date != 'null') || (from_date != 'null' && to_date == 'null')){
		alert("Please enter both Dates to search");
	}else{
		urlReload();
	}
});

				$('.datepicker').datepicker({  						//datepicker intitalization 
					autoclose: true,
					format: "yyyy-mm-dd",
					todayHighlight: true,
					todayBtn: true,
					todayHighlight: true,
					setDate: new Date()

				});
			  							table = $('#example').DataTable({ 							//datatables intitalization 
			  								"ajax": {
			  									"url": "<?php echo site_url('HomeController/getAllCustomersDatatables')?>/"+from_date+"/"+to_date,
			  									"type": "POST"
			  								},
			  							});
				$('#ct-btn').click(function(){							// add new customer button
    $('#ct-form')[0].reset(); // reset form on modals
    $('#exampleModal').modal('show');
    $('#ct-form').attr('action', '<?php echo base_url();?>HomeController/createCustomer');
});
				$.ajax({																//ajax call for customers to show in map				
					url: "<?php echo base_url(); ?>HomeController/getAllCustomers" , 
					type: 'POST',
				// data: new FormData($('#'+formid)[0]),
				// processData: false,
				// contentType:false,
				dataType: 'json',
				success: function(data)
				{  	
					var getUrl = window.location.origin
					// console.log(data);
					// maps script start here
					// var descriptionBurgundy = `<strong>Customer Name: </strong> ${data[0]['customer_name']} <br> <strong>Monthly charges: </strong>${data[0]['monthly_charges']} <br> <strong>Sms charges: </strong>${data[0]['sms_charges']} <br> <strong>Server charges: </strong>${data[0]['server_charges']} <br> <img src="${getUrl}/map_test/uploads/${data[0]["customer_pic"]}" width="150px" height="100px" />` ;

					// var descriptionBrittany = 'Brittany (French: Bretagne [bʁə.taɲ] ; Breton: Breizh, pronounced [brɛjs]; Gallo: Bertaèyn) is a cultural region in the north-west of France.<br /><br /><b>Coat of arms</b><br /><img src="http://upload.wikimedia.org/wikipedia/commons/thumb/2/26/COA_fr_BRE.svg/545px-COA_fr_BRE.svg.png" style="width: 100px;" /><br /><br /><b>Scenerey</b><br /><img src="http://upload.wikimedia.org/wikipedia/commons/thumb/7/7d/Bretagne_Finistere_PointeduRaz15119.jpg/220px-Bretagne_Finistere_PointeduRaz15119.jpg" /><br />';

					var targetSVG = "M9,0C4.029,0,0,4.029,0,9s4.029,9,9,9s9-4.029,9-9S13.971,0,9,0z M9,15.93 c-3.83,0-6.93-3.1-6.93-6.93S5.17,2.07,9,2.07s6.93,3.1,6.93,6.93S12.83,15.93,9,15.93 M12.5,9c0,1.933-1.567,3.5-3.5,3.5S5.5,10.933,5.5,9S7.067,5.5,9,5.5 S12.5,7.067,12.5,9z";
					var images=[];
/**
 * Define SVG path for target icon
 */

 for (var i = 0; i < data.length; i++) {
 	images[i] = {
 		"svgPath": targetSVG,
 			// "zoomLevel": 5,
 			"scale": 0.5,
 			"title": "remainings",
 			"latitude": 31.582045+i,
 			"longitude": 74.329376	+i,
 			"description": `<strong>Customer Name: </strong> ${data[i]['customer_name']} <br> <strong>Monthly charges: </strong>${data[i]['monthly_charges']} <br> <strong>Sms charges: </strong>${data[i]['sms_charges']} <br> <strong>Server charges: </strong>${data[i]['server_charges']} <br> <img src="${getUrl}/map_test/uploads/${data[i]["customer_pic"]}" width="150px" height="100px" />`,
 			"color" : "red"

 		};
 	}


/**
 * Create the map
 */
 var map = AmCharts.makeChart( "chartdiv", {
 	"type": "map",
 	"projection": "winkel3",
 	"theme": "light",
 	"imagesSettings": {
 		"rollOverColor": "#089282",
 		"rollOverScale": 3,
 		"selectedScale": 3,
 		"selectedColor": "#089282",
 		"color": "#13564e"
 	},
 	"areasSettings": {
 		"autoZoom": false,
 		"color": "#1A5FFF",
 		"rollOverColor": "#00298B",
 		"descriptionWindowY": 20,
 		"descriptionWindowX": 550,
 		"descriptionWindowWidth": 280,
 		"descriptionWindowHeight": 330,
 		"unlistedAreasColor": "#15A892",
 		"outlineThickness": 0.1
 	},

 	"dataProvider": {
 		"map": "worldLow",
 		"images": images,
 		"areas": [{
 			"id": "PK",
 			"color": "green",
 			"autoZoom": true
 		}],
 	}
 	// "export": {
 	// 	"enabled": true
 	// }
 } );
 //maps script end here
 var mapObject = map.getObjectById('PK');
 map.clickMapObject(mapObject);
 reload();
}

           //success function end here
       });//ajax call end here
		}); //jquery end here
		// console.log(map);

		function reload(){
			table.ajax.reload(null,false);
		}
	</script>
</body>
</html>