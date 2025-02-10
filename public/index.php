<?php    
    require_once __DIR__ . '/../app/Config/config.php';

    function require_all_files($directory) {
        foreach (glob($directory . '/*.php') as $filename) {
            require_once $filename;
        }
    }

    // Require all core files
    require_all_files(__DIR__ . '/../app/Core');
    $db = new Database();
    BaseModel::setDatabase($db);

    require_all_files(__DIR__ . '/../app/Helpers');
    require_once __DIR__ . '/../app/Models/User.php';
    require_all_files(__DIR__ . '/../app/Models');
    require_all_files(__DIR__ . '/../app/Controllers');

    // Define the routes
    $router = new Router();
    $request = new Request();
    // examples of the routs 
    // $router->get('/', [HomeController::class, 'index'], ["visitor", "student"]);
    // $router->post('/courses/enroll/{id}', [CoursesController::class, 'enroll'], ["student"]);

    $router->dispatch($request);