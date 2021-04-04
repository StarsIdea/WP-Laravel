@extends('layouts.adminTemplate')

@section('css')
<link href="{{ asset('css/admin.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="content">
    <div class="navigation">
        <h1> Site admin</h1>
        <div class="rides">
            <div class="title">Rides</div>
            <ul>
                <li>
                    <ul>
                        <li><a href="/rides/admin/ride">Ride</a></li>
                        <li><a href="/rides/admin/ride/add">Add</a><span>{{ $count['ride'] }}</span></li>
                    </ul>
                </li>
                <li>
                    <ul>
                        <li><a href="/rides/admin/event_result">Event Result</a></li>
                        <li><a href="/rides/admin/event_result/add">Add</a><span>{{ $count['event_result'] }}</span></li>
                    </ul>
                </li>
            </ul>
        </div>
        
        <div class="members">
            <div class="title">Members</div>
            <ul>
                <li>
                    <ul>
                        <li><a href="/rides/admin/member">Member</a></li>
                        <li><a href="/rides/admin/member/add">Add</a><span>{{ $count['member'] }}</span></li>
                    </ul>
                </li>
                <li>
                    <ul>
                        <li><a href="/rides/admin/reclaim">Reclaim</a></li>
                        <li><a href="/rides/admin/reclaim/add">Add</a><span>{{ $count['reclaim'] }}</span></li>
                    </ul>
                </li>
                <li>
                    <ul>
                        <li><a href="/rides/admin/equine">Equine</a></li>
                        <li><a href="/rides/admin/equine/add">Add</a><span>{{ $count['equine'] }}</span></li>
                    </ul>
                </li>
            </ul>
        </div>
        
        <div class="reference">
            <div class="title">Reference</div>
            <ul>
                <li>
                    <ul>
                        <li><a href="/rides/admin/event_type">Event Type</a></li>
                        <li><a href="/rides/admin/event_type/add">Add</a><span>{{ $count['event_type'] }}</span></li>
                    </ul>
                </li>
                <li>
                    <ul>
                        <li><a href="/rides/admin/member_type">Member Type</a></li>
                        <li><a href="/rides/admin/member_type/add">Add</a><span>{{ $count['member_type'] }}</span></li>
                    </ul>
                </li>
                <li>
                    <ul>
                        <li><a href="/rides/admin/equine_sex">Equine Sex</a></li>
                        <li><a href="/rides/admin/equine_sex/add">Add</a><span>{{ $count['equine_sex'] }}</span></li>
                    </ul>
                </li>
                <li>
                    <ul>
                        <li><a href="/rides/admin/federation">Federation</a><span></span></li>
                        <li><a href="/rides/admin/federation/add">Add</a><span>{{ $count['federation'] }}</span></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div class="Extra Datas">
        <div class="block-quick-links">
            <h1>Quick Links</h1>
            <div class="quick-links">
                <div class="quick-link-item riders"><a href="/rides/admin/member">Riders</a></div>
                <div class="quick-link-item horses"><a href="/rides/admin/equine">Horses</a></div>
                <div class="quick-link-item events"><a href="/rides/admin/event_result">Events</a></div>
                <div class="quick-link-item riders"><a href="/rides/admin/member?active=1&show_all=1">Active Members</a></div>
                <div class="quick-link-item horses"><a href="/rides/admin/equine?active=1&show_all=1">Active Horses</a></div>
                <div class="quick-link-item reset"><a href="/rides/admin/member/reset_active">Reset Active Members</a></div>
            </div>
        </div>
        <div class="block-approvals">
            <h1>Approvals</h1>
            <span>No changes waiting approval.</span>
        </div>
        <div class="block-imports">
            <h1>Imports</h1>
            <a class="help" href="/rides/admin/help/importer">Help</a>
            <a class="import" href="/rides/admin/importer/new">New Import</a>
            <span>No changes waiting approval.</span>
        </div>
    </div>
</div>

@endsection