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

    public function store(Ticket $ticket): bool
    {
        $this->db->query('INSERT INTO ' . self::db_name . '(event_id, price, stock, type, description) VALUES (:event_id, :price, :stock, :type, :description)');
        $this->db->bind('event_id', $ticket->event_id);
        $this->db->bind('price', $ticket->price);
        $this->db->bind('stock', $ticket->stock);
        $this->db->bind('type', $ticket->type);
        $this->db->bind('description', $ticket->description);

        return $this->db->execute();
    }

    public function getByType(string $type, int $event_id)
    {
        $this->db->query('SELECT * FROM ' . self::db_name . ' WHERE event_id = :event_id AND type = :type');
        $this->db->bind('event_id', $event_id);
        $this->db->bind('type', $type);

        return $this->db->fetch();
    }

    /*public function getAll(int $position, int $limit): array
    {
        $this->db->query('UPDATE ' . self::db_name . ' SET stock = stock - :qty WHERE id = :id');
        $this->db->bind('qty', $qty);
        $this->db->bind('id', $id);

        return $this->db->fetchAll();
    }*/

    public function getAll(): array
    {
        $this->db->query('SELECT t.*, e.title as event_title, e.description as event_description FROM ' . self::db_name . ' t INNER JOIN event e ON t.event_id = e.id WHERE t.deleted_at is null ORDER BY event_id, price');

        return $this->db->fetchAll();
    }

    public function find(string $event_title, int $position, int $limit): array
    {
        $this->db->query('SELECT t.*, e.title as event_title, e.description as event_description FROM ' . self::db_name . ' t INNER JOIN event e ON t.event_id = e.id WHERE e.title LIKE :event_title AND t.deleted_at is null LIMIT :position, :limit');
        $this->db->bind('event_title', '%'.$event_title.'%');
        $this->db->bind('position', $position);
        $this->db->bind('limit', $limit);
        
        return $this->db->fetchAll();
    }

    public function update(Ticket $ticket): bool
    {
        $this->db->query('UPDATE ' . self::db_name . ' SET price = :price, stock = :stock, description = :description WHERE id = :id');
        $this->db->bind('id', $ticket->id);
        $this->db->bind('price', $ticket->price);
        $this->db->bind('stock', $ticket->stock);
        $this->db->bind('description', $ticket->description);

        return $this->db->execute();
    }

    public function updateQty(int $id, int $qty)
    {
        $this->db->query('UPDATE ' . self::db_name . ' SET stock = stock - :qty WHERE id = :id');
        $this->db->bind('qty', $qty);
        $this->db->bind('id', $id);

        return $this->db->execute();
    }

    public function delete(int $event_id): bool
    {
        $this->db->query('UPDATE ' . self::db_name . ' SET deleted_at = :deleted_at WHERE event_id = :event_id');
        $this->db->bind('event_id', $event_id);
        $this->db->bind('deleted_at', date('y-m-d h:m:s', time()));

        return $this->db->execute();
    }
    
    public function getByEventId(int $event_id): array
    {
        $this->db->query('SELECT * FROM ' . self::db_name . ' WHERE event_id = :event_id');        
        $this->db->bind('event_id', $event_id);
        return $this->db->fetchAll();
    }
 
}
