<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	
		function __construct()
		{

			parent::__construct();
			$this->load->library('session');	
			$this->load->model('login_db','',TRUE);
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');			
			$this->load->helper('string');
			$this->load->helper('security');
			

					
		}
		public function index()
		{
			$this->load->view('add_items');
		}	

        public function insert_items()
		{
        $name=$this->security->xss_clean($this->input->post('name')); 
		 
		 $quantity=$this->security->xss_clean($this->input->post('quantity'));

         $price=$this->security->xss_clean($this->input->post('price'));

        $tax=$this->security->xss_clean($this->input->post('tax'));	


       $data=array('name'=>$name,
                   'quantity'=>$quantity,
                  'price'=> $price,
                  'tax'=>$tax);
$this->db->insert('products',$data);
	

redirect(base_url());			  
        		  
	     }
		 
		 public function view_items()
		 {
			 
			 $data['pdt_view']=$this->login_db->get_products();
			$this->load->view('view_items',$data); 
			 
		}

	public function add_customer_details()
	{
		
		$data['checked_pdt']=$this->input->post('selected_value');
		$this->load->view('add_customer_details',$data);
		
	}
	
	public function insert_customer()
	{
		$customer_name=$this->security->xss_clean($this->input->post('customer_name')); 
		 
		 $customer_mobile=$this->security->xss_clean($this->input->post('customer_mobile'));

         $customer_address=$this->security->xss_clean($this->input->post('customer_address'));
		 
		 $pdt_data=$this->input->post('pdt_data');
		 
		 $pdt_array=explode(',',$pdt_data);
		 for($i=0;$i<count($pdt_array);$i++)
		 {
			$data_to_insert=array('customer_name' => $customer_name,
			                      'customer_mobile'=> $customer_mobile,
								  'customer_address'=>$customer_address,
								  'pdtid'=>$pdt_array[$i]);
								  
								 if( $this->db->insert('customer_details',$data_to_insert))
								 {
									 
									 $sql="update products set quantity = quantity-1 where id ='$pdt_array[$i]'";
									 $this->db->query($sql);
									 
								 
								  
								  
			                     }
								 
								  echo "success";
			 
		}
	
		
	}	
	
	public function purchased_pdts()
	{
		$data['purchase_view']=$this->login_db->get_purchase_details();
		$this->load->view('purchased_pdts',$data);
		
		
		
	}
 
	 
		
		
}
