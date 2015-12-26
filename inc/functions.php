<?php

function sec_session_start() {
    $session_name = 'sec_session_id'; //Asignamos un nombre de sesión
    $secure = false; //mejor en config.php Lo ideal sería true para trabajar con https
    $httponly = true;

    // Obliga a la sesión a utilizar solo cookies.
    // Habilitar este ajuste previene ataques que impican pasar el id de sesión en la URL.
    if (ini_set('session.use_only_cookies', 1) === FALSE) {
    $accion = "error";
    $error="No puedo iniciar una sesion segura (ini_set)";
    }

    // Obtener los parámetros de la cookie de sesión
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"],
	$cookieParams["domain"],
	$secure, //si es true la cookie sólo se enviará sobre conexiones seguras
	$httponly); //Marca la cookie como accesible sólo a través del protocolo HTTP.
    
    //Esto siginifica que la cookie no será accesible por lenguajes de script, 
    // tales como JavaScript.
    //Este ajuste puede ayudar de manera efectiva a reducir robos de 
    //indentidad a través de ataques
   
    // Incia la sesión PHP
    session_name($session_name);
    session_start();
    // Actualiza el id de sesión actual con uno generado más reciente    
    //Ayuda a evitar ataques de fijación de sesión
    session_regenerate_id(true);
} 

// Esta función comprobará que el nombre de usuario y contraseña correspondiente
//  se encuentran en la base de datos. Si todo va bien devolverá true.
function login($usuario, $password, $conexion) {
    // Usar consultas preparadas previene de los ataques SQL injection.
    if ($stmt = $conexion->prepare("SELECT id, usuario, password
    FROM clientes
    WHERE usuario = ?
    LIMIT 1")) {
    $stmt->bind_param('s', $usuario);
    $stmt->execute();
    $stmt->store_result();

    // recogemos el resultado de la consulta
    $stmt->bind_result($id, $usuario, $db_password); //password de la bd
    $stmt->fetch();
    
    
?>