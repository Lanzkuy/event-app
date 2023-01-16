<?php

namespace App\Repositories;

use App\Core\Database;
use App\Models\Ticket;

class UserTicketRepository
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

    public function updateQty(int $id, int $qty)
    {
        $this->db->query('UPDATE ' . self::db_name . ' SET stock = stock - :qty WHERE id = :id');
        $this->db->bind('qty', $qty);
        $this->db->bind('id', $id);

        return $this->db->execute();
    }

    public function addQty(int $id, int $qty)
    {
        $this->db->query('UPDATE ' . self::db_name . ' SET stock = stock + :qty WHERE id = :id');
        $this->db->bind('qty', $qty);
        $this->db->bind('id', $id);

        return $this->db->execute();
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