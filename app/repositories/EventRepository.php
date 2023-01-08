<?php

namespace App\Repositories;

use App\Core\Database;
use App\Models\Event;

class EventRepository
{
    private $db;
    private const db_name = 'event';
    private int $user_id;

    public function __construct()
    {
        $this->db = new Database;
        $this->user_id = $_SESSION['user_session']['id'];
    }

    public function store(Event $event): bool
    {
        $this->db->query('INSERT INTO ' . self::db_name . '(user_id, category_id, title, description, image, location, start_datetime, end_datetime, status, created_at, deleted_at) VALUES (:user_id, :category_id, :title, :description, :image, :location, :start_datetime, :end_datetime, :status, :created_at, :deleted_at)');
        $this->db->bind('user_id', $this->user_id);
        $this->db->bind('category_id', $event->category_id);
        $this->db->bind('title', $event->title);
        $this->db->bind('description', $event->description);
        $this->db->bind('image', $event->image);
        $this->db->bind('location', $event->location);
        $this->db->bind('start_datetime', $event->start_datetime);
        $this->db->bind('end_datetime', $event->end_datetime);
        $this->db->bind('status', null);
        $this->db->bind('created_at', date('Y-m-d H:i:s'));
        $this->db->bind('deleted_at', null);
        $this->db->execute();

        return true;
    }

    public function get(int $id): array
    {
        $this->db->query('SELECT * FROM ' . self::db_name . ' WHERE id = :id AND deleted_at is null');
        $this->db->bind('id', $id);
        return $this->db->fetch();
    }

    public function getAll(int $position, int $limit): array
    {
        $this->db->query('SELECT * FROM ' . self::db_name . ' WHERE user_id = :user_id AND deleted_at is null ORDER BY id DESC LIMIT :position, :limit');
        $this->db->bind('user_id', $this->user_id);
        $this->db->bind('position', $position);
        $this->db->bind('limit', $limit);
        return $this->db->fetchAll();
    }

    public function find(string $title, int $position, int $limit): array
    {
        $this->db->query('SELECT * FROM ' . self::db_name . ' WHERE title LIKE :title AND user_id = :user_id AND deleted_at is null ORDER BY id DESC LIMIT :position, :limit');
        $this->db->bind('title', '%' . $title . '%');
        $this->db->bind('user_id', $this->user_id);
        $this->db->bind('position', $position);
        $this->db->bind('limit', $limit);
        return $this->db->fetchAll();
    }

    public function paginate(?string $title): int
    {
        if($title){
            $this->db->query('SELECT * FROM ' . self::db_name . ' WHERE title LIKE :title AND user_id = :user_id AND deleted_at is null');
            $this->db->bind('title', '%' . $title . '%');
            $this->db->bind('user_id', $this->user_id);
        }else{
            $this->db->query('SELECT * FROM ' . self::db_name . ' WHERE user_id = :user_id AND deleted_at is null');
            $this->db->bind('user_id', $this->user_id);
        }

        return $this->db->rowCount();
    }
    
    public function update(Event $event): bool
    {
        $this->db->query('UPDATE ' . self::db_name . ' SET category_id = :category_id, title = :title, description = :description, image = :image, location = :location, start_datetime = :start_datetime, end_datetime = :end_datetime WHERE id = :id');

        $this->db->bind('category_id', $event->category_id);
        $this->db->bind('title', $event->title);
        $this->db->bind('description', $event->description);
        $this->db->bind('image', $event->image);
        $this->db->bind('location', $event->location);
        $this->db->bind('start_datetime', $event->start_datetime);
        $this->db->bind('end_datetime', $event->end_datetime);
        $this->db->bind('id', $event->id);
        $this->db->execute();

        return true;
    }

    public function delete(int $id): bool
    {
        $this->db->query('UPDATE ' . self::db_name . ' SET deleted_at = :deleted_at WHERE id = :id');

        $this->db->bind('id', $id);
        $this->db->bind('deleted_at', date('Y-m-d H:i:s'));

        return $this->db->execute();
    }
}
