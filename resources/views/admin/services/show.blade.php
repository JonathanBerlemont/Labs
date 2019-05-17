<?php
function lastWord($string)
{
    $listWords = explode('-', $string);
    array_shift($listWords);
    array_shift($listWords);
    $lastWord = implode('-', $listWords);
    
    return ucfirst($lastWord);
}
?>
@extends('layouts.admin')

@section('content')
    @include('flashMessage')

    <div class="d-flex ml-5">
        {{-- Back Button --}}
        <div class="mt-3">
            <a href="/admin/services" class="btn btn-dark">
                Back
            </a>
        </div>
        {{-- Delete Button --}}
        <form action="/admin/services/{{$service->id}}" method="post" class="mt-3">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger ml-3">Delete Service</button>    
        </form>
    </div>
    
    <div class="card m-5">
        <form action="/admin/services/{{$service->id}}" method="post">
            @csrf
            @method('patch')
            <div class="card-header">
                <h1><input type="text" name="title" value="{{$service->title}}" class="w-100" style="border:0"></h1>
            </div>
            <div class="card-body">
                <div class="mb-3 row">
                    <div class="col-3 offset-3">
                        <i id="icon" class="{{$service->icon_class}}" style="font-size: 120px"></i>
                    </div>
                    <div class="col-3 d-flex align-items-center">
                        <select name="icon_class" id="selectIcon" class="form-control" onchange="checkChange(this)">
                            <option selected hidden>{{lastWord($service->icon_class)}}</option>
                            @foreach ($icons as $icon)
                                <option value="{{$icon}}">{{lastWord($icon)}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div>
                    <textarea name="description" id="" cols="30" rows="5" class="form-control" placeholder="Description" style="border:0">{{$service->description}}</textarea>
                </div>
            </div>

            <button type="submit" class="btn btn-primary m-3">Update</button>
        </form>
        @if ($errors->any())
            <ul class="list-unstyled">
                @foreach ($errors->all() as $error)
                    <li class="bg-warning text-danger">{{$error}}</li>
                @endforeach
            </ul>
        @endif
    </div>

    <script>
        function checkChange(select) {
            icon = document.querySelector('#icon');
            icon.classList = select.value;
        }
    </script>
@endsection