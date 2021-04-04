@extends('layouts.mainTemplate')

@section('css')
<link href="{{ asset('css/main.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="datas">
    <div class="section-header">
        <h2>{{ $title }}</h2>
        <form action="/rides/riders?page={{ $page }}" method="get">
            <input type="text" name="search_value" value="{{ $search_value }}" placeholder="Search" class="<?php echo ($search_value !='')?'exist_value':''?>">
            <input type="submit" value="Go">
        </form>
    </div>
    <div class="section-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ERA #</th>
                    <th>Name</th>
                    <th>Province</th>
                    <th>YTD Mileage</th>
                    <th>Lifetime Mileage</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($data) && $data->count())
                    @foreach($data as $key => $value)
                        <tr>
                            <td>{{ $value->id }}</td>
                            <td><a href="/rides/riders/view/{{ $value->id }}">{{ $value->name }}</a></td>
                            <td>{{ $value->province }}</td>
                            <td>{{ $value->YTD_mileage }}</td>
                            <td>{{ $value->lifetime_mileage }}</td>
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