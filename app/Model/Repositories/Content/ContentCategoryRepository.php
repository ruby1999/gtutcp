<?php

namespace App\Model\Repositories\Content;

use App\Model\Entities\Content\ContentCategory;
use App\Model\Repositories\AbstractRepository;
use App\Model\Repositories\CategoryTreeContract;
use App\Model\Repositories\CategoryTreeTrait;
use App\Services\Common\Enum\ActiveEnum;
use App\Services\Page\Enum\ShowHomeTypeEnum;
use App\Services\Tree\Node;
use App\Services\Tree\Tree;
use DB;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\JoinClause;

class ContentCategoryRepository extends AbstractRepository implements CategoryTreeContract
{
    use CategoryTreeTrait;

    /**
     * ContentCategoryRepository constructor.
     *
     * @param ContentCategory $model
     */
    public function __construct(ContentCategory $model)
    {
        $this->model = $model;
    }

    public function findSuppliersCategoryBySlug($id)
    {
        $languageId = config('app.language_id');

        $categoryIds = ContentCategory::select('id')
                        ->where('route', 'like', "%{$id}%")
                        ->get();
                
        return $this->model->leftJoin(
            'content_category_details as details',
            function (JoinClause $join) use ($languageId) {
                        $join->on('details.content_category_id', '=', 'content_categories.id');
                        $join->where('details.language_id', '=', $languageId);
                    }
        )
                    ->leftJoin(
                        'content_categories_contents as categories_contents',
                        function (JoinClause $join) use ($languageId) {
                            $join->on('categories_contents.content_category_id', '=', 'content_categories.id');
                        }
                    )
                    ->orderBy('content_categories.route')
                    ->orderBy('content_categories.order')
                    ->where('parent_category_id', $id)
                    ->whereIn('categories_contents.content_category_id', $categoryIds)
                    ->distinct('content_categories.id')
                    ->get(['content_categories.*', 'details.name', 'details.active']);
    }
}