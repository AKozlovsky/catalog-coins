<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Detail extends Controller
{
    public function edit($id)
    {
        return view("pages.detail.edit", ["item" => $id]);
    }
}
