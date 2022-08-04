<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
  border: 1px solid white;
  border-collapse: collapse;
}
th, td {
  background-color: #96D4D4;
}
</style>
</head>
<body>

<h2>Product Listing</h2>


<div id="printMe">
<table style="width:100%" border="1px">


 <tr id="dis_div">
  <td colspan ="6"></td>
 
  <td>discount in <select id="discount_type"><option value="%">%</option>
  <option value="amount">amount</option></select> &nbsp&nbsp <input type="number" name="discount" id="discount" class="form-control"> &nbsp&nbsp<!--<button type="button" id="submit_discount">Apply--></td>
  
  <td></td>
  
  </tr>
  <tr>
  <th>#</th>
    <th>Product</th>
    <th>Quantity</th> 
    <th>Price</th>
	<th>Tax</th>
	<th>Total</th>
	<th>Final Amount(Including Tax)</th>
	<th>#</th>
  </tr>
 
  <?php 
  $total = 0;
  if($pdt_view)
  {
	  $i=0;$sum=0;$final=0;$grand_total =0;$grand_total_tax =0;
	  foreach($pdt_view as $row)
	  {
		  $i++;
		  $price=$row->price;
		  $quantity = $row->quantity;
		  $sum=$price*$quantity;
		  $tax = $row->tax;
		  $amount_tax = ($tax/100)*$price;
		  $final_tax = ($amount_tax+$price)* $quantity;
		  
		  $total=$total+$sum;
		  $final = $final+$final_tax;
		 
		  ?>
  <tr>
    <td><?php echo $i;?></td>
    <td><?php echo $row->name;?></td>
    <td><?php echo $row->quantity;?></td>
	<td><?php echo $row->price;?></td>
	<td><?php echo $row->tax;?></td>
	<td><?php echo $total;?></td>
	<td><?php echo $final;?></td>
	<td><input type ="checkbox" name="sel_pdt" id="sel_pdt" value="<?php echo $row->id;?>"></td>
  </tr>
  
  <?php
  $grand_total = $grand_total+$total;
    $grand_total_tax =  $grand_total_tax+ $final;
  }
  
  

  

  }
  
  else
	  
	  {
		?>  
		
		<h2>No Products Found</h2>
		<?php  
		}  
  ?>
   <tr>
  <td colspan = "5">Grand Total</td>
  <td><?php echo $grand_total;?></td>
  <td id ="grand_value"><?php echo $grand_total_tax;?></td>
  <input type ="hidden" id="grand_value_id" value="<?php echo $grand_total_tax;?>">
  
  <td></td>
  </tr>
 
</table>
</div>
<div style="right">
<button class="btn btn-primary" onclick="printDiv('printMe')">Generate Invoice</button>

<button type="button" class="btn btn-danger" onclick="click_purchase()">Click here to purchase</button>
</div>

</body>
</html>




  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
     <div id="results"></div>
      
    </div>
  </div>














<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js"></script>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<script src="<?php echo site_url();?>assets/js/printarea.js"></script>
<script>
$('#discount').change(function(){
	var discount_type = $('#discount_type').val();
	var discount_amount = parseFloat($('#discount').val());
	var grand_value =parseFloat($('#grand_value_id').val());
	
	if(discount_type=='%')
	{
		var discount_per = (discount_amount/100)*grand_value;
		
		 var total_discount = grand_value-discount_per;
	}
	else
	{
	 var total_discount = grand_value-discount_amount;	
	}
	
	$('#grand_value').text(total_discount);
	});
	
	function printDiv(divName){
			/*var printContents = document.getElementById(divName).innerHTML;
			var originalContents = document.body.innerHTML;

			document.body.innerHTML = printContents;
			document.getElementById('dis_div').style.display = "none";
			

			window.print();

			document.body.innerHTML = originalContents;*/
			
			document.getElementById('dis_div').style.display = "none";
			
			 $("#printMe").printArea({ mode: 'popup', popClose: true });

		}
		
		function click_purchase()
		{
			var numberOfChecked = $('input:checkbox:checked').length;
			
			if(numberOfChecked==0)
			{
				
				swal('Please select atleast one product');
				
			}
			
			else
			{
				var selected_value = [];
				
				$("input:checkbox[name=sel_pdt]:checked").each(function(){
             selected_value.push(this.value);
			 
						});
						
					$.ajax({
						
						type:"POST",
						url:"<?php echo site_url();?>Welcome/add_customer_details",
						data:{selected_value:selected_value},
						success:function(msd)
						{
							$('#myModal').modal('show');
							$('#results').html(msd);
						}

						
				       });
			}	
		}	
			
</script>