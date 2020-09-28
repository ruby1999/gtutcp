<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Query\Builder;

use App\Http\Requests;
use App\Post;
use App\Category; //引用Model
use App\Page;
use Session; //引用會話(提示新建貼文成功)
use Image; //要存入照片
use Storage;
use DB;

class PageController extends Controller
{
    // 抓NAVBAR
    public function menu(){
        $datas = [];

        // --NAV_BAR--
        $datas = DB::table('category')->distinct()->where('categoryID', '=', 0)->get();
        // dd($datas);
        foreach ($datas as $key => $row) {
            $datas[$key]->subCategories = DB::table('category')->distinct()->where('categoryID', '=', $row->id)->get();
            // dd($datas[$key]->subCategories);
            foreach ($datas[$key]->subCategories as $k => $val) {
                $datas[$key]->subCategories[$k]->childCategories = DB::table('category')->distinct()->where('categoryID', '=', $val->id)->get();
            }
            // dd($datas);
        }
        return $datas;
    }
    
    public function id( $categoryID ){
        $id = DB::table('category')
                 ->select('id')
                 ->where('categoryID', '=', $categoryID)
                 ->get();
        return $id;
    }

    // 所有貼文
    public function allPosts(){
        $data = $this->menu();
        $catID = $this->id('1'); //呼叫function id() 傳入父類別的ID(第一層分類)
        $catID = json_decode($catID,false);
        // VAR_DUMP($catID);
        $id = array_column($catID, 'id');
    
        $select = DB::table('pages')
        ->select('*')
        ->whereIn('categoryID', $id);
        // ->whereIn('categoryID', $catID);
        
        $categories = Category::all();
        $posts = $select->get();
        
        return view('frontend.pages.posts', ['datas' => $data])->withPosts($posts)->withCategories($categories);
    }
    
    // 日常貼文
    public function dailyPost(){
        $data = $this->menu();
        // 待補把ID2k7
        $posts = DB::table('pages')
                     ->select(DB::raw('*'))
                     ->where('categoryID', '=', 4);
        $categories = Category::all();
        $posts = $posts->get();

        return view('frontend.pages.posts', ['datas' => $data])->withPosts($posts)->withCategories($categories);
    }

    // 優惠貼文
    public function salePost(){
        $data = $this->menu();
        $posts = DB::table('pages')
                        ->select(DB::raw('*'))
                        ->where('categoryID', '=', 5);
        $categories = Category::all();
        $posts = $posts->get();

        return view('frontend.pages.posts', ['datas' => $data])->withPosts($posts)->withCategories($categories);
    }
}
