<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ResponseTrait;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use App\Http\Requests\Api\User\ChargeWalletRequest;
use App\Models\User;
use App\Http\Resources\Api\Payment\PaymentsResource;
use DB;
class PaymentsController extends Controller {
  use ResponseTrait;


  public function chargeWallet(ChargeWalletRequest $request){
    $user = auth()->user();
    $amount = convert2english($request->amount);

    $client = new \GuzzleHttp\Client();
    $url = config('services.upayments.live_url');
    if(config('services.upayments.test_mode')){
        $url = config('services.upayments.test_url');
    }
    $body = json_encode([
        'order' => [
            'id' => (string)$user->id,
            'reference' => (string)$user->id,
            'description' => 'Charge Wallet',
            'currency' => config('services.upayments.CurrencyCode'),
            'amount' => $amount
        ],
        'language' => lang(),
        // 'paymentGateway' => [
        //     'src' => 'knet'
        // ],
        'reference' => [
            'id' => (string)$user->id
        ],
        'customer' => [
            'uniqueId' => (string) $user->id,
            'name' => $user->name ?? "test",
            'email' => $user->email ?? "test@email.com",
            'mobile' => $user->full_phone,
        ],
        'returnUrl' => route('wallet-charge-success'),
        'cancelUrl' => route('wallet-charge-fail'),
        'notificationUrl' => route('wallet-charge-fail'),
        'customerExtraData' => $amount
    ]);
    $response = $client->request('POST', $url, [
      'body' =>  $body,
      'headers' => [
        'Authorization' => "Authorization: Bearer ".config('services.upayments.api_key'),
        'accept' => 'application/json',
        'content-type' => 'application/json',
      ],
    ]);
    $server_output  = json_decode( $response->getBody());

    return $this->successData(['paymentURL' => $server_output->data->link??'']);
  }  

  public function walletChargeSuccess(Request $request){
    $id =  $request->requested_order_id??null;
    $user = User::find($id);
    $amount = $request->trn_udf??0;
    (new TransactionService)->addToWalletOnlineSuccess($user,$amount,$request->all());
    return $this->successMsg(__('apis.payment_success'));

  }

  public function walletChargeFail(Request $request){
    return $this->response('failed', __('apis.payment_failed'));
  }

  public function paymentsArchive(){
    $payments             = PaymentsResource::collection(auth()->user()->transactions);
    return $this->successData( $payments );
  }

}
