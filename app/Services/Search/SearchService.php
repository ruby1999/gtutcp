<?php

namespace App\Services\Search;

// use App\Model\Entities\Content\Content;
// use App\Model\Entities\Content\ContentAttachment;
// use App\Model\Entities\Content\ContentCategory;
// use App\Model\Entities\Content\ContentMedia;
// use App\Model\Entities\Content\FormCategory;
// use App\Model\Entities\Product\Product;
// use App\Model\Entities\Product\ProductAttachment;
// use App\Model\Entities\Product\ProductCategory;
// use App\Model\Entities\Product\ProductMedia;
// use App\Services\Common\Enum\ActiveEnum;
// use App\Services\Feature\Enum\FeatureSnEnum;
// use FeatureChecker;
// use Illuminate\Database\Query\JoinClause;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Category;
use App\Content;
use DB;

class SearchService
{
    private $dateTimeFormat = 'Y-m-d H:i:s';
    private $perPage = 10;

    /**
     *供應商搜尋。
     *
     * @param string|null $keyword
     *
     * @return LengthAwarePaginator
    */
    public function searchSuppliers($categoryId, $keyword = null)
    {

        $categoryIds = Category::select('id')
                ->where('id', '=', $categoryId)
                ->get();

        echo("<script>console.log('".json_encode($categoryIds)."');</script>");
        // 啥鬼都沒印出來啦


        // $categoryIds = ContentCategory::select('id')
        // ->where('route', 'like', "%{$categoryId}%")
        // ->get();

        if (count($categoryIds) == 0) {
            $categoryIds = Content::select('id')
            ->where('id', $categoryId)
            ->get();
        }

        // if (count($categoryIds) == 0) {
        //     $categoryIds = ContentCategory::select('id')
        //     ->where('id', $categoryId)
        //     ->get();
        // }

        $items = collect();


        $contents = DB::table('content')
        ->join('categories', function($join)
        {
            $join->on('content.category_id', '=', 'categories.id');
        })
        ->select('content.*', 'categories.name as sub_cat')
        ->get();
        
        // $contents = Content::leftJoin('content_details as details', function (JoinClause $join) use ($languageId) {
        //         $join->on('details.content_id', '=', 'contents.id');
        //         $join->where('details.language_id', '=', $languageId);
        //     })
        //     ->leftJoin('content_categories_contents as categories_contents', function (JoinClause $join) {
        //         $join->on('categories_contents.content_id', '=', 'contents.id');
        //     })
        //     ->where(function ($query) use ($keyword) {
        //         $query->where('details.title', 'like', "%{$keyword}%")
        //               ->orWhere('details.introduction', 'like', "%{$keyword}%")
        //               ->orWhere('details.description', 'like', "%{$keyword}%");
        //     })
        //     ->whereIn('categories_contents.content_category_id', $categoryIds)
        //     ->frontendFilter()
        //     ->activeIs(ActiveEnum::PUBLISHED, 'details')
        //     ->orderBy('order', 'ASC')
        //     ->get([
        //         'contents.*',
        //         'details.title',
        //         'details.parsed_introduction',
        //         'details.parsed_description',
        //         'details.image',
        //     ]);

        return $contents;
    }
}
