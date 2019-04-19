<?php
/**
 * Created by PhpStorm.
 * User: awake
 * Date: 2019/3/25
 * Time: 17:00
 */

namespace App\Http\Controllers;


use App\Models\Custom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use EasyWeChat\Factory;

class ShareController extends Controller
{
    /**
     *获取用户二维码
     */
    public function qrcode()
    {

        $uid = Auth::id();
        $file_name = '/storage/app/public/user_qrcode/user_'.$uid.'.png';
        $file_names = '/storage/user_qrcode/user_'.$uid.'.png';
        $code = QrCode::format('png')->size(436)->margin(1)
            ->generate(route('user.register', ['id'=>$uid]), base_path($file_name));
        $qrcode = asset($file_names);
		
        $bg = Custom::where('type', 1)->value('imgurl');
        $path_1= 'http://wby.houlahoula.com//uploads/images/5d98a322c4a0f96ad16e457c40221304.png';
        $path_2= '/var/www/basis/public/storage/user_qrcode/user_'.$uid.'.png';		
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
        $url = '/user/register/'.$uid;
        $app = Factory::officialAccount($config);
	
        return view('Qrcode.qrcode', ['code'=>$file_names, 'app'=>$app,'res'=>$res,'url'=>$url]);
    }
    

}
