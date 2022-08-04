<html>
<body>
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
         
        <!-- Link Bootstrap Js and Jquery -->
       
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
<h2>Add Product</h2>

<form id="newform" action="<?php echo site_url('insert_items');?>" method="POST">
<div class="well_rr">
<div class="col-md-4">
<div class="form-group">
  <label for="name">Name:</label><br>
  <input type="text" id="name" name="name" class="form-control">
  </div>
  <div class="form-group">
  <label for="quantity">Quantity:</label>
  <input type="text" id="quantity" name="quantity" class="form-control">
  </div>
  <div class="form-group">
 <label for="price">Unit Price($):</label>
  <input type="text" id="price" name="price" class="form-control" >
  </div>
  <div class="form-group">
   <label for="tax">Tax(%):</label>
  <select id="tax" name="tax" class="form-control">
  <option value="">Select</option>
  <option value="0">0 %</option>
  <option value="1">1 %</option>
  <option value="5">5 %</option>
  <option value="10">10 %</option>
  </select><br><br>
  </div>
  <button type="submit" value="Submit" class="btn btn-primary">Submit</button>
  <a href="<?php echo site_url();?>view_items">View Link</a>
  </div>
  </div>
</form> 



</body>
</html>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script>  
$(document).ready (function () {  
  
  
  $('#newform').validate({  
    rules: {  
      name: 'required',  
       
      quantity: {  
        required: true,  
        number: true,  
      },  
      price: {  
        required: true,  
        number: true,  
      }, 

 tax: {  
        required: true,  
        number: true,  
      } 	  
    },  
    messages: {  
      name: 'Please enter Item Name',  
      
      
      quantity: {  
        required: 'Please enter quantity',
        number:'quantity should be in number',		
      },
     price: {  
        required: 'Please enter Price',
        number:'Price should be in number',		
      },
      tax: {  
        required: 'Please enter tax',
        number:'Tax should be in number',		
      }	

  	  
    },  
    
  }); 

  });

</script> 

<style>
.error{
	color:red;
	
}	

.well_rr
{
	
	padding-left: 50px;
	}
</style>



