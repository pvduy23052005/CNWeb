<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageControler extends Controller
{
  public function showHomepage()
  {
    // TODO 9: Thay vì echo, chúng ta 'return'
    return "Chào mừng bạn đến với PHT Chương 6 - Laravel!";
  }
}
