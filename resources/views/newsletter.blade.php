<!-- newsletter section -->
<div class="newsletter-section spad">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h2>Newsletter</h2>
            </div>
            <div class="col-md-9">
                @if (($message = Session::get('success')) || ($message = Session::get('error')))
                    <p>{{$message}}</p>
                @endif
                <!-- newsletter form -->
                <form class="nl-form" method="post" action="/newsletter">
                    @csrf
                    <input type="text" name="email" placeholder="Your e-mail here" style="width: calc(100% - 250px)!important">
                    <button class="site-btn btn-2" type="submit">Newsletter</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- newsletter section end-->