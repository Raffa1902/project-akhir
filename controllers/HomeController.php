<?php
// Controller untuk halaman utama
class HomeController extends Controller {
    private $userModel; // Tambahkan jika ada model User

    public function __construct() {
        // Memuat model User jika diperlukan (hapus komentar jika model sudah ada)
        // if (file_exists('models/User.php')) {
        //     $this->userModel = $this->model('User');
        // }
    }

    public function index() {
        $data = [
            'title' => 'Halaman Utama',
            'content' => 'Selamat datang di aplikasi MVC PHP'
        ];

        // Memuat view dengan data yang sesuai
        $this->view('templates/header', $data);
        $this->view('home/index', $data);
        $this->view('templates/footer', $data);
    }
}
