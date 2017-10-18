$(function(){
	$("#fechaInn").datepicker({ dateFormat: "yy-mm-dd" });

});

$(function(){
	$("#fechaOut").datepicker({ dateFormat: "yy-mm-dd" });
});

function enviarDatos(idCliente, idAuto, fechaOut, fechaInn){

	var parametros = {
		"idCliente" : idCliente,
		"idAuto" : idAuto,
		"fechaOut" : fechaOut,
		"fechaInn" : fechaInn
	};

	$.ajax({
		data: parametros,
		url: 'renting.php',
		type: 'post',
		beforeSend: function(){
			$("#procesando").html("Procesando, Favor Espera");
		},
		error: function(){
			alert('ERROR EN EL PROCESO');
		},

		success: function(response){
		$("#procesando").empty();
		$("#procesando").append(response);
		}
	});
}


function gettingClientId(minfo){
	var valorClientId = {
		"minfo" : minfo
	};

	$.ajax({
		type: "POST",
		url: "getClientId.php",
		data: valorClientId,
		dataType: "html",
		beforeSend: function(){
			$("#myModal").html('Procesando');
		},
		error: function(){
			alert('Error En El Proceso');
		},
		success: function(response){
			$("#myModal").empty();
			$("#myModal").append(response);
		}
	});	
}


function gettingCarId(carinfo){
	var valorAutoId = {
		"carinfo" : carinfo
	};

	$.ajax({
		type: "POST",
		url: "carinfomodal.php",
		data: valorAutoId,
		dataType: "html",
		beforeSend: function(){
			$("#myModal").html('Procesando');
		},
		error: function(){
			alert('Error En El Proceso');
		},
		success: function(response){
			$("#myModal").empty();
			$("#myModal").append(response);
		}
	});	
}


$(document).ready(function() {
	var busquedaClientes;

	$("#datosCliente").focus();
	$("#datosCliente").keyup(function(e){
		busquedaClientes = $("#datosCliente").val();

		$.ajax({
			type: "POST",
			url: "modalreporteclientes.php",
			data: "b="+busquedaClientes,
			dataType: "html",
			beforeSend: function(){
				$("#respuesta").html("Procesando");
			},
			error: function(){
				alert("Error De Petición De Datos");
			},
			success: function(data){
				$("#respuesta").empty();
				$("#respuesta").append(data);
			}
		});
	});
});


$(document).ready(function() {
	var busquedaAutos;

	$("#datosAuto").focus();
	$("#datosAuto").keyup(function(e){
		busquedaAutos = $("#datosAuto").val();

		$.ajax({
			type: "POST",
			url: "modalreporteautos.php",
			data: "bc="+busquedaAutos,
			dataType: "html",
			beforeSend: function(){
				$("#answer").html("Procesando");
			},
			error: function(){
				alert("Error De Petición De Datos");
			},
			success: function(data){
				$("#answer").empty();
				$("#answer").append(data);
			}
		});
	});
});


