<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/profile_styles.css">
<?php
	if (isset($seller_feedback)){
		$ratingObject;
		 
		foreach ($seller_feedback as $object) {
			 $ratingObject = $object;
		}
		echo '<h1>Seller ' . $ratingObject->username . '</h1>';
		echo '<a href="' . base_url() .'/search/query?seller='. $sellerId .'" >Items for sale</a>';

		if (isset($_SESSION['user_id']) && strcmp($sellerId, $_SESSION['user_id']) != 0) {
			//Show folow box if seller is not the logged in user
			echo '<div id="follow_box">';
			echo '<strong>'. $followersCount[0]->followers_count .' followers</strong><br>';
			if ($isFollowing) {
				echo '<a href="' . base_url() .'Profile/UnfollowSeller/?seller='. $sellerId .'" class="colored_button" >Unfollow</a>
						</br>
						<span class="follow_box_description" >You are following this seller. You will receive notification 
						when seller add new items.</span>';
			}else{
				echo '<a href="' . base_url() .'Profile/FollowSeller/?seller='. $sellerId .'" class="colored_button" >Follow</a>
						</br><span class="follow_box_description">Follow seller to receive notification 
						when seller add new items.</span>';
			}
			echo '</div>';
		}
		
		
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
			<tr><th>Buyer</th><th>Rating</th><th>Feedback</th><th>Sold item</th></tr>	';
		
		foreach ($list_of_feedbacks as $feedbackObject) {
			echo '<tr class="feedback_item" >
					<td><a href="'. base_url() .'Profile/buyer/?buyer='. $feedbackObject->buyer_id .'" >'
						. $feedbackObject->buyer_username .'</a></td><td>';

			$roundedRating = round($feedbackObject->buyer_rating);
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
					<td>'. $feedbackObject->buyer_comment .'</td>
					<td class="item_name_column"><a href="'. base_url() . 'item/item/?item='. $feedbackObject->item_id .'">'. $feedbackObject->title .'</a>
						<br>
						<span class="sold_price" >Rs.'. $feedbackObject->sold_price .'</span>
					</td>

					</tr>';
		}

		echo '</table>';
	}

	

?>