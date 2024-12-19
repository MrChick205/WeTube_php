<?php
require_once '../models/type_movie.php'; // Đảm bảo đường dẫn đúng đến file model

class TypeController {
    private $typeModel;

    public function __construct($dbConnection) {
        $this->typeModel = new TypeModel($dbConnection);
    }

    // Thêm một loại mới
    public function addType($typeName) {
        if ($this->typeModel->addType($typeName)) {
            echo "Thêm loại thành công!";
        } else {
            echo "Không thể thêm loại.";
        }
    }

    // Lấy tất cả các loại
    public function getAllTypes() {
        $types = $this->typeModel->getAllTypes();
        foreach ($types as $type) {
            echo "ID: " . $type['type_id'] . " - Tên: " . $type['type_name'] . "<br>";
        }
    }

    // Lấy thông tin loại theo ID
    public function getTypeById($typeId) {
        $type = $this->typeModel->getTypeById($typeId);
        if ($type) {
            echo "ID: " . $type['type_id'] . " - Tên: " . $type['type_name'];
        } else {
            echo "Không tìm thấy loại.";
        }
    }

    // Cập nhật thông tin loại
    public function updateType($typeId, $typeName) {
        if ($this->typeModel->updateType($typeId, $typeName)) {
            echo "Cập nhật loại thành công!";
        } else {
            echo "Không thể cập nhật loại.";
        }
    }

    // Xóa loại theo ID
    public function deleteType($typeId) {
        if ($this->typeModel->deleteType($typeId)) {
            echo "Xóa loại thành công!";
        } else {
            echo "Không thể xóa loại.";
        }
    }
}

$typeController = new TypeController($conn);
$conn->close();
?>