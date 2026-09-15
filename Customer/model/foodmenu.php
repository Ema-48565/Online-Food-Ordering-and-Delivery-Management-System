<?php
include_once("../../DatabaseConnection.php");

class FoodMenu {
    private $db;
    private $connection;

    public function __construct() {
        $this->db = new DatabaseConnection();
        $this->connection = $this->db->openConnection();
    }

    public function getAllFoods() {
        $result = $this->connection->query("SELECT * FROM foods");
        $foods = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $foods[] = $row;
            }
        }
        return $foods;
    }

    public function getAllRestaurants() {
        $result = $this->connection->query("SELECT * FROM restaurants");
        $restaurants = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $row['name'] = $row['restaurant_name'];
                $restaurants[] = $row;
            }
        }
        return $restaurants;
    }

    public function searchFoods($keyword) {
        $keyword = $this->connection->real_escape_string($keyword);
        $result = $this->connection->query("SELECT * FROM foods WHERE name LIKE '%$keyword%'");
        $foods = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $foods[] = $row;
            }
        }
        return $foods;
    }

    public function getFoodById($id) {
        $id = (int)$id;
        $result = $this->connection->query("SELECT * FROM foods WHERE id = $id");
        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        return null;
    }

    public function getSuggestedFoods($id) {
        $id = (int)$id;
        $result = $this->connection->query("SELECT * FROM foods WHERE id != $id LIMIT 3");
        $foods = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $foods[] = $row;
            }
        }
        return $foods;
    }
}
?>