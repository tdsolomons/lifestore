
<div  class="container-fluid table-bordered" style="margin-top:50px;margin-bottom:100px">

    <div class="container" style="margin-top:20px;font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">

        <div class="panel" style="width:700px;margin-bottom:20px;"><h3> Sub Categories  </h3></div>

        <div class="form-group">
            <form role="form" action="http://sep.tagfie.com/SubCategories/addSubCategory" method="post">
                <input type="text" class="form-control"  name="new_subcategory" id="new_subcategory" placeholder="" value="" required="" >
                <input type="submit" name="submit" class="btn btn-default" value="Add Subcategory">
                </div>


                <table width="718" class="table table-striped table-bordered" style="margin-top:8px; margin-left:0px; padding-left:0px; font-size:12px">

                    <tr>
                        <th width="546" height="39" align="left">Sub Categories</th>
                        <th width="80">Parent Category</th>
                        <th width="80">Category Image</th>
                        <th width="74">Edit</th>
                        <!--th width="82">Remove</th-->
                    </tr>

                    <?php
                    if ($subCategories != 0) {
                        foreach ($subCategories as $row) {
                            ?>
                            <tr>
                                <?php $cid = $row->category_id ?>
                                <td width="546" height="50px"><?php echo $row->category_name; ?></td>
                                <td width="546" height="50px"><?php echo $row->parent_category; ?></td>
                                <td width="200" height="50px"><?php echo '<img src="'.asset_url().'img/category_images/'. $row->category_id.'.svg" width="70" height="70" />';?></td>
                                <td width="74" height="50px" align="center"><a href="http://sep.tagfie.com/SubCategories/updateSubCategoryView?cid=<?php echo $cid; ?>"><input type="button" value="Edit"></a>
                                <!--td width="82" height="50px" align="center">
                                    <input type="button" onclick="toRemoveSub()" value='Remove' class="de" id="t<?php echo $cid ?>"></td-->
                            </tr>

                            <?php
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


                </br>
                </br>

        </div>
    </div>

