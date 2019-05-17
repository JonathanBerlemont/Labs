<h1 style="text-align:center">Newsletter</h1>
<p style="text-align:center">Our last Blog:</p>
<p style="padding-left:150px;padding-right: 150px; width: 100%;">{{App\Blog::all()->last()->description}}</p>

<p style="margin-top: 100px">By: {{App\Blog::all()->last()->author()->name}}</p>