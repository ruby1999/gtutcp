<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Search\SearchService;
use Collective\Html\FormFacade as Form;
// use Illuminate\Pagination\LengthAwarePaginator;
// use App\Services\Optimize\Cache\CacheService;
// use App\Services\Page\PageService;
use App\Category;
use App\Content;
use DB;
// use Form;

class HomeController extends Controller
{

    private $searchService;

    /**
     * SearchesController constructor.
     *
     * @param SearchService $searchService
     */
    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    public function menu(){
        $datas = DB::table('categories')->distinct()->where('parent_id', '=', 0)->select('id', 'name', 'slug')->get();

        foreach ($datas as $key => $row) {
            $b = DB::table('categories')->distinct()->where('parent_id', '=', $row->id)->select('id', 'name', 'slug')->get();
            if(json_decode($b) != []) {
                $datas[$key]->subCategories = $b;
            }
        }

        return $datas;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $datas = $this->menu();
        $contents = DB::table('content')
            ->join('categories', function($join)
            {
                $join->on('content.category_id', '=', 'categories.id');
            })
            ->select('content.*', 'categories.name as sub_cat')
            ->get();
        // dd($datas);
        // $contents = Content::all();
        $categories = Category::all();

        $top_cat = DB::table('categories')->where('parent_id', 0)->select('id', 'name')->get();

        return view('home', compact('datas', 'contents', 'categories', 'top_cat'));
    }

    public function showCatPage(Request $request)
    {

        $contents = DB::table('content')
            ->join('categories', function($join)
            {
                $join->on('content.category_id', '=', 'categories.id');
            })
            ->select('content.*', 'categories.name as sub_cat')
            ->get();
        // dd($contents);

        $cat = DB::table('categories')->distinct()->where('parent_id', '=', 0)->get('name');
        // dd($request);
        $data = $this->menu();
        $posts = DB::table('pages')
                     ->select(DB::raw('*'))
                     ->where('categoryID', '=', 4);
        $categories = Category::all();
        $posts = $posts->get();

        return view('frontend.pages.posts', ['datas' => $data])->withPosts($posts)->withCategories($categories);

        $datas = $this->menu();
        $categories = Category::all();


        // $posts = Post::orderBy('id', 'asc')->paginate(5);
        return view('home', compact('datas', 'contents', 'categories','system'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // $select = DB::table('categories')
    // ->select('*')
    // ->where('parent_id', '=', 0)
    // ->get();
}
