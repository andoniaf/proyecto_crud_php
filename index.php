<html>
    <head>
        <meta charset="UTF-8">
        <title>Proyecto CRUD</title>
	    <link media="all" href="css/style.css" rel="stylesheet" type="text/css"></link>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script type="text/JavaScript">
            function borra_cliente(id){
        		var answer = confirm('¿Estás seguro que deseas borrar el cliente?');
        		if (answer) {
        		// si el usuario hace click en ok,
        		// se ejecutar borra.php
        		window.location = 'borra.php?id=' + id;
        		}
            }
        </script>
    </head>
    <body>
    <div id="wrapper">
	<div id="header">
	    <div id="logo">
		<img src="img/logo_web.jpeg"></img>
	    </div>
	    <div id="title">
		Manager Emulator LOL
	    </div>

	</div>
    <nav class="navbar navbar-default">
        <!-- http://getbootstrap.com/customize/?id=3f3323b47a99e302d879#navbar -->
    </nav>
	<div id="content">
	<?php
	    $default = 'lista'; //nuestra página por defecto.
	    
	    $action = isset($_GET['action']) ? $_GET['action'] : $default; 

	    //obtenemos la página que queremos mostrar.
	    $accion = basename($accion); //nos quedamos solo con el nombre.
	
	    if (!file_exists($accion . '.php')) { //comprobamos que el fichero exista
	    $accion = $default; //si no existe mostramos la página por defecto
	    //NOTA: Hacer la página 404
	    }
	    
	    include( $accion . '.php'); //y ahora mostramos la pagina llamada
	?>
	</div>
	<div id="footer">
        <div class="pull-left"><kbd>#MELOL</kbd></div>
	    <div class="pull-right"><kbd>Andoni Alonso (2015)</kbd></div>
	</div>
    </div>
    </body>
</html>
