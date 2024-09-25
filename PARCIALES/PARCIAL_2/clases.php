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
}


interface Detalles{
    public function obtenerDetallesEspecificos();
}


class TareaDesarrollo extends Tarea {
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
}

class TareaDiseño extends Tarea {
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

}

// Implementar:
// 1. La interfaz Detalle
// 2. Modificar la clase Tarea para implementar la interfaz Detalle
// 3. Las clases TareaDesarrollo, TareaDiseno y TareaTesting que hereden de Tarea