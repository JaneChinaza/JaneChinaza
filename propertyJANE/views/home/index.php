

    <div class="hero">
      <div class="hero-slide">
        <div
          class="img overlay"
          style="background-image: url('images/hero_bg_3.jpg')"
        ></div>
        <div
          class="img overlay"
          style="background-image: url('images/hero_bg_2.jpg')"
        ></div>
        <div
          class="img overlay"
          style="background-image: url('images/hero_bg_1.jpg')"
        ></div>
      </div>

      <div class="container">
        <div class="row justify-content-center align-items-center">
          <div class="col-lg-9 text-center">
            <!-- this print out your name if you are logged in -->
            <?php if (isset($_SESSION['roleId'])): ?>
              <?php if (($_SESSION['roleId'] == 2)):?>
                  <h3 class="text-white mb-5" data-aos="fade-up">
                      Welcome Admin <?php echo ucwords($_SESSION['first_name'] ." ".$_SESSION['last_name']) ;?>
                  </h3>
                <?php endif ?>
                <?php if (($_SESSION['roleId'] == 3)):?>
                  <h3 class="text-white mb-5" data-aos="fade-up">
                      Welcome Agent <?php echo ucwords($_SESSION['first_name'] ." ".$_SESSION['last_name']) ;?>
                  </h3>
                <?php endif ?>
                <?php if ($_SESSION['roleId'] == 1): ?>
                  <h3 class="text-white mb-4" data-aos="fade-up">
                      Welcome <?php echo ucwords($_SESSION['first_name'] ." ".$_SESSION['last_name']) ;?>
                  </h3>
                <?php endif; ?>
            <?php endif; ?>
            <?php if (!isset($_SESSION['roleId']) || ($_SESSION['roleId'] == 1)):?>
              <h2 class="heading" data-aos="fade-up">
                Easiest way to find your dream home 
              </h2>
            <?php endif; ?>
            <form
              action="" method="get"
              class="narrow-w form-search d-flex align-items-stretch mb-3"
              data-aos="fade-up"
              data-aos-delay="20"
            >
              <input
                type="text"
                name = "search"
                class="form-control px-4"
                value="<?php echo $search ?>"
                placeholder="Type of bulding or City. e.g. Abuja or duplex"
              />
              <button type="submit" class="btn btn-primary">Search</button>
            </form>
            <?php if(!isset($_SESSION['roleId'])): ?>
                <div class="row justify-content-center align-items-center">
                  <a href="/" class="h6 text-warning" style="font-family: Arial, Helvetica, sans-serif;"><em>You need to login or sign up</em></a>
                </div>
              <?php endif; ?>   
            <?php if (isset($_SESSION['roleId'])):?>
                <?php if ($_SESSION['roleId'] == 1): ?>
                  <h5 class=" text-white mb-4" data-aos="fade-up">
                    Click <a href="/request" class="text-warning">here</a> if you would like to request to be an agent
                  </h5>
                <?php endif; ?>
            <?php endif; ?>
            
          </div>
        </div>
      </div>
    </div>

    <div class="section">
      <div class="container">
        <div class="row mb-5 align-items-center">
          <div class="col-lg-6">
            <h2 class="font-weight-bold text-primary heading">
              Recent Properties
            </h2>
          </div>
          <div class="col-lg-6 text-lg-end">
            <p>
              <a
                href="/properties"
                target="_blank"
                class="btn btn-primary text-white py-3 px-4"
                >View all properties</a
              >
            </p>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="property-slider-wrap">
              
                <div class="property-slider">
                <?php foreach ($property as $i => $item):  ?>
                  <!--this loops through the items in property arrray  -->
                <?php if ($i < 6): ?>
                  <!-- this makes sure the items rendered are 6 -->
                <div class="property-item">
                  <div class="box">
                  <a href="/single_property?id=<?php echo $item['property_id'] ?>" class="img">
                    <img src="/<?php echo $item['property_image']; ?>" alt="...Property image" class="img-fluid" style="width: 360px; height:350px;"/>
                  </a>
                </div>
                  <div class="property-content">
                    <div class="price mb-2"><span>&#8358;<?php $currency = number_format( $item['property_price'], 2, '.', ',');
                                                        echo $currency  ?>
                                            </span></div>
                    <div>
                      <span class="d-block mb-2 text-black-50"
                        ><?php echo $item['property_type'] ?></span
                      >
                      <div class="size">
                        <span class="city d-block mb-3"><?php echo $item['property_address'] ?></span>
                      </div>

                      <div class="specs d-flex mb-4">
                        <span class="d-block d-flex align-items-center me-3">
                          <span class="icon-bed me-2"></span>
                          <span class="caption"><?php echo $item['bed'] ?></span>
                        </span>
                        <span class="d-block d-flex align-items-center">
                          <span class="icon-bath me-2"></span>
                          <span class="caption"><?php echo $item['bath'] ?></span>
                        </span>
                        <span class="d-block d-flex align-items-center ">
                          <span class="icon-kitchen me-2"></span>
                          <span class="caption"><?php echo $item['kitchen'] ?></span>
                        </span>
                      </div>
                      <span class="d-block mb-2 text-black-50"
                        >status: <?php echo $item['property_status'] ?></span>

                      <a
                        href="/single_property?id=<?php echo $item['property_id'] ?>"
                        class="btn btn-primary py-2 px-3"
                        >See details</a
                      >
                    </div>
                  </div>
                </div>
                <!-- .item -->
               <?php endif; ?>
              <?php endforeach; ?>
              </div>
              
              <?php if(empty($property)): ?>
                <div class="alert alert-warning alert-dismissible fade show tooltip-test" title="Click X to dismiss" role="alert">
                <center><strong>No results</strong></center>
                <button type="button" class="btn-close" data-bs-dismiss="alert" ></button>
                </div>
                <?php endif; ?>
                
              <div 
                id="property-nav"
                class="controls"
                tabindex="0"
                aria-label="Carousel Navigation"
              >
                <span 
                  class="prev mt-2"
                  data-controls="prev"
                  aria-controls="property"
                  tabindex="-1"
                  >Prev</span
                >
                <span
                  class="next mt-2"
                  data-controls="next"
                  aria-controls="property"
                  tabindex="-1"
                  >Next</span
                >
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php if (!isset($_SESSION['roleId']) || ($_SESSION['roleId'] == 1)):?>
   
    <div class="section section-4 bg-light">
      <div class="container">
        <div class="row justify-content-center text-center mb-5">
          <div class="col-lg-5">
            <h2 class="font-weight-bold heading text-primary mb-4">
            Let's find you the ideal home.
            </h2>
          </div>
        </div>
        <div class="row justify-content-between mb-5">
          <div class="col-lg-7 mb-5 mb-lg-0 order-lg-2">
            <div class="img-about dots">
              <img src="images/hero_bg_3.jpg" alt="Image" class="img-fluid" />
            </div>
          </div>
          <div class="col-lg-4">
            <div class="d-flex feature-h">
              <span class="wrap-icon me-3">
                <span class="icon-home2"></span>
              </span>
              <div class="feature-text">
                <h3 class="heading">2M Properties</h3>
                <p class="text-black-50">
                Under our organization's name, we have nearly 2 million properties.
                </p>
              </div>
            </div>

            <div class="d-flex feature-h">
              <span class="wrap-icon me-3">
                <span class="icon-person"></span>
              </span>
              <div class="feature-text">
                <h3 class="heading">Top Rated Agents</h3>
                <p class="text-black-50">
                We have the best and most trustworthy agents.
                </p>
              </div>
            </div>

            <div class="d-flex feature-h">
              <span class="wrap-icon me-3">
                <span class="icon-security"></span>
              </span>
              <div class="feature-text">
                <h3 class="heading">Legit Properties</h3>
                <p class="text-black-50">
                Our properties are legitimate, thoroughly documented, and free of scams.
                </p>
              </div>
            </div>
          </div>
        </div>
       
        </div> 
      </div>
    </div>

    <div class="section">
      <div class="row justify-content-center footer-cta" data-aos="fade-up">
        <div class="col-lg-7 mx-auto text-center">
          <h2 class="mb-4">Be a part of our growing real state agents</h2>
          <p>
            <a
              href="/request"
              target="_blank"
              class="btn btn-primary text-white py-3 px-4"
              >Apply for Real Estate agent</a
            >
          </p>
        </div>
        <!-- /.col-lg-7 -->
      </div>
      <!-- /.row -->
    </div>

    <div class="section section-5 bg-light">
      <div class="container">
        <div class="row justify-content-center text-center mb-5">
          <div class="col-lg-6 mb-5">
            <h2 class="font-weight-bold heading text-primary mb-4">
              Our Agents
            </h2>
            <p class="text-black-50">
            Our Agents are the best in the business.
            They are extremely skilled at what they do.
            We guarantee you'll get the best out of the best.
            </p>
          </div>
        </div>
        <div class="row">
          <?php foreach($agent as $i => $agent): ?>
            <?php if($i < 3):  ?>
          <div class="col-sm-6 col-md-6 col-lg-4 mb-5 mb-lg-0">
            <div class="h-100 person">
              <img
                src="/<?php echo $agent['user_image'] ?>"
                alt="Image"
                class="img-fluid"
              />

              <div class="person-contents">
                <h2 class="mb-0"><a href="#"><?php echo $agent['first_name']." ".$agent['last_name'] ?></a></h2>
                <span class="meta d-block mb-3">Agent</span>
                <?php if ($i == 0): ?>
                    <p>
                    You are guaranteed to find the best and most affordable houses here.
                    </p>
                  <?php endif; ?>
                  <?php if ($i == 1): ?>
                    <p>
                    We are trusted and dependable. You don't want to go anywhere else.
                    </p>
                  <?php endif; ?>
                  <?php if ($i == 2): ?>
                    <p>
                    You don't need to be anxious because we only offer the best houses in the country.
                    </p>
                  <?php endif; ?>
                  <ul class="social list-unstyled list-inline dark-hover">
                  <li class="list-inline-item">
                    <a href="#"><span class="icon-twitter"></span></a>
                  </li>
                  <li class="list-inline-item">
                    <a href="#"><span class="icon-facebook"></span></a>
                  </li>
                  <li class="list-inline-item">
                    <a href="#"><span class="icon-linkedin"></span></a>
                  </li>
                  <li class="list-inline-item">
                    <a href="#"><span class="icon-instagram"></span></a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <?php  endif;  ?> 
          <?php endforeach; ?>
        </div>
      </div>
    </div>
 <?php endif; ?>