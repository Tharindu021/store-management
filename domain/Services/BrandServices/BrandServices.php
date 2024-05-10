<?php

namespace domain\Services\BrandServices;
use App\Models\Brand;

class BrandServices
{
    protected $brand;

    public function __construct()
    {
        $this->brand = new Brand();
    }

    public function all(){
        return $this->brand->all();
    }
    public function create($data){
        return $this->brand->create($data);
    }
    public function delete($id){
        $brand = $this->brand->find($id);
        $brand->delete();
    }

}