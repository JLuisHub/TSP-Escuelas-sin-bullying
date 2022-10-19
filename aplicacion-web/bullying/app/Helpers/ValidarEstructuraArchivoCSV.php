<?php 

if( !function_exists('validar_estructura_del_archivo')){
    
    function validar_estructura_del_archivo($renglones){
        $mensaje_de_error = "";

        $contiene_cols_vacias = false;
        $es_la_clave_congruente = true;
        $contiene_mas_de_7_cols = false;

        $numero_renglon = 2; // Esta variable nos ayuda a detectar en que renglón del archivo CSV se dio un error.
        $clave_erronea = "";

        // Recorre cada una de las filas del archivo CSV
        foreach( $renglones as $renglon_actual ){

            // Divido el renglón acutal o fila por ,
            // Renglon dividido contiene el contenido en texto de cada una de las columnas del archivo CSV
            $renglon_dividido = explode(",",$renglon_actual);
            $numero_cols = 0;

            //  Verificamos que las columnas no esten vacias.
            foreach( $renglon_dividido as $parte_del_renglon ){
                if( empty( rtrim( ltrim($parte_del_renglon) ) ) ){ // Se encontró una columna vacía
                    $contiene_cols_vacias = true;
                    break;
                }
                $numero_cols = $numero_cols + 1;
            }

            // Recordemos que cada fila el archivo CSV debe de tener 7 columnas
            if( $contiene_cols_vacias || count($renglon_dividido ) < 7){
                $contiene_cols_vacias = true;
                break;
            }

            if($numero_cols > 7){
                $contiene_mas_de_7_cols = true;
                break;
            }

            //  Valida que la clave del director sea igual que la clave de los alumnos del archivo CSV
            //  Ejemplo: Supongamos que la clave del director es: 1324JFB123 y en el archivo CSV tenemos
            //  un registro con clave de institución  HGFBB1234. En este caso no deberia de ser posible para
            //  el director subir el archivo CSV.
            if(  rtrim((ltrim($renglon_dividido[6]))) != Auth::user()->clave  ){ 
                $es_la_clave_congruente = false;
                $clave_erronea = rtrim(ltrim($renglon_dividido[6]));
                break;
            }

            $numero_renglon = $numero_renglon + 1;
        }

        if( $contiene_mas_de_7_cols ){
            $mensaje_de_error = 'En la fila ' . $numero_renglon . ' el archivo CSV contiene más de 7 columnas.';
        }

        if( $contiene_cols_vacias ){
            $mensaje_de_error = 'En la fila ' . $numero_renglon . ' el archivo CSV contiene 1 o más columnas vacias';
        }

        if( $es_la_clave_congruente == false ){
            if( empty(trim($clave_erronea)) ){
                $clave_erronea = "Columna vacía";
            }

            $mensaje_de_error = 'En la fila ' . $numero_renglon . ' del archivo CSV la clave de institución 
            no es congruente con la clave de tu institución. Tu clave es :' . Auth::user()->clave . ' la clave en el archivo CSV es '
            . $clave_erronea;
        }

        return $mensaje_de_error;

    }
}

?>