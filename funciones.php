<?php
/**
 * Función que dependiendo de la acción a realizar, se muestra para ingresos o 
 * para pagos de recibos.
 * 
 * @param type $accion variable a pasar con la accion capturada del boton.
 */
function formulario ($accion){
    if ($accion === 'Ingreso'){ //Si se captura Ingreso...
        $etiqueta = "Formulario de ingreso bancario"; //Nombre de la etiqueta del fieldset
        $boton = "Ingresar"; //Nombre del boton
    } else { 
        $etiqueta = "Formulario de pagos bancarios"; //Nombre de la etiqueta del fieldset
        $boton = "Pagar"; //Nombre del boton
    }
?>
    <!-- Formulario a mostrar, reutilizable para pagos e ingresos -->
    <fieldset class="menu"> 
        <?php echo "<legend>" . $etiqueta . "</legend>"; ?>
        Fecha: <input type="text" name="fecha" />
        Concepto: <input type="text" name="concepto" />
        <!--<div class="input-group">
            <span class="input-group-addon">€</span>
            <input type="text" class="form-control" name="concepto">
            <span class="input-group-addon">0.00</span>
        </div>-->
        Cantidad: <input type="text" name="cantidad" />
        <input type="submit" name="accion" value="<?php echo $boton; ?>">
    </fieldset>
<?php
}

/**
 * Funcion que muestrsa los movimientos de la cuenta al serle pasado por parametro un array de movimientos
 * 
 * @param type $lista array de movimientos a pasar
 */
function muestraMovimientos ($lista){
    // Encabezado de la tabla, siempre será fijo en este caso
    echo "<table>";
    echo "<tr class='encabezado'><th>Fecha</th><th>Concepto</th><th>Cantidad</th><th>Saldo contable</th></tr>";
    
    if (!empty ($lista)) { //Si la lista de movimientos no esta vacia....

        $saldo = 0; //Definimos la variable del saldo
        $saldo_contable = 0; //Definimos la variable del saldo contable
        $ultimo_movimiento = (count($lista)-10); //Marcamos que deseamos ver los 10 ultimos movimientos del tamaño del array
        
        foreach ($lista as $indice => $movimiento) { //Por cada elemento del array de movimientos...
            
            $saldo_contable = saldo($saldo, $movimiento); //Llamada a la funcion saldo, que caldculará el saldo con respecto a los movimientos anteriores, pese a que no sean visibles
            $saldocontable_final = number_format($saldo_contable, 2, ',', '.'); //Saldo final de la cuenta, en formato número y dos decimales
            
            if ($indice >= $ultimo_movimiento) { //Si el indice del elemento está dentro del intervalo, se muestra por filas...
                
                echo "<tr><td class='centrado'>" . $movimiento['fecha'] . "</td><td>" . $movimiento['concepto'] . "</td>"; //Muestra fecha y concepto
                
                if ($movimiento['cantidad'] > 0) { //Si la cantidad es mayor a 0
                    echo "<td class='contable'>" . number_format($movimiento['cantidad'], 2, ',', '.') . " €</td>"; //Muestra el valor normal
                } else {
                    echo "<td class='negativo'>" . number_format($movimiento['cantidad'], 2, ',', '.') . " €</td>"; //Muestra el valor en rojo (cambia css)
                }
                
                if ($saldocontable_final > 0) { //Si el saldo contable es mayor que 0
                    echo "<td class='contable'>" . $saldocontable_final . " €</td></tr>"; //Muestra el valor normal
                } else {
                    echo "<td class='negativo'>" . $saldocontable_final . " €</td></tr>"; //Muestra el valor en rojo (cambia css)
                }    
            }
            
            $saldo += $movimiento['cantidad']; //Variable donde va almacenado el saldo final
            $saldo_final = number_format($saldo, 2, ',', '.'); //Lo formateamos el saldo final total en formato redondeado a dos decimas
        }
        
        if ($saldo > 0){ //Si el saldo final es mayor que 0...
            echo "<tr class='saldoFinal'><td colspan='3'>Saldo total: </td><td>" . $saldo_final . " €</td></tr>"; //Muestra el valor normal
        } else {
            echo "<tr class='saldoFinal'><td colspan='3' >Saldo total: </td><td class='negativo'>" . $saldo_final . " €</td></tr>"; //Muestra el valor en rojo (cambia css)
        }

    } else { //En el caso de que no existan recibos en el array de movimientos... 
        echo "<tr class='centrado'><td colspan='4'>No existen recibos que visualizar</td></tr>"; //Muestra mensaje de información
    }
    echo "</table>"; //Cerramos la tabla abierta
}

