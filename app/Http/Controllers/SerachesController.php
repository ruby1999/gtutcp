<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\Search\SearchService;
use Exception;
use Illuminate\Http\Request;
use Throwable;

class SearchesController extends Controller
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

    /**
     * 供應商搜尋。
     *
     * @param Request $request
     *
     * @return string
     * @throws Throwable
     */

    public function searchSuppliers(Request $request)
    {
        // ----------------
        try {
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

            /* $content內容要有啥 */
            $contents = $this->searchService->searchSuppliers($categoryId, $keyword);
            // dd($contents);  

            $html = '';
            foreach ($contents as $key => $row) {
                // $html .= '<div class="item col-md-4 col-sm-6">';
                // $html .= '<div class="vendor">';
                // $html .= '<a href="'. '留白' .'" title="'.$row->name. '" target="_blank" rel="nofollow">';
                // $html .= '<div class="picp">';
                // $html .= '</div>';
                // $html .= '<div class="text">';
                // $html .= '<h5>'.$row->name.'</h5>';
                // $html .= '<p>'.$row->company.'</p>';
                // $html .= '</div></a></div></div>';

                $html .= '<tr>';
                $html .= '<td>'. $row->id  .'</td>';
                $html .= '<td>'. $row->sub_cat .'</td>';
                $html .= '<td>'. $row->company .'</td>  ';  
                $html .= '<td>'. $row->name .'</td>';
                $html .= '<td>'. $row->description .'</td>';
                $html .= '<th>'. $row->system .'</th>';
                $html .= '<\tr>';
            }

            return json_encode(['data' => $html]);

        } catch (Exception $exception) {
            exception_debug($exception);

            abort(404);
        } catch (Throwable $e) {
            exception_debug($e);

            abort(404);
        }
        // ----------------
    }
}