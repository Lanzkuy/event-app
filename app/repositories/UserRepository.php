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

    public function store(User $user): bool
    {
        $this->db->query('INSERT INTO ' . self::db_name . '(email, password, name) VALUES (:email, :password, :name)');
        $this->db->bind('email', $user->email);
        $this->db->bind('password', $user->password);
        $this->db->bind('name', $user->name);

        return $this->db->execute();
    }

    public function get(string $key, string $value): ?User
    {
        $this->db->query('SELECT * FROM ' . self::db_name . ' WHERE ' . $key . ' = :value AND deleted_at is null LIMIT 1');
        $this->db->bind('value', $value);
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

    /*public function getAll(int $position, int $limit): array
    {
        $this->db->query('SELECT * FROM ' . self::db_name . ' WHERE deleted_at is null LIMIT :position, :limit');
        $this->db->bind('position', $position);
        $this->db->bind('limit', $limit);

        return $this->db->fetchAll();
    }*/

    public function getAll(): array
    {
        $this->db->query('SELECT * FROM ' . self::db_name . ' WHERE deleted_at is null ORDER BY role');
        
        return $this->db->fetchAll();
    }

    public function find(string $email, int $position, int $limit) : array
    {
        $this->db->query('SELECT * FROM ' . self::db_name . ' WHERE email = :email AND deleted_at is null LIMIT :position, :limit');
        $this->db->bind('email', '%' . $email . '%');
        $this->db->bind('position', $position);
        $this->db->bind('limit', $limit);

        return $this->db->fetchAll();
    }

    public function update(User $user): bool
    {
        $this->db->query('UPDATE ' . self::db_name . ' SET email = :email, name = :name, role = :role WHERE id = :id');
        $this->db->bind('id', $user->id);
        $this->db->bind('email', $user->email);
        $this->db->bind('name', $user->name);
        $this->db->bind('role', $user->role);

        return $this->db->execute();
    }

    public function delete(int $id): bool
    {
        $this->db->query('UPDATE ' . self::db_name . ' SET deleted_at = :deleted_at WHERE id = :id');
        $this->db->bind('id', $id);
        $this->db->bind('deleted_at', date('y-m-d h:m:s', time()));

        return $this->db->execute();
    }
}
