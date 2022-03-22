<?php

namespace App\Controllers;
use App\Models\SelectItem;
use CodeIgniter\API\ResponseTrait;
class Home extends BaseController
{   
     use ResponseTrait;

    protected $table = 'selectitems';
    private $db; 

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {  

        $d = new SelectItem();
        $data['items']  = $d->get_all_data(); 
        echo view('home', $data);

    }

    public function getchildren($parent_id)
    {   

        $d= [];
        $data = new SelectItem();
        $a  = $data->get_child_items($parent_id);

        if( count($a) <= 0 ) {
            $childItems = $data->create_child_items($parent_id);
            $a  = $data->get_child_items($parent_id);
        }

         foreach($a as $item)
         {
             $d[] = ['id' => $item->id , 'item' => $item->select_item];
         }

           return $this->respond($d);

    }

    
}