/**
 * Función similar a la muestra de movimientos. En este caso filtraremos de dicha lista de elementos aquellos 
 * que unicamente tengan importe negativo y de la posibilidad de devolver el recibo que sea seleccionado con el radio button.
 * 
 * @param type $lista array para mostrar los elementos recibo
 */
function muestraRecibos ($lista){
    
    $existe_flag = false; //Creamos un flag de control para la existencia de recibos
    
    //Mostramos la cabecera de la tabla
    echo "<table>";
    echo "<tr class='encabezado'><th>#</th><th>Fecha</th><th>Concepto</th><th>Cantidad</th></tr>";
    
    if (!empty ($lista)) { //Si la lista de movimientos no esta vacia....
       
        foreach ($lista as $indice => $movimiento) { //Por cada movimiento de la lista, con su indice...
            if (($movimiento['cantidad']) < 0) { //Si el importe es menor que 0, mostramos las filas, con indice (será un radio button que toma su valor), fecha, cencepto e cantidad (en rojo por css)
                echo "<tr>";
                echo "<td class='centrado'><input type='radio' name='indice' value='" . $indice . "'></td><td>" . $movimiento['fecha'] . "</td><td>" . $movimiento['concepto'] . "</td><td class='negativo'>" . $movimiento['cantidad'] . " €</td>";
                echo "</tr>";
                $existe_flag = true; //Al existir un recibo, marcamos el flag como true
            }
        }
        
        if ($existe_flag) { //Si existen recibos, mostramos los botones de devolver y cancelar debajo de la tabla de movimientos
            echo "</table>"; //Cerramos la tabla de movimientos
            echo "<div class='centrado'><input type='submit' name='accion' value='Devolver'> <input type='submit' name='accion' value='Cancelar'></div>"; //Creamos los botones de accion Devolver y Cancelar
        } else if (($existe_flag === false) AND (!empty($lista))) { //Si no existieran recibos y la lista tuviera aun asi movimientos...
            echo "<tr class='centrado'><td colspan='4'>No existen recibos que visualizar</td></tr></table>"; //Mostramos mensaje de feedback...
        }
        
    } else { //En el caso de no existir elementos de movimiento alguno en la cuenta
        echo "<tr class='centrado'><td colspan='4'>No existen recibos que visualizar</td></tr></table>"; //Mostramos mensaje de feedback..
    }
}

/**
 * Función que sirve para devolver recibos elimina un valor de la lista seleccionada. FUNCION PRINCIPAL
 * 
 * @param type $lista array que se pasa por referencia, ya que vamos a modificar el array pasado al vuelo
 * return type El array de movimientos modificado
 */
function devuelveRecibo (&$lista){ //Se pasa por referencia el valor
    if ((isset($_REQUEST['indice'])) AND ($_REQUEST['indice']) != NULL) { //Si existe indice y este no es nulo....
        $indice = (int) $_REQUEST['indice']; //Forzamos a valor entero del indice que tenemos, necesario para eliminar el elemento seleccionado
        unset($lista[$indice]); //Eliminamos el elemento del array con dicho indice
        echo "<p class='perfect'><strong>INFO:</strong> Ha realizado usted una devolución satisfactoria</p>"; //Mensaje de feedback
    } else {
        echo "<p class='error'><strong>INFO:</strong> No ha seleccionado ningún pago para devolver</p>"; //Mensaje en el caso de no haber seleccionado ningun elemento de indice y haber pulsado el boton de Devolver
    }
    return $lista; //Devolvemos el array de movimientos modificado
}

/**
 * Función alternativa para la devolución de recibos. 
 * 
 * NOTA DEL ALUMNO/PROGRAMADOR: Dicha función debería ser la ideal para el ejercicio, su función trata de añadir a la lista de recibos un movimiento con valor 
 * contrario al recibo devuelto y el concepto marcado como devuelto (podria ser por css). El fallo que posee es que estos recibos seguirian apareciendo en el listado 
 * de recibos (recordemos que filtra los movimientos negativos), por lo que habria que marcarlos con un valor true/false cada movimiento como "pagado/devuelto", que
 * permitirá identificar estos en la lista de recibos y filtrarlos. Se ha descartado entonces su uso por no aumentar la dificultad de la tarea, aunque su resultado 
 * hubiera quedado mucho más estetico y original a la idea deseada. 
 * 
 * @param type $lista array a pasar por referencia
 * @return type devolucion del array modificado por referencia
 */
