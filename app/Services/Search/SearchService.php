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
use App\Http\Controllers\SearchesController;
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
        $languageId = config('app.language_id');

        $categoryIds = ContentCategory::select('id')
                ->where('route', 'like', "%{$categoryId}%")
                ->get();

        if (count($categoryIds) == 0) {
            $categoryIds = ContentCategory::select('id')
            ->where('id', $categoryId)
            ->get();
        }

        // -----------
        
        if (count($categoryId) == 0) {
            $categoryIds = Category::select('id')
            ->where('id', $categoryId)
            ->get();
        }

        var_dump($categoryIds);

        if (count($categoryIds) == 0) {
            $categoryIds = ContentCategory::select('id')
            ->where('id', $categoryId)
            ->get();
        }
        
        $items = collect();
        
        $contents = DB::table('content')
        ->leftJoin(
            'category_content',
            'category_content.content_id',
            '=',
            'content.id'
        )
            ->leftJoin(
                'categories',
                'category_content.category_id',
                '=',
                'categories.id'
            )
        // ->where(function ($query) use ($keyword) {
        //     $query->where('content.name', 'like', "%{$keyword}%")
        //           ->orWhere('content.description', 'like', "%{$keyword}%");
        // })
        ->whereIn('categories_content.category_id', $categoryIds)
        ->select('content.*')
        ->get();

        // dd($contents);

        return $contents;
    }
}
