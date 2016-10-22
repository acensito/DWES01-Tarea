<!DOCTYPE html>
<!-- Desarrollo Web en Entorno Servidor -->
<!-- Tema 1 : Plataformas de programación web en entorno servidor Aplicaciones LAMP -->
<!-- Felipe Rodríguez Gutiérrez -->
<!-- Tarea: 01 Diodos BANK -->
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>DWES - Tarea01 - Felipe Rodríguez Gutiérrez</title>
	<link rel="stylesheet" type="text/css" href="estilos.css" >
</head>
<body>
	<h1 class="centrado">Tarea01: DIODOS BANK</h1>
	<h2 class="centrado">Felipe Rodríguez Gutiérrez</h2>

    <!-- Conformamos el formulario con el que trabajaremos -->
    <form name="form" action="index.php" method="post">
    
    <!-- Conformamos el menu de usuario -->    
    <fieldset class="menu">
        <input type="submit" name="accion" value="Ingreso" />
        <input type="submit" name="accion" value="Pago" />
        <input type="submit" name="accion" value="Devolución" />
        <input type="submit" name="accion" value="Movimientos" />
    </fieldset>   
    
	<?php
	//Hacemos llamada al archivo de funciones
	include 'funciones.php';

	//Creamos el array que almacena los movimientos
	$movimientos = array();

	//Si existe una variable de movimientos enviada, volcamos los datos
	if (isset($_REQUEST['movimientos'])) {
		$movimientos = $_REQUEST['movimientos'];
	}

	//Ahora capturaremos las acciones del formulario y de sus diferentes botones.
	//Dependiendo de la acción, se mostrará un formulario o se tomará una acción concreta.


    if (isset($_REQUEST['accion'])) { //Si se pulsa un boton del formulario....
        $accion = $_REQUEST['accion']; //Se captura el valor de ese boton de acción
        switch ($accion) { //Seleccionamos según ese valor del boton
            
            case 'Ingreso':
            	echo "<h4 class='centrado'>INFO: Rellene los siguientes campos para realizar un ingreso de efectivo</h4>";//Información feedback
                formulario("Ingreso"); //Mostramos el formulario de ingreso
                break;
            
            case 'Ingresar': //Si pulsa el botón "Ingresar" para hacer un ingreso.. 
                
                //Activamos un flag de control (true/false) pasandole los valores del ingreso para validarlos
                $flag = validacion($_REQUEST['fecha'], $_REQUEST['concepto'], $_REQUEST['cantidad']);
                
                if ($flag) { //En el caso de que sea falso (existe un error)...
                    echo $flag; //Mostrará los valores de retorno de la funcion con los mensajes de validación
                    formulario("Ingreso"); //Mostrará el formulario nuevamente
                } else { //Caso contrario...
                    $movimiento = array( //Creará un movimiento, con los valores introducidos
                        'fecha' => $_REQUEST['fecha'],
                        'concepto' => $_REQUEST['concepto'],
                        'cantidad' => $_REQUEST['cantidad']
                    );
                    $movimientos[] = $movimiento; //Se incluye el movimiento creado al array de movimientos  

                    echo "<p class='perfect'>Ha realizado usted un ingreso correctamente</p>"; //Feedback satisfactorio
                    muestraMovimientos($movimientos); //Hacemos muestra de los ultimos movimientos
                }
                break;
            
            case 'Pago': //Si pulsamos el botón de "Pago" para pagar un recibo...
                echo "<h4 class='centrado'>INFO: Rellene los siguientes campos para realizar el pago de un recibo</h4>"; //Información feedback...
                formulario("Pago"); //Mostramos el formulario de pago
                break;
            
            case 'Pagar': //Si pulsamos en el botón de "Pagar"...
                
                //Activamos un flag de control (true/false) pasandole los valores del ingreso para validarlos
                $flag = validacion($_REQUEST['fecha'], $_REQUEST['concepto'], $_REQUEST['cantidad']);
                
                if ($flag) { //En el caso de que sea falso (existe un error)...
                    echo $flag; //Mostrará los valores de retorno de la funcion con los mensajes de validación
                    formulario($accion); //Mostrará el formulario nuevamente
                } else { //Caso contrario...
                    $movimiento = array( //Creará un movimiento de pago, con los valores introducidos
                        'fecha' => $_REQUEST['fecha'],
                        'concepto' => $_REQUEST['concepto'],
                        'cantidad' => -$_REQUEST['cantidad'] //OJO!!, en este caso negativizamos el valor
                    );
                    $movimientos[] = $movimiento; //Se incluye el movimiento de pago creado al array de movimientos  

                    echo "<h4 class='perfect'>Ha realizado usted un pago correctamente</h4>"; //Feedback satisfactorio
                    muestraMovimientos($movimientos); //Hacemos muestra de los ultimos movimientos
                }
                break;
            
            case 'Devolución': //Si pulsamos el botón "Devolución"...
                echo "<h4 class='centrado'>Recibos bancarios</h4>"; //Información feedback
                muestraRecibos($movimientos); //Mostramos los recibos que tenemos en el array de movimientos
                break;
            
            case 'Devolver': //Si pulsamos en el botón "Devolver"...
                devuelveRecibo($movimientos); //Hacemos una devolución
                muestraMovimientos($movimientos); //mostramos los movimientos y como quedan
                break;
            
            case 'Cancelar': //Si pulsamos el botón "Cancelar"
                echo "<h4 class='centrado'>Recibos bancarios</h4>"; //Información feedback...
                muestraRecibos($movimientos); //Mostramos nuevamente los recibos sin seleccionar ninguno
                break;
        
            case 'Movimientos': //Si pulsamos el botón "Movimientos"...
                echo "<h4 class='centrado'>Movimientos de su cuenta</h4>"; //Información feedback...
                muestraMovimientos($movimientos); //Mostramos los movimientos de la cuenta
                break;
        }
    }
    
    //Este es el input hidden que recibirá los valores del array de movimientos y se remandarán
    foreach ($movimientos as $clave => $valor) {
        echo '<input type="hidden" name="movimientos[' . $clave . '][fecha]"     value="' . $valor['fecha'] . '">'; //Fechas
        echo '<input type="hidden" name="movimientos[' . $clave . '][concepto]"  value="' . $valor['concepto'] . '">'; //Conceptos  
        echo '<input type="hidden" name="movimientos[' . $clave . '][cantidad]"  value="' . $valor['cantidad'] . '">'; //Importes
    }
	?>

	</form>
	<footer>Felipe Rodriguez Gutiérrez - DWES Tarea 1 - Curso 2016/2017</footer>
</body>
</html>