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
        $datas = DB::table('categories')->distinct()->where('parent_id', '=', 0)->select('id', 'name')->get();
        // dd($datas);
        foreach ($datas as $key => $row) {
            $b = DB::table('categories')->distinct()->where('parent_id', '=', $row->id)->select('id', 'name')->get();
            if(json_decode($b) != []) {
                $datas[$key]->subCategories = $b;
            }
        }
        dd($datas);
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
        // dd($datas);
        // $contents = Content::all();
        $categories = Category::all();
        $contents = DB::table('content')
            ->join('categories', function($join)
            {
                $join->on('content.category_id', '=', 'categories.id');
            })
            ->select('content.*', 'categories.name as sub_cat')
            ->get();
        // dd($contents);


        // $cat = DB::table('categories')->distinct()->where('parent_id', '=', 0)->get('name');
        $top_cat = DB::table('categories')->where('parent_id', 0)->select('id', 'name')->get();

        // dd($roles);

        $top_catalog = $request->get('top-catalog');
        $meddle_catalog = $request->get('meddle_catalog');

        // $categoryId = $request->get('id');

        // if (!$top_catalog) {
        //     $categoryId = $request->get('id');
        // } elseif ($meddle_catalog && $top_catalog) {
        //     $categoryId = $meddle_catalog;
        // } elseif ($top_catalog) {
        //     $categoryId = $top_catalog;
        // }

        // $posts = Post::orderBy('id', 'asc')->paginate(5);
        return view('home', compact('datas', 'contents', 'categories','system', 'top_cat'));
    }

    public function showCatPage(Request $request)
    {
        dd($request);
        // $data = $this->menu();
        // $posts = DB::table('pages')
        //              ->select(DB::raw('*'))
        //              ->where('categoryID', '=', 4);
        // $categories = Category::all();
        // $posts = $posts->get();

        // return view('frontend.pages.posts', ['datas' => $data])->withPosts($posts)->withCategories($categories);

        // $datas = $this->menu();
        // $categories = Category::all();

        // $contents = DB::table('content')
        //     ->join('categories', function($join)
        //     {
        //         $join->on('content.category_id', '=', 'categories.id');
        //     })
        //     ->select('content.*', 'categories.name as sub_cat')
        //     ->get();

        // $posts = Post::orderBy('id', 'asc')->paginate(5);
        return view('home', compact('datas', 'contents', 'categories','system'));
    }

    public function searchSuppliers2(
        ImageProxyService $imageProxyService,
        ContentTransformer $contentTransformer,
        Request $request
    )
    {
        try {
            $this->imageProxyService = $imageProxyService;
            $this->contentTransformer = $contentTransformer;

            $top_catalog = $request->get('top-catalog');
            $meddle_catalog = $request->get('meddle_catalog');

            $keyword = $request->get('q');

            if (!$top_catalog) {
                $categoryId = $request->get('id');
            } elseif ($meddle_catalog && $top_catalog) {
                $categoryId = $meddle_catalog;
            } elseif ($top_catalog) {
                $categoryId = $top_catalog;
            }

            $contents = $this->searchService->searchSuppliers($categoryId, $keyword);

            $imageProxyConfigs =
                            $this->imageProxyService->getConfigsByTypes([ImageProxyTypeEnum::PAGE_CONTENT]);

            $contents = $this->contentTransformer->transform($contents, $imageProxyConfigs);

            $html = '';
            foreach ($contents as $key => $row) {
                $html .= '<div class="item col-md-4 col-sm-6">';
                $html .= '<div class="vendor">';
                $html .= '<a href="'. $row->url .'" title="'.$row->name. '" target="_blank" rel="nofollow">';
                $html .= '<div class="picp">';
                if (isset($row->image)) {
                    $html .= '<img src = "'. $row->image .'"' . $row->image_attr .'>';
                }
                $html .= '</div>';
                $html .= '<div class="text">';
                $html .= '<h5>'.$row->title.'</h5>';
                $html .= '<p>'.$row->parsed_introduction.'</p>';
                $html .= '</div></a></div></div>';
            }

            return json_encode(['data' => $html]);
        } catch (Exception $exception) {
            exception_debug($exception);

            abort(404);
        } catch (Throwable $e) {
            exception_debug($e);

            abort(404);
        }
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
