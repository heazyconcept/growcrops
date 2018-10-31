<?php
   defined('BASEPATH') OR exit('No direct script access allowed');
   ?>
<div class="main">
   <div class="main-inner">
      <div class="content">
         <div class=" crops_header single_page_header has_overlay">
            <div class="header_overlay">
               <div class="container">
                  <h2>All Our Crops</h2>
                  <!-- <p>Farming made easy</p> -->
               </div>
            </div>
         </div>
         <div class="single_page_main_content crops_wrapper">
            <div class="container">
               <form class="filter">
                  <div class="row">
                     <div class="col-sm-12 col-md-5">
                        <div class="form-group">
                           <input type="text" placeholder="Keyword" class="form-control">
                        </div>
                        <!-- /.form-group -->
                     </div>
                     <!-- /.col-* -->
                     <div class="col-sm-12 col-md-4">
                        <div class="form-group">
                           <select class="form-control" title="Select Location">
                              <option>Fully booked</option>
                              <option>Available</option>
                           </select>
                        </div>
                        <!-- /.form-group -->
                     </div>
                     <!-- /.col-* -->
                     <div class="col-sm-12 col-md-3">
                        <button type="submit" class="btn btn-primary">Redefine Search Result</button>
                     </div>
                     <!-- /.col-* -->
                  </div>
                  <!-- /.row -->
                  <hr>
                  <div class="row">
                     <div class="col-sm-8">
                        <div class="filter-actions">
                           <a href="#"><i class="fa fa-close"></i> Reset Filter</a>
                           <a href="#"><i class="fa fa-save"></i> Save Search</a>
                        </div>
                        <!-- /.filter-actions -->
                     </div>
                     <!-- /.col-* -->
                     <div class="col-sm-4">
                     </div>
                     <!-- /.col-* -->
                  </div>
                  <!-- /.row -->
               </form>
               <!-- <h2 class="page-title">
                  1802 results matching your query


                  </h2>  -->
               <div class="cards-simple-wrapper">
                  <div class="row">
                     <?php foreach ($crops as $crop): ?>
                     <div class="col-sm-6 col-md-3">
                        <div class="card-simple" data-background-image="<?php echo asset_url('img/').$crop->featured_image; ?>">
                           <div class="card-simple-background">
                              <div class="card-simple-content">
                                 <h2><a href="<?php echo base_url('crops/view/').$crop->slug ?>"><?php echo$crop->crop_name; ?></a></h2>
                                 <!-- <div class="card-simple-rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    </div><!-- /.card-rating --> -->
                                 <div class="card-simple-actions">
                                    <a href="<?php echo base_url('crops/view/').$crop->slug ?>" class="fa fa-search"></a>
                                 </div>
                                 <!-- /.card-simple-actions -->
                              </div>
                              <!-- /.card-simple-content -->
                           </div>
                           <!-- /.card-simple-background -->
                        </div>
                        <!-- /.card-simple -->
                     </div>
                     <!-- /.col-* -->
                     <?php endforeach; ?>
                  </div>
                  <!-- /.row -->
               </div>
               <!-- /.cards-simple-wrapper -->
               <div class="pager">
                  <ul>
                     <?php foreach ($links as $link) {
                        echo "<li>". $link."</li>";
                        } ?>
                     <!-- <li><a href="#">Prev</a></li>
                        <li><a href="#">5</a></li>
                        <li class="active"><a>6</a></li>
                        <li><a href="#">7</a></li>
                        <li><a href="#">Next</a></li> -->
                  </ul>
               </div>
               <!-- /.pagination -->
            </div>
         </div>
      </div>
      <!-- /.content -->
   </div>
   <!-- /.main-inner -->
</div>
<!-- /.main -->
