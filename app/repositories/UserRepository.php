<?php

namespace App\Repositories;

use App\Core\Database;
use App\Models\User;

class UserRepository
{
    private $db;
    private const db_name = 'user';

    public function __construct()
    {
        $this->db = new Database;
    }

    public function create(User $user): User
    {
        $this->db->query("INSERT INTO user VALUES ('', :email, :password, :name, :role");
        $this->db->bind('email', $user->email);
        $this->db->bind('password', $user->password);
        $this->db->bind('name', $user->name);
        $this->db->bind('role', $user->role);
        $this->db->execute();

        return $this->getLast();
    }

    public function getAll(): array
    {
        $this->db->query('SELECT * FROM ' . self::db_name . ' WHERE deleted_at is null');
        return $this->db->fetchAll();
    }

    public function find(string $key, string $value): ?User
    {
        $this->db->query('SELECT * FROM ' . self::db_name . ' WHERE ' . $key . ' = :' . $key . ' AND deleted_at is null');
        $this->db->bind($key, $value);
        $data = $this->db->fetch();

        if ($data == false) {
            return null;
        }

        $user = new User;
        $user->id = $data['id'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->name = $data['name'];
        $user->role = $data['role'];
        $user->created_at = $data['created_at'];
        $user->deleted_at = $data['deleted_at'];

        return $user;
    }

    public function getLast(): User
    {
        $this->db->query('SELECT * FROM ' . self::db_name . ' ORDER BY id DESC LIMIT 1;');
        $data = $this->db->fetch();

        $user = new User;
        $user->id = $data['id'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->name = $data['name'];
        $user->role = $data['role'];
        $user->created_at = $data['created_at'];
        $user->deleted_at = $data['deleted_at'];

        return $user;
    }

    public function update(User $user): User
    {
        $this->db->query('UPDATE user SET email = :email, password = :password, name = :name, role = :role WHERE id = :id');

        $this->db->bind('id', $user->id);
        $this->db->bind('email', $user->email);
        $this->db->bind('password', $user->password);
        $this->db->bind('name', $user->name);
        $this->db->bind('role', $user->role);
        $this->db->execute();

        return $this->getLast();
    }

    public function delete($id): bool
    {
        $this->db->query("UPDATE user SET deleted_at = :deleted_at WHERE id = :id");

        $this->db->bind('id', $id);
        $this->db->bind('deleted_at', date('y-m-d h:m:s', time()));

        return $this->db->execute();
    }
}
