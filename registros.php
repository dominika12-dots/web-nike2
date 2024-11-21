<?php
$servidor = "localhost";
$usuario = "root";
$password = "";
$basedatos = "b_datos";

$cone = new mysqli($servidor,$usuario,$password, $basedatos);
if ($cone->connect_error){
	echo "sin conexion";
}

$cor=$_POST['cor'];
$nom=$_POST['nom'];
$ape=$_POST['ape'];
$tel=$_POST['tel'];

$sql ="INSERT INTO registros(Correo, Nombre, Apellido, Telefono) VALUES ('$cor','$nom','$ape','$tel')";
if ($cone->query ($sql) === TRUE){  
	echo "envio exitoso";

	}else{
	     echo "error";
	}
$cone->close();
?>
