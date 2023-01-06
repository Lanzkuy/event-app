<?php

namespace App\Repositories;

use App\Core\Database;
use App\Models\Ticket;
use PDO;

class TicketRepository
{
    private $db;
    private const db_name = 'ticket';

    public function __construct()
    {
        $this->db = new Database;
    }

    public function create(Ticket $ticket): Ticket
    {
        $this->db->query('INSERT INTO ' . self::db_name . '(event_id, price, type, description) VALUES (:event_id, :price, :type, :description)');
        $this->db->bind('event_id', $ticket->event_id);
        $this->db->bind('price', $ticket->price);
        $this->db->bind('type', $ticket->type);
        $this->db->bind('description', $ticket->description);
        $this->db->execute();

        return $this->getLast();
    }

    public function getAll() : array
    {
        $this->db->query('SELECT * FROM ' . self::db_name . ' WHERE deleted_at is null');
        return $this->db->fetchAll();
    }

    public function find(string $key, string $value) : ?Ticket
    {
        $this->db->query('SELECT * FROM ' . self::db_name . ' WHERE ' . $key . ' = :' . $key . ' AND deleted_at is null');
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

    public function update(Ticket $ticket) : Ticket
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

    public function delete(int $id) : bool
    {
        $this->db->query('UPDATE ' . self::db_name . ' SET deleted_at = :deleted_at WHERE id = :id');

        $this->db->bind('id', $id);
        $this->db->bind('deleted_at', date('y-m-d h:m:s', time()));

        return $this->db->execute();
    }
}
