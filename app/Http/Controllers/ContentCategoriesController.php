<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Throwable;
use DB;

class ContentCategoriesController extends Controller
{
    // private $contentCategoryRepository;


    /**
     * ContentCategoriesController constructor.
     *
     * @param ContentCategoryRepository  $contentCategoryRepository
     */
    public function __construct()
    {
        // $this->middleware('check.customerInformation');
        // $this->contentCategoryRepository = $contentCategoryRepository;
    }

    /**
     * ajax取得底下分類
     *
     * @param Request $request
     *
     * @throws Exception
    */

    public function ajaxGetSuppliersSubcategories(Request $request)
    {
        try {
            $id = $request->get('id');

            if (isset($id)) {
                $categories = DB::table('categories')
                    ->where('categories.parent_id', $id)
                    ->get(['categories.id','categories.name']);
            
                foreach ($categories as $category) {
                    $data[] = [
                        'id' => $category->id,
                        'name' => $category->name
                    ];
                }
            }
            $data = isset($data) ? $data : '';

            return json_encode(['data' => $data]);

            // 這邊在抓大分類下面的子分類了，應該可以想辦法直接塞，不要透過contentCategoryRepository
            // 然後我都DD不出來

            // 要先把資料塞成array
            // 再encode成jason，傳回去ajax，成為res

            // return json_encode(123);
        } catch (Exception $exception) {
            exception_debug($exception);

            return response()->json([
                'status' => 'Error: ',
                'message' => '錯誤'
            ]);
        }
    }
}
