<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use domain\Facades\BrandFacade\BrandFacade;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BrandsController extends Controller
{
    // protected $task;

    // public function __construct()
    // {
    //     $this->task = new Brand();
    // }

    public function index()
    {
        return Inertia::render('Settings/Brands/all');
    }

    public function store(Request $request)
    {
        //dd($request->all());
        return BrandFacade::create($request->all());
        // return $this->task->create($request->all());
    }


    public function show()
    {
        $data = BrandFacade::view();
        return response()->json($data);

    }
}
