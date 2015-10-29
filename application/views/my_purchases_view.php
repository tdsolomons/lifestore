<?php

	if (isset($orders)) {
		echo '<table>
			<tr>
			<th>Order Id</th>
			<th>Item</th>
			<th>Order Total</th>
			<th>Action</th>
			</tr>	';
		foreach ($orders as $orderObject) {
			$action = '';
			if ($orderObject->order_status >= 4 ) {
				 $action = '<a href="' . base_url() . 'Feedback/buyerForm/?order='. $orderObject->order_id .'&seller='. $orderObject->seller_username .'&item='. $orderObject->item_id .'">Leave feedback</a>';
			}

			echo '<tr>
				<td>Order: '. $orderObject->order_id .'</td>
				<td>'. $orderObject->title .'</td>
				<td>Rs. '. $orderObject->sold_price .'</td>
				<td>Status: '. $orderObject->status_title .'<br/>'. $action .'</td>
				</tr>';

		}

		echo "</table>";
	}

?>