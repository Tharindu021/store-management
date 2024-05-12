<?php

namespace domain\Services\CategoryServices;
use App\Models\Category;


class CategoryServices
{
    protected $category;

    public function __construct()
    {
        $this->category = new Category();
    }

    public function all(){
        return $this->category->all();
    }

    public function store($data){
        return $this->category->create($data);
    }

    public function delete($id){
        $category = $this->category->find($id);
        $category->delete();
    }

    public function get($id){
        $category = $this->category->find($id);
        return $category;
    }

    public function update(array $data , int $id){
        $category = $this->category->find($id);
        return $category ->update($this->edit($category, $data));
    }

    protected function edit(Category $category, array $data)
    {
        return array_merge($category->toArray(), $data);
    }

    public function deleteSelected($data)
    {
        
        $ids = $data->input('ids');
        Category::whereIn('id', $ids)->delete();

        return response()->json([
            'success' => true,
        ]);
    }

    public function inactive($data)
    {
        $ids = $data->input('ids');
        $category = Category::whereIn('id', $ids)->get();

        foreach ($category as $categories) {
            $categories->status = 0;
            $categories->update();
        }

        return response()->json([
            'success' => true,
        ]);
    }

    public function active($data)
    {
        $ids = $data->input('ids');

        $category = Category::whereIn('id', $ids)->get();

        foreach ($category as $categories) {
            $categories->status = 1;
            $categories->update();
        }

        return response()->json([
            'success' => true,
        ]);
    }
}