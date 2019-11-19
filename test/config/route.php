<?php

class Routings {

    public static function buildRoute() {
        $controllerName = "SiteController";
        $modelName = "SiteModel";
        $action = "index";

        $route = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

        $i = count($route)-1;

        while($i>0) {
            if($route[$i] != '') {
                if(is_file(CONTROLLER_FOLDER . ucfirst($route[$i]) . "Controller.php")) {
                    $controllerName = ucfirst($route[$i]) . "Controller";
                    $modelName =  ucfirst($route[$i]) . "Model";
                    break;
                } else {
                     $action = $route[$i];
                }
            }
            $i--;
        }

        require_once CONTROLLER_FOLDER . $controllerName . ".php";
        require_once MODELS_FOLDER . $modelName . ".php";

        $controller = new $controllerName();
		$controller->$action();
    }

    public function errorPage() {

    }

}

?>