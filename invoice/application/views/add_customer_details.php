 <!-- Modal content-->
 
 <?php
$pdt=$checked_pdt;

$data_pass=implode(',',$pdt);
 ?>
 <form id="newform">
      <div class="modal-content">
	  <div id ="submit_msg" style="color:red"></div>
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Customer Details</h4>
        </div>
        <div class="modal-body">
          <p><input type="text" name="customer_name" id="customer_name" class="form-control" placeholder="Customer Name"></p>
		  
		   <p><input type="text" name="customer_mobile" id="customer_mobile" class="form-control" placeholder="Customer Mobile"></p>
		   
		    <p><textarea name="customer_address" id="customer_address" class="form-control" placeholder="Customer Address"></textarea></p>
        </div>
		<input type="hidden" name="pdt_data" id="pdt_data" value="<?php echo $data_pass;?>">
        <div class="modal-footer">
		<button type="submit" class="btn btn-primary"  id="submit_cus_details">Submit</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
	  <style>
	  .error{
		  color:red;
		  }
		  
	  
	  </style>
	  
	  
	  
	  <script>
	  
	  
	  $(document).ready (function () {  
  
  
  $('#newform').validate({  
    rules: {  
      customer_name: 'required',  
       
      customer_mobile: {  
        required: true,  
        number: true,  
      },  
      customer_address: {  
        required: true,  
         
      }, 

	  
    },  
    messages: {  
      customer_name: 'Please enter  Name',  
      
      
      customer_mobile: {  
        required: 'Please enter Mobile',
        number:'quantity should be in number',		
      },
     customer_address: {  
        required: 'Please enter Address',
       		
      },
      tax: {  
        required: 'Please enter tax',
        number:'Tax should be in number',		
      }	

  	  
    },  
	
	
	submitHandler: function ()
        {
             if($("#newform").valid()){
                $('#submit_cus_details').attr('Disabled',true);
         
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>Welcome/insert_customer",
        data:  $("#newform").serialize(),       
               
             
                        success: function (msd)
                        {

                            if (msd == "success") {
								
								$('#newform')[0].reset();
								
								 $('#submit_cus_details').attr('Disabled',false);
                             $('#submit_msg').html('Purchase Completed successfully!');
              }

              else {
                 $('#submit_msg').html('Somer error occured!');
                            }
                        }
            
            })

        }
        }
    
  }); 

  });
  
  </script>