function devuelveAlternativo (&$lista) { //Parametro por referencia
    if ((isset($_REQUEST['indice'])) AND ($_REQUEST['indice']) != NULL) { //Si el indice existe y no es nulo...
        $indice = (int) $_REQUEST['indice']; //Forzamos a valor entero del indice que tenemos
        $devuelto = $lista[$indice]; //Obtenemos el elemento completo del pago que queremos devolver y lo volcamos a una variable
        $devuelto['concepto'] = 'DEVUELTO: ' . $devuelto['concepto']; //Modificamos en esta variable el concepto y la marcamos como 'DEVUELTO'
        $devuelto['cantidad'] = -$devuelto['cantidad']; //Positivamos la cantidad retirada para anularla
        $lista[] = $devuelto; //Añadimos este movimiento de devolucion al array
        echo "<p class='centrado'><strong>INFO:</strong> Ha realizado usted una devolución satisfactoria</p>"; //Mensaje de feedback
    } else {
        echo "<p class='error'><strong>ERROR:</strong> No ha seleccionado ningún pago para devolver</p>"; //Mensaje en el caso de no haber seleccionado ningun elemento de indice y haber pulsado el boton de Devolver
    }
    return $lista; //Devolvemos el array de movimientos modificado
}

/**
 * Función externa para el calculo del saldo contable. Mostrará el saldo que
 * hubo en cada movimiento
 * 
 * @param type $saldo Se le pasa el saldo actual en dicho momento
 * @param type $movimiento Se le pasa el movimiento que le vamos a sumar
 * @return type devolvemos el saldo sumados
 */
function saldo($saldo, $movimiento) {
    $saldo +=$movimiento['cantidad']; //Autosumatorio del movimiento
    return $saldo; //Devolvemos el saldo actualizado
}

/**
 * Funcion independiente que valida una fecha en el formato especificado o en cualquiera que 
 * le espeficiquemos.
 * 
 * @param type $fecha fecha a pasar
 * @param type $formato formato preestablecido, modificable p.e: 'd-m-Y'
 * @return type retorna la fecha si es correcta, false si es incorrecta
 */
function validarFecha($fecha, $formato = 'd/m/Y') { //Pasamos la fecha y un valor por defecto
    $d = DateTime::createFromFormat($formato, $fecha); //Reformateamos usando el formato (modificable si queremos)
    return $d && $d->format($formato) == $fecha; //Devolvemos la fecha si es correcto, false si es incorrecto
}

/**
 * Funcion independiente que valida el concepto
 * 
 * @param type $concepto //Concepto a pasar
 * @return boolean //devuelve true o false del resultado validado
 */
function validarConcepto ($concepto) {
    if (empty($concepto)) { //Si el campo esta vacio...
        return false; //Devuelve false (no validado)
    }
    return true; //En cualquier otro caso devuelve verdadero (validado)
}

/**
 * Función independiente que valida el importe
 * 
 * @param type $importe importe a validar
 * @return boolean devuelve true o false dependiendo si esta validado o no
 */
function validarImporte ($importe) {
    if (empty($importe) OR (!is_numeric($importe)) OR ($importe < 0)) { //Si el importe esta vacío, no es numerico o es menor de cero
        return false; //Devuelve un valor false (no validado)
    }
    return true; //En cualquier otro caso, devuelve true (validado)
}


/**
 * Función que valida los tres campos, devolviendo mensaje en el caso de error, true en el caso de estar validado
 * 
 * @param type $fecha elemento fecha
 * @param type $concepto elemento cencepto
 * @param type $importe elemento importe
 *
 * @return boolean devuelve false si no llega a validar, añadiendose los mensajes de los elementos no validados
 */
function validacion ($fecha, $concepto, $importe) {
    $error = ""; //Creamos el flag del mensaje
    if (!validarFecha($fecha)) { //Si no valida la fecha, inserta el mensaje
        $error = $error . "<p class='error'><strong>ERROR:</strong> La fecha es INCORRECTA. Use el formato dd/mm/yyyy</p>";
    }
    if (!validarConcepto($concepto)) { //Si no valida el concepto, inserta el mensaje
        $error = $error . "<p class='error'><strong>ERROR:</strong> El concepto no puede estar vacío</p>";
    }
    if (!validarImporte($importe)) { //Si no valida el importe, inserta el mensaje
        $error = $error . "<p class='error'><strong>ERROR:</strong> El importe es erroneo. Ingrese un importe de forma númerica, sin simbolos. Para decimales, use punto en vez de coma</p>";
    }
    if ((validarFecha($fecha)) AND (validarConcepto($concepto)) AND (validarImporte($importe))) { //Si esta todo correcto, cambia el valor al booleano false
        $error = false;
    }
    return $error; //Devuelve el valor obtenido
}