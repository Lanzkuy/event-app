<?php

namespace App\Repositories;

use App\Core\Database;
use App\Models\Ticket;

class TicketRepository
{
    private $db;
    private const db_name = 'ticket';

    public function __construct()
    {
        $this->db = new Database;
    }

    public function store(Ticket $ticket): Ticket
    {
        $this->db->query('INSERT INTO ' . self::db_name . '(event_id, price, type, description) VALUES (:event_id, :price, :type, :description)');
        $this->db->bind('event_id', $ticket->event_id);
        $this->db->bind('price', $ticket->price);
        $this->db->bind('type', $ticket->type);
        $this->db->bind('description', $ticket->description);
        $this->db->execute();

        return $this->getLast();
    }

    public function get(string $key, string $value): ?Ticket
    {
        $this->db->query('SELECT t.*, e.* FROM ' . self::db_name . ' t INNER JOIN event e ON t.event_id = e.id WHERE ' . $key . ' = :' . $key . ' AND t.deleted_at is null');
        $this->db->bind($key, $value);
        $data = $this->db->fetch();

        if ($data == false) {
            return null;
        }

        $ticket = new Ticket;
        $ticket->id = $data['id'];
        $ticket->event_id = $data['event_id'];
        $ticket->price = $data['price'];
        $ticket->type = $data['type'];
        $ticket->description = $data['description'];
        $ticket->created_at = $data['created_at'];
        $ticket->deleted_at = $data['deleted_at'];

        return $ticket;
    }

    public function getAll(int $position = 0, int $limit = 8): array
    {
        $this->db->query('SELECT t.*, e.* FROM ' . self::db_name . ' t INNER JOIN event e ON t.event_id = e.id WHERE t.deleted_at is null LIMIT ' . $position . ' , ' . $limit);
        return $this->db->fetchAll();
    }

    public function find(string $event_name, int $position = 0, int $limit = 8): array
    {
        $this->db->query('SELECT t.*, e.* FROM ' . self::db_name . ' t INNER JOIN event e ON t.event_id = e.id WHERE e.title LIKE :event_name AND t.deleted_at is null LIMIT ' . $position . ' , ' . $limit);
        $this->db->bind('event_name', '%'.$event_name.'%');
        return $this->db->fetchAll();
    }

    public function getLast(): Ticket
    {
        $this->db->query('SELECT * FROM ' . self::db_name . ' ORDER BY id DESC LIMIT 1;');
        $data = $this->db->fetch();

        $ticket = new Ticket;
        $ticket->id = $data['id'];
        $ticket->event_id = $data['event_id'];
        $ticket->price = $data['price'];
        $ticket->type = $data['type'];
        $ticket->description = $data['description'];
        $ticket->created_at = $data['created_at'];
        $ticket->deleted_at = $data['deleted_at'];

        return $ticket;
    }

    public function update(Ticket $ticket): Ticket
    {
        $this->db->query('UPDATE ' . self::db_name . ' SET event_id = :event_id, price = :price, type = :type, description = :description WHERE id = :id');

        $this->db->bind('id', $ticket->id);
        $this->db->bind('event_id', $ticket->event_id);
        $this->db->bind('price', $ticket->price);
        $this->db->bind('type', $ticket->type);
        $this->db->bind('description', $ticket->description);
        $this->db->execute();

        return $this->getLast();
    }

    public function delete(int $id): bool
    {
        $this->db->query('UPDATE ' . self::db_name . ' SET deleted_at = :deleted_at WHERE id = :id');

        $this->db->bind('id', $id);
        $this->db->bind('deleted_at', date('y-m-d h:m:s', time()));

        return $this->db->execute();
    }
}
