<?php
	if (isset($buyer_feedback)){
		$ratingObject;
		 
		foreach ($buyer_feedback as $object) {
			 $ratingObject = $object;
		}
		echo '<h1>Buyer ' . $ratingObject->username . '</h1>';
		echo '<h3>Feedback rating</h3>';
		echo number_format($ratingObject->avarage_rating, 2). '/5 Avarage rating';
		echo '<br><strong>' . $ratingObject->total_ratings . ' Ratings</strong>';


	}
	
	if (isset($list_of_feedbacks)) {

		echo '<br><table>
			<tr><th>Seller</th><th>Rating</th><th>Feedback</th></tr>	';
		
		foreach ($list_of_feedbacks as $feedbackObject) {
			echo '<tr><td>'. $feedbackObject->seller_username .'</td>
					<td>'. $feedbackObject->seller_rating .'/5</td>
					<td>'. $feedbackObject->seller_comment .'</td></tr>';
		}

		echo '</table>';
	}

	

?>