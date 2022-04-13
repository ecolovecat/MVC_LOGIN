<?php

require_once '../libraries/Database.php';

class User {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function findUserEmailOrUsername($email, $username) {
        $this->db->query('SELECT * FROM users WHERE userUid = :username OR userEmail = :email ');
        $this->db->bind(':username', $username);
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else return false;
    }

    public function register($data) {
        $this->db->query("INSERT INTO users (userName, userEmail, userUid, userPwd) values (:name, :email, :Uid, :password)");
        // bind values
        $this->db->bind(':name', $data['userName']);
        $this->db->bind(':email', $data['userEmail']);
        $this->db->bind(':Uid', $data['userUid']);
        $this->db->bind(':password', $data['userPwd']);
        //execute
        if ($this->db->execute()) {
            return true;
        } else return false;
    }

    // Login user
    public function login($nameOrEmail, $password) {
        $row = $this->findUserEmailOrUsername($nameOrEmail, $nameOrEmail);

        if ($row == false) return false;
        $hashedPwd = $row->userPwd;
        if (password_verify($password, $hashedPwd)) {
            return $row;
        } else return false;
    }
}