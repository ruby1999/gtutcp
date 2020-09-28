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
                <div class="default-table">
                    <table>
                        <thead>
                            <tr>
                                <th>客製功能編號</th>
                                <th>功能分類</th>
                                <th>客戶名稱</th>
                                <th>功能名稱</th>
                                <th>功能說明</th>
                                <th>系統</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contents as $content)
                                <tr>
                                    <td>{{ $content->id }}</td>
                                    <td>{{ $content->category->id }}</td>
                                    <td>{{ $content->category->name }}</td>
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

@foreach ($post->tags as $tag)
                <span class="badge badge-info">{{ $tag->name }}</span>
            @endforeach