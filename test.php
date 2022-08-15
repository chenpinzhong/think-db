<?php
require_once __DIR__ . '/vendor/autoload.php';
use think\facade\Db;
Db::setConfig([
    // 默认数据连接标识
    'default'     => 'mysql',
    // 数据库连接信息
    'connections' => [
        'mysql' => [
            // 数据库类型
            'type'     => 'mysql',
            // 主机地址
            'hostname' => '127.0.0.1',
            // 用户名
            'username' => 'root',
            'password'    => '74ni9bukaiaa',
            // 数据库名
            'database' => 'd2wd',
            // 数据库编码默认采用utf8
            'charset'  => 'utf8',
            // 数据库表前缀
            'prefix'   => '',
            // 数据库调试模式
            'debug'    => true,
        ],
    ],
]);
$db=Db::table('admin_user')->where('id',2)->select();
var_dump($db);


