<?php
include 'conexion.php';
include_once 'inc/functions.php';
sec_session_start();

$usuario = filter_input(INPUT_POST, 'usuario', $filter = FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'psha', $filter = FILTER_SANITIZE_STRING); // The hashed password.

if (!login_check($conexion)) { //no estas autorizado
    if (isset($usuario, $password)) {
	if (login($usuario, $password, $conexion) == true) {
	    // Éxito
	    $action = "lista"; //acción por defecto
	} else {
	    // Login error: no coinciden usuario y password
	    $action = "login";
	}
    } else {
	//significa que aún no has valores para usuario y password
	$action = "login";
    }
} else { // si estas autorizado
    $action = basename(filter_input(INPUT_GET, 'action', $filter = FILTER_SANITIZE_STRING));
    if (!isset($action)) {
	$action = 'lista'; //acción por defecto $default_action = "lista"
    }
    if (!file_exists($action . '.php')) { //comprobamos que el fichero exista
	$action = 'lista'; //si no existe mostramos la página por defecto
	echo "Operación no soportada: 404";
    }
}
include( $action . '.php'); //y ahora mostramos la pagina llamada



