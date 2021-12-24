var app=angular.module("sistemaAtencionCliente",[]);

app.directive("fileInput", function($parse){
  return{
    link: function($scope, element, attrs){
      element.on("change", function(event){
        var files = event.target.files;
        console.log(attrs.fileInput);
        $parse(attrs.fileInput).assign($scope, element[0].files);
        $scope.$apply();
      });
    }
  }
});

 	
							
app.controller("ticket",function($scope,$http,$rootScope,$interval){
	$rootScope.ticket = $scope;

	$scope.filterCriteria =	{ 
		"dni":"123456",
		"nombre":"test",
		"cola_id": "1",
		"status_id":"1",
		"ticket_number":"123456"
	}

	$scope.generarTicket = function(){
		
		
		if ($scope.dni=='undefined' || $scope.dni=='' || $scope.dni==null || $scope.dni==0){
			$("#mensajevalidacion_contenedor").fadeIn(50);
			$rootScope.mensajevalidacion.titulo_mensaje_validacion="Error en DNI";
			$rootScope.mensajevalidacion.cuerpo_mensaje_validacion="Debe Proporcionar un Numero de Identificacion";
			$('html,body').animate({scrollTop:100},'slow');
			$("#mensajevalidacion_contenedor").fadeOut(20000);
			return;
		}
	
		if ($scope.full_name=='undefined' || $scope.full_name=='' || $scope.full_name==null || $scope.full_name==0){
			$("#mensajevalidacion_contenedor").fadeIn(50);
			$rootScope.mensajevalidacion.titulo_mensaje_validacion="Error en Nombre";
			$rootScope.mensajevalidacion.cuerpo_mensaje_validacion="El nombre del Cliente no puede estar vacio";
			$('html,body').animate({scrollTop:100},'slow');
			$("#mensajevalidacion_contenedor").fadeOut(20000);
			return;
		}
		

		$scope.filterCriteria.dni = $scope.dni;
		$scope.filterCriteria.nombre = $scope.full_name;
		$scope.filterCriteria.status_id = 1;
		
		if($scope.sumTiempoTotalCola1 > $scope.sumTiempoTotalCola2){
			$scope.filterCriteria.cola_id = 2;
		}else{
			$scope.filterCriteria.cola_id = 1;
		}			
		
		var config = {
			transformRequest: angular.identity,
				headers: {
					'Content-Type': 'application/json'
				}
			};
		var form_data=JSON.stringify($scope.filterCriteria);
		var url="http://localhost/SAC/ticketCloud/ClienteRelationship/processTicket.json";
		$('#loader').show();
		$http.post(url,form_data,config)
				.then(
					function success(response){
						console.log("Succesfull");
						var data=response.data;
						
						console.log("=====================================");
						console.log(data.response);
						console.log("=====================================");
						if(data.response.code == 1){
							$('#loader').hide();
							$("#mensajevalidacion_contenedor_ok").fadeIn(50);
							$rootScope.mensajevalidacion_ok.titulo_mensaje_validacion_ok="Ticket Generado";
							$rootScope.mensajevalidacion_ok.cuerpo_mensaje_validacion_ok="Registro Exitoso";
							$('html,body').animate({scrollTop:100},'slow');
							$("#mensajevalidacion_contenedor_ok").fadeOut(20000);
							$scope.dni = '';
							$scope.full_name = '';
							$scope.getClientesWaiting();
				
						}else{
							$('#loader').hide();
							$("#mensajevalidacion_contenedor").fadeIn(50);
							$rootScope.mensajevalidacion.titulo_mensaje_validacion="Error";
							$rootScope.mensajevalidacion.cuerpo_mensaje_validacion="No se Pudo Generar el Ticket";
							$('html,body').animate({scrollTop:100},'slow');
							$("#mensajevalidacion_contenedor").fadeOut(20000);
							$scope.dni = '';
							$scope.full_name = '';
					
						}
					},function error(response){
							var error=response.data;
						    $('#loader').hide();
							console.log("Error: "+error.response.message);
							$("#mensajevalidacion_contenedor").fadeIn(50);
							$rootScope.mensajevalidacion.titulo_mensaje_validacion="Error";
							$rootScope.mensajevalidacion.cuerpo_mensaje_validacion="No se Pudo Generar el Ticket";
							$('html,body').animate({scrollTop:100},'slow');
							$("#mensajevalidacion_contenedor").fadeOut(20000);
							$scope.dni = '';
							$scope.full_name = '';
							
					}
					
				);
		
	}
	
	$scope.getClientesWaiting = function(){
		
	
		var config = {
			transformRequest: angular.identity,
				headers: {
					'Content-Type': 'application/json'
				}
			};
		var form_data=JSON.stringify($scope.filterCriteria);
		var url="http://localhost/SAC/ticketCloud/ClienteRelationship/viewAllClientRelationshipActive.json";

		$http.post(url,form_data,config)
				.then(
					function success(response){
						$scope.listClientInformationWaitingCola1 = [];
						$scope.listClientInformationWaitingCola2 = [];
						$scope.sumTiempoTotalCola1 = 0;
						$scope.sumTiempoTotalCola2 = 0;
						$scope.listClientInformation =  response.data.response.object;
						$scope.totalItems = $scope.listClientInformation.length;
						
						 if($scope.totalItems > 0) {
							 
							$scope.listClientInformation.forEach(function (entry) {
								 var aux = {
									dni: entry.cliente.dni,
                                    nombre: entry.cliente.nombre,
                                    cola: entry.cola.cola_id,
									duracion_cola: entry.cola.tiempo_duracion_min,
                                    status: entry.status.id,
                                    ticket_number: entry.ticket_number
                                }
								if(entry.cola_id == 1){
									$scope.listClientInformationWaitingCola1.push(aux);
									$scope.sumTiempoTotalCola1 = $scope.sumTiempoTotalCola1 + entry.cola.tiempo_duracion_min;
						
								}else{
									$scope.listClientInformationWaitingCola2.push(aux);
									$scope.sumTiempoTotalCola2 = $scope.sumTiempoTotalCola2 + entry.cola.tiempo_duracion_min;
								}
							});
							 
						 }else{
							$scope.listClientInformationWaitingCola1 = [];
							$scope.listClientInformationWaitingCola2 = [];
							$scope.sumTiempoTotalCola1 = 0;
							$scope.sumTiempoTotalCola2 = 0;
                            $scope.totalItems = 0;
						 }
						
					}
					
				);
		
	}
	
	
	$scope.atenderTicketCola1 = function(){
		$scope.listClientInformationWaitingCola1[0].status = 2;
		$scope.changeStatusClient($scope.listClientInformationWaitingCola1[0].ticket_number,2);
		$('#btn_llamado_cola1').attr('disabled', true);
		$('#countdown_cola1').show();
 

		var timer2 = "2:00";
		var interval = setInterval(function() {
			var timer = timer2.split(':');
			var minutes = parseInt(timer[0], 10);
			var seconds = parseInt(timer[1], 10);
			--seconds;
			minutes = (seconds < 0) ? --minutes : minutes;
			if (minutes < 0) clearInterval(interval);
			seconds = (seconds < 0) ? 59 : seconds;
			seconds = (seconds < 10) ? '0' + seconds : seconds;
			
			$('.countdown_cola1').html(minutes + ':' + seconds);
			timer2 = minutes + ':' + seconds;
			
			if(minutes == 0 && seconds == 0){
				
				$('#btn_llamado_cola1').attr('disabled', false);
				$scope.changeStatusClient($scope.listClientInformationWaitingCola1[0].ticket_number,3);
				$scope.listClientInformationWaitingCola1.shift();
				$('#countdown_cola1').hide();
			}
		
		}, 1000);
		
		
	}
	
	$scope.atenderTicketCola2 = function(){
		$scope.listClientInformationWaitingCola2[0].status = 2;
		$scope.changeStatusClient($scope.listClientInformationWaitingCola2[0].ticket_number,2);
		$('#btn_llamado_cola2').attr('disabled', true);
		$('#countdown_cola2').show();
		
		var timer2 = "3:00";
		var interval = setInterval(function() {
			var timer = timer2.split(':');
			var minutes = parseInt(timer[0], 10);
			var seconds = parseInt(timer[1], 10);
			--seconds;
			minutes = (seconds < 0) ? --minutes : minutes;
			if (minutes < 0) clearInterval(interval);
			seconds = (seconds < 0) ? 59 : seconds;
			seconds = (seconds < 10) ? '0' + seconds : seconds;
			
			$('.countdown_cola2').html(minutes + ':' + seconds);
			timer2 = minutes + ':' + seconds;
			
			if(minutes == 0 && seconds == 0){
				
				$('#btn_llamado_cola2').attr('disabled', false);
				$scope.changeStatusClient($scope.listClientInformationWaitingCola2[0].ticket_number,3);
				$scope.listClientInformationWaitingCola2.shift();
				$('#countdown_cola2').hide();
			}
		
		}, 1000);
		
	}
	
	
	$scope.changeStatusClient = function(ticketNumber,status_id){
		$scope.filterCriteria.ticket_number = ticketNumber;
		$scope.filterCriteria.status_id = status_id;
		var config = {
			transformRequest: angular.identity,
				headers: {
					'Content-Type': 'application/json'
				}
			};
		var form_data=JSON.stringify($scope.filterCriteria);
		var url="http://localhost/SAC/ticketCloud/ClienteRelationship/changeStatusClientRelationship.json";

		$http.post(url,form_data,config)
		.then(
			function success(response){
				if(status_id!=3){
					$("#mensajevalidacion_contenedor_ok").fadeIn(50);
					$rootScope.mensajevalidacion_ok.titulo_mensaje_validacion_ok="Ticket Atendido";
					$rootScope.mensajevalidacion_ok.cuerpo_mensaje_validacion_ok="El ticket: "+ticketNumber+" Esta siendo Procesado en este Momento.";
					$('html,body').animate({scrollTop:100},'slow');
					$("#mensajevalidacion_contenedor_ok").fadeOut(20000);
				}
			}
			
		);
	
	}
	
	$scope.getClientesWaiting();

});

