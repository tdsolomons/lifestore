<div  class="container-fluid table-bordered" style="margin-top:50px;margin-bottom:100px">

    <div class="container" style="margin-top:20px;font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">

        <div class="panel" style="width:700px;margin-bottom:20px;"><h3>Sub Categories</h3></div>

        <div class="form-group">
            <form role="form" action="http://sep.tagfie.com/SubCategories/addSubCategory" method="post">
                <input type="text" class="form-control"  name="new_subcategory" id="new_subcategory" placeholder="" value="" required="" >
                <input type="submit" name="submit" class="btn btn-default" value="Add Subcategory">
            </form>
        </div>
        
        
        
        
        
    <!--Edit Categories Table--------------------------------->    
	
        <table width="718" class="table table-striped table-bordered" style="margin-top:8px; margin-left:0px; padding-left:0px; font-size:12px">

            <tr>
                <th width="546" height="39" align="left">Sub Categories</th>
                <th width="80">Edit Category</th>
                <th width="80">Edit Image</th>
                <th width="80">Update</th>
                <th width="80">Remove</th>
            </tr>

            
			<?php
            if ($subCategories != 0) {
                foreach ($subCategories as $row) {
                    $cID = $row->category_id;
                    if ($cid == $cID) {
            ?>
                     <tr>
                         <form method="post" action="http://sep.tagfie.com/SubCategories/updateSubCategory?cid=<?php echo $cID; ?>">    
                         <td width="446" height="50px">
                         	<input type="text" name="subCategoryEdit" value="<?php echo set_value('subCategoryEdit', $row->category_name); ?>"
                            </input>
                         </td>
                           
                           
                         <td width="100" height="50px"> 
                                <select name="parent_category_edit" value="<?php echo set_value('parent_category_edit', $row->parent_category); ?>">
                                    <?php
                                    if ($categories != 0) {
                                        foreach ($categories as $each) {
                                            ?>
                                            <option value="<?php echo $each->parent_category_id ?>"><?php echo $each->parent_category ?></option>
                                            <?php
                                        }
                                    }
                                        ?>
                                 </select> 
                          </td>


                          <td width="200" height="50px">
						  		<?php //echo $error;?>
                                
                               
								<?php echo '<img src="'.asset_url().'img/category_images/'.$row->category_id.'.svg" width="70" height="70" />' ?>
							
                                
                                 
								 	<input type="button" id="a<?php echo $cID; ?>" onclick="addImage(this.id)" value="Change Image"/>
                              
                          </td>
                                
                                
                                
                          <td width="74" height="50px" align="center">
                                <input type="submit" value="Update" />
                          </td>
                                
                                
                          <td width="82" height="50px" align="center">
                                <input type="button" onclick="toRemoveSub()" value='Remove' class="de" id="t<?php echo $cID; ?>">
                          </td>
                            </form>
                            
                         </tr>
                            <?php
                        } 
						
						
						
						
						
						else {
                            ?>

                            <tr>   
                                <td width="446" height="50px"><?php echo $row->category_name; ?></td>
                                <td width="100" height="50px"><?php echo $row->parent_category; ?></td>
                                <td width="200" height="50px"><?php echo '<img src="'.asset_url().'img/category_images/'.$row->category_id.'.svg" width="70" height="70" />' ?></td>
                                <td width="74" height="50px" align="center"><a href="http://sep.tagfie.com/SubCategories/updateSubCategoryView?cid=<?php echo $cID; ?>"><input type="button" value="Edit"></a>
                                <td width="82" height="50px" align="center"><input type="button" onclick="toRemoveSub()" value='Remove' class="de" id="t<?php echo $cID ?>"></td>
                            </tr>
                            <?php
                        }
                    }
                } else {
                    ?>
                    <tr><h4>There are no records to show!</h4></tr> 
                    <?php
					echo $check;
                }
                ?>

        </table>
	
        <script type="text/javascript">

			function addImage(bId){
									 buttonId=bId.slice(1);
									window.open("http://sep.tagfie.com/SubCategories/load_category_im_upload?subCatId="+buttonId, "_blank", "toolbar=no, scrollbars=no, resizable=yes, width=800, height=400");
									}


            function toRemoveSub() {
				var cid = event.target.id.slice(1);
				var bool = "<?php echo $check ?>";
				if(bool>0){
					alert("Cannot delete category, Items available.!");
				}
				else{	
                if (confirm("Are you sure you want to remove category?")) {
                    location.href = 'http://sep.tagfie.com/SubCategories/deleteSubCategory?cid=' + cid;
                }
				}
            }

        </script>

    </div>
</div>