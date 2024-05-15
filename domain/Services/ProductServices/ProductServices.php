<?php

namespace domain\Services\ProductServices;
use App\Models\Products;


class ProductServices
{
    protected $product;

    public function __construct()
    {
        $this->product = new Products();
    }

    public function all()
    {
        return $this->product->all();
    }

    public function store($data)
    {
        return $this->product->create($data);
    }

    public function delete($id)
    {
        $product = $this->product->find($id);
        $product->delete();
    }

    public function get($id)
    {
        $product = $this->product->find($id);
        return $product;
    }

    public function update(array $data, $id)
    {
        $product = $this->product->find($id);
        return $product ->update($this->edit($product, $data));
    }

    protected function edit(Products $product, array $data)
    {
        return array_merge($product->toArray(), $data);
    }

}