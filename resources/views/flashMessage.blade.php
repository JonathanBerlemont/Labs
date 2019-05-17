@if ($message = Session::get('error'))    
<div id="flashMessage" class="alert-danger p-3 mt-3 mx-5 rounded">
    <h4>{{$message}}</h4>
</div>  

@elseif ($message = Session::get('success'))
    <div id="flashMessage" class="alert-success p-3 mt-3 mx-5 rounded">
        <h4>{{$message}}</h4>
    </div> 
@endif
<script>
    setTimeout( () => {
        document.querySelector('#flashMessage').remove();
    }, 3000)
</script>