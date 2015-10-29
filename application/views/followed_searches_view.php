<title><?php echo $title ?></title>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/search_styles.css">

<h1>My Followed Searches</h1>

<div id="all_searches_container">
<table>
<?php

	if($searches == NULL){
		echo '<div id="result_count_text"><h3>You have no followed searches.</h3></div>';
	}else{
		//Showing Searches

		foreach ($searches as $object) {
			echo '<tr>
					<td>
						<h3>'. $object->keywords .'</h3>';
						
			if ($object->min_price != -1) {
				echo '<br>Minimum price: ' . $object->min_price;
			}

			if ($object->max_price != -1) {
				echo '<br>Maximum price: ' . $object->max_price;
			}

			echo	'</td>
					<td>
						<a href="'. base_url() .'/search/unfollow/?followed_search='. $object->search_id .'&redirect=all">Unfollow</a>
					</td>
				</tr>';	
		}
	}
	
?>
</table>
</div>