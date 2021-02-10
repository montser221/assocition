<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewFileController extends Controller
{
   public function viewFile( )
   {
      
       return view('pages.viewFiles' );
   }
}
