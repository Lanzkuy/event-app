<?php

namespace App\Repositories;

use App\Models\Order;
use App\Core\Database;
use App\Models\OrderDetail;

class OrderRepository
{
    private $db;
    private const db_name = '`order`';
    private int $user_id;

    public function __construct()
    {
        $this->db = new Database;
        $this->user_id = $_SESSION['user_session']['id'];
    }

    public function check()
    {
        $this->db->query('SELECT * FROM ' . self::db_name . ' WHERE user_id = :user_id AND status = :status ORDER BY created_at DESC LIMIT 1');
        $this->db->bind('user_id', $this->user_id);
        $this->db->bind('status', 0);

        $data = $this->db->fetch();

        if ($data == false) {
            return null;
        }

        return $data;
    }

    public function store(Order $order): bool
    {
        $this->db->query('INSERT INTO ' . self::db_name . '(user_id, order_date, total_qty, total_price, created_at) VALUES (:user_id, :order_date, :total_qty, :total_price,:created_at)');
        $this->db->bind('user_id', $this->user_id);
        $this->db->bind('order_date', date('Y-m-d'));
        $this->db->bind('total_qty', $order->total_qty);
        $this->db->bind('total_price', $order->total_price);
        $this->db->bind('created_at', date('Y-m-d H:i:s'));

        return $this->db->execute();
    }


    public function update(Order $order): bool
    {
        $this->db->query('UPDATE ' . self::db_name . ' SET total_qty = total_qty + :total_qty, total_price = total_price + :total_price WHERE id = :id');
        $this->db->bind('id', $order->id);
        $this->db->bind('total_qty', $order->total_qty);
        $this->db->bind('total_price', $order->total_price);

        return $this->db->execute();
    }

    public function updateData(OrderDetail $orderDetail)
    {
        $this->db->query('UPDATE ' . self::db_name . ' SET total_qty = total_qty - :qty, total_price = total_price - :total_price WHERE id = :id');
        $this->db->bind('id', $orderDetail->order_id);
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

    public function updateStatus(int $id)
    {
        $this->db->query('UPDATE ' . self::db_name . ' SET status = :status WHERE id = :id');
        $this->db->bind('status', 2);
        $this->db->bind('id', $id);

        return $this->db->execute();
    }

    public function getByStatus(int $status)
    {
        $this->db->query('SELECT * FROM ' . self::db_name . ' WHERE user_id = :user_id AND status = :status');
        $this->db->bind('user_id', $this->user_id);
        $this->db->bind('status', $status);

        return $this->db->fetchAll();
    }

    public function getByOrderDetail(int $order_id)
    {
        $this->db->query('SELECT * FROM ' . self::db_name . ' WHERE user_id = :user_id AND id = :order_id');
        $this->db->bind('user_id', $this->user_id);
        $this->db->bind('order_id', $order_id);

        return $this->db->fetchAll();
    }

    public function getRowCount(): int
    {
        $this->db->query('SELECT * FROM ' . self::db_name . ' WHERE deleted_at is null');

        return $this->db->rowCount();
    }

    public function getOrderSummary(): array
    {
        for ($i = 1; $i < 13; $i++) {
            $this->db->query('SELECT COUNT(*) as order_total FROM ' . self::db_name . ' WHERE MONTH(order_date)=' . $i);
            $row = $this->db->fetchAll();
            $result[] = $row[0]['order_total'];
        }

        return $result;
    }
}
