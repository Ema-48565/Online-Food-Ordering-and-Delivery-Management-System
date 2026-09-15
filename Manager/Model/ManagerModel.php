<?php
class ManagerModel {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function getTotalOrders() {
        $result = $this->conn->query("SELECT COUNT(*) AS total FROM orders");
        return $result ? $result->fetch_assoc()['total'] : 0;
    }

    public function getTodayRevenue() {
        // created_at কলাম না থাকায় সাময়িকভাবে টোটাল রেভিনিউ হিসাব করা হলো যাতে এরর না আসে
        $result = $this->conn->query("SELECT COALESCE(SUM(amount),0) AS revenue FROM orders");
        return $result ? $result->fetch_assoc()['revenue'] : 0;
    }

    public function getPendingOrdersCount() {
        $result = $this->conn->query("SELECT COUNT(*) AS total FROM orders WHERE status = 'Pending'");
        return $result ? $result->fetch_assoc()['total'] : 0;
    }

    public function getCompletedOrdersCount() {
        $result = $this->conn->query("SELECT COUNT(*) AS total FROM orders WHERE status = 'Completed'");
        return $result ? $result->fetch_assoc()['total'] : 0;
    }

    public function getRecentOrders($limit = 10) {
        return $this->conn->query("SELECT * FROM orders ORDER BY id DESC LIMIT $limit");
    }

    public function getAllFoods() {
        return $this->conn->query("SELECT * FROM foods ORDER BY id DESC");
    }

    public function getFoodById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM foods WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $res;
    }

    public function addFood($name, $category, $price, $status) {
        $stmt = $this->conn->prepare("INSERT INTO foods (name, category, price, status) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssds", $name, $category, $price, $status);
        $res = $stmt->execute();
        $stmt->close();
        return $res;
    }

    public function updateFood($id, $name, $category, $price, $status) {
        $stmt = $this->conn->prepare("UPDATE foods SET name=?, category=?, price=?, status=? WHERE id=?");
        $stmt->bind_param("ssdsi", $name, $category, $price, $status, $id);
        $res = $stmt->execute();
        $stmt->close();
        return $res;
    }

    public function deleteFood($id) {
        $stmt = $this->conn->prepare("DELETE FROM foods WHERE id = ?");
        $stmt->bind_param("i", $id);
        $res = $stmt->execute();
        $stmt->close();
        return $res;
    }

    public function getOrdersByStatus($filter) {
        if ($filter === 'All') {
            return $this->conn->query("SELECT * FROM orders ORDER BY id DESC");
        } else {
            $stmt = $this->conn->prepare("SELECT * FROM orders WHERE status=? ORDER BY id DESC");
            $stmt->bind_param("s", $filter);
            $stmt->execute();
            $res = $stmt->get_result();
            $stmt->close();
            return $res;
        }
    }

    public function updateOrderStatus($id, $status) {
        $stmt = $this->conn->prepare("UPDATE orders SET status=? WHERE id=?");
        $stmt->bind_param("si", $status, $id);
        $res = $stmt->execute();
        $stmt->close();
        return $res;
    }
}
?>