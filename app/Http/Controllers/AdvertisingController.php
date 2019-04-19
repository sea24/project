<?php
/**
 * Created by PhpStorm.
 * User: awake
 * Date: 2019/3/25
 * Time: 9:59
 */

namespace App\Http\Controllers;

use phpDocumentor\Reflection\Location;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Advertising;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Custom;

class AdvertisingController extends Controller
{
    public function adv(){
        $res = Advertising::first();

        return view('Advertising.advertising',['adv'=>$res]);

    }
    /**
     *自定义分享信息
     */
    public function wxshare($id){

        $uid = $id;
        $file_name = '/storage/app/public/user_qrcode/user_'.$uid.'.png';
        $file_names = '/storage/user_qrcode/user_'.$uid.'.png';
        $code = QrCode::format('png')->size(436)->margin(1)
            ->generate(route('user.register', ['id'=>$uid]), base_path($file_name));
        $qrcode = asset($file_names);

        $bg = Custom::where('type', 1)->value('imgurl');

        $path_1= env('APP_URL').'/uploads/'.$bg;
        $path_2= $qrcode;

        $image_1 = imagecreatefrompng($path_1);
        $image_2 = imagecreatefrompng($path_2);
        imagecopymerge($image_1, $image_2, 320, 1000, 0, 0, 436, 436, 100);
        $qrcodes =imagepng($image_1, base_path($file_name));

        $config = [
            'app_id' => 'wx2618381ecf647c68',
            'secret' => 'f15da704079f2c9c2c5e60bfe7ce23fc',

            // 指定 API 调用返回结果的类型：array(default)/collection/object/raw/自定义类名
            'response_type' => 'array',

            //...
        ];
        $res = DB::table('wxshare')->first();
        $url = '/user/register/'.$id;

        $app = Factory::officialAccount($config);
        return view('Qrcode.qrcode', ['code'=>$file_names, 'app'=>$app,'res'=>$res]);
    }

}