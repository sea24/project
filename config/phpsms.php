<?php

return [
    /*
     * The scheme information
     * -------------------------------------------------------------------
     *
     * The key-value paris: {name} => {value}
     *
     * Examples:
     * 'Log' => '10 backup'
     * 'SmsBao' => '100'
     * 'CustomAgent' => [
     *     '5 backup',
     *     'agentClass' => '/Namespace/ClassName'
     * ]
     *
     * Supported agents:
     * 'Log', 'YunPian', 'YunTongXun', 'SubMail', 'Luosimao',
     * 'Ucpaas', 'JuHe', 'Alidayu', 'SendCloud', 'SmsBao',
     * 'Qcloud', 'Aliyun'
     *
     */
    'scheme' => [
        'Log',
        'Aliyun'=>'100'
    ],

    /*
     * The configuration
     * -------------------------------------------------------------------
     *
     * Expected the name of agent to be a string.
     *
     */
    'agents' => [
        /*
         * -----------------------------------
         * YunPian
         * 云片代理器
         * -----------------------------------
         * website:http://www.yunpian.com
         * support content sms.
         */
        'YunPian' => [
            //用户唯一标识，必须
            'apikey' => 'your_api_key',
        ],

        /*
         * -----------------------------------
         * YunTongXun
         * 云通讯代理器
         * -----------------------------------
         * website：http://www.yuntongxun.com/
         * support template sms.
         */
        'YunTongXun' => [
            //主帐号
            'accountSid'    => 'your_account_sid',
            //主帐号令牌
            'accountToken'  => 'your_account_token',
            //应用Id
            'appId'         => 'your_app_id',
            //请求地址(不加协议前缀)
            'serverIP'      => 'app.cloopen.com',
            //请求端口
            'serverPort'    => '8883',
            //被叫号显
            'displayNum'    => null,
            //语音验证码播放次数
            'playTimes'     => 3,
        ],

        /*
         * -----------------------------------
         * SubMail
         * -----------------------------------
         * website:http://submail.cn/
         * support template sms.
         */
        'SubMail' => [
            'appid'     => 'your_app_id',
            'signature' => 'your app key',
        ],

        /*
         * -----------------------------------
         * luosimao
         * -----------------------------------
         * website:http://luosimao.com
         * support content sms.
         */
        'Luosimao' => [
            'apikey'        => 'your_api_key',
            'voiceApikey'   => 'your_voice_api_key',
        ],

        /*
         * -----------------------------------
         * ucpaas
         * -----------------------------------
         * website:http://ucpaas.com
    kl;'''''''''        /*
         * -----------------------------------
         * SmsBao
         * -----------------------------------
         * website: http://www.smsbao.com
         * support content sms.
         */
        'SmsBao' => [
            //注册账号
            'username'  => 'your_username',
            //账号密码（明文）
            'password'  => 'your_password',
        ],

        /*
         * -----------------------------------
         * Qcloud
         * 腾讯云
         * -----------------------------------
         * website:http://www.qcloud.com
         * support template sms.
         */
        'Qcloud' => [
            'appId'     => 'your_app_id',
            'appKey'    => 'your_app_key',
        ],

        /*
         * -----------------------------------
         * Aliyun
         * 阿里云
         * -----------------------------------
         * website:https://www.aliyun.com/product/sms
         * support template sms.
         */
        'Aliyun' => [
            'accessKeyId'       => 'LTAINtnl02HnqlQL',
            'accessKeySecret'   => 'HjZu3KkJqe9ql0T1AtD1DUQMuoM9Cu',
            'signName'          => '易达新零售',
            'regionId'          => 'cn-shenzhen',
        ],
    ],
];
