<?php
    class User {

    public $id,$username,$password,$created_at,$updated_at,$deleted_at,$remember_token;

    public function __construct($id = 0 ,$username = '',$password = '',$created_at = NULL,$updated_at = NULL,$deleted_at = NULL,$remember_token = NULL)
    {
        // setting up data of new user model
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        $this->deleted_at = $deleted_at;
        $this->remember_token = $remember_token;
    }

    // find user by id
    public function find($id, $withDeleted = false)
    {
        //connect to database
        $conn = DB::getConnection();
        $query = '';
        if (!$withDeleted) {
            $query = "SELECT * FROM `users` WHERE `id` = $id AND `deleted_at` IS NULL LIMIT 1";
        } else {
            $query = "SELECT * FROM `users` WHERE `id` = $id LIMIT 1";
        }
        $req = mysqli_query($conn,$query);
        DB::closeConnection();
        // check query
        if ($req != false) {
            $user = $req->fetch_assoc();
            return new User($user['id'],$user['username'],$user['password'],$user['created_at'],$user['updated_at'],$user['deleted_at'],$user['remember_token'],$user['remember_token']);
        }
        return NULL;
    }

    // find user by username
    public function findByName($username, $withDeleted = false)
    {
        //connect to database
        $conn = DB::getConnection();
        $query = '';
        if (!$withDeleted) {
            $query = "SELECT * FROM `users` WHERE `username` = '$username' AND `deleted_at` IS NULL LIMIT 1";
        } else {
            $query = "SELECT * FROM `users` WHERE `username` = '$username' LIMIT 1";
        }
        $req = mysqli_query($conn,$query);
        DB::closeConnection();
        // check query
        if ($req != false) {
            $user = $req->fetch_assoc();
            return new User($user['id'],$user['username'],$user['password'],$user['created_at'],$user['updated_at'],$user['deleted_at'],$user['remember_token']);
        }
        return NULL;
    }

    // get all users
    public function all($withDeleted = false) {
        //connect to database
        $connection = DB::getConnection();
        $query = '';
        if (!$withDeleted) {
            $query = "SELECT * FROM `users` WHERE `deleted_at` IS NULL";
        } else {
            $query = "SELECT * FROM `users`";
        }
        $req = $connection->query($query);
        $list = [];
        // check query
        if ($req != false) {
            foreach ($req->fetchAll() as $user) {
                $list[] = new User($user['id'],$user['username'],$user['password'],$user['created_at'],$user['updated_at'],$user['deleted_at'],$user['remember_token']);
            }
        }
        return $list;
    }

    // set a remember token to user
    public function setToken() {
        $remember_token = $this->remember_token;
        if ($this->remember_token == NULL) {
            do {
                $remember_token = bin2hex(random_bytes(20));
                $conn = DB::getConnection();
                $query = "SELECT * FROM `users` WHERE `remember_token` = '$remember_token' LIMIT 1";
                $req = mysqli_query($conn,$query);
            }
            while (mysqli_num_rows($req) > 0);
        }
        $this->remember_token = $remember_token;
        return $remember_token;
    }

    public function delete() {
        $conn = DB::getConnection();
        $this->deleted_at = date("Y-m-d H:i:s");
        $query = "UPDATE `users` SET 
            `deleted_at` = '$this->deleted_at'
            WHERE `id` = $this->id;";
        $req = mysqli_query($conn,$query);
    }

    // save changes
    public function save() {
        $conn = DB::getConnection();
        $query = "SELECT * FROM `users` WHERE `id` = $this->id LIMIT 1";
        $req = mysqli_query($conn,$query);
        if (mysqli_num_rows($req) > 0) {
            $query = "UPDATE `users` SET 
                `username` = '$this->username',
                `password` = '$this->password',
                `remember_token` = '$this->remember_token'
                WHERE `id` = $this->id;";
            $req = mysqli_query($conn,$query);
        }
        else {
            $query = "INSERT INTO users (`username`,`password`) VALUES ('$this->username','$this->password')";
            $req = mysqli_query($conn,$query);
        }
        DB::closeConnection();
    }
}
