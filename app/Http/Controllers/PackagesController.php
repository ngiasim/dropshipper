<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Packages;
use Illuminate\Support\Facades\Redirect;
use App;

class PackagesController extends Controller
{
    public function index()
    {
        $packages  =  Packages::all();
        return view('packages.packages',compact('packages'));
    }

    public function show(Article $article)
    {
        //return $article;
    }

    public function create()
    {
        return view('packages.create');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $package = Packages::create($input);
        return Redirect::to('packages')->with('success','Package created successfully.');
    }

    public function edit($id) {
        $edit_section  =  Packages::where('id',$id)->first();
        return view('packages.create',compact('edit_section'));
    }   

    public function update(Request $request)
    {
        $input = $request->all();
        $package = Packages::where('id',$id)->first();
        $package->update($input);
        return Redirect::to('packages')->with('success','Package updated successfully.');
    }

    public function destroy($id)
    {
     //   $input = $request->all();
        $package = Packages::where('id',$id)->first();
        $package->delete();
        return Redirect::to('packages')->with('success','Package deleted successfully.');
    }
}
