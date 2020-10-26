<?php 

namespace App\Http;
/**
 * Clase encargada de realizar el proceso
 * FrontController
 * Recibe las peticiones que vienen por la URL
 * @param $segmentos //ruta
 * @param $ctr // controlador name
 * @param $acc // metodo del controlador
 * @author Juan Felipe Rodríguez
 */
class Request
{
    protected $segmentos = [];
    protected $ctr;
    protected $acc;
    /**
     * se recibe la petición
     * 
     */
    public function __construct()
    {
        //suponiendo que el dominio fuera
        //http://sitiofelipe/controlador/metodo
        //convertimos en array la url de la peticion

        $this->segmentos = explode('/', $_SERVER['REQUEST_URI']);
        $this->setController();
        $this->setMethod();
    }

    public function setController()
    {
        $this->ctr = empty($this->segmentos[1])
                    ? 'home'
                    : $this->segmentos[1];
    }
    public function setMethod()
    {

        $this->acc = empty($this->segmentos[2])
            ? 'index'
            : $this->segmentos[2];
    }
    public function getController()
    {
        $ctr = ucfirst($this->ctr);
        return "App\Http\Controllers\\{$ctr}Controller";
    }
    public function getMethod()
    {
        return $this->acc;
    }
    public function send()
    {
        $ctr = $this->getController();

        $acc = $this->getMethod();
        $response = call_user_func([
            new $ctr,
            $acc
        ]);
        $response->send();
    }
}
