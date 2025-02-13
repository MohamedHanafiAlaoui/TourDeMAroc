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
    $router->get('/', [HomeController::class, 'index'], ["visitor", "fan", "cyclist"]);
    $router->get('/tour', [HomeController::class, 'details'], ["visitor", "fan", "cyclist"]);
    $router->get('/cyclists', [CyclistController::class, 'index'], ["visitor", "fan", "cyclist"]);
    $router->get('/cyclists/{id}', [CyclistController::class, 'show'], ["visitor", "fan", "cyclist"]);
    $router->get('/stages', [StagesController::class, 'index'], ["visitor", "fan", "cyclist"]);
    $router->get('/stages/{id}', [StagesController::class, 'show'], ["visitor", "fan", "cyclist"]);
    $router->get('/ranking', [RankingController::class, 'index'], ["visitor", "fan", "cyclist"]);
    $router->get('/profile', [FanController::class, 'profile'], ["fan"]);
    $router->get('/profile', [CyclistController::class, 'profile'], ["cyclist"]);


    $router->get('/', [DashboardController::class, 'index'], ["admin"]);
    $router->get('/categories', [CategoryController::class, 'index'], ["admin"]);
    $router->post('/categories/create', [CategoryController::class, 'store'], ["admin"]);
    $router->post('/categories/delete', [CategoryController::class, 'delete'], ["admin"]);
    $router->post('/regions/delete', [RegionController::class, 'delete'], ["admin"]);
    $router->post('/regions/store', [RegionController::class, 'createRegion'], ["admin"]);
    $router->get('/regions', [RegionController::class, 'index'], ["admin"]);

    $router->get('/api/Teams', [TeamController::class, 'fetchTeam'], ["visitor"]);

    
    
    $router->get('/login', [AuthController::class, 'login'], ["visitor"]);
    $router->post('/login', [AuthController::class, 'signin'], ["visitor"]);
    $router->get('/signup', [AuthController::class, 'signup'], ["visitor"]);
    $router->post('/signup', [AuthController::class, 'register'], ["visitor"]);
    
    $router->get('/forget-password', [ResetPasswordController::class, 'index'], ["visitor"]);
    $router->get('/reset-password', [ResetPasswordController::class, 'reset'], ["visitor"]);

    $router->dispatch($request);

    //  create stage / create category / create region / verify cyclist / accept comment / 
    // report / like / commenter / favorite / notification