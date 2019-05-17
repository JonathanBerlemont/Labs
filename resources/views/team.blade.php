<?php
    $members = App\Team::where('flag', 0)->get()->random(2);
    $flagged = App\Team::where('flag', 1)->first();
?>
<!-- single member -->
<div class="col-sm-4">
    <div class="member">
        <img src="/storage/uploads/{{$members->first()->image_name}}" alt="">
        <h2>{{$members->first()->name}}</h2>
        <h3>{{$members->first()->job}}</h3>
    </div>
</div>
<!-- single member -->
<div class="col-sm-4">
    <div class="member">
        <img src="/storage/uploads/{{$flagged->image_name}}" alt="">
        <h2>{{$flagged->name}}</h2>
        <h3>{{$flagged->job}}</h3>
    </div>
</div>
<!-- single member -->
<div class="col-sm-4">
    <div class="member">
        <img src="/storage/uploads/{{$members->last()->image_name}}" alt="">
        <h2>{{$members->last()->name}}</h2>
        <h3>{{$members->last()->job}}</h3>
    </div>
</div>