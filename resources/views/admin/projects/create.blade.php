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
    <div class="card m-5">
        <form action="/admin/projects" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-header">
                <h1><input type="text" name="title" class="w-100" style="border:0" placeholder="Title"></h1>
            </div>
            <div class="card-body">
                <div class="mb-3 row">
                    <div class="col-4 offset-1 text-center">
                        <i id="icon" class="flaticon-001-picture" style="font-size: 120px"></i>
                        <select name="icon_class" id="selectIcon" class="form-control" onchange="checkChange(this)">
                            <option selected hidden disabled value="flaticon-001-picture">Icon</option>
                            @foreach ($icons as $icon)
                                <option value="{{$icon}}">{{lastWord($icon)}}</option>
                            @endforeach
                        </select>
                        
                    </div>
                    <div class="col-4 d-flex align-items-center">
                        <img src="" alt="">
                        <input type="file" name="image" id="" class="form-control mt-auto mx-auto">
                    </div>
                </div>
                <div>
                    <textarea name="description" id="" cols="30" rows="5" class="form-control" placeholder="Description"></textarea>
                </div>
            </div>

            <button type="submit" class="btn btn-primary m-3">Create</button>
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