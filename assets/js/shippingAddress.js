$(function(){
		
		$('#new_add').hide();
		
 		$('#change_address').on('change',function(){
				
			if($(this).is((':checked'))){
			
				$('#new_add').show();
		
			}else{
				
				$('#new_add').hide();
		
			}
		});
	});
	
	function btn_change_add_click(){
		
		var isOk = true;
		
		if($('#name').val().length == 0){
			
			isOk = false;
			$('#name').next('span').html('Please insert name');
			
		}else{
			
			$('#name').next('span').html('');
		}
		
		if($('#aline1').val().length == 0){
			
			isOk = false;
			$('#aline1').next('span').html('Please insert address line 1');
			
		}else{
			
			$('#aline1').next('span').html('');
		}
		
		if($('#city').val().length == 0){
			
			isOk = false;
			$('#city').next('span').html('Please insert city');
			
		}else{
			
			$('#city').next('span').html('');
		}
		
		if(isOk){
			return true;
	
		}else{
			return false;
		}

	}