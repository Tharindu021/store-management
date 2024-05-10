<?php

namespace domain\Services\BrandServices;
use App\Models\Brand;

class BrandServices
{
    protected $task;

    public function __construct()
    {
        $this->task = new Brand();
    }

    public function view(){
        //dd($this->task->all());
        return $this->task->all();
    }

    public function create($data){
        return $this->task->create($data);
    }
}