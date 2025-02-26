<?php
// Class Controller dasar
class Controller {
    /**
     * Method untuk memuat model
     * @param string $model Nama model yang akan dipanggil
     * @return object Model yang dimuat
     */
    public function model($model) {
        $file = 'models/' . $model . '.php';
        if (file_exists($file)) {
            require_once $file;
            return new $model();
        } else {
            die("Model <b>$model</b> tidak ditemukan.");
        }
    }

    /**
     * Method untuk memuat view
     * @param string $view Nama view yang akan dipanggil
     * @param array $data Data yang akan dikirim ke view
     */
    public function view($view, $data = []) {
        $file = 'views/' . $view . '.php';
        
        if (file_exists($file)) {
            require_once $file;
        } else {
            // Pastikan file error ada, jika tidak, tampilkan pesan sederhana
            if (file_exists('views/error/index.php')) {
                require_once 'views/error/index.php';
            } else {
                die("Error: View <b>$view</b> tidak ditemukan, dan halaman error juga tidak tersedia.");
            }
        }
    }
    

    /**
     * Method untuk melakukan redirect
     * @param string $url Halaman tujuan redirect
     */
    public function redirect($url) {
        header('Location: ' . BASE_URL . '/' . ltrim($url, '/'));
        exit;
    }
}
