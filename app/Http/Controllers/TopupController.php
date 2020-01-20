<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topup;
use App\TopupPackage;
use App\TopupFreebies;
class TopupController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
      $data = array(
        'breadcrumb' => ['title' => 'Topup', 'subtitle' => 'All'],
        'topup' => Topup::all()
      );
      return view('topup.index')->with($data);
    }
    public function packages(){
      $data = array(
        'breadcrumb' => ['title' => 'Topup', 'subtitle' => 'Packages'],
        'packages' => TopupPackage::where('archive', false)->orderBy('created_at', 'DESC')->get()
      );
      return view('topup.packages')->with($data);
    }
    public function archived(){
      $data = array(
        'breadcrumb' => ['title' => 'Topup', 'subtitle' => 'Archived Packages'],
        'packages' => TopupPackage::where('archive', true)->orderBy('created_at', 'DESC')->get()
      );
      return view('topup.archive')->with($data);
    }

    public function packages_store(Request $request){
      $package = new TopupPackage;
      $package->name = $request->name;
      $package->description = $request->description;
      $package->price = $request->price;
      $package->taney = $request->taney;
      $saved = $package->save();

      if($request->freebies):
        foreach($request->freebies as $list):
          $freebie = new TopupFreebies;
          $freebie->ItemName = $list['itemname'];
          $freebie->ItemIndex = $list['itemindex'];
          $freebie->ItemCount = $list['itemcount'];
          $freebie->QtyPerBundle = $list['itemqty'];
          $freebie->isBundle = $list['isbundle'];
          $freebie->package_id = $package->id;
          $saved = $freebie->save();
        endforeach;
      endif;

      if($saved){
        return response()->json([
          'msg' => 'New Topup Package Successfully Saved',
          'type'=> 'success'
        ]);
      }else{
        return response()->json([
          'msg' => 'Somethint went wrong...',
          'type'=> 'fail'
        ]);
      }
    }
    public function package_archive($id){
        $package = TopupPackage::where('id', $id)->first();
        $package->archive = true;
        $package->save();

        if($package){
          return response()->json([
            'msg' => 'Package Successfully Archived!',
            'type' => 'success'
          ]);
        }else{
          return response()->json([
            'msg' => 'Something went wrong!',
            'type' => 'fail'
          ]);
        }
    }
    public function package_undo($id){
        $package = TopupPackage::where('id', $id)->first();
        $package->archive = false;
        $package->save();

        if($package){
          return response()->json([
            'msg' => 'Package Successfully Undo!',
            'type' => 'success'
          ]);
        }else{
          return response()->json([
            'msg' => 'Something went wrong!',
            'type' => 'fail'
          ]);
        }
    }
}
