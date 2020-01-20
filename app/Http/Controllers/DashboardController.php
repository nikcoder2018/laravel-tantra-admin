<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Players;
class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
      $serverStatus = null;
      $filename = env('SERVER_DIRECTORY_URL')."\\DBSRV\\current_user\\serv00.htm";
      $manager = fopen($filename, "r");
      $content = fread($manager, filesize($filename));
      fclose($manager);

      $onlineresult = explode("\n", $content);
      $total_online = 0;
      for ($i=0; $i<50; $i++) {
				if ($onlineresult[$i] >= 0) {
					$total_online = $total_online+intval($onlineresult[$i]);
				}
			}

      if(@fsockopen(env('SERVER_IP'), env('ZONE1_PORT'), $errno, $errstr, 3) and @fsockopen(env('SERVER_IP'), env('ZONE1_PORT'), $errno, $errstr, 3))
      {
        $serverStatus = 1;
      }else{
        $serverStatus = 0;
      }
      $data = array(
        'breadcrumb' => ['title' => 'Dashboard', 'subtitle' => 'all'],
        'totalAccounts' => Players::count(),
        'serverStatus' => $serverStatus,
        'serverPlayerOnline' => $total_online,
      );
      return view('dashboard.index')->with($data);
    }
}
