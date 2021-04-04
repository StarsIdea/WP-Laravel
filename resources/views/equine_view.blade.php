@extends('layouts.mainTemplate')

@section('css')
<link href="{{ asset('css/main.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="equine-datas">
    <div class="section-header">
        <h2 class="print-only"><?php echo "Horses ".$equine->name; ?> </h2>
        <span class="meta"><?php echo $details->owner; ?></span>

        <p>
        <strong>YTD Miles:</strong> <?php echo $details->YTD_mileage; ?><br/>
        <strong>Lifetime Miles:</strong> <?php echo $details->lifetime_mileage;?><br/>
        <strong>Sex:</strong> <?php echo $details->sex;?><br/>
        <strong>Foal Date:</strong> <?php echo $details->foal_date;?><br/>
        <strong>Breed:</strong> <?php echo $details->breed;?><br/>
        <strong>Color:</strong> <?php echo $details->color;?><br/>
        </p>
    </div>
    <div class="section-body">
        <div id="equines-ridden">
            <h3>Ridden By</h3>
        @if($ridden_by and count($ridden_by))
            <table>
                <thead>
                    <?php
                    $keys = array_keys((array)$ridden_by[0]);
                    foreach($keys as $item){
                        echo '<th>'.$item.'</th>';
                    }
                    ?>
                </thead>
                <tbody>
                    @foreach($ridden_by as $object)
                        <tr>
                            @foreach($object as $key => $value)
                                <td><?php echo html_entity_decode($value); ?></td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            No members have ridden this equine.
        @endif
        </div>
        
        <div id='rides'>
            <h3>Rides</h3>
        @if($rides_by_type  and count($rides_by_type))
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
        @else
            No rides yet.
        @endif
        </div>
    </div>
</div>
@endsection