<?php
class Product extends Model
{
    public function getAllProduct()
    {
        $query = 'SELECT wp.package_code, wp.status_publish, 
                         pd.package_name, pd.package_image, pd.description, pd.price
                  FROM wedding_package wp
                  JOIN package_details pd ON wp.package_id = pd.package_id';

        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $products = $result->fetch_all(MYSQLI_ASSOC);
            return $products;
        } else {
            return [];
        }
    }

    public function addProduct($data)
    {
        $query_wp = 'INSERT INTO wedding_package (status_publish, user_id, created_at, updated_at) 
                     VALUES (?, ?, NOW(), NOW())';
        $stmt_wp = $this->db->prepare($query_wp);
        $stmt_wp->bind_param('si', $data['status_publish'], $data['user_id']);
        $stmt_wp->execute();

        $package_id = $stmt_wp->insert_id;
        $package_code = 'JWP' . $package_id;

        $query_update_code = 'UPDATE wedding_package SET package_code = ? WHERE package_id = ?';
        $stmt_code = $this->db->prepare($query_update_code);
        $stmt_code->bind_param('si', $package_code, $package_id);
        $stmt_code->execute();

        $query_pd = 'INSERT INTO package_details (package_id, package_name, package_image, description, price) 
                     VALUES (?, ?, ?, ?, ?)';
        $stmt_pd = $this->db->prepare($query_pd);
        $stmt_pd->bind_param('isssd', $package_id, $data['package_name'], $data['package_image'], $data['description'], $data['price']);
        $stmt_pd->execute();
    }

    public function getProductByCode($package_code)
    {
        $query = 'SELECT wp.package_id, wp.package_code, wp.status_publish, wp.user_id, wp.created_at, wp.updated_at, 
                         pd.package_name, pd.package_image, pd.description, pd.price
                  FROM wedding_package wp
                  JOIN package_details pd 
                  ON wp.package_id = pd.package_id
                  WHERE wp.package_code = ?';
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $package_code);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function updateProduct($package_code, $data)
    {
        $query_select_package_id = 'SELECT package_id FROM wedding_package WHERE package_code = ?';
        $stmt_select_package_id = $this->db->prepare($query_select_package_id);
        $stmt_select_package_id->bind_param('s', $package_code);
        $stmt_select_package_id->execute();
        $result_package = $stmt_select_package_id->get_result();

        if ($result_package->num_rows > 0) {
            $row = $result_package->fetch_assoc();
            $package_id = $row['package_id'];

            if (isset($data['package_image'])) {
                $query_update_details = 'UPDATE package_details SET package_name = ?, package_image = ?, description = ?, price = ? WHERE package_id = ?';
                $stmt_update_details = $this->db->prepare($query_update_details);
                $stmt_update_details->bind_param('sssdi', $data['package_name'], $data['package_image'], $data['description'], $data['price'], $package_id);
            } else {
                $query_update_details = 'UPDATE package_details SET package_name = ?, description = ?, price = ? WHERE package_id = ?';
                $stmt_update_details = $this->db->prepare($query_update_details);
                $stmt_update_details->bind_param('ssdi', $data['package_name'], $data['description'], $data['price'], $package_id);
            }


            if ($stmt_update_details->execute()) {
                echo "Details updated successfully";
            } else {
                echo "Error updating details: " . $stmt_update_details->error;
            }

            $update_status_publish = 'UPDATE wedding_package SET status_publish = ?, updated_at = NOW() WHERE package_code = ?';
            $stmt_update_status_publish = $this->db->prepare($update_status_publish);
            $stmt_update_status_publish->bind_param('ss', $data['status_publish'], $package_code);


            if ($stmt_update_status_publish->execute()) {
                echo "Status updated successfully";
            } else {
                echo "Error updating status: " . $stmt_update_status_publish->error;
            }

            return true;
        } else {
            return false;
        }
    }

    public function deleteProduct($package_code)
    {
        $query = 'DELETE FROM wedding_package WHERE package_code = ?';
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $package_code);
        $stmt->execute();
    }
}
