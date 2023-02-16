
    <div
      class="hero page-inner overlay"
      style="background-image: url('images/hero_bg_1.jpg')"
    >
      <div class="container">
        <div class="row justify-content-center align-items-center">
          <div class="col-lg-9 text-center mt-5">
            <h1 class="heading" data-aos="fade-up">Properties</h1>

            <nav aria-label="breadcrumb" data-aos="fade-up"data-aos-delay="200">
               <ol class="breadcrumb text-center justify-content-center">
              <?php if(isset($_SESSION['role_id'])) :?>
                <?php if($_SESSION['role_id'] == 2): ?>
                  <li class="breadcrumb-item h6"><a href="/property_crud"><em>Update</em></a></li>
                  <li class="breadcrumb-item h6"><a href="/property_crud"><em> Delete </em></a></li>
                  <li class="breadcrumb-item h6"><a href="/properties/create"><em>Create</em></a></li>
                <?php endif; ?>
              <?php endif ?>
              <?php if(!(isset($_SESSION['role_id'])) || $_SESSION['role_id'] == 1): ?>
                  <li class="breadcrumb-item h6 text-white"><em>Click <a href="/house_sale" style="color:#E30B5D;">Here</a> to view Properties for Sale</em></li>
                <?php endif; ?>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>

    <div class="section section-properties">
      <div class="container">
        <div class="row">
          <?php foreach($property as $i => $property): ?>
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
            <div class="property-item mb-30">
              <div class="box">
              <a href="/property_single?id=<?php echo $property['id'] ?>" class="img">
                <img src="/<?php echo $property['image'] ?>" alt="...Property image"  class="img-fluid" style="width: 360px; height:350px;"> 
              </a></div>

              <div class="block">
              <div class="property-content">
                <div class="price mb-2"><span>&#8358;<?php $currency = number_format( $property['price'], 2, '.', ',');                               echo $currency  ?></span></div>
                <div>
                  <span class="d-block mb-2 text-black-50"><?php echo $property['description'] ?></span>

                  <span class="city d-block mb-3 text-black-50"><?php echo $property['type'] ?></span>

                  <span class="city d-block mb-3"><?php echo $property['name'] ?></span>

                  <div class="specs d-flex mb-4">
                    <span class="d-block d-flex align-items-center me-3">
                      <span class="icon-bed me-2"></span>
                      <span class="caption"><?php echo $property['bed'] ?></span>
                    </span>
                    <span class="d-block d-flex align-items-center">
                      <span class="icon-bath me-2"></span>
                      <span class="caption"><?php echo $property['bath'] ?></span>
                    </span>
                  </div>
                  <span class="d-block mb-2 text-black-50"
                        >status: <?php echo $property['property_status'] ?></span>
                  <a href="/property_single?id=<?php echo $property['id'] ?>" class="btn btn-primary mb-1 py-2 px-3">See details</a>
                  <?php if(isset($_SESSION['role_id'])) :?>
                          <?php if($_SESSION['role_id'] == 2): ?>
                  <a href="/property_crud" class="btn btn-primary py-2 px-3">See Actions</a>
                
                  <?php endif; ?>
                   <?php endif; ?>
                   </div>
                </div>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>

        <?php if(empty($property)): ?>
                <div class="alert alert-warning alert-dismissible fade show tooltip-test" title="Click X to dismiss" role="alert">
                <center><strong>No property</strong></center>
                <button type="button" class="btn-close" data-bs-dismiss="alert" ></button>
                </div>
              <?php endif; ?>
              <?php if(isset($_SESSION['role_id'])) :?>
                          <?php if($_SESSION['role_id'] == 3): ?>
                            <a href="/agent_dashboard" class="btn  btn-warning">Go back</a>
                          <?php endif; ?>
                        <?php endif; ?>
                        <?php if(isset($_SESSION['role_id'])) :?>
                          <?php if($_SESSION['role_id'] == 2): ?>
                            <a href="/admin_dashboard" class="btn  btn-warning">Go back</a>
                          <?php endif; ?>
                        <?php endif; ?>
      </div>
    </div>


 