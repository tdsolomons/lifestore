<table>
<tr><th>From</th><th>Item</th><th>Received date</th></tr>
<?php
	foreach ($messages as $object){
		echo '<tr class="message Item" >
				<td>'. $object->sender_username . '</td>
				<td>'. $object->title .'</td>
				</tr>';
	}

?>

</table>