<?php
include_once  'Database.class.php';
class TripClass
{
    private $db;

    public function __construct()
    {
        $this->db = new DataBaseClass('trips');
    }

    public function findByDriver($driver_id)
    {
        return $this->db->readBy('driver_id', $driver_id);
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

    public function createTrip($data)
    {
        return $this->db->insert($data);
    }



    public function getAllTrips($columnName = null, $value = null)
    {
        return $this->db->getAll($columnName, $value);
    }

    public function getTotalTrips($columnName = null, $value = null)
    {
        return $this->db->getTotal($columnName, $value);
    }

    public function deleteTripByid($id)
    {
        return $this->db->delete('id=' . $id);
    }
}
