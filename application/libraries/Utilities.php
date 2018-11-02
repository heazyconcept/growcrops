<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class Utilities
{
    public function formatDate($date)
    {
       return date("F j, Y", strtotime($date));
    }
}