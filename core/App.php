<?php
// Definisi konstanta default
define("DEFAULT_CONTROLLER", "Home"); // Sesuaikan dengan controller utama
define("DEFAULT_METHOD", "index");

// Class App untuk routing dan menangani URL
class App {
    protected $controller = DEFAULT_CONTROLLER;
    protected $method = DEFAULT_METHOD;
    protected $params = [];

    public function __construct() {
        $url = $this->parseUrl();
        
        // Mencari controller
        if(isset($url[0])) {
            if(file_exists('controllers/' . ucfirst($url[0]) . 'Controller.php')) {
                $this->controller = ucfirst($url[0]);
                unset($url[0]);
            } else {
                // Redirect ke error page jika controller tidak ditemukan
                $this->controller = 'Error';
            }
        }

        require_once 'controllers/' . $this->controller . 'Controller.php';
        $this->controller = $this->controller . 'Controller';
        $this->controller = new $this->controller;

        // Mencari method
        if(isset($url[1])) {
            if(method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // Menyimpan parameter
        $this->params = $url ? array_values($url) : [];

        // Memanggil method dari controller dengan parameter
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl() {
        if(isset($_GET['url'])) {
            // Membersihkan URL dari trailing slash dan karakter berbahaya
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
        
        return [];
    }
}
?>
