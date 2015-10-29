
    
    
    <div  class="container-fluid table-bordered" style="width:1300px;margin-top:50px;margin-bottom:100px">
        
        <div class="container" style="margin-top:20px;font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">

<div class="panel" style="width:700px;margin-bottom:20px;"><h3> User Details  </h3></div>
 <table width="1250" class="table table-striped table-bordered" style="margin-top:8px; width:1200px;font-size:12px">
      
            <tr>
                <th width="158" height="47">First Name</th>
                <th width="184">Last Name</th>
                <th width="213">Email</th>
                <th width="235">Address</th>
                <th width="115">Phone</th>
                <th width="148">Go to Profile</th>
                <th width="148">Remove user</th>
            </tr>

            <?php
            if ($users != 0) {
                foreach ($users as $row) {
                    if ($row->user_status == 1) {
                    ?>
                    <tr>
                        <?php $uname = $row->username ?>
                        <td width="158" height="50px"><?php echo $row->first_name ?></td>
                        <td width="184" height="50px"><?php echo $row->last_name ?></td>
                        <td width="213" height="50px"><?php echo $row->email ?></td>
                        <td width="235" height="50px"><?php echo $row->address . "," . $row->street . "," . $row->city ?></td>
                        <td width="115" height="50px" align="center"><?php echo $row->phone ?></td>
                        <td width="148" height="50px" align="center"><a href="http://sep.tagfie.com/admin/viewProfile?uname=<?php echo $uname; ?>"><input type="button" value="Go to profile"></a></td>
                        
                        <td width="145" height="50px" align="center">
                         <?php //echo $uname ?>
                        <input type="button" onclick="toDeactivate()" value='Deactivate User' class="de" id="t<?php echo $uname ?>">
                        </td>
                    </tr>
					<?php
                	}
					
					if ($row->user_status == 0) {
                    ?>
                    <tr>
                        <?php $uname = $row->username ?>
                        <td width="158" height="50px"><?php echo $row->first_name ?></td>
                        <td width="184" height="50px"><?php echo $row->last_name ?></td>
                        <td width="213" height="50px"><?php echo $row->email ?></td>
                        <td width="235" height="50px"><?php echo $row->address . "," . $row->street . "," . $row->city ?></td>
                        <td width="115" height="50px" align="center"><?php echo $row->phone ?></td>
                        <td width="148" height="50px" align="center"><a href="http://sep.tagfie.com/admin/viewProfile?uname=<?php echo $uname; ?>"><input type="button" value="Go to profile"></a></td>
                        
                        <td width="145" height="50px" align="center">
                         <?php //echo $uname ?>
                        <input type="button" onclick="toActivate()" value='Activate User' class="de" id="t<?php echo $uname ?>">
                        </td>
                    </tr>
					<?php
                	}
                }
				
            } else {
                ?>
                <tr><h4>There are no records to show!</h4></tr> 
            <?php
        }
        ?>

    </table>

	<!--Javascript -->
     <script type="text/javascript">
	 
	  function toDeactivate() {
		 
		// $(".de").click(function(event) {
           var uname=event.target.id.slice(1);
		//document.write(uname);
		  if (confirm("Are you sure you want to deactivate the user?")) {	
				  location.href='http://sep.tagfie.com/admin/changeUserDeactivate?uname=' + uname ;
				  }
		//  });  
	  }
	  
	  function toActivate() {
		 
		//  $(".de").click(function(event) {
           var uname=event.target.id.slice(1);
		//document.write(uname);
		  if (confirm("Are you sure you want to activate the user?")) {	
				  location.href='http://sep.tagfie.com/admin/changeUserActivate?uname=' + uname ;
				  }
		//  });  
	  }
	  
	 </script>

<div>  
     <a href="http://sep.tagfie.com/admin"><input type='button' value='Back to Admin'></a>
</div>

   </div>
</div>
