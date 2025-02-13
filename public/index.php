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
    $router->get('/stages', [StageController::class, 'index'], ["visitor", "fan", "cyclist"]);
    $router->get('/stages/{id}', [StageController::class, 'show'], ["visitor", "fan", "cyclist"]);
    $router->get('/ranking', [RankingController::class, 'index'], ["visitor", "fan", "cyclist"]);
    $router->get('/profile', [FanController::class, 'profile'], ["fan"]);
    $router->get('/profile', [CyclistController::class, 'profile'], ["cyclist"]);


    $router->get('/', [DashboardController::class, 'index'], ["admin"]);
    $router->get('/categories', [CategoryController::class, 'index'], ["admin"]);
    $router->get('/regions', [RegionController::class, 'index'], ["admin"]);
    $router->get('/stages', [StageController::class, 'index'], ["admin"]);
    $router->get('/unverified-cyclists', [CyclistController::class, 'unverifiedCyclists'], ["admin"]);
    $router->get('/pending-comments', [CommentController::class, 'pendingComments'], ["admin"]);

    $router->get('/api/Teams', [TeamController::class, 'fetchTeam'], ["visitor", "fan", "cyclist"]);
    $router->get('/api/Stages', [StageController::class, 'fetchStages'], ["visitor", "fan", "cyclist"]);

    
    
    $router->get('/login', [AuthController::class, 'login'], ["visitor"]);
    $router->post('/login', [AuthController::class, 'signin'], ["visitor"]);
    $router->get('/signup', [AuthController::class, 'signup'], ["visitor"]);
    $router->post('/signup', [AuthController::class, 'register'], ["visitor"]);
    $router->post('/logout', [AuthController::class, 'logout'], ["admin", "fan", "cyclist"]);
    
    $router->get('/forget-password', [ResetPasswordController::class, 'index'], ["visitor"]);
    $router->post('/forget-password', [ResetPasswordController::class, 'store'], ["visitor"]);
    $router->get('/reset-password', [ResetPasswordController::class, 'reset'], ["visitor"]);
    $router->post('/reset-password', [ResetPasswordController::class, 'update'], ["visitor"]);

    $router->dispatch($request);

    //  create stage / create category / create region / verify cyclist / accept comment / 
    // report / like / commenter / favorite / notification