<?php

use App\Models\Language;
use Illuminate\Support\Str;

// Tags format

function formatTage($tags){
    return implode(",",$tags);
}

//Get all language
function languages(){
    return Language::where('status','active')->get();
}


//Get language from session
function getLanguage(){
    if (session()->has('language')) {
        return session('language');
    }else{
        try {
            $language = Language::where('default',1)->first();
            session(['language' => $language->slug]);
            return $language->slug;
        } catch (\Throwable $th) {
            session(['language' => 'en']);
            return $language->slug;
        }
    }
}


//truncate

function truncate(String $text, Int $limit = 100): String{
    return Str::limit($text, $limit, '...');
}

//Convert number into k format

function convertNumberToKFormat(int $number):String
{
    if ($number < 1000) {
        return $number;
    } elseif ($number < 1000000) {
        return round($number / 1000, 1) . 'K';
    } else {
        return round($number / 1000000, 1) . 'M';
    }

}
