<?php
/**
 * Created by PhpStorm.
 * User: Gustavo
 * Date: 21/03/14
 * Time: 01:29 PM
 */

class Parametros
{
    /** Esta clase servirá para obtener los parametros individuales de cada instancia del sistema
     * Llamando a la tabla parametros desde métodos estáticos. Solo se tendrán metodos estáticos */
    static function DIA_INTERESES_COLEGIATURA()
    {
        $query = "SELECT dia_intereses_colegiatura FROM parametros";
        $res = Database::select($query);
        $res[0]['dia_intereses_colegiatura'];
    }
}