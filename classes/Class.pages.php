<?php
include_once '../admin/Helpers/dataBaseClass.php';
class pagesClass {
    private $db;

    public function __construct() {
        $this->db = new DataBaseClass( 'pages');
    }

    public function findBy() {
        return $this->db->readBy();
    }

    public function findById($id) {
        return $this->db->readBy('page_id', $id);
    }

    public function update($data, $id) {
        if (is_numeric($id)){
            return $this->db->updateinfo($data, $id,'page_id');
        }
    }

    public function createPage($data) {
        return $this->db->insert($data);
    }

    public function getAllPages($offset, $users_per_page){
        return $this->db->getAllPages($offset, $users_per_page);
    }

    public function getTotalPages(){
        return $this->db->getTotal();
    }

    public function deletePageByid($id){
        return $this->db->delete('page_id='.$id);
    }



}
?>
