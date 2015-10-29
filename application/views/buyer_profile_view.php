<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/profile_styles.css">
<?php
	if (isset($buyer_feedback)){
		$ratingObject;
		 
		foreach ($buyer_feedback as $object) {
			 $ratingObject = $object;
		}
		echo '<h1>Buyer ' . $ratingObject->username . '</h1>';
		echo '<h3>Feedback rating</h3>';
		echo '<div class="stars"> ';
		$rating =  number_format($ratingObject->avarage_rating, 1);
		$roundedRating = round($ratingObject->avarage_rating);
		for ($i=5; $i >= 1; $i--) { 
			$checkedIndicator = '';
			if ($roundedRating >= $i) {
				$checkedIndicator = 'checked';
			}
			echo '<input class="star star-'. $i .'" id="star-'. $i .'" type="radio" name="star" disabled ' . $checkedIndicator . ' />
				    <label class="star star'. $checkedIndicator .'" for="star-'. $i .'"></label>
				';
		}

		echo '</div></br>';

		echo $rating . '/5 Avarage rating. ' ;

		echo '<br><strong>' . $ratingObject->total_ratings . ' Ratings</strong>';


	}
	
	if (isset($list_of_feedbacks)) {

		echo '<br><table id="feedback_table">
			<tr><th>Seller</th><th>Rating</th><th>Feedback</th><th>Bought item</th></tr>	';
		
		foreach ($list_of_feedbacks as $feedbackObject) {
			echo '<tr class="feedback_item" >
				<td><a href="'. base_url() .'Profile/seller/?seller='. $feedbackObject->seller_id .'" >' . $feedbackObject->seller_username .'</td>
					<td>';

			$roundedRating = round($feedbackObject->seller_rating);
			for ($i=5; $i >= 1; $i--) { 
				$checkedIndicator = '';
				if ($roundedRating >= $i) {
					$checkedIndicator = 'checked';
				}
				echo '<input class="star star-'. $i .'" id="star-'. $i .'" type="radio" name="star" disabled ' . $checkedIndicator . ' />
					    <label class="star star'. $checkedIndicator .' small_rating" for="star-'. $i .'"></label>
					';
			}

			echo ' <br>'. $roundedRating .'/5 Rating</td>
					<td>'. $feedbackObject->seller_comment .'</td>
					<td class="item_name_column"><a href="'. base_url() . 'item/item/?item='. $feedbackObject->item_id .'">'. $feedbackObject->title .'</a>
						<br>
						<span class="sold_price" >Rs.'. $feedbackObject->sold_price .'</span>
					</td>

					</tr>';
		}

		echo '</table>';
	}

	

?>