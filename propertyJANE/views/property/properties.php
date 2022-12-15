    <div
      class="hero page-inner overlay"
      style="background-image: url('images/hero_bg_1.jpg'); height:50vh;"
    >
      <div class="container">
        <div class="row justify-content-center align-items-center">
          <div class="col-lg-9 text-center mt-5">
            <h1 class="heading" data-aos="fade-up"> All Properties</h1>

            <nav
              aria-label="breadcrumb"
              data-aos="fade-up"
              data-aos-delay="200"
            >
              <ol class="breadcrumb text-center justify-content-center">
              <?php if(isset($_SESSION['roleId'])) :?>
                <?php if($_SESSION['roleId'] == 2): ?>
                  <li class="breadcrumb-item h6"><a href="/property_actions"><em>Update</em></a></li>
                  <li class="breadcrumb-item h6"><a href="/property_actions"><em> Delete </em></a></li>
                  <li class="breadcrumb-item h6"><a href="/property/create"><em>Create</em></a></li>
                <?php endif; ?>
              <?php endif ?>
              <?php if(!(isset($_SESSION['roleId'])) || $_SESSION['roleId'] == 1): ?>
                  <li class="breadcrumb-item h6 text-white"><em>Click <a href="/house_sale" class="text-warning">Here</a> to view Properties for Sale</em></li>
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
          <?php foreach ($property as $i => $item):  ?>
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 mb-3">
             <div class="property-item">
              <div class="box">
                  <a href="/single_property?id=<?php echo $item['property_id'] ?>" class="img">
                    <img src="/<?php echo $item['property_image'];  ?>" alt="...Property image" class="img-fluid" style="width: 360px; height:350px;" />
                  </a></div>

              <div class="property-content">
                    <div class="price mb-2"><span>&#8358;<?php $currency = number_format( $item['property_price'], 2, '.', ',');
                                                        echo $currency  ?>
                                            </span></div>
                    <div>
                      <span class="d-block mb-2 text-black-50"
                        ><?php echo $item['property_type'] ?></span
                      >
                      <div class="size">
                        <span class="city d-block mb-3"  style="font-size: 19px;"><?php echo $item['property_address'] ?></span>
                      </div>

                      <div class="specs d-flex mb-4">
                        <span class="d-block d-flex align-items-center me-3">
                          <span class="icon-bed me-2"></span>
                          <span class="caption"><?php echo $item['bed'] ?></span>
                        </span>
                        <span class="d-block d-flex align-items-center ">
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

                      <a href="/single_property?id=<?php echo $item['property_id'] ?>"
                        class="btn btn-primary mb-1 py-2 px-3">See details</a>
                        <?php if(isset($_SESSION['roleId'])) :?>
                          <?php if($_SESSION['roleId'] == 2): ?>
                                  <a href="/property_actions" class="btn btn-primary mb-1 py-2 px-3">
                                    See Actions
                                  </a>
                          <?php endif; ?>
                        <?php endif; ?>
                        
                    </div>
                  </div>
            </div>
            
            <!-- .item -->
          </div>
          <?php endforeach; ?>
        </div>
        <?php if(empty($property)): ?>
                <div class="alert alert-warning alert-dismissible fade show tooltip-test" title="Click X to dismiss" role="alert">
                <center><strong>No property</strong></center>
                <button type="button" class="btn-close" data-bs-dismiss="alert" ></button>
                </div>
                <?php endif; ?>
                <?php if(isset($_SESSION['roleId'])) :?>
                          <?php if($_SESSION['roleId'] == 3): ?>
                            <a href="/agent_dashboard" class="btn  btn-warning">Go back</a>
                          <?php endif; ?>
                        <?php endif; ?>
                        <?php if(isset($_SESSION['roleId'])) :?>
                          <?php if($_SESSION['roleId'] == 2): ?>
                            <a href="/admin_dashboard" class="btn  btn-warning">Go back</a>
                          <?php endif; ?>
                        <?php endif; ?>
      </div>
    </div>
