
    <div
      class="hero page-inner overlay"
      style="background-image: url('<?php echo $property['image']?>')"
    >
      <div class="container">
        <div class="row justify-content-center align-items-center">
          <div class="col-lg-9 text-center mt-5">
            <h1 class="heading" data-aos="fade-up">
            <?php echo $property['description']?>
            </h1>

            <nav
              aria-label="breadcrumb"
              data-aos="fade-up"
              data-aos-delay="200"
            >
              <ol class="breadcrumb text-center justify-content-center">
                <li class="breadcrumb-item">
                  <a href="/properties">Properties</a>
                </li>
                <li
                  class="breadcrumb-item active text-white-50"
                  aria-current="page"
                >
                <?php echo $property['description']?>
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>

    <div class="section">
      <div class="container">
        <div class="row justify-content-between">
          <div class="col-lg-7">
            <div class="img-property-slide-wrap">
              <div class="img-property-slide">
              <img src="/<?php echo $property['image']?>" alt="Image" class="img-fluid" style=" height:100vh;"/>
                <img src="/<?php echo $property['image']?>" alt="Image" class="img-fluid" style=" height:100vh;"/>
                <img src="/<?php echo $property['image']?>" alt="Image" class="img-fluid" style=" height:100vh;" />
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <p class="text-black-50">
            <p class="meta"><u>Description</u></p>

            <p class="text-black-50"> This property is located at <strong class="text-primary"><?php echo $property['description']?>.</strong>
                  It is a/an <strong class="text-primary"><?php echo $property['type']?></strong> 
                  with <?php echo $property['bath']?> bathroom(s) and <?php echo $property['bed']?>
                  bed(s).</p>

                  <p class="meta"><em>Agent's comment: <?php echo $property['description']?>.</em></p>
                <p>This property is currently <strong class="text-primary"><?php echo $property['property_status']?></strong></p>
                <?php if (!($property['property_status'] == 'Sold')): ?>
                  <?php $id = $_GET['id']; ?>
                  <h6>Are you interested in this property? If yes, Click 
                    <!-- <button type="submit" formmethod="post" class="text-warning btn btn-link py-1 px-1">
                      <a href="/property/request"class="text-warning">Here</a>
                    </button> -->
                  
                  <form method="post" action="/properties/request" style="display: inline-block;">
                      <input type="hidden" name = "request_id" value="<?php echo $property['id'] ?>">
                      <button type="submit"  class="text-warning btn btn-link py-1 px-1">Here</button>
                      </form>
                    </h6>
                   <?php endif ?>
            </p>

            <?php if($property['role_id'] == 3):?>
            <div class="d-block agent-box p-5">
              <div class="img mb-4">
                <img
                  src="/<?php echo $property['user_image']?>"
                  alt="Image"
                  class="img-fluid"
                />
              </div>
              <div class="text">
                <h3 class="mb-0"><h3 class="mb-0"><?php echo $property['user_name']?></h3></h3>
                <div class="meta mb-3">Agent</div>
                <p>
                <?php echo $property['agent_description']?>
                </p>
                <ul class="list-unstyled social dark-hover d-flex">
                  <li class="me-1">
                    <a href="#"><span class="icon-instagram"></span></a>
                  </li>
                  <li class="me-1">
                    <a href="#"><span class="icon-twitter"></span></a>
                  </li>
                  <li class="me-1">
                    <a href="#"><span class="icon-facebook"></span></a>
                  </li>
                  <li class="me-1">
                    <a href="#"><span class="icon-linkedin"></span></a>
                  </li>
                </ul>
              </div>
            </div>
            <?php endif ?>
          </div>
        </div>
        <a href="/properties" class="btn  btn-warning">Go back</a>
      </div>
    </div>
