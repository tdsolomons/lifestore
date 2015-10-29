<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sell</title>
   
   <link href="<?php echo asset_url(); ?>css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="css/style.css" type="text/css">
   <link rel="stylesheet" href="test.css" type="text/css">




</head>

<body>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
 
 
 

 
 
 


<!--Contents------------------------------------------------------------------> 
<div class="container">

    
    
    
    
    <div class="row"  style="min-height:800px;">
               <!--Side Bar----------------------->
               <div class="col-md-6" style="min-height:800px;background-color:#CCC;margin-left:0px;width:180px;">
               </div>
               
               
               <!--Main Content----------------------->
               <div class="col-lg-10" style="min-height:800px;">
                        <div class="page-header h4">Add items </div>
                             
               
               
               <!---Add Form-------------------------->
               <div style="margin-top:10px;margin-left:30px;width:700px;height:400px">
                    
                          
                          
                   <!--Image Upload Bar-------------------------------------> 
                            
                      <div class="row" style="margin-top:10px;margin-left:0px;width:700px;">
                            <div class="panel"><h4>Add Images</h4>
                            </div>
                        
                        
                    
						  	
                        
                           
                            <div class="col-md-2" style="text-align:center">
                             	  <?php if(isset($imageOne)){
									  			if($imageOne!=0)
													$url1=asset_url()."img/item_images/".$imageOne;
												else
												    $url1=asset_url()."img/logo1.png";
								  		}
										else
                             		    		$url1=asset_url()."img/logo1.png";
												
											?>	
								 <img src="<?php echo $url1?>" alt="Smiley face" height="80" width="80">
                           		
                                
                                 <?php if(isset($imageOne)){
									  			if($imageOne!=0)
													{?>
													 <input type="button" id="1" value="Replace" class="btn btn-default" onclick="addImage(this.id)" />
												<?php } else {
												    $url1=asset_url()."img/logo1.png"; ?>
								  					 <input type="button" id="1" value="Add" class="btn btn-default" onclick="addImage(this.id)" /> <?php }
										}
										else {
                             		    		$url1=asset_url()."img/logo1.png";?>
												 <input type="button" id="1" value="Add" class="btn btn-default" onclick="addImage(this.id)" /> <?php } ?>
                            </div>
                            
                           
                           
                           
                           
                           
                             <div class="col-md-2" style="text-align:center">
                                  <?php if(isset($imageTwo)){
									  			if($imageTwo!=0)
													$url2=asset_url()."img/item_images/".$imageTwo;
												else
												    $url2=asset_url()."img/logo1.png";
								  		}
										else
                             		    		$url2=asset_url()."img/logo1.png";
												
											?>	
								 <img src="<?php echo $url2?>" alt="Smiley face" height="80" width="80">
                           		
                                 
								 <?php if(isset($imageTwo)){
									  			if($imageTwo!=0)
													{?>
													 <input type="button" id="2" value="Remove" class="btn btn-default" onclick="removeImage(this.id)" />
												<?php } else {
												    $url2=asset_url()."img/logo1.png"; ?>
                                                     <input type="button" id="2" value="Add" class="btn btn-default" onclick="addImage(this.id)" /> <?php } 
								  		}
										else {
                             		    		$url2=asset_url()."img/logo1.png";?>
												 <input type="button" id="2" value="Add" class="btn btn-default" onclick="addImage(this.id)" /> <?php } ?>
                            </div>
                         
                         
                            
                            
                             <div class="col-md-2" style="text-align:center">
                                  <?php if(isset($imageThree)){
									  			if($imageThree!=0)
													$url3=asset_url()."img/item_images/".$imageThree;
												else
												    $url3=asset_url()."img/logo1.png";
								  		}
										else
                             		    		$url3=asset_url()."img/logo1.png";
												
											?>	
								 <img src="<?php echo $url3?>" alt="Smiley face" height="80" width="80">
                           		
                                 <?php if(isset($imageThree)){
									  			if($imageThree!=0)
													{?>
													 <input type="button" id="3" value="Remove" class="btn btn-default" onclick="removeImage(this.id)" />
												<?php } else {
												    $url3=asset_url()."img/logo1.png"; ?>
                                                     <input type="button" id="3" value="Add" class="btn btn-default" onclick="addImage(this.id)" /> <?php } 
								  		}
										else {
                             		    		$url3=asset_url()."img/logo1.png";?>
												 <input type="button" id="3" value="Add" class="btn btn-default" onclick="addImage(this.id)" /> <?php } ?>
                            </div>
                            
                            
                            
                            
                            <div class="col-md-2" style="text-align:center">
                                <?php if(isset($imageFour)){
									  			if($imageFour!=0)
													$url4=asset_url()."img/item_images/".$imageFour;
												else
												    $url4=asset_url()."img/logo1.png";
								  		}
										else
                             		    		$url4=asset_url()."img/logo1.png";
												
								?>	
								
                                
                                 <img src="<?php echo $url4?>" alt="Smiley face" height="80" width="80">
                           		
                                 <?php if(isset($imageFour)){
									  			if($imageFour!=0)
													{?>
													 <input type="button" id="4" value="Remove" class="btn btn-default" onclick="removeImage(this.id)" />
												<?php } else {
												    $url4=asset_url()."img/logo1.png"; ?>
                                                     <input type="button" id="4" value="Add" class="btn btn-default" onclick="addImage(this.id)" /> <?php } 
								  		}
										else {
                             		    		$url4=asset_url()."img/logo1.png";?>
												 <input type="button" id="4" value="Add" class="btn btn-default" onclick="addImage(this.id)" /> <?php } ?>
                            </div>
                            
                            
                            
                          
                          
						  <script type="text/javascript">
						   		function addImage(bId){
									 buttonId=bId;
									window.open("http://sep.tagfie.com/Upload?buttonId="+buttonId, "_blank", "toolbar=no, scrollbars=no, resizable=yes, width=800, height=400");
									}
								
								function removeImage(bId){
									 buttonId=bId;
									window.location.href="http://sep.tagfie.com/Upload/remove_image?buttonId="+buttonId;
									}
                          
                          </script>
                          
                          
                           </div>
                          
                    
                           <div style="margin-top:100px">
                    			<a href="http://sep.tagfie.com/UserAccount/verifyUpload" class="btn btn-primary">Done </a>       
                           </div>
             
        
        
        </div>
               
               
               
               
               
              
              
               </div>
               
     </div>
 
 </div>
 
 
 
 
 
 
 