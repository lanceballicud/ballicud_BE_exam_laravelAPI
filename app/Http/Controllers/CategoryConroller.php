<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryConroller extends Controller
{
    public function index()
    {
        // Return all categories as JSON
        return response()->json(Category::all());
    }
}
