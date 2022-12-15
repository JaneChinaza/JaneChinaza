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
<?php if(isset($_SESSION['roleId'])) :?>
    <?php if($_SESSION['roleId'] == 3): ?>
    <section class="features-1">
      <div class="container">
        <div class="row">
          <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
            <div class="box-feature">
              <span class="flaticon-house"></span>
              <h3 class="mb-3">All Properties</h3>
              <p class="size">
                This includes all properties that are available, sold, for sale, for rent etc.
              </p>
              <p><a href="/properties" class="learn-more">View All</a></p>
            </div>
          </div>
          <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="500">
            <div class="box-feature">
                <span><svg xmlns="http://www.w3.org/2000/svg" class="ionicon" style="height: 70px;" viewBox="0 0 512 512">
                  <title>My Property</title>
                  <path d="M80 212v236a16 16 0 0016 16h96V328a24 24 0 0124-24h80a24 24 0 0124 24v136h96a16 16 0 0016-16V212" fill="none" stroke="#00204a" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"/>
                  <path d="M480 256L266.89 52c-5-5.28-16.69-5.34-21.78 0L32 256M400 179V64h-48v69" fill="none" stroke="#00204a" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"/></svg></span>
              <h3 class="mb-3">My Properties</h3>
              <p class="size">
              These are your properties, you can edit, delete and also create new ones.
              </p>
              <p><a href="/agent_actions" class="learn-more">View All</a></p>
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