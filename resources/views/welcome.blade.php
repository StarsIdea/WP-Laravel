@extends('layouts.mainTemplate')

@section('css')
<link href="{{ asset('css/main.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="elementor-section elementor-section-boxed">
    <div class="elementor-container">
        @if (Route::has('login'))
            <div class="links">
                <div class="nav-list">
                    <ul>
                        <li><a href="/rides">Overview</a></li>
                        <li><a href="/rides/riders">Riders</a></li>
                        <li><a href="/rides/horses">Horses</a></li>
                        <li><a href="/rides/events">Events</a></li>
                    </ul>
                </div>
                <div class="">
                @auth
                    <a href="{{ url('/home') }}">Home</a>
                @else
                    <a href="{{ route('login') }}">Login</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
                </div>
            </div>
        @endif

        <div class="content">
            <div class="title m-b-md">
                <ul id="linklist">
                    <li class="riders"><a href="/rides/riders">Riders</a></li>
                    <li class="horses"><a href="/rides/horses">Horses</a></li>
                    <li class="events"><a href="/rides/events">Events</a></li>
                </ul>
            </div>

            <div class="datas">
                <h2>{{ $title }}</h2>
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
                                    <td>{{ $value->name }}</td>
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
            <?php 
                if($title != 'Recent Events')
                    echo $data->links();
            ?>
            </div>
        </div>
    </div>
</div>
@endsection