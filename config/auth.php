<?php

return [

    'defaults' => [
        'guard' => 'student',  // ✅ Giữ nguyên guard là 'student'
        'passwords' => 'students', // ✅ Đổi từ 'users' thành 'students' cho đồng bộ
    ],

    'guards' => [
        'student' => [
            'driver' => 'session',
            'provider' => 'students', // ✅ Đổi từ 'student' thành 'students'
        ],
    ],

    'providers' => [
        'students' => [ // ✅ Đổi từ 'student' thành 'students' để đồng bộ với guard
            'driver' => 'eloquent',
            'model' => App\Models\Student::class, // ✅ Đảm bảo Model Student đúng
        ],
    ],

    'passwords' => [
        'students' => [ // ✅ Đổi từ 'users' thành 'students'
            'provider' => 'students',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];
