<?php
// Archivo: clases.php

class Tarea {
    public $id;
    public $titulo;
    public $descripcion;
    public $estado;
    public $prioridad;
    public $fechaCreacion;
    public $tipo;

    public function __construct($datos) {
        foreach ($datos as $key => $value) {
            $this->$key = $value;
        }
    }

    // Implementar estos getters
    // public function getEstado() { }
    // public function getPrioridad() { }
}

class GestorTareas {
    private $tareas = [];

    public function cargarTareas() {
        $json = file_get_contents('tareas.json');
        $data = json_decode($json, true);
        foreach ($data as $tareaData) {
            $tarea = new Tarea($tareaData);
            $this->tareas[] = $tarea;
        }
        
        return $this->tareas;
    }


    public function agregarTarea($tarea){
        
    }


    public function eliminarTarea($id) {
     // Se elimina La tare de la lista de areelgos y en JSONjjj
    }

    public function actualizarTarea($tarea){
        // Se actuliza los datos en JSON
    }

    public function actualizarEstadoTarea($id, $nuevoEstado){
        // Se acutliza el estado de tarea
    }


    public function buscarTareasPorEstado($estado){
        // Buscar Tareas por estados 
    }

    public function listarTareas($filtroEstado = '') {

    }
}

// Implementar:
// 1. La interfaz Detalle
interface Detalles{
    public function obtenerDetallesEspecificos();
}
// 2. Modificar la clase Tarea para implementar la interfaz Detalle
// 3. Las clases TareaDesarrollo, TareaDiseno y TareaTesting que hereden de Tarea
class TareaDesarrollo extends Tarea implements Detalles {
    private $lenguaje;    
    
    public function __construct($lenguaje){
        $this->setLenguaje($lenguaje);
    }

    public function getLenguaje() {
        return $this->lenguaje;
    }

    public function setLenguaje($lenguaje) {
        $this->lenguaje = trim($lenguaje);
    }

    public function obtenerDetallesEspecificos(){
        //devuelva una cadena con los detalles particulares de cada tipo de tarea.
    }
}

class TareaDiseño extends Tarea implements Detalles {
     private $herramientaDiseno;    
    public function __construct($herramientaDiseno){
        $this->setHerramientaDiseno($herramientaDiseno);
    }
    public function  getHerramientaDiseno() {
        return $this->herramientaDiseno;
    }
    public function setHerramientaDiseno($herramientaDiseno) {
        $this->herramientaDiseno = trim($herramientaDiseno);
    }

    public function obtenerDetallesEspecificos(){
        //devuelva una cadena con los detalles particulares de cada tipo de tarea.
    }

}

class TareaTesting extends Tarea implements Detalles {

    public function obtenerDetallesEspecificos(){
        //devuelva una cadena con los detalles particulares de cada tipo de tarea.
    }

}