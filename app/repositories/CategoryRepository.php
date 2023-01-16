<?php

namespace App\Repositories;

use App\Core\Database;

class CategoryRepository
{
    private $db;
    private const db_name = 'category';

    public function __construct()
    {
        $this->db = new Database;
    }

    public function get(int $id): array
    {
        $this->db->query('SELECT * FROM ' . self::db_name . ' WHERE id = :id');
        $this->db->bind('id', $id);
        return $this->db->fetch();
    }

    public function getAll(): array
    {
        $this->db->query('SELECT * FROM ' . self::db_name);
        return $this->db->fetchAll();
    }
}
