<div class="container-fluid"> 
 <!--HEADING-->
 <div class="row">
  <div class="col-md-4">
 	<h2>Generate Reports</h2>
  </div>
  
  <div class="col-md-4">
    
  </div>
 </div>
 
 
 <!--ITEM DETAILS------------------------------>
 <div class="row" style="margin-top:30px">
  <div class="col-md-8">
    <form role="form form-horizontal" action="http://sep.tagfie.com/Report/generate_report" method="post" >
       <div class="form-group">
       <label for="name">Time Period:</label>
       <select class="form-control" id="time" name="time"  >
               <option value="this" >This Month</option>
               <option value="prev" >Previous Month</option>
               <option value="all" >All time</option>
       </select>
      </div>
                           
     <div class="form-group">
      <div class="col-md-12" style="padding-left:0px">
        <label >Item Type:</label>
      </div>
      <div class="col-md-12" style="padding-left:0px">
       <div class=" radio-inline">
         <label class="radio-inline"><input type="radio" name="optradio" value="1">Fixed Price</label>
       </div>
       <div class=" radio-inline">
         <label class="radio-inline"><input type="radio" name="optradio" checked="checked" value="0">Auction</label>
       </div>
      </div>  
     </div>
           
           <div class="form-group">
      <div class="col-md-12" style="padding-left:0px">
        <label >Report Type:</label>
      </div>
      <div class="col-md-12" style="padding-left:0px">
       <div class=" radio-inline">
         <label class="radio-inline"><input type="radio" name="optradio2" value="1">Sales</label>
       </div>
       <div class=" radio-inline">
         <label class="radio-inline"><input type="radio" name="optradio2" checked="checked" value="0">Purchases</label>
       </div>
      </div>  
     </div>  

     <div class="form-group col-md-8" style="padding-left:0px;margin-left:0px;margin-top:40px;" >
           <button type="submit" class="btn btn-primary ">Generate Report</button>
     </div>
                      
  
  </div>
  
 </div>
 
 
 
 

 
 
 

 

 
 
</div><!--Container----->