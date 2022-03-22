<?php

namespace App\Models;

use CodeIgniter\Model;

class SelectItem extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'selectitems';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];


     protected $db;
     protected $builder;

     public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder =  $this->db->table($this->table);
    }

    public function insert_data($data = array())
    {
        $this->db->table($this->table)->insert($data);
        return $this->db->insertID();
    }

    public function update_data($id, $data = array())
    {
        $this->db->table($this->table)->update($data, array(
            "id" => $id,
        ));
        return $this->db->affectedRows();
    }

    public function delete_data($id)
    {
        return $this->db->table($this->table)->delete(array(
            "id" => $id,
        ));
    }

    public function get_all_data()
    {
        $query = $this->db->query('select * from ' . $this->table);
        return $query->getResult();
    }


    public function get_child_items($parent_id)
    {
        $query = $this->builder->where('select_item_parent_id',$parent_id)->get();       

        return $query->getResult();
    }

    public function create_child_items($id)
    {   
        $no_of_children = 2; 
        $parent = $this->builder->where('id',$id)->get()->getResult();
        
        for($i = 0; $i<$no_of_children; $i++ ) {

        $data = ['select_item' => $this->format_item_name($parent[0]->select_item, $i+1) , 'select_item_parent_id' => $id];
        $save = $this->insert_data($data);

        }

        return true; 

    }

    public function format_item_name($name, $count)
    {   
        
        $newName ='';
        if(str_contains($name, 'category')) {
          
            $newName = 'sub '.substr($name,9).$count;
            return $newName; 
        }

        else{

            $newName = 'sub '.$name.'-'.$count;
            return $newName; 
        }

    }

}
