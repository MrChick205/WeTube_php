<?php
require_once '../config/connect.php';
class TypeModel {
    private $db;

    public function __construct($dbConnection) {
        $this->db = $dbConnection;
    }

    // Thêm một loại mới
    public function addType($typeName) {
        $stmt = $this->db->prepare("INSERT INTO type (type_name) VALUES (?)");
        $stmt->bind_param("s", $typeName);
        return $stmt->execute();
    }

    // Lấy tất cả các loại
    public function getAllTypes() {
        $result = $this->db->query("SELECT * FROM type");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Lấy thông tin loại theo ID
    public function getTypeById($typeId) {
        $stmt = $this->db->prepare("SELECT * FROM type WHERE type_id = ?");
        $stmt->bind_param("i", $typeId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Cập nhật thông tin loại
    public function updateType($typeId, $typeName) {
        $stmt = $this->db->prepare("UPDATE type SET type_name = ? WHERE type_id = ?");
        $stmt->bind_param("si", $typeName, $typeId);
        return $stmt->execute();
    }

    // Xóa loại theo ID
    public function deleteType($typeId) {
        $stmt = $this->db->prepare("DELETE FROM type WHERE type_id = ?");
        $stmt->bind_param("i", $typeId);
        return $stmt->execute();
    }
}
?>