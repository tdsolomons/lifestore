<?php
	if (isset($seller_feedback)){
		$ratingObject;
		 
		foreach ($seller_feedback as $object) {
			 $ratingObject = $object;
		}
		echo '<h1>Seller ' . $ratingObject->username . '</h1>';
		echo '<h3>Feedback rating</h3>';
		echo number_format($ratingObject->avarage_rating, 2). '/5 Avarage rating';
		echo '<br><strong>' . $ratingObject->total_ratings . ' Ratings</strong>';


	}
	
	if (isset($list_of_feedbacks)) {

		echo '<br><table>
			<tr><th>Buyer</th><th>Rating</th><th>Feedback</th></tr>	';
		
		foreach ($list_of_feedbacks as $feedbackObject) {
			echo '<tr><td>'. $feedbackObject->buyer_username .'</td>
					<td>'. $feedbackObject->buyer_rating .'/5</td>
					<td>'. $feedbackObject->buyer_comment .'</td></tr>';
		}

		echo '</table>';
	}

	

?>