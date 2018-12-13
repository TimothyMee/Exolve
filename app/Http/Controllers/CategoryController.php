<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function add(Request $request, Category $category)
    {
        try{
            $request = $request->all();
            $result = $category->createNew($request);

            return redirect()->back()->with('success', 'Category '.$result['name'].' created successfully');
        }
        catch (\Exception $e)
        {
            return redirect()->back()->with('error', $e);
        }
    }

    public function getAllWithVideos()
    {
        $category = new Category();
        $result = $category->getAllWithVideos();
        return apiSuccess($result, 'Fetched Data successfully', '200');
    }
}
