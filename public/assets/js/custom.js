$(document).ready(function(){

	$(".size_product").on('click',function(){
		var price=$(this).data('price');
		var qty=$(".qty").val();
		changeSize(price,qty);
	});

	$(".value-press").on('click',function(){
		var price=$(".size_product:checked").data('price');
		var qty=$(".qty").val();
		if(!price){
			price=0
		}
		
		changeSize(price,qty);
	})

	function changeSize(prize,qty)
	{
		$(".price").val(prize*qty)
		$("#price").html(prize*qty)
	}

	$("#is_dropship").on('change',function(){
		console.log(this.checked)
		if(this.checked){
			$(".coba").html(
				`<div class="col-lg-12">
				<input type="text" placeholder="Nama Pengirim" name="sender_dropship" class="single-input-wrapper" required>
				</div>
				<div class="col-lg-12">
				<input type="text" placeholder="Telepon Pengirim" name="phone_dropship" class="single-input-wrapper" required>
				</div>`
				)
		} else {
			$(".coba").html("")
		}
	})

	if($('select').length) {

		// Province
		$('#province').selectize();
		$.ajax({
			url: "http://127.0.0.1:8000/rajaongkir/province",
			success: function(response) {
				console.log('province',response)
				var selectize = $("select[name=province]")[0].selectize;
				response.rajaongkir.results.forEach(function(province) {
					selectize.addOption({
						value: province.province_id+'|'+province.province,
						text: province.province 
					});
				});
			},
			error: function(xhr, status, error) {
				console.error(error);
			}
		});

		// City
		$('#city').selectize();
		$("select[name=province]").change(function() {
			var selectedProvince = $(this).val().split('|')[0];

			$.ajax({
				url: "http://127.0.0.1:8000/rajaongkir/city",
				method: "GET",
				data: { province_id: selectedProvince },
				success: function(response) {
					var selectize = $("select[name=city]")[0].selectize;
					selectize.clearOptions();
					response.rajaongkir.results.forEach(function(city) {
						selectize.addOption({
							value: city.city_id+'|'+city.city_name,
							text: city.city_name
						});
					});
					selectize.refreshItems();
					console.log(response)
				},
				error: function(xhr, status, error) {
					console.error(error);
				}
			});
		});

		  // District
		  $('#district').selectize();
		  $("select[name=city]").change(function() {
		  	var selectedCity = $(this).val().split('|')[0];

		  	$.ajax({
		  		url: "http://127.0.0.1:8000/rajaongkir/kecamatan",
		  		method: "GET",
		  		data: { city_id: selectedCity },
		  		success: function(response) {
		  			var selectize = $("select[name=district]")[0].selectize;
		  			selectize.clearOptions();
		  			response.rajaongkir.results.forEach(function(district) {
		  				selectize.addOption({
		  					value: district.subdistrict_id,
		  					text: district.subdistrict_name
		  				});
		  			});
		  			selectize.refreshItems();
		  			console.log(response);
		  		},
		  		error: function(xhr, status, error) {
		  			console.error(error);
		  		}
		  	});
		  });

  // Expedisi
  $('#expedisi').selectize();
  $('#paket').selectize();
  $("select[name=expedisi]").change(function() {
  	var selectedExpedisi = $(this).val();
  	var selectedSubdistrict = $("select[name=district]").val();
  	var berat = $("input[name=berat]").val();
  	console.log(selectedExpedisi);
  	console.log(selectedSubdistrict);
  	console.log(berat);
  	$.ajax({
  		url: "http://127.0.0.1:8000/rajaongkir/expedisi",
  		method: "GET",
  		data: {
  			expedisi: selectedExpedisi,
  			subdistrict:selectedSubdistrict,
  			berat:berat
  		},
  		success: function(response) {
  			var selectize = $("select[name=paket]")[0].selectize;
  			selectize.clearOptions();
  			response.rajaongkir.results[0].costs.forEach(function(paket) {
  				selectize.addOption({
  					value: paket.service+'|'+paket.cost[0].value+'|'+paket.cost[0].etd,
  					text: paket.service+' - '+paket.cost[0].value
  				});
  			});
  			selectize.refreshItems();
  			console.log(response);
  		},
  		error: function(xhr, status, error) {
  			console.error(error);
  		}
  	});
  });

  $("select[name=paket]").change(function(){
  	var harga=$(this).val();
  	var subtotal=$("#subtotal").html();
  	var shipping_cost=harga.split('|')[1];
  	var total=parseInt(subtotal)+parseInt(shipping_cost);
  	$("#shipping_cost").html(shipping_cost);
  	$("#total").html(total)
  	console.log(total);
  })


}

})