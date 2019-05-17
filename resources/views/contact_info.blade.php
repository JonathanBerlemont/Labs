<!-- Contact section -->
<div class="contact-section spad fix">
    <div class="container">
      <div class="row">
        <!-- contact info -->
        <div class="col-md-5 col-md-offset-1 contact-info col-push">
          <div class="section-title left">
            <h2>Contact us</h2>
          </div>
          <p>{{env('CONTACT_DESCRIPTION')}}</p>
          <h3 class="mt60">Main Office</h3>
          <p class="con-item">{{env('CONTACT_ADDRESS')}}</p>
          <p class="con-item">{{env('CONTACT_PHONE')}}</p>
          <p class="con-item">{{env('CONTACT_MAIL')}}</p>
        </div>
        <!-- contact form -->
        <div class="col-md-6 col-pull">
          <form class="form-class" id="con_form" method="post" action="/mails">
            @csrf
            <div class="row">
              <div class="col-sm-6">
                <input type="text" name="name" placeholder="Your name" value="{{old('name')}}">
              </div>
              <div class="col-sm-6">
                <input type="text" name="email" placeholder="Your email" value="{{old('email')}}">
              </div>
              <div class="col-sm-12">
                <input type="text" name="subject" placeholder="Subject" value="{{old('subject')}}">
                <textarea name="message" placeholder="Message">{{old('message')}}</textarea>
                <button class="site-btn">send</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Contact section end-->