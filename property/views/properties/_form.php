<?php if (!empty($errors)): ?>
<div class="alert alert-danger alert-dismissible fade show tooltip-test" title="Click X to dismiss" role="alert"> 
<?php foreach ($errors as $error): ?> 
    <div>
      <?php echo $error ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" ></button>
    </div>
 <?php endforeach ?>

</div>
<?php endif; ?>

 <form action="/properties/create" method="post" enctype="multipart/form-data" class="form2">
  <div class="row">
  <div class="col-6 mb-1">
  <?php if ($property['image']): ?>
                    <img src = "/<?php  echo $property['image'] ?>" >
                <?php endif;  ?>
  </div>
      <div class="col-12 mb-1">
        <div class="form-group fieldGroup">
          <label class="form-label">Property images</label>
            <div class="input-group">
              <input type="file" name="image[]" accept="image/x-png, image/gif, image/jpeg" class="form-control" />
                <div class="input-group-btn">
                  <button type="button" class="btn btn-success addMore py-2 px-2 ml-5"><span
                      class="fldemo glyphicon glyphicon glyphicon-plus"aria-hidden="true"></span>Add</button>
                </div>
            </div>
          </div>
       </div>
      </div>
      
        <div class="col-6" style="opacity: 0.6 !important;">
          <label ><b>Property Name</b></label>
          <input type="text" name="name" class="form-control"  value="<?php echo $property['name'] ?>"><br>
        </div>

        <div class="col-6 mb-3" style="opacity: 0.6 !important;">
          <label ><b>Property Price</b></label>
          <input type="number"step=".01"  class="form-control" name="price" value="<?php echo $property['price'] ?>"><br>
        </div>


        
      
        <div class="col-6" style="opacity: 0.6 !important;">
          <label ><b>Beds</b></label>
          <input type="text" name="bed" class="form-control"  value="<?php echo $property['bed'] ?>"><br>
        </div>

        <div class="col-6" style="opacity: 0.6 !important;">
          <label ><b>Baths</b></label>
          <input type="text" name="bath" class="form-control"  value="<?php echo $property['bath'] ?>"><br>
        </div>
      
        <div class="col-6" style="opacity: 0.6 !important;">
          <label ><b>Property Description</b></label>
          <textarea class="form-control" name="description"><?php echo $property['description'] ?></textarea><br>
        </div>

        <div class="col-6 mb-3" style="opacity: 0.6 !important;">
          <label ><b>Property Type</b></label>
          <select name="type" class="form-control">
                <option value="0">Select property type</option>
                <option value="Apartment/flat">Apartment/flat</option>
                <option value="Mansion">Mansion</option>
                <option value="Bungalow">Bungalow</option>
                <option value="Duplex">Duplex</option>
                <option value="Terraced house">Terraced house</option>
                <option value="Detached house">Detached house</option>
                <option value="Penthouse">Penthouse</option>
                <option value="Self Contain">Self Contain</option>
                <option value="Story buliding">Seltory building</option>
            </select><br>
        </div>

        <div class="col-6" style="opacity: 0.6 !important;">
          <label class="form-label"><b>Property status</b></label>
          <select name="property_status" class="form-control">
                <option value="0">Select property status</option>
                <option value="Sold">Sold</option>
                <option value="For rent">For rent</option>
                <option value="For sale">For sale</option>
                <option value="Pending">Pending</option>
            </select>
        </div>
        
      <div class="col-12" style="opacity: 0.6 !important;">
      <button type="submit" class="btn btn-primary">Submit</button>
      </div>
  </div>
</form> 

 <!-- copy of input fields group -->
 <div class="form-group fieldGroupCopy " style="display: none;">
    <div class="col-md-12">
        <div class="input-group">
            <input type="file" name="image[]" class="form-control" />
            <div class="input-group-btn">
                <button class="btn btn-danger remove py-2 px-2"><span
                        class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span> Remove</button>
            </div>
        </div>
    </div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script type="text/javascript">
                            $(document).ready(function() {

                                //new input fields group add limit
                                var maxGroup = 5;

                                //add more fields group
                                $(".addMore").click(function() {
                                    if ($('body').find('.fieldGroup').length < maxGroup) {
                                        var fieldHTML = '<div class="form-group fieldGroup">' + $(".fieldGroupCopy").html() +
                                            '</div>';
                                        $('body').find('.fieldGroup:last').after(fieldHTML);
                                    } else {
                                        // alert('Maximum '  ' groups are allowed.');
                                        swal("Maximum of " + maxGroup + " selections are allowed.", " ",  "info");
                                    }
                                });

                                //remove fields group
                                $("body").on("click", ".remove", function() {
                                    $(this).parents(".fieldGroup").remove();
                                });



                                //datepickr JS
                                $("#date").flatpickr({
                                    dateFormat: "d-m-Y",
                                });

                            });
    </script>
    <style>
        .form-label{
            font-size: 16px;
            color: white;
        }
        .form-control{
            height: 38px;
            opacity: 0.6 !important;
            font-weight: 500;
        }
            img{
                width :150px;
                height :80px;
            }
        
    </style>