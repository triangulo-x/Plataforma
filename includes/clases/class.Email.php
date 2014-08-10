<?php
include_once("class.Database.php");

class Email
{
    public $id_email;
    public $id_persona;
    public $email;
    public $tipo_email;

    function __construct($id_email)
    {
        $email = Database::select("SELECT * FROM email WHERE id_email = $id_email LIMIT 1;");
        $email = $email[0];
        $this->id_email     = $email['id_email'];
        $this->id_persona   = $email['id_persona'];
        $this->email        = $email['email'];
        $this->tipo_email   = $email['tipo_email'];
    }

    function eliminar()
    {
        $query = "DELETE FROM email WHERE id_email = $this->id_email";
        return Database::update($query);
    }

    # Método estáticos
    public static function getTipos()
    {
        return Database::select("SELECT * FROM tipo_email");
    }
}

?>