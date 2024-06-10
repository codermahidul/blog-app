<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminCategoryCreateRequest;
use App\Http\Requests\AdminCategoryUpdateRequest;
use App\Models\Category;
use App\Models\Language;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $languages = Language::all();
        return view('admin.category.index',compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $language = Language::all();
        return view('admin.category.create',compact('language'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminCategoryCreateRequest $request)
    {
        $category = new Category();
        $category->language = $request->input('language');
        $category->name = $request->input('name');
        $category->slug = $request->input('slug');
        $category->show_at_nav = $request->input('show_at_nav');
        $category->status = $request->input('status');
        $category->save();
        toast( __('Created Successfull'),'success')->width('350');
        return redirect()->route('admin.category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $language = Language::all();
        $category = Category::findOrFail($id);
        return view('admin.category.edit',compact(['language','category']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminCategoryUpdateRequest $request, string $id)
    {
        $category = Category::findOrFail($id);
        $category->language = $request->input('language');
        $category->name = $request->input('name');
        $category->slug = $request->input('slug');
        $category->show_at_nav = $request->input('show_at_nav');
        $category->status = $request->input('status');
        $category->save();
        toast(__('Update successfully!'),'success')->width('350');
        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();
            return response(['status' => 'success', 'message' =>  __('Deleted successfull!')]);
        } catch (\Throwable $th) {
            return response(['status' => 'error', 'message' => __('Something went wrong!')]);
        }
    }
}
