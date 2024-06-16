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
}
