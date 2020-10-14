<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComponentsController extends Controller
{
  public function parts($name){
    return view('flat_ui.'.$name);
  }
}
 
