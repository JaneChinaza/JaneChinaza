
    <div
      class="hero page-inner overlay"
      style="background-image: url('images/hero_bg_1.jpg'); height:1vh;"
    >
      <div class="container">
        <div class="row justify-content-center align-items-center">
          <div class="col-lg-9 text-center mb-5">
            <h1 class="heading" data-aos="fade-up">Dashboard</h1>
          </div>
        </div>
      </div>
    </div>
<?php if(isset($_SESSION['role_id'])) :?>
  <?php if($_SESSION['role_id'] == 2): ?>
    <section class="features-1">
      <div class="container">
        <div class="row">
          <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
            <div class="box-feature">
              <span class="flaticon-house"></span>
              <h3 class="mb-3">All Properties</h3>
              <p class="size">
                This includes all properties that are pending, available, sold,
                for sale and for rent etc.
              </p>
              <p><a href="/properties" class="learn-more">View All</a></p>
            </div>
          </div>
          <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="500">
            <div class="box-feature">
              <span><svg xmlns="http://www.w3.org/2000/svg" class="ionicon" style="height: 70px;" viewBox="0 0 512 512">
                <title>Add Agents</title>
                <path d="M376 144c-3.92 52.87-44 96-88 96s-84.15-43.12-88-96c-4-55 35-96 88-96s92 42 88 96z" fill="none" stroke="#00204a" stroke-linecap="round" stroke-linejoin="round" stroke-width="15"/>
                <path d="M288 304c-87 0-175.3 48-191.64 138.6-2 10.92 4.21 21.4 15.65 21.4H464c11.44 0 17.62-10.48 15.65-21.4C463.3 352 375 304 288 304z" fill="none" stroke="#00204a" stroke-miterlimit="10" stroke-width="15"/>
                <path fill="none" stroke="#00204a" stroke-linecap="round" stroke-linejoin="round" stroke-width="15" d="M88 176v112M144 232H32"/></svg></span>
              <h3 class="mb-3">Agents Request</h3>
              <p class="size">
                Review all agent request.
                Accept to add agents to our wonderful list of agents
              </p>
              <p><a href="/agent_request" class="learn-more">View All</a></p>
            </div>
          </div>
          <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
            <div class="box-feature">
              <span class="flaticon-house-3"></span>
              <h3 class="mb-3">All Agents</h3>
              <p class="size">
                This includes all the agents with their respective details and properties.
              </p>
              <p><a href="/agents" class="learn-more">View All</a></p>
            </div>
          </div>
          <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="600">
            <div class="box-feature">
              <span class="flaticon-house-1"></span>
              <h3 class="mb-3">House for Sale</h3>
              <p class="size">
                This includes apartments, flats and other buldings available for sale.
              </p>
              <p><a href="/house_sale" class="learn-more">View All</a></p>
            </div>
          </div>
        </div>
      </div>
    </section>
<?php endif; ?>
<?php endif; ?>
    