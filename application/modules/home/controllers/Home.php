<?php  

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Common_Front_Controller {
     
    public $data = "";
    function __construct() {
      parent::__construct();  
      
    }
      


    //INDEX FUNCTION TO LOAD LOGIN VIEW
    public function index(){
     $this->load->view('home');
           
    }
    //END OF FUNCTION



    
}//END OF CLASS
