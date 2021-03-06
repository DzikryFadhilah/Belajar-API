<<<<<<< HEAD
<?php namespace App\Http\Controllers;


namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\TiketAPI\APIController as API;
class Reservasi extends Controller
{
    public function flight()
    {
    	$s['airport'] = \App\Airport::all();
    	return view('reservasi.flight')->with($s);
    }
    public function serchflight()
    {
    	$data = [];
    	$data['d'] = Input::get('from');
    	$data['a'] = Input::get('to');
    	$data['date'] = date_format(date_create(Input::get('depart_date')),"Y-m-d");
    	if (Input::get('type')=="RT") {
    		$data['ret_date'] = Input::get('return_date');
    	}
    	$data['adult'] = Input::get('adult');
    	$data['child'] = Input::get('child');
    	$data['infant'] = Input::get('infant');
    	$data['v'] = 1;
    	
    	//kosongkan session token untuk transaksi
    	\Session::put('token','');
    	//panggil class API
    	$newapi = new API;
    	//panggil curl ke search flight dengan parameter $data
    	$log = new \App\Logtrx;
    	$log->request = json_encode($data);
    	$log->token = session('token');
    	$log->save();

    	$sd = new \App\SearchData;
    	$sd->depart_city = Input::get('from');
    	$sd->arrive_city = Input::get('to');
    	$sd->depart_date = $data['date'];
    	if (Input::get('type')=="RT") {
    		$sd->return_date = $data['ret_date'];
    	}
    	$sd->adult = Input::get('adult');
    	$sd->child = Input::get('child');
    	$sd->infant = Input::get('infant');
    	$sd->ver = $data['v'];
    	$sd->token = session('token');
    	$sd->save();

    	$hasil = $newapi->getCurl('search/flight',$data);
    	echo "<pre>".print_r(($hasil),1)."</pre>";

    	//panggil curl ke search/flight dengan parameter $data

    	//tampilkan hasil curl diubah ke json
    	echo json_encode($hasil);

    	$sd->result = json_encode($hasil);
    	$sd->save();

    	$log->response = json_encode($hasil);
    	$log->status_code = $hasil->diagnostic->status;
    	$log->save();
    }
=======
<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controller\TiketAPI\APIController as API;

class Reservasi extends Controller
{
   
   public function flight()
   {
   	//add airport data
   	$s['airport'] = \App\Airport::all();
   	//view reservasi/flight.blade.php with data
   	return view('reservasi.flight')->with($s);
   }
>>>>>>> 1f99628cb77c6b681e14b284c4b1943c25502ce5
}
