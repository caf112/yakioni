<?php

namespace App\Http\Controllers;

use Google\Client as GoogleClient;
use Google\Service\Gmail;
use Illuminate\Http\Request;

class GmailController extends Controller
{
    public function redirectToGoogle()
    {
        $client = $this->getClient();
        $authUrl = $client->createAuthUrl();
        return redirect()->away($authUrl);
    }

    public function handleGoogleCallback(Request $request)
    {
        $client = $this->getClient();

        //認証コードの取得
        $code = $request->input('code');

        //アクセストークンの取得
        $accessTokenResponse = $client->fetchAccessTokenWithAuthCode($request->input('code'));

        if(isset($accessTokenResponse['error'])){
            //エラーメッセージをログに記録する
            \Log::error('Google API error: ' . $accessTokenResponse['error']);
            return response()->json(['error' => 'Failed to obtain access token'], 400);
        }

            //$client->fetchAccessTokenWithAuthCode($request->input('code'));
            //$token = $client->getAccessToken();
        $token = $accessTokenResponse['access_token'];
        $client->setAccessToken($token);

        // Gmail APIインスタンスを作成
        $gmail = new Gmail($client);

            // メールリストを取得
            $messages = $gmail->users_messages->listUsersMessages('me', ['maxResults' => 10]);

            foreach ($messages->getMessages() as $message) {
                //メッセージの詳細を取得
                $messageDetails = $gmail->users_messages->get('me', $message->getId());

                //ヘッダーから送信者の情報を取得
                $headers = $massageDetails->getPayload()->getHeaders();
                $sender - null;
                foreach($headers as $header){
                    if($header->getName() == 'From'){
                        $sender = $header->getValue();
                        break;
                }
            }
                // 送信者情報を表示
                echo 'Sender: ' . htmlspecialchars($sender) . '<br>';
            }
    }

    private function getClient()
    {
        $client = new GoogleClient();
        $client->setClientId(config('services.google.client_id'));
        $client->setClientSecret(config('services.google.client_secret'));
        $client->setRedirectUri(config('services.google.redirect'));
        $client->addScope(Gmail::GMAIL_READONLY);
        $client->setAccessType('offline');
        return $client;
    }
}

