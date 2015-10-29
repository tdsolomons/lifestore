<?php
echo '<table>
		<tr>
		<td>
			<img width="200" height="200" src="' . asset_url() . 'img/item_images/' . $image_file_name . '"/>
		<td>
			<a href="'. $item_link .'"><h4>'. $item_title . '</h4></a>
			<br>
			'. $item_price .'
			<br>
			<span>'. getShippingTitle($shipping_cost) . '</span>

			</span>
		</td>
		</tr>
	</table>';
?>