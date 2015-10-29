<title><?php echo $title ?></title>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="<?php echo asset_url(); ?>js/w2ui-fields-1.0.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/search_styles.css">
<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/deal_styles.css">
<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/w2ui-fields-1.0.css">

<script type="text/javascript">
	
	$(function(){
		var tommorow = new Date();
		tommorow.setDate(tommorow.getDate() + 1);
		var month = tommorow.getMonth() + 1;
		var year  = tommorow.getFullYear();
		var day  = tommorow.getDate();

		$('input[type=us-dateA]').w2field('date', { format: 'yyyy-mm-dd', start: year  + '-'+ month +'-' + day, end: '' });
		
	});

	$(function(){
		$('input[type=us-timeA]').w2field('time', { format: 'h24'});
		$('#us-percent').w2field('percent', { precision: 1, min: 1, max: 99 });
	});


</script>

<h1>Create Deal</h1>

<?php
$item;
foreach ($items as $object) {
	$item = $object;
}
?>

<table>
	<tr>
		<td><img src="<?php echo asset_url() . 'img/item_images/' . $item->file_name . '.jpg'; ?>" height="100" width="100" >
		</td>
		<td>
			<table>
				<tr><td><?php echo '<a href="' . base_url(). 'item/item/?item=' . $item->item_id . '" >' . $item->title . '</a>'; ?></td></tr>
				<tr><td>Item Number: <?php echo $item->item_id; ?></td></tr>
				<tr><td> 
				<?php 
					if (isset($item->price)) {
						echo 'Price: ' . printCurrencyInRs($item->price); 
					}else{
						echo 'Auction Item';
					}
					
				?>
				</td></tr>
			</table>

		</td>
	</tr>
</table>

<form method="post" action="<?php echo base_url() . '/Deals/create_deal_submit/'; ?>">
	<div class="w2ui-label"> Ending Date: </div>
	<div class="w2ui-field"><input type="us-dateA" name="date"></div>

	<div class="w2ui-label"> Time: </div>
	<div class="w2ui-field"><input type="us-timeA" name="time"> </div>

	<div class="w2ui-label"> Off Percentage: </div>
	<div class="w2ui-field"><input id="us-percent" value="0" name="percentage" class="w2field"> </div>
	<input type="hidden" name="item" value="<?php echo $item->item_id; ?>">
	<input type="submit" value="Create" class="colored_button">
</form>