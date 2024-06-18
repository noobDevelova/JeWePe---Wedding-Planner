<?php
class User extends Model
{
    public function getUserByEmail($email)
    {
        $stmt = $this->db->prepare('SELECT * FROM admin WHERE email = ?');
        $stmt->bind_param('s', $email);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    public function getDashboardMetrics()
    {
        $query = 'SELECT 
                (SELECT COUNT(*) FROM wedding_package) AS total_catalog,
                (SELECT COUNT(*) FROM orders) AS total_orders,
                (SELECT COUNT(*) FROM orders WHERE order_status = "pending") AS total_pending_orders,
                (SELECT COUNT(*) FROM orders WHERE order_status = "approved") AS total_approved_orders';

        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return [
                'total_catalog' => 0,
                'total_orders' => 0,
                'total_pending_orders' => 0,
                'total_approved_orders' => 0
            ];
        }
    }
}
