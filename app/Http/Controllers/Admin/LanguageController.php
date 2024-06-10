<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLanguageStoreRequest;
use App\Http\Requests\AdminLanguageUpdateRequest;
use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function index()
    {
        $languages = Language::latest()->get();
        return view('admin.language.index', compact('languages'));
    }

    public function create()
    {
        return view('admin.language.create');
    }

    public function store(AdminLanguageStoreRequest $request)
    {

        $language = new Language();
        $language->language = $request->name;
        $language->slug = $request->slug;
        $language->default = $request->default;
        $language->status = $request->status;
        $language->save();
        toast(__('Created successfully'), 'success')->width(400);
        return redirect()->route('admin.language.index');
    }

    public function edit(string $id)
    {
        $language = Language::findOrFail($id);
        return view('admin.language.edit', compact('language'));
    }


    public function update(AdminLanguageUpdateRequest $request, string $id)
    {
        $language = Language::findOrFail($id);
        $language->language = $request->name;
        $language->slug = $request->slug;
        $language->default = $request->default;
        $language->status = $request->status;
        $language->save();
        toast(__('Update successfully'), 'success')->width(400);
        return redirect()->route('admin.language.index');
    }

    public function destroy(string $id)
    {
        try {
            $language = Language::findOrFail($id);
            if ($language->slug == 'en') {
            return response(['status' => 'error', 'message' =>  __('You can\'t delete default language.')]);
            }
            $language->delete();
            return response(['status' => 'success', 'message' =>  __('Deleted successfull!')]);
        } catch (\Throwable $th) {
            return response(['status' => 'error', 'message' => __('Something went wrong!')]);
        }
    }
}
