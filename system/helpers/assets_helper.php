<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

     if ( ! function_exists('asset_url()'))
     {
       function asset_url()
       {
          return base_url().'assets/';
       }
     }


     if ( ! function_exists('asset_file_url()'))
     {
        function asset_file_url($file)
       	{
       		echo asset_url() . $file . '?tms=' . FILE_TIMESTAMP;
       	}
     }