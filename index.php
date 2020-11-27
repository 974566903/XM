<?php
error_reporting(0);
!empty($_GET['phone']) && !empty($_GET['password']) && !empty($_GET['step']) ? true : exit(json_encode([
    "code"=>-1,
    "msg"=>"请输入数据信息",
    "说明"=>"关注微信公众号：宅哥技术 发送：步数 获取最新修改步数程序"
],JSON_UNESCAPED_UNICODE));
$phone=$_GET['phone'];
$password = $_GET['password'];
$step = $_GET['step'];
intval($step) ? true : exit(json_encode([
    "code"=>-2,
    "msg"=>"步数必须为整数！"
],JSON_UNESCAPED_UNICODE));

$logo_url = 'https://api-user.huami.com/registrations/+86'.$phone.'/tokens';
$logo_data=[
    'client_id'=>'HuaMi',
    'password'=>$password,
    'redirect_uri'=>'https://s3-us-west-2.amazonaws.com/hm-registration/successsignin.html',
    'token'=>'access'
];
$logo_header = [
    'Content-Type:application/x-www-form-urlencoded;charset=UTF-8',
    'User-Agent:MiFit/4.6.0 (iPhone; iOS 14.0.1; Scale/2.00)'
];
$access_data=Curl_Post($logo_url,$logo_data,$logo_header,true);
preg_match('/access=(.*?)&country_code/', $access_data, $access, PREG_OFFSET_CAPTURE);
if ($access == null){
    exit(json_encode([
        "code"=>-3,
        "msg"=>"登录失败，账户或密码错误"
    ],JSON_UNESCAPED_UNICODE));
}else{
    $logo_url2='https://account.huami.com/v2/client/login';
    $logo_data2=[
        'app_name'=>'com.xiaomi.hm.health',
        'app_version'=>'4.6.0',
        'code'=>$access[1][0],
        'country_code'=>'CN',
        'device_id'=>'2C8B4939-0CCD-4E94-8CBA-CB8EA6E613A1',
        'device_model'=>'phone',
        'grant_type'=>'access_token',
        'third_name'=>'huami_phone'
    ];
    $logo_datas = json_decode(Curl_Post($logo_url2,$logo_data2,$logo_header,false));
    $app_token = $logo_datas->token_info->app_token;
    $userid = $logo_datas->token_info->user_id;
    $data_jsons = str_replace('2020-09-23',date("Y-m-d"),'[{"summary":"{\"sn\":\"\",\"slp\":{\"ss\":0,\"lt\":0,\"dt\":0,\"st\":1600876800,\"lb\":0,\"dp\":0,\"is\":0,\"rhr\":0,\"stage\":[],\"ed\":1600876800,\"wk\":0,\"wc\":0},\"stp\":{\"runCal\":0,\"cal\":83,\"conAct\":0,\"stage\":[{\"stop\":688,\"mode\":1,\"dis\":542,\"step\":490,\"cal\":27,\"start\":675},{\"stop\":631,\"mode\":1,\"dis\":295,\"step\":326,\"cal\":14,\"start\":627},{\"stop\":516,\"mode\":1,\"dis\":165,\"step\":258,\"cal\":4,\"start\":508}],\"ttl\":12345,\"dis\":1820,\"rn\":0,\"wk\":19,\"runDist\":0,\"ncal\":0},\"tz\":\"28800\",\"v\":6,\"goal\":8000}","data":[{"stop":1439,"value":"fv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Yfv8lfv8Mfv8Rfv9Efv8Afv8yfv8dfv8Vfv8Afv8Afv8Afv8xfv8Afv8Ufv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv81fv8Afv8Lfv8Ffv8jfv8dfv8Hfv8Ofv\/Vfv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Mfv8tfv8Afv8Afv94fv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Nfv8Afv+afv8Afv8Afv8Afv8Afv9efv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Ifv8Bfv8Afv8Afv8Jfv8Pfv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv9jfv8Vfv8Afv8Tfv+7fv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Afv8Jfv8Afv8xfv8Afv8Afv8Afv8Afv8Afv8yfv8Afv8ifv8Cfv8Bfv8Tfv8Afv8Afv8Afv\/+fv8Afv8Afv8Nfv91fgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfv8Afv8Afv8Afv8NfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAAfgAA","did":"-1","tz":0,"src":7,"start":0}],"data_hr":"","summary_hr":"","date":"2020-09-23"}]');
    $data_jsons = str_replace('12345',$step,$data_jsons);
    $step_header=[
        'User-Agent:MiFit/4.6.0 (iPhone; iOS 14.0.1; Scale/2.00)',
        'Content-Type:application/x-www-form-urlencoded;charset=UTF-8',
        'app_token:'.$app_token
    ];
    $url_step='https://api-mifit-cn.huami.com/v1/data/band_data.json?&t='.get_time();
    $url_date=[
        'data_json'=>$data_jsons,
        'userid'=>$userid,
        'device_type'=>0,
        'last_sync_data_time'=>'1589917081',
        'last_deviceid'=>'DA932FFFFE8816E7'
    ];
    $data_step = json_decode(Curl_Post($url_step,$url_date,$step_header,false));
    if($data_step->code == 1){
        exit(json_encode([
            "code"=>1,
            "msg"=>"步数修改成功".$step
        ],JSON_UNESCAPED_UNICODE));
    }else{
        exit(json_encode([
            "code"=>-4,
            "msg"=>"修改失败"
        ],JSON_UNESCAPED_UNICODE));
    }
}

function Curl_Post($url,$data,$header,$localhost){
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,FALSE);
    curl_setopt($curl, CURLOPT_POST, 1);
    //判断是否需要返回头信息
    if ($localhost==true){
        curl_setopt($curl, CURLOPT_HEADER,1);
    }elseif($localhost==false){
        curl_setopt($curl, CURLOPT_HEADER,0);
    }
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($curl,CURLOPT_HTTPHEADER,$header);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($curl);
    curl_close($curl);
    return $output;
}

function get_time(){
    $date = json_decode(file_get_contents('http://api.m.taobao.com/rest/api3.do?api=mtop.common.getTimestamp'));
    return $date->data->t;
}