@extends('layouts.mainTemplate')

@section('css')
<link href="{{ asset('css/main.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="member-datas">
    <div class="section-header">
        <h2 class="print-only"><?php echo "Riders ".$title; ?></h2>
        <span class="meta">{{ $member->address }}</span>

        <p>
        <strong>ERA #:</strong> {{ $member->id }}<br/>
        <strong>YTD Miles:</strong> {{ $member->YTD_mileage }}<br/>
        <strong>Lifetime Miles:</strong> {{ $member->lifetime_mileage }}<br/>
        <strong>Member Type:</strong> {{ $member->member_type }}<br/>
        <strong>Status:</strong> {{ $member->active }}<br/>
        </p>
    </div>
    <div class="section-body">
        <div id="equines-ridden">
            <h3>Horses Ridden</h3>
        @if($equines)
            <table>
                <thead>
                    <?php
                    $keys = array_keys((array)$equines[0]);
                    foreach($keys as $item){
                        echo '<th>'.$item.'</th>';
                    }
                    ?>
                </thead>
                <tbody>
                    @foreach($equines as $object)
                        <tr>
                            @foreach($object as $key => $value)
                                <td><?php echo html_entity_decode($value); ?></td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            No rides yet.
        @endif
        </div>
        
        <div id='rides'>
            <h3>Rides</h3>
        @if($rides_by_type)
            @foreach($rides_by_type as $type => $results)
            <h4>{{ $type }}</h4>
            <table>
                <thead>
                    <?php
                    $keys = array_keys((array)$results[0]);
                    ?>
                    @foreach($keys as $item)
                        <?php if($item == 'ride id')continue;?>
                        <th>{{ $item }}</th>
                    @endforeach
                </thead>
                <tbody>
                    @foreach($results as $obejct)
                        <tr>
                        @foreach($obejct as $key => $value)
                            <?php if($key == 'ride id')continue;?>
                            <td><?php echo html_entity_decode($value); ?></td>
                        @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @endforeach
        @endif
        </div>
    </div>
</div>
@endsection