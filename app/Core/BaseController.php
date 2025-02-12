<?php
    class BaseController
    {
        function render($path, $data = []){
            if ($path == "/") {
                $path = "/index";
            }
            if ($path[0] != "/") {
                $path = "/" . $path;
            }

            
            $path = APPROOT . "View" . $path . ".php";  

            $role = "fan";
            if (isLoggedIn() && user()->isAdmin()) {
                $role = "admin";
            }
            elseif (isLoggedIn() && user()->isCyclist()) {
                $role = "cyclist";
            }
            
            if (file_exists($path)) {
                extract($data);
                require_once APPROOT . "View/". $role ."/components/header.php";
                require_once $path;
                require_once APPROOT . "View/". $role ."/components/footer.php";
            } else {
                http_response_code(404);
                echo "404 Not Found";
            }
        }
    }