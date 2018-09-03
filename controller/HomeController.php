<?php
   use Slim\Views\PhpRenderer;
    namespace controller;
    require './vendor/autoload.php';

    class HomeController{
        public function __invoke($request, $response, $args){
            error_reporting(0);
            session_start();
            if($_SESSION['authStatus']==true){
                $api = new \models\ApiKey();
                $data['api_data'] = $api->get_api_data();
                $phpView = new \Slim\Views\PhpRenderer("./view");
                return $phpView->render($response, "/V_Api_Management.php", $data); 
            }else{
                return $response->withRedirect('http://localhost:8123/API_Webservice_Perpus/');
            }
        }

        public function login_form($request, $response, $args){
            error_reporting(0);
            session_start();
            if($_SESSION['authStatus']==true){
                return $response->withRedirect('http://localhost:8123/API_Webservice_Perpus/api-management/'); 
            }else{
                $phpView = new \Slim\Views\PhpRenderer("./view");
                return $phpView->render($response, "/V_Login_Form.php");
            }
        }
        public function login($request, $response, $args){
            session_start();
                $phpView = new \Slim\Views\PhpRenderer("./view");
                $data = $request->getParsedBody();
                $username = $data['username'];
                $password = $data['password'];
                $password = md5($password);
                $api = new \models\ApiKey();
                $adminData = $api->adminData($username, $password);
                $cek = count($adminData);
                if($cek > 0){
                    foreach($adminData as $a){
                        $_SESSION["authStatus"] = true;
                        $_SESSION["username"] = $a->nama_pengguna;
                        return $response->withRedirect('http://localhost:8123/API_Webservice_Perpus/api-management/'); 
                    }
                }else{
                    $_SESSION["failedLoginStatus"] = true;
                    return $response->withRedirect('http://localhost:8123/API_Webservice_Perpus/'); 
                }
        }

        public function logout($request, $response, $args){
            session_start();
            $_SESSION['authStatus']=false;
            session_destroy(); 
            return $response->withRedirect('http://localhost:8123/API_Webservice_Perpus/'); 
        }
        
        public function get_ip($request, $response, $args){
            $api_key = $args['api_key'];
            $api = new \models\ApiKey();
            $ip = $api->ip($api_key);
            return $response->withJson($ip);
        }

        public function update_api($request, $response, $args){
            $data = $request->getParsedBody();
            $api = new \models\ApiKey();
            $data = $api->update_api_data($data);
        }

        public function delete_api($request, $response, $args){
            $data = $request->getParsedBody();
            $api = new \models\ApiKey();
            $data = $api->delete_api_data($data);
        }

        public function create_api($request, $response, $args){
            $data = $request->getParsedBody();
            $api = new \models\ApiKey();
            $data = $api->create_api_data($data);
        }
        
    }
?>