<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/search_box_styles.css">
<form method="get" action="<?php echo base_url(); ?>search/query/" id="searchbox">
	<input type="text"    maxlength="300" placeholder="Search..." id="search_input_box" name="keywords" autocapitalize="off" autocorrect="off" spellcheck="false" autocomplete="off" value="<?php echo $this->input->get('keywords'); ?>">
	<input type="submit" id="search_submit" value="Search"/>
</form>
