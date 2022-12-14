@extends('frontend.layout.master')
@section('content')
  <section class="ftco-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6 text-center my-3">
          <h2 class="heading-section">Contract Us Form</h2>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="wrapper">
            <div class="row no-gutters mb-5">
              <div class="col-12 col-lg-7">
                <div class="contact-wrap w-100 p-md-5 p-4">
                  <h3 class="mb-4">Contact Us</h3>
                  <div id="form-message-warning" class="mb-4"></div>
                  <div id="form-message-success" class="mb-4">
                    Your message was sent, thank you!
                  </div>
                  <form method="POST" id="contactForm" name="contactForm" class="contactForm">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="label" for="name">Full Name</label>
                          <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="label" for="email">Email Address</label>
                          <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="label" for="subject">Subject</label>
                          <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject">
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="label" for="#">Message</label>
                          <textarea name="message" class="form-control" id="message" cols="30" rows="4"
                            placeholder="Message"></textarea>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <input type="submit" value="Send Message" class="btn btn-primary">
                          <div class="submitting"></div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <div class="col-12 col-lg-5">
                <div class="card border-0 rounded-0">
                  <div class="card-body">
                    <a class="navbar-brand text-black" style="font-size: 48px; color: black;" href="index.html"> <span class="lms font-weight-bold">LMS</span><span
                            class="edu font-weight-light">edu</span></a>


                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis eius eos esse fugit hic in inventore laudantium, libero, minus odit porro quaerat quasi quisquam quos ratione repellendus sed, vel veniam.</p>
                    <br>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam beatae consequuntur corporis distinctio eius excepturi facilis inventore iure magnam molestiae nobis nulla officia, possimus, quod sunt tempora velit, voluptatibus voluptatum!</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam beatae consequuntur corporis distinctio eius excepturi facilis inventore iure magnam molestiae nobis nulla officia,</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <div class="dbox w-100 text-center">
                  <div class="icon d-flex align-items-center justify-content-center">
                    <span class="fa fa-map-marker"></span>
                  </div>
                  <div class="text">
                    <p><span>Address:</span> 198 West 21th Street, Suite 721 New York NY 10016</p>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="dbox w-100 text-center">
                  <div class="icon d-flex align-items-center justify-content-center">
                    <span class="fa fa-phone"></span>
                  </div>
                  <div class="text">
                    <p><span>Phone:</span> <a href="tel://1234567920">+ 1235 2355 98</a></p>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="dbox w-100 text-center">
                  <div class="icon d-flex align-items-center justify-content-center">
                    <span class="fa fa-paper-plane"></span>
                  </div>
                  <div class="text">
                    <p><span>Email:</span> <a
                        href="#"">contact@email.com</span></a>
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="dbox w-100 text-center">
                  <div class="icon d-flex align-items-center justify-content-center">
                    <span class="fa fa-globe"></span>
                  </div>
                  <div class="text">
                    <p><span>Website</span> <a href="#">yoursite.com</a></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
