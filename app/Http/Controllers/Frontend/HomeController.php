<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;

class HomeController extends Controller
{
    //Return Home Page
    public function index(){
        $breakingNews= News::where([
            'is_breaking_news'=> 'yes',
            ])->activeEntries()->withLocalize()->orderBy('id','DESC')->take(10)->get();
        return view('frontend.home',compact('breakingNews'));
    }

    //Blog Details
    function showNews($slug){
        $newsDetails = News::with(['admin','tags'])->where('slug',$slug)->activeEntries()->withLocalize()->first();
        $this->viewCount($newsDetails);

        $recentNews = News::with(['category','admin'])->where('slug', '!=', $newsDetails->slug)->latest()->take(4)->activeEntries()->withLocalize()->get();
        return view('frontend.news-details', compact('newsDetails','recentNews'));
    }

    public function viewCount($news){

        if (session()->has('viewedPost')) {
            $postIds = session('viewedPost');

            if (!in_array($news->id, $postIds)) {
               $postIds[]=$news->id;
               $news->increment('views');
            }
            session(['viewedPost' => $postIds]);
        }else{
            session(['viewedPost' => [$news->id]]);
            $news->increment('views');
        }
    }


}
