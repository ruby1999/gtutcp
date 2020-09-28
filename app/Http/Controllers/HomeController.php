<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Content;
use DB;

class HomeController extends Controller
{
    public function menu(){
        $datas = DB::table('categories')->distinct()->where('parent_id', '=', 0)->get();

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
    public function index()
    {
        $datas = $this->menu();
        $contents = Content::all();
        $categories = Category::all();

        // $posts = Post::orderBy('id', 'asc')->paginate(5);
        return view('home', compact('datas','contents', 'categories'));
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
