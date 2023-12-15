<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppBaseController extends Controller
{
    public function callAction($method, $parameters)
    {

        $controller = class_basename(get_class($this));
        $action = $method;
        $model = str_replace('Controller', '', $controller);
        $modelPath = 'App\\Models\\'.$model;  

        $permssion = $action . '-' . $controller;

        $this->authorize($permssion);

        
        return parent::callAction($method, $parameters);
    }

    
}
