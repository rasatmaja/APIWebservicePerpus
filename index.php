<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    defined('APPLICATION_ENV') || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'local'));

    // show errors when working on local
    if(APPLICATION_ENV === 'local'){
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
    }

    require '/vendor/autoload.php';
    require '/configs/'.strtolower(APPLICATION_ENV).'.config.php';

    $container = new \Slim\Container;
    $container['cache'] = function () {
        return new \Slim\HttpCache\CacheProvider();
    };

    $container['PelanggaranController'] = function ($c) {
        $cache = $c->get('cache');
        return new controller\PelanggaranController($cache);
    };
    

    $app = new \Slim\App($container);
    $app->add(new \Slim\HttpCache\Cache('private', 3600));

    $app->add(new RKA\Middleware\IpAddress());

    $app->group('/api/pelanggaran', function () use ($app) {
        $app->get('/{nim}/', controller\PelanggaranController::class);
        $app->get('/belum-selesai/{nim}/', controller\PelanggaranController::class. ':belumSelesai');
        $app->get('/sudah-selesai/{nim}/', controller\PelanggaranController::class. ':sudahSelesai');
    })->add(controller\middlewares\MiddlewareController::class);


    $app->group('/api/transaksi', function () use ($app) {
        $app->get('/{nim}/', controller\TransaksiController::class);
        $app->get('/belum-kembali/{nim}/', controller\TransaksiController::class. ':belumKembali');
        $app->get('/sudah-kembali/{nim}/', controller\TransaksiController::class. ':sudahKembali');
    })->add(controller\middlewares\MiddlewareController::class);

    $app->POST('/api/buku/pengusulan-buku/', controller\BukuController::class. ':pengusulanBuku');
    $app->POST('/api/transaksi/perpanjangan-peminjaman/', controller\TransaksiController::class. ':perpanjanganKoleksi');
    $app->POST('/api/aktivasi-anggota-online/', controller\AnggotaController::class. ':aktivasi');

    $app->GET('/', controller\HomeController::class. ':login_form');
    $app->POST('/api-management/login/', controller\HomeController::class. ':login');
    $app->GET('/api-management/logout/', controller\HomeController::class. ':logout');

    $app->GET('/api-management/', controller\HomeController::class);
    $app->POST('/api-management/', controller\HomeController::class. ':create_api');
    $app->PUT('/api-management/', controller\HomeController::class. ':update_api');
    $app->DELETE('/api-management/', controller\HomeController::class. ':delete_api');

    $app->GET('/api-management/ip/{api_key}/', controller\HomeController::class. ':get_ip');
    
    $app->run();

?>