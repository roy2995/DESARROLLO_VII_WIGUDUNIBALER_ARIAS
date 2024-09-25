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

            switch($tareaData['tipo']){
                case 'Desarrollo':
                    $tarea = new TareaDesarrollo($tareaData);
                    $this->tareas[] = $tarea;
                break;
                case 'Diseño':
                    $tarea = new TareaDiseño($tareaData);
                    $this->tareas[] = $tarea;
                break;
                case 'Testing':
                    $tarea = new TareaTesting($tareaData);
                    $this->tareas[] = $tarea;
                break;

            }
        }
        return $this->tareas;
    }


    public function agregarTarea($tarea){
 
        switch($tarea['tipo']){
            case 'Desarrollo':
                $nuevaTarea = new TareaDesarrollo($tarea);
            break;
            case 'Diseño':
                $nuevaTarea = new TareaDiseño($tarea);
            break;
            case 'Testing':
                $nuevaTarea = new TareaTesting($tarea);
            break;
        }       
        $this->tareas[] = $nuevaTarea;
    }


    public function eliminarTarea($id) {
    
        $ListaNueva = array_filter($this->tareas,function($tarea, $id){
            if ($tarea['id'] <> $id){
               return $tarea; 
            }
        });

        $this->tareas[] = $ListaNueva;
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