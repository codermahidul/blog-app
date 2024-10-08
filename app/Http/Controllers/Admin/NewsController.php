<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminNewsCreateRequest;
use App\Http\Requests\AdminNewsUpdateRequest;
use App\Models\Category;
use App\Models\Language;
use App\Models\News;
use App\Models\Tag;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
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
     * Toggle Status.
     */
    public function toggleNewsStatus(Request $request)
    {
        try {
            $news = News::findOrFail($request->id);
        $message = '';


        if ($request->name == 'status') {

            if ($request->status == 'true') {
                $news->status = 'active';
                $message = 'Status active successfully!';
            } else {
                $news->status = 'inactive';
                $message = 'Status inactive successfully!';
            }
            $news->save();
            $message;
        }
        elseif($request->name == 'is_breaking'){
            if ($request->status == 'true') {
                $news->is_breaking_news = 'yes';
                $message = 'News on breaking!';
            } else {
                $news->is_breaking_news = 'no';
                $message = 'News not on breaking!';
            }
            $news->save();
            $message;
        }
        elseif ($request->name == 'show_at_slider') {
            if ($request->status == 'true') {
                $news->show_at_slider = 'yes';
                $message = 'News show at slider!';
            } else {
                $news->show_at_slider = 'no';
                $message = 'News not show at slider!';
            }
            $news->save();
            $message;
        }
        elseif($request->name == 'show_at_popular'){
            if ($request->status == 'true') {
                $news->show_at_popular = 'yes';
                $message = 'News show at popular';
            } else {
               $news->show_at_popular = 'no';
               $message= 'News not show at popular';
            }
            $news->save();
            $message;
        }

        return response(['status' => 'success', 'message' => __($message)]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $language = Language::all();
        $news = News::find($id);
        $categories = Category::where('language',$news->language)->get();
        return view('admin.news.edit',compact('language','news','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminNewsUpdateRequest $request, string $id)
    {
        //Image handle
        $news=News::findOrFail($id);
        $save_url = $news->thumbnail;

        if ($request->file('thumbnail')) {
            // unlink(base_path('public/' . $news->thumbnail));

            $manager = new ImageManager(new Driver);
            $image = $request->file('thumbnail');
            $name = 'thumbnail-'.Str::uuid().'.'.$image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img = $img->resize(600,400);
            $img->save(base_path('public/uploads/thumbnail/'.$name));
            $save_url = 'uploads/thumbnail/'.$name;
        }

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

        $news->language = $request->input('language');
        $news->category_id = $request->input('category');
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

        $news->tags()->delete();
        $news->tags()->detach($news->tags);

        foreach ($tags as $tag) {
            $item = new Tag();
            $item->name = $tag;
            $item->save();

            $tagsId[] = $item->id;
        }

        $news->tags()->attach($tagsId);


        toast(__('News Update Successfull!'),'success')->width('350');
        return redirect()->route('admin.news.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $news = News::findOrFail($id);
        unlink(base_path('public/'.$news->thumbnail));
        $news->tags()->delete();
        $news->delete();
        return response(['status' => 'success', 'message' => __('News Deleted successfully!')]);

    }


    public function copyNews(string $id){

        $news = News::findOrFail($id);
        $newsCopy = $news->replicate();
        $newsCopy->save();
        toast(__('News Copied Successfully!'), 'success')->width('350');

        return redirect()->back();

    }






}
