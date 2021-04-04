@extends('layouts.mainTemplate')

@section('css')
<link href="{{ asset('css/main.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="datas">
    <div class="section-header">
        <h2>{{ $title }}</h2>
        <form action="/rides/horses?page={{ $page }}" method="get">
            <input type="text" name="search_value" value="{{ $search_value }}" placeholder="Search" class="<?php echo ($search_value !='')?'exist_value':''?>">
            <input type="submit" value="Go">
        </form>
    </div>
    <div class="section-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Breed</th>
                    <th>Sex</th>
                    <th>Color</th>
                    <th>YTD Mileage</th>
                    <th>Lifetime Mileage</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($data) && $data->count())
                    @foreach($data as $object)
                        <tr>
                            <td>{{ $object->id }}</td>
                            <td><a href="/rides/horses/view/{{ $object->id }}">{{ $object->name }}</a></td>
                            <td>{{ $object->breed }}</td>
                            <td>{{ $object->sex }}</td>
                            <td>{{ $object->color }}</td>
                            <td>{{ $object->YTD_mileage }}</td>
                            <td>{{ $object->lifetime_mileage }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="10">There are no data.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
<?php 
    echo $data->links();
?>
</div>
        
@endsection