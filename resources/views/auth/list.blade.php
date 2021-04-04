@extends('layouts.adminTemplate')

@section('css')
<link href="{{ asset('css/main.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="datas">
    <div class="section-header">
        <h2>{{ $title }}</h2>
        <form action="/rides/admin/ride?page={{ $page }}" method="get">
            <input type="text" name="search_value" value="{{ $search_value }}" placeholder="Search" class="<?php echo ($search_value !='')?'exist_value':''?>">
            <input type="submit" value="Go">
        </form>
    </div>
    <div class="section-body">
        @if(!isset($data[0]))
            <h5>There is no record.</h5>
        @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    @foreach($data[0] as $field => $value)
                        @if($field == 'id')
                            @continue
                        @endif
                        <th>{{ $field }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($data as $item)
                    <tr>
                        @foreach($item as $field => $value)
                            @if($field == 'id')
                                @continue
                            @endif
                            <td><?php echo htmlspecialchars_decode($value); ?></td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
<?php 
    echo $data->links();
?>
</div>
        
@endsection