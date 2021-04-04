@extends('layouts.mainTemplate')

@section('css')
<link href="{{ asset('css/main.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="datas">
    <div class="section-header">
        <h2>{{ $title }}</h2>
        @if($title != 'Recent Events')
        <form action="/rides/events?page={{ $page }}" method="get">
            <input type="text" name="search_value" value="{{ $search_value }}" placeholder="Search" class="<?php echo ($search_value !='')?'exist_value':''?>">
            <input type="submit" value="Go">
        </form>
        @endif
    </div>
    <div class="section-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Date</th>
                    <th>City</th>
                    <th>Province</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($data) && $data->count())
                    @foreach($data as $key => $value)
                        <tr>
                            <td><a href="/rides/events/view/{{ $value->id }}">{{ $value->name }}</a></td>
                            <td>{{ $value->date }}</td>
                            <td>{{ $value->city }}</td>
                            <td>{{ $value->province }}</td>
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
    if($title != 'Recent Events')
        echo $data->links();
?>
</div>
@endsection