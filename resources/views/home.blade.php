@extends('main')
@section('content') 
    
<!-- Tables -->
<section class="tables">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading">
                    <h2>客製功能清單</h2>
                </div>

                {{-- <div>
                    <select id='system'>
                        <option>選擇系列</option>
                        @foreach($system as $s1 => $s2)
                            <option value="{{ $s1 }}">{{ $s2 }}</option>
                        @endforeach
                    </select>
                </div> --}}
                <a class="btn btn-primary btn-lg" href="http://gtutcp.com/test" role="button">Learn more</a>

                {{-- 下拉式長起來 --}}
                <div class="row">
                    <div class="col-12" id="searchmp">
                        <form id="search-suppliers" onsubmit="return false">
                            <fieldset>
                                <div>
                                    <select id="top-catalog" name="top-catalog" class="selectx" placeholder="">
                                        <option>系統類別</option>
                                        @foreach($system as $id => $name)
                                            <option value="{{ $id }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </fieldset>

                            {{-- 第二類別 --}}
                            {{-- <fieldset>
                                <div id="med_catalog" class="unuse">
                                    <select id="meddle_catalog" name="meddle_catalog" class="selectx" disabled>
                                        <option disabled selected hidden>{{ trans('frontend/general.categoriessecond') }}</option>
                                    </select>
                                </div>
                            </fieldset> --}}

                            {{-- 搜尋輸入框 --}}
                            {{-- <fieldset class="keyword">
                                <div>
                                    <input type="text" id="q" name="q" placeholder="{{ trans('frontend/general.please_enter_search_keyword') }}">
                                </div>
                            </fieldset> --}}
                        </form>
                    </div>
                </div>
                {{-- 下拉式長起來 --}}

                <div class="default-table">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>功能子分類</th>
                                <th>客戶名稱</th>
                                <th>功能名稱</th>
                                <th>功能說明</th>
                                <th>系統</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contents as $content)
                                <tr>
                                    {{-- {{dd($content->id)}} --}}
                                    <td>{{ $content->id }}</td>
                                    <td>{{ $content->sub_cat }}</td>
                                    <td>{{ $content->company }}</td>       
                                    <td>{{ $content->name }}</td>
                                    <td>{{ $content->description }}</td>
                                    <th>{{ $content->system }}</th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <ul class="table-pagination">
                        <li><a href="#">Previous</a></li>
                        <li><a href="#">1</a></li>
                        <li class="active"><a href="#">2</a></li>
                        <li><a href="#">...</a></li>
                        <li><a href="#">8</a></li>
                        <li><a href="#">9</a></li>
                        <li><a href="#">Next</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection

