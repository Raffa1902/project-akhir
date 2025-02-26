<?php
// Controller untuk halaman error

class ErrorController extends Controller {
    public function index() {
        $data = [
            'title' => 'Error 404',
            'message' => 'Halaman tidak ditemukan'
        ];

        // Memuat view
        $this->view('templates/header', $data);
        $this->view('error/index', $data);
        $this->view('templates/footer');
    }
}