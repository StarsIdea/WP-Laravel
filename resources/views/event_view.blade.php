@extends('layouts.mainTemplate')

@section('css')
<link href="{{ asset('css/main.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="event-datas">
    <div class="section-header">
        <h2>Events {{ $title }}</h2>
        @if($ride)
        <div class="meta">
            <span class="date">
                {{ $ride['date'] }}
            </span>
            <span class="city">
                {{ $ride['city'] }}
            </span>
        </div>
        @endif
    </div>
    <div class="section-body">
        @if($results_by_type)
            <?php 
                $sub_title = '';
            ?>
            @foreach($results_by_type as $type => $results)
                @if($sub_title != $results->event_type)
                    <?php
                    if($sub_title != ''){
                        echo '</tbody></table>';
                    }
                    echo '<h3>'.$results->event_type.'</h3>';
                    $sub_title = $results->event_type;
                    echo '<table class="table table-bordered"><thead>';
                    $keys = array_keys((array)$results);
                    for($i = 0; $i < count($keys); $i ++){
                        if($keys[$i] == 'event_type')
                            continue;
                        echo '<th>'.$keys[$i].'</th>';
                    }
                    ?>
                    </thead>
                    <tbody>
                @endif
                    <tr>
                    @foreach($results as $key => $value)
                        <?php
                        if($key == 'event_type')
                            continue;
                        ?>
                        <td><?php echo html_entity_decode($value); ?></td>
                    @endforeach
                    </tr>
            @endforeach
            </tbody>
            </table>
        @endif
    </div>
</div>
@endsection