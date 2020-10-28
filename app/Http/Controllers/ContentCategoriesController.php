<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Throwable;

class ContentCategoriesController extends Controller
{
    // private $contentCategoryRepository;


    /**
     * ContentCategoriesController constructor.
     *
     * @param ContentCategoryRepository  $contentCategoryRepository
     */
    public function __construct() {
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
            // $id = $request->get('id');

            // if (isset($id)) {
            //     $categories = $this->contentCategoryRepository->findSuppliersCategoryBySlug($id);

            //     foreach ($categories as $category) {
            //         $data[] = [
            //             'id' => $category->id,
            //             'name' => $category->name
            //         ];
            //     }
            // }
            // 要先把資料塞成array
            // 再encode成jason，傳回去ajax，成為res
            // $data = isset($data) ? $data : '';

            return json_encode(123);
        } catch (Exception $exception) {
            exception_debug($exception);

            return response()->json([
                'status' => 'Error: ',
                'message' => '錯誤'
            ]);
        }
    }
}