app.controller("mensajevalidacion",function($scope,$http,$rootScope){	
	$rootScope.mensajevalidacion=$scope;
});

app.controller("mensajevalidacion_ok",function($scope,$http,$rootScope){	
	$rootScope.mensajevalidacion_ok=$scope;
});


	function uniconumeroDano(evt)
	{
		var keyPressed = (evt.which) ? evt.which : event.keyCode
		return !(keyPressed > 31 && (keyPressed < 48 || keyPressed > 57));
	}
	  
	function soloLetras(e) {
		key = e.keyCode || e.which;
		tecla = String.fromCharCode(key).toLowerCase();
		letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
		especiales = [8];

		tecla_especial = false
		for(var i in especiales) {
			if(key == especiales[i]) {
				tecla_especial = true;
				break;
			}
		}

		if(letras.indexOf(tecla) == -1 && !tecla_especial)
			return false;
	}

	function mixto(e) {
		key = e.keyCode || e.which;
		tecla = String.fromCharCode(key).toLowerCase();
		letras = " áéíóúabcdefghijklmnñopqrstuvwxyz1234567890";
		especiales = [8,44];

		tecla_especial = false
		for(var i in especiales) {
			if(key == especiales[i]) {
				tecla_especial = true;
				break;
			}
		}

		if(letras.indexOf(tecla) == -1 && !tecla_especial)
			return false;
	}
	
	function correo(e) {
		key = e.keyCode || e.which;
		tecla = String.fromCharCode(key).toLowerCase();
		letras = " áéíóúabcdefghijklmnñopqrstuvwxyz1234567890";
		especiales = [8,46,45,64,95];

		tecla_especial = false
		for(var i in especiales) {
			if(key == especiales[i]) {
				tecla_especial = true;
				break;
			}
		}

		if(letras.indexOf(tecla) == -1 && !tecla_especial)
			return false;
	}	
