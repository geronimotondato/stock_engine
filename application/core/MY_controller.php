<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {


    function __construct()
    {

        parent::__construct();
        //Initialization code that affects all controllers
    }

}


class Admin_Controller extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        //Initialization code that affects Admin controllers I.E. redirect and die if not logged in or not an admin
        if(!(isset($this->session->logged_in))){
            echo $this->load->view('login.php', '', TRUE);
            exit();
        }

}
}

class Member_Controller extends MY_Controller {

    function __construct()
    {
        parent::__construct();

        //Initialization code that affects Member controllers. I.E. redirect and die if not logged in

        if(!(isset($this->session->logged_in))){
            echo $this->load->view('login.php', '', TRUE);
            exit();

    }

}
}