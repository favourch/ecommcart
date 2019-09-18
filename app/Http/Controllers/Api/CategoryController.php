<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\CategoryGroup;
use App\CategorySubGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategoryGroupResource;
use App\Http\Resources\CategorySubGroupResource;

class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::active()->get();
        return CategoryResource::collection($categories);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function categoryGroup()
    {
        $categories = CategoryGroup::active()->get();
        return CategoryGroupResource::collection($categories);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function categorySubGroup()
    {
        $categories = CategorySubGroup::active()->get();
        return CategorySubGroupResource::collection($categories);
    }
}
