<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Errors extends CI_Controller {

    function error_404()
    {
        $this->errorlib->show(404);
    }

    function error_403()
    {
        $this->errorlib->show(403);
    }
}
