

<div  class="container-fluid table-bordered" style="margin-top:50px;margin-bottom:100px">

    <div class="container" style="margin-top:20px;font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">

        <div class="panel" style="width:700px;margin-bottom:20px;"><h3> Categories  </h3></div>

        <div class="form-group">
            <form role="form" action="http://sep.tagfie.com/Parent_categories/addCategory" method="post">
                <input type="text" class="form-control" width="500px" name="new_category" id="new_category" placeholder="" value="" required="">
                <input type="submit" name="submit" class="btn btn-default" value="Add Category">
            </form>
        </div>

        <table width="716" class="table table-striped table-bordered" style="margin-top:8px; margin-left:0px; padding-left:0px; font-size:12px">

            <tr>
                <th width="545" height="39" align="left">Categories</th>
                <th width="80">Edit</th>
                <th width="80">Remove</th>
            </tr>

            <?php
            if ($categories != 0) {
                foreach ($categories as $row) {
                    $cID = $row->parent_category_id;
                    if ($cid == $cID) {
                    ?>
            <tr><form method="post" action="http://sep.tagfie.com/Parent_categories/updateCategory?cid=<?php echo $cID; ?>">
                        <td width="545" height="50px"><input type="text" class="form-control" width="500px" name="categoryEdit" value="<?php echo set_value('categoryEdit', $row->parent_category);?>"</input></td>
                        <td width="74" height="50px" align="center"><button type="submit" value="Update">Update</button></td>
                        <td width="82" height="50px" align="center"><input type="button" onclick="toRemove()" value='Remove' class="de" id="t<?php echo $cID; ?>"></td>
            </form></tr>
                    <?php
                    }else{
                        ?>
                    <tr>
                        <td width="545" height="50px"><?php echo $row->parent_category; ?></td>
                        <td width="74" height="50px" align="center"><a href="http://sep.tagfie.com/Parent_categories/updateCategoryView?cid=<?php echo $cID; ?>"><input type="button" value="Edit"></a></td>
                        <td width="82" height="50px" align="center"><input type="button" onclick="toRemove()" value='Remove' class="de" id="t<?php echo $cID; ?>"></td>
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

                <script type="text/javascript">

                    function toRemove() {

                        // $(".de").click(function(event) {
                        var cid = event.target.id.slice(1);
                        //document.write(item);
                        if (confirm("Are you sure you want to remove category?")) {
                            location.href = 'http://sep.tagfie.com/Parent_categories/deleteCategory?cid=' + cid;
                        }
                        //  });  
                    }
                    
                </script>

        </div>
    </div>