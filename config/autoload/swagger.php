<?php

return [
    // enable false 将不会生成 swagger 文件
    'enable' => env('APP_ENV') !== 'prod',
    // swagger 配置的输出文件
    // 当你有多个 http server 时, 可以在输出文件的名称中增加 {server} 字面变量
    // 比如 /public/swagger/swagger_{server}.json
    'output_file' => BASE_PATH . '/runtime/swagger.json',
    // 忽略的hook, 非必须 用于忽略符合条件的接口, 将不会输出到上定义的文件中
    'ignore' => function ($controller, $action) {
        return false;
    },
    // 自定义验证器错误码、错误描述字段
    'error_code' => 400,
    'http_status_code' => 400,
    'field_error_code' => 'code',
    'field_error_message' => 'message',
    // swagger 的基础配置
    'swagger' => [
        'swagger' => '2.0',
        'info' => [
            'description' => 'hyperf swagger api desc',
            'version' => '1.0.0',
            'title' => 'HYPERF API DOC',
        ],
        'host' => '', //默认空为当前目录
        'schemes' => ['http'],
        "securityDefinitions" => [
            "token" => [
                "type" => "apiKey",
                "name" => "token",
                "in" => "header"
            ]
        ],
    ],
];
