<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('/articles', ArticleController::class);
    Route::resource('/companys', CompanyController::class);
});

// Route::get('/emails', function () {
//     // JSONファイルを読み込む
//     $json = file_get_contents(storage_path('app/senders.json'));

//     // JSONデータをデコード
//     $data = json_decode($json, true);

//     // メールアドレスのみを抽出
//     $emails = array_map(function ($item) {
//         // 正規表現を使って<>の中身を抽出
//         if (preg_match('/<(.+?)>/', $item['from'], $matches)) {
//             return $matches[1];
//         }
//         return null;
//     }, $data);

//     // null値を除外
//     $emails = array_filter($emails);

//     // 結果を表示
//     return response()->json($emails);
// });



// Route::get('/emails', function () {
//     // JSONファイルを読み込む
//     $path = storage_path('app/senders.json');
    
//     // ファイルが存在するか確認
//     if (!file_exists($path)) {
//         return response()->json(['error' => 'File not found'], 404);
//     }

//     // ファイルを読み込む
//     $json = file_get_contents($path);

//     // JSONデータをデコード
//     $data = json_decode($json, true);

//     // メールアドレスのみを抽出
//     $emails = array_map(function ($item) {
//         // 正規表現を使って<>の中身を抽出
//         if (preg_match('/<(.+?)>/', $item['from'], $matches)) {
//             return $matches[1];
//         }
//         return null;
//     }, $data);

//     // null値を除外
//     $emails = array_filter($emails);

//     // 重複を除去
//     $uniqueEmails = array_unique($emails);

//     // 結果を表示
//     return response()->json(array_values($uniqueEmails));
// });




Route::get('/emails', function () {
    // JSONファイルを読み込む
    $path = storage_path('app/senders.json');
    
    // ファイルが存在するか確認
    if (!file_exists($path)) {
        return response()->json(['error' => 'File not found'], 404);
    }

    // ファイルを読み込む
    $json = file_get_contents($path);

    // JSONデータをデコード
    $data = json_decode($json, true);

    // メールアドレスのみを抽出
    $emails = array_map(function ($item) {
        // 正規表現を使って<>の中身を抽出
        if (preg_match('/<(.+?)>/', $item['from'], $matches)) {
            return $matches[1];
        }
        return null;
    }, $data);

    // null値を除外
    $emails = array_filter($emails);

    // 各メールアドレスの出現回数をカウント
    $emailCounts = array_count_values($emails);

    // 結果を表示
    return response()->json($emailCounts);
});
