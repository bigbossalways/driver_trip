<?php
include_once BASE_URL . './Database.class.php';

class driverClass
{
    private $db;

    public function __construct()
    {
        $this->db = new DataBaseClass('driver');
    }

    public function findByEmail($email)
    {
        return $this->db->readBy('email', $email);
    }

    public function findById($id)
    {
        return $this->db->readBy('id', $id);
    }

    public function update($data, $id)
    {
        if (is_numeric($id)) {
            return $this->db->updateinfo($data, $id);
        }
    }

    public function createUser($data)
    {
        return $this->db->insert($data);
    }

    // public function upload($file)
    // {
    //     if (isset($file) && $file['error'] === UPLOAD_ERR_OK) {
    //         $targetDir = "uploads/";
    //         $fileName = basename($file['name']);
    //         $targetFilePath = $targetDir . $fileName;

    //         if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
    //             return $targetFilePath;
    //         } else {
    //             return "uploads/default.png";
    //             echo "Error uploading file.";
    //         }
    //     } else {
    //         return "uploads/default.png";
    //         echo "No file uploaded or an upload error occurred.";
    //     }
    // }

    public function getAllUsers($offset, $users_per_page, $roleId)
    {
        return $this->db->getAll($offset, $users_per_page, $roleId);
    }

    public function getTotalUsers($columnName = null, $value = null)
    {
        return $this->db->getTotal($columnName, $value);
    }

    public function deleteUserByid($id)
    {
        return $this->db->delete('id=' . $id);
    }
}
