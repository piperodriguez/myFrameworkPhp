<?php

namespace App\Http;

class Response
{
    /**
     * En el momento solo retornamos una vista
     * pero mas adelante si es necesario desde aqui 
     * se condifgura para que retorne
     * array, json, pdf, excel, xml etc ...
     */
    protected $view;

    public function __construct($view)
    {
        $this->view = $view;
    }
    public function getView()
    {
        return $this->view;
    }
    public function send()
    {
        $view = $this->getView();
        $content = \file_get_contents(viewPath($view));
        require viewPath('layout');
    }
}
