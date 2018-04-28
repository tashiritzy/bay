<?php
namespace App\Http\Controllers;

class NavController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function getView1()
    {
        return view('tutorial.view1');
    }

    public function getView2()
    {
        return view('tutorial.view2');
    }

    public function getView3()
    {
        return view('tutorial.view3');
    }
}