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

    public function store($data){
        return $this->brand->create($data);
    }

    public function delete($id){
        $brand = $this->brand->find($id);
        $brand->delete();
    }

    public function get($id){
        $brand = $this->brand->find($id);
        return $brand;
    }

    public function update(array $data , int $id){
        $brand = $this->brand->find($id);
        return $brand ->update($this->edit($brand, $data));
    }

    protected function edit(Brand $brand, array $data)
    {
        return array_merge($brand->toArray(), $data);
    }

    public function deleteSelected($data)
    {
        
        $ids = $data->input('ids');
        dd($ids);
        Brand::whereIn('id', $ids)->delete();

        return response()->json([
            'success' => true,
        ]);
    }

    public function inactive($data)
    {
        $ids = $data->input('ids');

        $brand = Brand::whereIn('id', $ids)->get();

        foreach ($brand as $brands) {
            $brands->status = 0;
            $brands->update();
        }

        return response()->json([
            'success' => true,
        ]);
    }

    public function active($data)
    {
        $ids = $data->input('ids');

        $brand = Brand::whereIn('id', $ids)->get();

        foreach ($brand as $brands) {
            $brands->status = 1;
            $brands->update();
        }

        return response()->json([
            'success' => true,
        ]);
    }

}