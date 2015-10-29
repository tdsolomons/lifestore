 <!--Image Banner-------------->
     <div class="row table-bordered" style="height:300px;margin:10px;padding-left:0px">
    	 <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
              <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
              <li data-target="#myCarousel" data-slide-to="1"></li>
              <li data-target="#myCarousel" data-slide-to="2"></li>
              <li data-target="#myCarousel" data-slide-to="3"></li>
            </ol>
          
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
             <?php
			  $this->load->helper('directory');
			  $dat = directory_map(FCPATH . 'assets/img/banner_images', 1);

			  for ($i=0; $i<sizeof($dat); $i++ ){
				
                if($i==0){ ?>
              <div class="item active">
                <img src="<?php echo asset_url();?>img/banner_images/<?php echo $dat[$i] ;?>" alt="Chania">
              </div>
          <?php } 
		        else{ ?>
			  
              <div class="item">
                <img src="<?php  echo asset_url();?>img/banner_images/<?php  echo $dat[$i] ;?>" alt="Chania">
              </div>
           <?php  }  } ?>
             
            </div>
          
            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
              <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
              <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
    
     </div>