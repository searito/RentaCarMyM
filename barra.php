<!-- BARRA DE NAVEGACION-->
		
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
			    	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			        	<span class="sr-only">Toggle navigation</span>
			        	<span class="icon-bar"></span>
			        	<span class="icon-bar"></span>
			        	<span class="icon-bar"></span>
			      	</button>
			      <a class="navbar-brand" href="index.php"><span class="glyphicon glyphicon-home" title="Inicio"></span></a>
			    </div>

				<!-- MENU DESPLEGABLE PARA CLIENTES-->
			    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			     	<ul class="nav navbar-nav">
			        	<li class="dropdown">
			          	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" 
			          	   aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Clientes <span class="caret"></span></a>
			          		<ul class="dropdown-menu">
			            		<li><a href="client-list.php"><span class="glyphicon glyphicon-list"></span> Lista De Clientes</a></li>
			            		<li role="separator" class="divider"></li>
			            		<li><a href="agregar-cliente.php"><span class="glyphicon glyphicon-plus"></span> Agregar</a></li>
					            <li role="separator" class="divider"></li>
					            <li><a href="buscar-cliente.php"><span class="glyphicon glyphicon-search"></span> Búsqueda De Clientes</a></li>
				          </ul>
				        </li>

				        <li class="dropdown">
			          	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" 
			          	   aria-expanded="false"><span class="glyphicon glyphicon-road"></span> Autos <span class="caret"></span></a>
			          		<ul class="dropdown-menu">
			          			<li><a href="car-list.php"><span class="glyphicon glyphicon-list"></span> Lista De Autos</a></li>
			            		<li role="separator" class="divider"></li>
			            		<li><a href="agregar-carro.php"><span class="glyphicon glyphicon-plus"></span> Agregar</a></li>
					            <li role="separator" class="divider"></li>
					            <li><a href="buscar-auto.php"><span class="glyphicon glyphicon-search"></span> Búsqueda De Autos</a></li>
					            <li role="separator" class="divider"></li>
					            <li><a href="validar-taller.php"><span class="glyphicon glyphicon-ok"></span> Ingreso Desde Taller</a></li>
				          </ul>
				        </li>
						
						<li class="dropdown">
			          	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" 
			          	   aria-expanded="false"><span class="glyphicon glyphicon-credit-card"></span> Renta <span class="caret"></span></a>
			          		<ul class="dropdown-menu">
			            		<li><a href="make-rent.php"><span class="glyphicon glyphicon-plus"></span> Nueva</a></li>
					            <li role="separator" class="divider"></li>
					            <li><a href="actualizarenta.php"><span class="glyphicon glyphicon-refresh"></span> Actualizar Transacción</a></li>
					            <li role="separator" class="divider"></li>
					            <li><a href="validar-ingreso.php"><span class="glyphicon glyphicon-ok"></span> Validar Devolución</a></li>
				          </ul>
				        </li>


				        <li class="dropdown">
			          	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" 
			          	   aria-expanded="false"><span class="glyphicon glyphicon-search"></span> Búsqueda <span class="caret"></span></a>
			          		<ul class="dropdown-menu">
			            		<li><a href="buscarxcliente.php"><span class="glyphicon glyphicon-user"></span> Buscar Por Cliente</a></li>
					            <li role="separator" class="divider"></li>
					            <li><a href="buscarxauto.php"><span class="glyphicon glyphicon-road"></span> Buscar Por Auto</a></li>
					            <li role="separator" class="divider"></li>
					            <li><a href="buscarxfecha.php"><span class="glyphicon glyphicon-calendar"></span> Buscar Por Fechas</a></li>
				          </ul>
				        </li>
						
						<li class="dropdown">
			          	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" 
			          	   aria-expanded="false"><span class="glyphicon glyphicon-console"></span>  Admón <span class="caret"></span></a>
			          		<ul class="dropdown-menu">
			            		<li><a href="bitacora.php"><span class="glyphicon glyphicon-file"></span> Bitácora</a></li>
					            <li role="separator" class="divider"></li>
					            <li><a href="moras.php"><span class="glyphicon glyphicon-list-alt"></span> Moras</a></li>
					            <li role="separator" class="divider"></li>
					            <li><a href="#.php"><span class="glyphicon glyphicon-list"></span> Estadísticas</a></li>
				          </ul>
				        </li>

						<li>
							<a href="func/salir.php"><span class="glyphicon glyphicon-eject"></span> Salir</a>
						</li>
			     	</ul>
			</div>
		</nav>

		<!-- FIN BARRA-->