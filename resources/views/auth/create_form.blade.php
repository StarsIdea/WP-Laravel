@extends('layouts.adminTemplate')

@section('css')
<link href="{{ asset('css/admin.css') }}" rel="stylesheet">
@endsection

@section('content')
<form action = "{{ $action }}" method="POST">
    @switch($model)
        @case('ride')
            <div class="input-block">
                <label>Name</label>
                <input type="text" name="name" value="<?php echo $object?$object->name:'';?>">
            </div>
            <div class="input-block">
                <label>Date</label>
                <input type="date" name="date" value="<?php echo $object?$object->date:'';?>">
            </div>
            <div class="input-block">
                <label>City</label>
                <input type="text" name="city" value="<?php echo $object?$object->city:'';?>">
            </div>
            <div class="input-block">
                <label>Province</label>
                <input type="text" name="province" value="<?php echo $object?$object->province:'';?>">
            </div>
            <div class="input-block">
                <label>Country</label>
                <input type="text" name="country" value="<?php echo $object?$object->country:'';?>">
            </div>
            <div class="input-block">
                <label>Manager</label>
                <input type="text" name="manager" value="<?php echo $object?$object->manager:'';?>">
            </div>
            <div class="input-block">
                <label>Secretary</label>
                <input type="text" name="secretary" value="<?php echo $object?$object->secretary:'';?>">
            </div>
            <div class="input-block">
                <label>Veterinarian</label>
                <input type="text" name="veterinarian" value="<?php echo $object?$object->veterinarian:'';?>">
            </div>
            <div class="input-block">
                <label>Description</label>
                <textarea name="description"><?php echo $object?$object->description:'';?></textarea>
            </div>
            <div class="input-block">
                <label>Sanctioned</label>
                <input type="checkbox" name="sanctioned" value="<?php echo $object?$object->sanctioned:'';?>">
            </div>
            @break
        @case('event_result')
            <div class="input-block">
                <label>Ride Id</label>
                <select name="ride_id">
                    <option value=""></option>
                    @foreach($rides as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-block">
                <label>Event Type Id</label>
                <select name="event_type_id">
                    <option value=""></option>
                    @foreach($event_types as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-block">
                <label>Rider Name</label>
                <input type="text" name="rider_name" value="<?php echo $object?$object->rider_name:'';?>">
            </div>
            <div class="input-block">
                <label>Member Id</label>
                <select name="event_type_id">
                    <option value=""></option>
                    @foreach($members as $item)
                        <option value="{{ $item->id }}"><?php echo $item->id.':'.$item->first_name.', '.$item->last_name; ?></option>
                    @endforeach
                </select>
            </div>
            <div class="input-block">
                <label>Equine Id</label>
                <select name="equine_id">
                    <option value=""></option>
                    @foreach($equines as $item)
                        <option value="{{ $item->id }}"><?php echo $item->id.':'.$item->name; ?></option>
                    @endforeach
                </select>
            </div>
            <div class="input-block">
                <label>Equine Name</label>
                <input type="text" name="equine_name" value="<?php echo $object?$object->equine_name:'';?>">
            </div>
            <div class="input-block">
                <label>Placing</label>
                <input type="text" name="placing" value="<?php echo $object?$object->placing:'';?>">
            </div>
            <div class="input-block">
                <label>Time</label>
                <input type="text" name="time" value="<?php echo $object?$object->time:'';?>">
            </div>
            <div class="input-block">
                <label>Weight</label>
                <input type="text" name="weight" value="<?php echo $object?$object->weight:'';?>">
            </div>
            <div class="input-block">
                <label>Miles</label>
                <input type="text" name="miles" value="<?php echo $object?$object->miles:'';?>">
            </div>
            <div class="input-block">
                <label>Points</label>
                <input type="text" name="points" value="<?php echo $object?$object->points:'';?>">
            </div>
            <div class="input-block">
                <label>Vet Score</label>
                <input type="text" name="vet_score" value="<?php echo $object?$object->vet_score:'';?>">
            </div>
            <div class="input-block">
                <label>Bc</label>
                <input type="checkbox" name="bc" value="<?php echo $object?$object->bc:'';?>">
            </div>
            <div class="input-block">
                <label>Bc Points</label>
                <input type="text" name="bc_points" value="<?php echo $object?$object->bc_points:'';?>">
            </div>
            <div class="input-block">
                <label>Bc Score</label>
                <input type="text" name="bc_score" value="<?php echo $object?$object->bc_score:'';?>">
            </div>
            <div class="input-block">
                <label>Pull</label>
                <input type="checkbox" name="pull" value="<?php echo $object?$object->pull:'';?>">
            </div>
            <div class="input-block">
                <label>Pull Reason</label>
                <input type="text" name="pull_reason" value="<?php echo $object?$object->pull_reason:'';?>">
            </div>
            <div class="input-block">
                <label>Comments</label>
                <textarea name="comments"><?php echo $object?$object->comments:'';?></textarea>
            </div>
            @break
        @case('member')
            <div class="input-block">
                <label>Active</label>
                <input type="checkbox" name="active" value="<?php echo $object?$object->active:'';?>">
            </div>
            <div class="input-block">
                <label>First Name</label>
                <input type="text" name="first_name" value="<?php echo $object?$object->first_name:'';?>">
            </div>
            <div class="input-block">
                <label>Last Name</label>
                <input type="text" name="last_name" value="<?php echo $object?$object->last_name:'';?>">
            </div>
            <div class="input-block">
                <label>Email</label>
                <input type="email" name="email" value="<?php echo $object?$object->email:'';?>">
            </div>
            <div class="input-block">
                <label>Address</label>
                <input type="text" name="address" value="<?php echo $object?$object->address:'';?>">
            </div>
            <div class="input-block">
                <label>City</label>
                <input type="text" name="city" value="<?php echo $object?$object->city:'';?>">
            </div>
            <div class="input-block">
                <label>Postal Code</label>
                <input type="text" name="postal_code" value="<?php echo $object?$object->postal_code:'';?>">
            </div>
            <div class="input-block">
                <label>State Prov</label>
                <input type="text" name="state_prov" value="<?php echo $object?$object->state_prov:'';?>">
            </div>
            <div class="input-block">
                <label>Phone Home</label>
                <input type="text" name="phone_home" value="<?php echo $object?$object->phone_home:'';?>">
            </div>
            <div class="input-block">
                <label>Phone Alternate</label>
                <input type="text" name="phone_alternate" value="<?php echo $object?$object->phone_alternate:'';?>">
            </div>
            <div class="input-block">
                <label>Fax Number</label>
                <input type="text" name="fax_number" value="<?php echo $object?$object->fax_number:'';?>">
            </div>
            <div class="input-block">
                <label>Birth Date</label>
                <input type="date" name="birth_date" value="<?php echo $object?$object->birth_date:'';?>">
            </div>
            <div class="input-block">
                <label>Aef Number</label>
                <input type="text" name="aef_number" value="<?php echo $object?$object->aef_number:'';?>">
            </div>
            @break
        @case('reclaim')
            <div class="input-block">
                <label>Equine Id</label>
                <select name="equine_id">
                    <option value=""></option>
                    @foreach($equines as $item)
                        <option value="{{ $item->id }}"><?php echo $item->id.' : '.$item->name?></option>
                    @endforeach
                </select>
            </div>
            <div class="input-block">
                <label>Member Id</label>
                <select name="event_type_id">
                    <option value=""></option>
                    @foreach($members as $item)
                        <option value="{{ $item->id }}"><?php echo $item->id.':'.$item->first_name.', '.$item->last_name; ?></option>
                    @endforeach
                </select>
            </div>
            <div class="input-block">
                <label>Ride Id</label>
                <select name="ride_id">
                    <option value=""></option>
                    @foreach($rides as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-block">
                <label>Miles Completed</label>
                <input type="text" name="miles_completed" value="<?php echo $object?$object->miles_completed:'';?>">
            </div>
            <div class="input-block">
                <label>Comments</label>
                <textarea name="comments"><?php echo $object?$object->comments:'';?></textarea>
            </div>
            <div class="input-block">
                <label>Year</label>
                <input type="text" name="year" value="<?php echo $object?$object->year:'';?>">
            </div>
            @break
        @case('equine')
            <div class="input-block">
                <label>Member Id</label>
                <select name="event_type_id">
                    <option value=""></option>
                    @foreach($members as $item)
                        <option value="{{ $item->id }}"><?php echo $item->id.':'.$item->first_name.', '.$item->last_name; ?></option>
                    @endforeach
                </select>
            </div>
            <div class="input-block">
                <label>Owner Name</label>
                <input type="text" name="owner_name" value="<?php echo $object?$object->owner_name:'';?>">
            </div>
            <div class="input-block">
                <label>Breed Registry #</label>
                <input type="text" name="breed_registry" value="<?php echo $object?$object->breed_registry:'';?>">
            </div>
            <div class="input-block">
                <label>Registration Date</label>
                <input type="date" name="registration_date" value="<?php echo $object?$object->registration_date:'';?>">
            </div>
            <div class="input-block">
                <label>Country</label>
                <input type="text" name="country" value="<?php echo $object?$object->country:'';?>">
            </div>
            <div class="input-block">
                <label>Name</label>
                <input type="text" name="name" value="<?php echo $object?$object->name:'';?>">
            </div>
            <div class="input-block">
                <label>Equine Sex Id</label>
                <select name="equine_sex_id">
                    <option value=""></option>
                    @foreach($equine_sexes as $item)
                        <option value="{{ $item->id }}"><?php echo $item->id.' : '.$item->name; ?></option>
                    @endforeach
                </select>
            </div>
            <div class="input-block">
                <label>Foal Date</label>
                <input type="date" name="foal_date" value="<?php echo $object?$object->foal_date:'';?>">
            </div>
            <div class="input-block">
                <label>Breed</label>
                <input type="text" name="breed" value="<?php echo $object?$object->breed:'';?>">
            </div>
            <div class="input-block">
                <label>Color</label>
                <input type="text" name="color" value="<?php echo $object?$object->color:'';?>">
            </div>
            <div class="input-block">
                <label>Active</label>
                <input type="checkbox" name="active" value="<?php echo $object?$object->active:'';?>">
            </div>
            @break
        @case('event_type')
            <div class="input-block">
                <label>Name</label>
                <input type="text" name="name" value="<?php echo $object?$object->name:'';?>">
            </div>
            @break
        @case('member_type')
            <div class="input-block">
                <label>Name</label>
                <input type="text" name="name" value="<?php echo $object?$object->name:'';?>">
            </div>
            <div class="input-block">
                <label>Description</label>
                <textarea name="description"><?php echo $object?$object->description:'';?></textarea>
            </div>
            <div class="input-block">
                <label>Age Start</label>
                <input type="text" name="age_start" value="<?php echo $object?$object->age_start:'';?>">
            </div>
            <div class="input-block">
                <label>Age End</label>
                <input type="text" name="age_end" value="<?php echo $object?$object->age_end:'';?>">
            </div>
            @break
        @case('equine_sex')
            <div class="input-block">
                <label>Name</label>
                <input type="text" name="name" value="<?php echo $object?$object->name:'';?>">
            </div>
            <div class="input-block">
                <label>Description</label>
                <textarea name="description"><?php echo $object?$object->description:'';?></textarea>
            </div>
            @break
        @case('federation')
            <div class="input-block">
                <label>Name</label>
                <input type="text" name="name" value="<?php echo $object?$object->name:'';?>">
            </div>
            <div class="input-block">
                <label>Description</label>
                <textarea name="description"><?php echo $object?$object->description:'';?></textarea>
            </div>
            @break
        @default
            @break
    @endswitch
<p><input type="submit" value="SUBMIT"></p>
</form>
@endsection