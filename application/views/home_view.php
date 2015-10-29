<h2>Shop by Category</h2>
<?php
	foreach ($categories as $object) {
		echo '<a href="search/category/?category=' . $object->category_id . '">' . $object->category_name . '</a><br>';
 	}

?>
