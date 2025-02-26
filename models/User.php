<?php
// Contoh model User

class User {
    private $db;
    
    public function __construct() {
        // Inisialisasi koneksi database
        $this->db = new Database;
    }

    // Mendapatkan semua user
    public function getAllUsers() {
        $this->db->query('SELECT * FROM users');
        return $this->db->resultSet();
    }

    // Mendapatkan user berdasarkan id
    public function getUserById($id) {
        $this->db->query('SELECT * FROM users WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    // Membuat user baru
    public function createUser($data) {
        $this->db->query('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');
        
        // Binding parameter
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        // Eksekusi query
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Update user
    public function updateUser($data) {
        $this->db->query('UPDATE users SET name = :name, email = :email WHERE id = :id');
        
        // Binding parameter
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':id', $data['id']);

        // Eksekusi query
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Hapus user
    public function deleteUser($id) {
        $this->db->query('DELETE FROM users WHERE id = :id');
        $this->db->bind(':id', $id);
        
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}