<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminNewsCreateRequest;
use App\Models\Category;
use App\Models\Language;
use App\Models\News;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $languages = Language::all();
        return view('admin.news.index',compact('languages'));
    }

    public function fatchCategory(Request $request){
        $language = $request->input('language');
        return $category = Category::where('language',$language)->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $language = Language::all();
        return view('admin.news.create',compact('language'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminNewsCreateRequest $request)
    {


        $manager = new ImageManager(new Driver);
        $image = $request->file('thumbnail');
        $name = 'thumbnail-'.Str::uuid().'.'.$image->getClientOriginalExtension();
        $img = $manager->read($image);
        $img = $img->resize(600,400);
        $img->save(base_path('public/uploads/thumbnail/'.$name));
        $save_url = 'uploads/thumbnail/'.$name;

        //condition
        $is_breaking_news = 'no';
        $show_at_slider = 'no';
        $show_at_popular = 'no';
        $status = 'inactive';

        if($request->input('is_breaking_news') == 'on'){
            $is_breaking_news = 'yes';
        }

        if($request->input('show_at_slider') == 'on'){
            $show_at_slider = 'yes';
        }

        if($request->input('show_at_popular') == 'on'){
            $show_at_popular = 'yes';
        }       
        
        if($request->input('status') == 'on'){
            $status = 'active';
        }

        $news = new News();
        $news->language = $request->input('language');
        $news->category_id = $request->input('category');
        $news->author_id = Auth::guard('admin')->user()->id;
        $news->title = $request->input('title');
        $news->slug = Str::slug($request->input('title'));
        $news->thumbnail = $save_url;
        $news->content = $request->input('content');
        $news->meta_title = $request->input('meta_title');
        $news->meta_description = $request->input('meta_description');
        $news->is_breaking_news = $is_breaking_news;
        $news->show_at_slider = $show_at_slider;
        $news->show_at_popular = $show_at_popular;
        $news->status = $status;
        $news->save();
        //Tag
        $tags = explode(',',$request->input('tags'));
        $tagsId = [];
        foreach ($tags as $tag) {
            $item = new Tag();
            $item->name = $tag;
            $item->save();

            $tagsId[] = $item->id;
        }

        $news->tags()->attach($tagsId);


        toast(__('News Created Successfull!'),'success')->width('350');
        return redirect()->route('admin.news.index');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
