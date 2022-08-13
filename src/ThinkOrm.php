<?php

namespace d2wd\ThinkOrm;

use Webman\Bootstrap;
use Workerman\Timer;
use think\Paginator;
use think\facade\Db;
use think\db\connector\Mysql;

class ThinkOrm implements Bootstrap
{
    // 进程启动时调用
    public static function start($worker)
    {
        // 配置
        Db::setConfig(config('thinkorm'));
        // 维持mysql心跳
        if ($worker) {
            Timer::add(55, function () {
                if (!class_exists(Mysql::class, false)) {
                    return;
                }
                $connections = config('think_db_config.connections', []);
                foreach ($connections as $key => $item) {
                    if ($item['type'] == 'mysql') {
                        try {
                            Db::connect($key)->query('select 1');
                        } catch (\Throwable $e) {
                        }
                    }
                }
                Db::getDbLog(true);
            });
        }
        if (!isset(Paginator::$currentPageResolver)) {
            Paginator::currentPageResolver(function ($pageName = 'page') {
                $page = request()->input($pageName, 1);
                if (filter_var($page, FILTER_VALIDATE_INT) !== false && (int)$page >= 1) {
                    return (int)$page;
                }
                return 1;
            });
        }
    }
}
