<?php
class Order extends Model
{
    public function getOrderData()
    {
        $query = 'SELECT pd.package_image,
                         o.order_code, o.customer_name, o.customer_email, o.order_status
                  FROM wedding_package wp
                  JOIN orders o
                  ON wp.package_id = o.package_id
                  LEFT JOIN package_details pd 
                  ON wp.package_id = pd.package_id';
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $orders = $result->fetch_all(MYSQLI_ASSOC);
            return $orders;
        } else {
            return [];
        }
    }

    public function approveOrder($order_code)
    {
        $order_status = 'approved';
        $query = 'UPDATE orders SET order_status = ?, updated_at = NOW() WHERE order_code = ?';
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss', $order_status, $order_code);
        $stmt->execute();
    }

    public function cancelOrder($order_code)
    {
        $order_status = 'pending';
        $query = 'UPDATE orders SET order_status = ?, updated_at = NOW() WHERE order_code = ?';
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss', $order_status, $order_code);
        $stmt->execute();
    }

    public function deleteOrder($order_code)
    {
        $query = 'DELETE FROM orders WHERE order_code = ?';
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $order_code);
        $stmt->execute();
    }

    public function addOrder($data)
    {
        $query = 'INSERT INTO 
                  orders (package_id, customer_name, customer_email, customer_phone_number, wedding_date, created_at, updated_at)
                  VALUES (?, ?, ?, ?, ?, NOW(), NOW())';
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('issss', $data['package_id'], $data['customer_name'], $data['customer_email'], $data['customer_phone_number'], $data['wedding_date']);
        $stmt->execute();

        $order_id = $stmt->insert_id;
        $order_code = 'ORD' . $order_id;

        $query_order_code = 'UPDATE orders SET order_code = ? WHERE order_id = ?';
        $stmt_order_code = $this->db->prepare($query_order_code);
        $stmt_order_code->bind_param('si', $order_code, $order_id);
        $stmt_order_code->execute();
    }

    public function getOrderReport()
    {
        $query = 'SELECT pd.package_name, 
                         pd.package_image, 
                         wp.package_code, 
                         wp.status_publish, 
                         pd.price,
                         COUNT(o.order_id) AS total_orders,
                         (pd.price * COUNT(o.order_id)) AS total_revenue
                  FROM wedding_package wp
                  INNER JOIN orders o ON wp.package_id = o.package_id
                  LEFT JOIN package_details pd ON wp.package_id = pd.package_id
                  GROUP BY pd.package_id, pd.package_name, pd.package_image, wp.package_code, wp.status_publish, pd.price
                  HAVING total_orders > 0';

        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $orders = $result->fetch_all(MYSQLI_ASSOC);
            return $orders;
        } else {
            return [];
        }
    }
}
