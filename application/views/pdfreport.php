<?php
tcpdf();
$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$title = "Report";
$obj_pdf->SetTitle($title);
$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, PDF_HEADER_STRING);
$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$obj_pdf->SetDefaultMonospacedFont('helvetica');
$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$obj_pdf->SetFont('helvetica', '', 9);
$obj_pdf->setFontSubsetting(false);
$obj_pdf->AddPage();
ob_start();
?>
   <!--REPORT VIEW--------------------------------------------------------------------------->
   
   <html>
    <head><link href="<?php echo asset_url(); ?>css/bootstrap.min.css" rel="stylesheet"></head>
    <body>
    <?php if(isset($sales_data)){ ?>
     	 <h1>Sales Report</h1>
     <?php } elseif(isset($purchase_data)){?>
     	    <h1>Purchases Report</h1>
     <?php } else{
		 		echo 'No transactions have been made.';
		   }?>
     
     <div>
      <div>
      <table cellpadding="2" cellspacing="2" class="table">
          <?php if(isset($sales_data)){ ?>
			     <tr>
                  <th>Date</th>
                  <th>Item</th>
                  <th>Quantity</th>
                  <th>Sold Price</th>
                 </tr>
				
				<?php foreach($sales_data as $sale){ ?>
                 <tr>
                   <td><?php echo $sale->ordered_date ?></td>
                   <td><?php echo $sale->title ?></td>
                   <td><?php echo $sale->ordered_quantity ?></td>
                   <td><?php echo $sale->sold_price.'.00' ?></td>
                 </tr>
       	<?php 	}?>
				<tr>
                <td></td>
                </tr>
                <tr> 
                  <td><b>TOTAL INCOME:</b></td>
                  <td><b><?php echo $sum.'.00' ?></b></td>
                </tr>
			<?php	}
        
          else if(isset($purchase_data)){ ?>
			     <tr>
                  <th>Date</th>
                  <th>Item</th>
                  <th>Quantity</th>
                  <th>Sold Price</th>
                 </tr>
				
				<?php foreach($purchase_data as $sale){ ?>
                 <tr>
                   <td><?php echo $sale->ordered_date ?></td>
                   <td><?php echo $sale->title ?></td>
                   <td><?php echo $sale->ordered_quantity ?></td>
                   <td><?php echo $sale->sold_price.'.00' ?></td>
                 </tr>
       	<?php } ?>
		
				<tr>
                <td></td>
                </tr>
                
                <tr> 
                  <td><b>TOTAL EXPENCE:</b></td>
                  <td><b><?php echo $sum.'.00' ?></b></td>
                </tr>
		
		<?php }
        
         else { } ?>
       
       
       </table>
	  
	  </div>
     </div>
    
    
    
    
    
    
    </body>
   
   </html>
   
   
   
   
   
<?php 
$content = ob_get_contents();
ob_end_clean();
$obj_pdf->writeHTML($content, true, false, true, false, '');
$obj_pdf->Output('output.pdf', 'I');
?>