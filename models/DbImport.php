<?php
// Importa a la base de datos
class Importing extends mysqli
{
    // Control de si todo paso bien
    private $state_file = false;

    public function __construct()
    {
        parent::__construct("localhost", "root", "", "viviendadb");
        if ($this->connect_error) {
            echo "Failed to connect: --> " . $this->connect_error;
        }
    }
    public function import($file)
    {
        $conn = mysqli_connect("localhost", "root", "", "viviendadb");

        $file = fopen($file, "r");
        // Para skipear la primera fila
        fgetcsv($file, 10000, ",");
        while ($row = fgetcsv($file)) {
            $value = "'" . implode("','", $row) . "'";
            $sql =
                "INSERT INTO viviendas(latitud,longitud,id_vivienda,titulo,anunciante,descripcion,reformado,telefonos,tipo,precio,precio_metro,direccion,provincia,ciudad,metros_cuadrados,habitaciones,baños,parking,segunda_mano,armarios_empotrados,construido_en,amueblado,calefaccion_individual,calefaccion_energetica,planta,exterior,interior,ascensor,fecha,calle,barrio,distrito,terraza,trastero,cocina_equipada,cocina_equipada2,aire_acondicionado,piscina,jardin,metros_cuadrados_utiles,movilidad_reducida,plantas,mascotas,balcon) VALUES(" .
                $value .
                ")";

            if (mysqli_query($conn, $sql)) {
                $this->state_file = true;
            } else {
                $this->state_file = false;
            }
        }
        if ($this->state_file) {
            echo "Archivo importado";
        } else {
            echo "No fue importado";
        }
    }
}
