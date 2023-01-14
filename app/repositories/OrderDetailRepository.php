<?php

namespace App\Repositories;

use App\Models\Event;
use App\Core\Database;
use App\Models\OrderDetail;


class OrderDetailRepository
{
    private $db;
    private const db_name = 'order_detail';
    private int $user_id;

    public function __construct()
    {
        $this->db = new Database;
        $this->user_id = $_SESSION['user_session']['id'];
    }

    public function store(OrderDetail $orderDetail): bool
    {
        $this->db->query('INSERT INTO ' . self::db_name . '(order_id, ticket_id, qty, total_price) VALUES (:order_id, :ticket_id, :qty, :total_price)');
        $this->db->bind('order_id', $orderDetail->order_id);
        $this->db->bind('ticket_id', $orderDetail->ticket_id);
        $this->db->bind('qty', $orderDetail->qty);
        $this->db->bind('total_price', $orderDetail->total_price);

        return $this->db->execute();
    }

    public function delete(int $id)
    {
        $this->db->query('DELETE FROM ' . self::db_name . ' WHERE id = :id');
        $this->db->bind('id', $id);

        return $this->db->execute();
    }

    public function getOrderDetailById(int $id) : array
    {
        $this->db->query('SELECT o.*, t.type as ticket_type, t.price as ticket_price, e.title as event_title, e.image as event_image FROM ' . self::db_name . ' o INNER JOIN ticket t ON o.ticket_id = t.id INNER JOIN event e ON t.event_id = e.id WHERE o.id = :id');
        $this->db->bind('id', $id);

        return $this->db->fetch();
    }

    public function getByOrderId(int $order_id)
    {
        $this->db->query('SELECT o.*, t.type as ticket_type, t.price as ticket_price, e.title as event_title, e.image as event_image FROM ' . self::db_name . ' o INNER JOIN ticket t ON o.ticket_id = t.id INNER JOIN event e ON t.event_id = e.id WHERE order_id = :order_id');
        $this->db->bind('order_id', $order_id);
        
        return $this->db->fetchAll();
    }

    public function getOneByOrderId(int $order_id)
    {
        $this->db->query('SELECT o.*, t.type as ticket_type, t.price as ticket_price, e.title as event_title FROM ' . self::db_name . ' o INNER JOIN ticket t ON o.ticket_id = t.id INNER JOIN event e ON t.event_id = e.id WHERE order_id = :order_id LIMIT 1');
        $this->db->bind('order_id', $order_id);
        
        return $this->db->fetch();
    }

    public function getCount(int $order_id)
    {
        $this->db->query('SELECT * FROM ' . self::db_name . ' WHERE order_id = :order_id');
        $this->db->bind('order_id', $order_id);
        return $this->db->rowCount();
    }

    public function checkTicket(int $ticket_id)
    {
        $this->db->query('SELECT * FROM ' . self::db_name . ' WHERE ticket_id = :ticket_id');
        $this->db->bind('ticket_id', $ticket_id);

        return $this->db->rowCount();
    }

    public function getSameTicket(int $ticket_id, int $order_id)
    {
        $this->db->query('SELECT id FROM ' . self::db_name . ' WHERE ticket_id = :ticket_id AND order_id = :order_id LIMIT 1');
        $this->db->bind('ticket_id', $ticket_id);
        $this->db->bind('order_id', $order_id);

        return $this->db->fetchAll();
    }

    public function update(OrderDetail $orderDetail)
    {
        $this->db->query('UPDATE ' . self::db_name .' SET  qty = qty + :qty,  total_price = total_price + :total_price WHERE id = :id');
        $this->db->bind('qty', $orderDetail->qty);
        $this->db->bind('total_price', $orderDetail->total_price);
        $this->db->bind('id', $orderDetail->id);

        return $this->db->execute();
    }


   
}
