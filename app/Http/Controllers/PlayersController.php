<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Players;
use App\Taney;
class PlayersController extends Controller
{
  public function index(){
    $data = array(
      'breadcrumb' => ['title' => 'Players', 'subtitle' => 'All'],
      'players' => Players::all()
    );
    return view('useraccounts.players')->with($data);
  }
  public function taneys(){
    $data = array(
      'breadcrumb' => ['title' => 'Taneys', 'subtitle' => 'All'],
      'players' => Taney::all(),
      'playersTaney' => Taney::all()->sortByDesc('totaltaneys'),
    );
    return view('useraccounts.taneys')->with($data);
  }
  public function addtaney(Request $request){
    $userInfo = Taney::where('userId', $request->userid)->first();

    if($userInfo){
      $cashBalance = $userInfo->cashBalance+$request->taney;
      $totaltaneys = $userInfo->totaltaneys+$request->taney;
      $updateTaney = Taney::where(['userId' => $request->userid])->update(['cashBalance' => $cashBalance, 'totaltaneys' => $totaltaneys]);

      if($updateTaney){
        return response()->json([
          'msg' => $request->taney.' Taneys has been added to '.$request->userid,
          'type'=> 'success'
        ]);
      }else{
        return response()->json([
          'msg' => 'Somethint went wrong...',
          'type'=> 'fail'
        ]);
      }
    }else{
      return response()->json([
        'msg' => 'This account is unable to receive a taney, this account might need first to login in the game before giving a taney.',
        'type'=> 'fail'
      ]);
    }

  }
  public function removetaney(Request $request){
    $userInfo = Taney::where('userId', $request->userid)->first();

    if($userInfo){
      if($userInfo->cashBalance < $request->taney){
        return response()->json([
          'msg' => "Taney is not enough to deduct.",
          'type'=> 'fail'
        ]);
      }

      $cashBalance = $userInfo->cashBalance-$request->taney;

      $updateTaney = Taney::where(['userId' => $request->userid])->update(['cashBalance' => $cashBalance]);

      if($updateTaney){
        return response()->json([
          'msg' => $request->taney.' Taneys has been deducted to '.$request->userid,
          'type'=> 'success'
        ]);
      }else{
        return response()->json([
          'msg' => 'Somethint went wrong...',
          'type'=> 'fail'
        ]);
      }
    }else{
      return response()->json([
        'msg' => 'This account is unable to receive a taney, this account might need first to login in the game before giving a taney.',
        'type'=> 'fail'
      ]);
    }

  }
}
