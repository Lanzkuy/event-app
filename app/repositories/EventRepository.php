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

    public function store(Event $event)
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

        return $this->db->lastInsertId();
    }

    public function get(string $key, string $value): ?Event
    {
        $this->db->query('SELECT e.*, u.email as user_email, u.name as user_name, c.name as category_name FROM ' . self::db_name . ' e INNER JOIN user u ON e.user_id = u.id INNER JOIN category c ON e.category_id = c.id WHERE e.' . $key . ' = :value AND e.deleted_at is null');
        $this->db->bind('value', $value);
        $data = $this->db->fetch();

        if ($data == false) {
            return null;
        }

        $event = new Event;
        $event->id = $data['id'];
        $event->user_id = $data['user_id'];
        $event->category_id = $data['category_id'];
        $event->title = $data['title'];
        $event->description = $data['description'];
        $event->image = $data['image'];
        $event->location = $data['location'];
        $event->start_datetime = $data['start_datetime'];
        $event->end_datetime = $data['end_datetime'];
        $event->status = $data['status'];
        $event->created_at = $data['created_at'];
        $event->deleted_at = $data['deleted_at'];

        return $event;
    }

    /*public function getAll(int $position, int $limit): array
    {
        $this->db->query('SELECT e.*, u.email as user_email, u.name as user_name, c.name as category_name FROM ' . self::db_name . ' e INNER JOIN user u ON e.user_id = u.id INNER JOIN category c ON e.category_id = c.id WHERE e.deleted_at is null AND user_id = :user_id ORDER BY e.id LIMIT :position, :limit');
        $this->db->bind('user_id', $this->user_id);
        $this->db->bind('position', $position);
        $this->db->bind('limit', $limit);

        return $this->db->fetchAll();
    }*/

    public function getAll(): array
    {
        $this->db->query('SELECT e.*, u.email as user_email, u.name as user_name, c.name as category_name FROM ' . self::db_name . ' e INNER JOIN user u ON e.user_id = u.id INNER JOIN category c ON e.category_id = c.id WHERE e.deleted_at is null ORDER BY e.id');

        return $this->db->fetchAll();
    }

    public function find(string $title, int $position, int $limit): array
    {
        $this->db->query('SELECT e.*, u.email as user_email, u.name as user_name, c.name as category_name FROM ' . self::db_name . ' e INNER JOIN user u ON e.user_id = u.id INNER JOIN category c ON e.category_id = c.id WHERE e.title LIKE :title AND e.deleted_at is null ORDER BY e.id LIMIT :position, :limit');
        $this->db->bind('title', '%' . $title . '%');
        $this->db->bind('position', $position);
        $this->db->bind('limit', $limit);

        return $this->db->fetchAll();
    }

    public function update(Event $event): bool
    {
        $this->db->query('UPDATE ' . self::db_name . ' SET user_id = :user_id, category_id = :category_id, title = :title, description = :description, image = :image, location = :location, start_datetime = :start_datetime, end_datetime = :end_datetime WHERE id = :id');
        $this->db->bind('id', $event->id);
        $this->db->bind('user_id', $event->user_id);
        $this->db->bind('category_id', $event->category_id);
        $this->db->bind('title', $event->title);
        $this->db->bind('description', $event->description);
        $this->db->bind('image', $event->image);
        $this->db->bind('location', $event->location);
        $this->db->bind('start_datetime', $event->start_datetime);
        $this->db->bind('end_datetime', $event->end_datetime);

        return $this->db->execute();
    }

    public function delete(int $id): bool
    {
        $this->db->query('UPDATE ' . self::db_name . ' SET deleted_at = :deleted_at WHERE id = :id');
        $this->db->bind('id', $id);
        $this->db->bind('deleted_at', date('Y-m-d H:i:s'));

        return $this->db->execute();
    }

    public function getRowCount(): int
    {
        $this->db->query('SELECT * FROM ' . self::db_name . ' WHERE deleted_at is null');

        return $this->db->rowCount();
    }
}
