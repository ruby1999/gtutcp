<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
    public function menu(){
        $datas = DB::table('categories')->distinct()->where('parent_id', '=', 0)->get();
        // dd($datas);
        foreach ($datas as $key => $row) {
            $b = DB::table('categories')->distinct()->where('parent_id', '=', $row->id)->get();
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
        $contents = Content::all();
        $categories = Category::all();


        $system = array('1' => '快易購', '2' => '快易');
        $top_catalog = $request->get('top-catalog');
        $meddle_catalog = $request->get('meddle_catalog');

        $categoryId = $request->get('id');

        // if (!$top_catalog) {
        //     $categoryId = $request->get('id');
        // } elseif ($meddle_catalog && $top_catalog) {
        //     $categoryId = $meddle_catalog;
        // } elseif ($top_catalog) {
        //     $categoryId = $top_catalog;
        // }

        // $posts = Post::orderBy('id', 'asc')->paginate(5);
        return view('home', compact('datas','contents', 'categories','system'));
    }


    public function searchSuppliers($categoryId, $keyword = null)
    {
        $languageId = config('app.language_id');

        $categoryIds = ContentCategory::select('id')
                ->where('route', 'like', "%{$categoryId}%")
                ->get();

        if (count($categoryIds) == 0) {
            $categoryIds = ContentCategory::select('id')
            ->where('id', $categoryId)
            ->get();
        }

        $items = collect();

        $contents = Content::leftJoin('content_details as details', function (JoinClause $join) use ($languageId) {
                $join->on('details.content_id', '=', 'contents.id');
                $join->where('details.language_id', '=', $languageId);
            })
            ->leftJoin('content_categories_contents as categories_contents', function (JoinClause $join) {
                $join->on('categories_contents.content_id', '=', 'contents.id');
            })
            ->where(function ($query) use ($keyword) {
                $query->where('details.title', 'like', "%{$keyword}%")
                      ->orWhere('details.introduction', 'like', "%{$keyword}%")
                      ->orWhere('details.description', 'like', "%{$keyword}%");
            })
            ->whereIn('categories_contents.content_category_id', $categoryIds)
            ->frontendFilter()
            ->activeIs(ActiveEnum::PUBLISHED, 'details')
            ->orderBy('order', 'ASC')
            ->get([
                'contents.*',
                'details.title',
                'details.parsed_introduction',
                'details.parsed_description',
                'details.image',
            ]);

        return $contents;
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
