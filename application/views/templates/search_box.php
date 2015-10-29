<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/search_box_styles.css">

<script type="text/javascript">

function loadSuggessions(){

  var dataList = document.getElementById('json-datalist');
  var input = document.getElementById('search_input_box');

  // Create a new XMLHttpRequest.
  var request = new XMLHttpRequest();

  // Handle state changes for the request.
  request.onreadystatechange = function(response) {

    if (request.readyState === 4) {
      if (request.status === 200) {
        document.getElementById('json-datalist').innerHTML = '';
        // Parse the JSON
        var jsonOptions = JSON.parse(request.responseText);

        // Loop over the JSON array.
        jsonOptions.forEach(function(item) {
          // Create a new <option> element.
          var option = document.createElement('option');
          // Set the value using the item in the JSON array.
          option.value = item;
          // Add the <option> element to the <datalist>.
          dataList.appendChild(option);
        });

        // Update the placeholder text.
         input.placeholder = "Search...";
      } else {
        // An error occured :(
        input.placeholder = "Couldn't load suggessions";
      }
    }
  };

  // Update the placeholder text.
  input.placeholder = "Loading options...";

  // Set up and make the request.
  request.open('GET', '<?php echo base_url(); ?>search/getSuggessions/?keyword=' + input.value , true);
  request.send();  
}

</script>

<div class="container-fluid" style="border-top:1px solid #CCCCCC;border-bottom:1px solid #CCCCCC;margin-top:5px;margin-bottom:10px;padding-bottom:3px;padding-top:3px" >
   <div class="container"> 
     <div class="row">
      <div class="col-sm-12 col-md-12  " >
        <form method="get" action="<?php echo base_url(); ?>search/query/" id="searchbox">
            
            <input type="text" list="json-datalist"  onkeydown="loadSuggessions()" maxlength="300" placeholder="Search..." 
                  id="search_input_box" name="keywords" autocapitalize="off" autocorrect="off" spellcheck="false" 
                  autocomplete="off" value="<?php echo $this->input->get('keywords'); ?>" >
           <datalist id="json-datalist"></datalist>

            <input type="submit" id="search_submit" value="Search"/>
        </form>
      </div>
     </div>
   </div>  
</div> 



  <div id="site_wrap">

