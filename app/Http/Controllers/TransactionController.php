<?php
namespace App\Http\Controllers;

// use Spr\Base\Models\Media as Image;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Models\Transaction as ModelTransaction;
use App\Http\Models\TransactionStatus as ModelTransactionStatus;
use App\Http\Models\TransactionDetail as ModelTransactionDetail;
use App\Http\Models\Customer as ModelCustomer;
use App\Http\Models\GroupCustomer as ModelGroupCustomer;
use App\Http\Models\TransactionAddress as ModelTransactionAddress;
use App\Http\Models\PaymentType as ModelPaymentType;
use App\Http\Models\PaymentTypeDetail as ModelPaymentTypeDetail;
use App\Http\Models\Promotion as ModelPromotion;
use App\Http\Models\HappyCode as ModelHappyCode;
use Spr\Base\Controllers\Helper as HelperController;
use App\Http\Models\Setting as ModelSetting;
use Spr\Base\Response\Response;
use Intervention\Image\Exception\NotReadableException;
use App\Http\Models\PriceList as ModelPriceList;
use App\Http\Models\PriceListDetail as ModelPriceListDetail;
use App\Http\Controllers\EmailController as EmailController;
use Hash;
use Input;
use Config;
use Auth;
use Lang;
use Session;
use Cache;
use Validator;
use URL;

class TransactionController  extends Controller
{


    public function __construct()
    {
    }


    public function confirmTransaction ($data_output_validate_param) {

        if($data_output_validate_param['meta']['success']) {

            $ModelCustomer                  = new ModelCustomer();
            $ModelTransactionAddress    = new ModelTransactionAddress();
            $ModelTransaction           = new ModelTransaction();
            $EmailController            = new EmailController();

            $buyerFirstname     = $data_output_validate_param['response']['buyerFirstname'];
            $buyerLastname      = $data_output_validate_param['response']['buyerLastname'];
            $buyerPhone         = $data_output_validate_param['response']['buyerPhone'];
            $buyerEmail         = $data_output_validate_param['response']['buyerEmail'];
            $buyerCityID        = $data_output_validate_param['response']['buyerCityID'];
            $buyerAddress       = $data_output_validate_param['response']['buyerAddress'];
            $buyerDistrictID    = $data_output_validate_param['response']['buyerDistrictID'];
            $buyerWardID        = $data_output_validate_param['response']['buyerWardID'];
            $create_new_acc     = ( $data_output_validate_param['response']['create_new_acc'] == "on" )? true : false;
            $receiverInfo       = ( $data_output_validate_param['response']['receiverInfo'] == "on" )? true : false;

            $receiverFirstname  = $data_output_validate_param['response']['receiverFirstname'];
            $receiverLastname   = $data_output_validate_param['response']['receiverLastname'];
            $receiverPhone      = $data_output_validate_param['response']['receiverPhone'];
            $receiverEmail      = $data_output_validate_param['response']['receiverEmail'];
            $receiverCityID     = $data_output_validate_param['response']['receiverCityID'];
            $receiverAddress    = $data_output_validate_param['response']['receiverAddress'];
            $receiverDistrictID = $data_output_validate_param['response']['receiverDistrictID'];
            $receiverWardID     = $data_output_validate_param['response']['receiverWardID'];

            $idAddressBuyer     = null;
            $idAddressReceiver  = null;
            $groupUser          = null;

            $dataBuyer = [
                'first_name'        => $buyerFirstname,
                'last_name'         => $buyerLastname,
                'phone_number'      => $buyerPhone,
                'address'           => $buyerAddress,
                'email'             => $buyerEmail,
                'city_id'           => $buyerCityID,
                'district_id'       => $buyerDistrictID,
                'ward_id'           => $buyerWardID
            ];

            $dataReceiver = [
                'first_name'        => $receiverFirstname,
                'last_name'         => $receiverLastname,
                'phone_number'      => $receiverPhone,
                'address'           => $receiverAddress,
                'email'             => $receiverEmail,
                'city_id'           => $receiverCityID,
                'district_id'       => $receiverDistrictID,
                'ward_id'           => $receiverWardID
            ];

            if(Auth::guard('customer')->check()) {
                $idBuyer = Auth::guard('customer')->user()->id;

                $where = [
                    [
                        'fields'    => 'id',
                        'operator'  => '=',
                        'value'     => $dataBuyer,
                    ]
                ];

                $ModelCustomer->updateData($dataBuyer, $where);

                $dataTransactionAddress = $ModelTransactionAddress->getDataByUserId($idBuyer);

                if($dataTransactionAddress['meta']['success'] && COUNT($dataTransactionAddress['response']) > 0){

                    $idAddressBuyer = $dataTransactionAddress['response'][0]->id;
                    $ModelTransactionAddress->updateData($dataBuyer, $idAddressBuyer);
                }else {
                    
                    $dataBuyer['users_id'] = $idBuyer;
                    $idAddressBuyer = $ModelTransactionAddress->insertData($dataBuyer)['response'];
                }
                $groupUser = Auth::guard('customer')->user()->group_id;
            }else {

                $idBuyer        = null;

                //************************************************************************************************************
                // Nếu người mua click vào nút tạo tài khoản sẽ chạy vào đây
                // Validate nếu sđt hoặc email đã tồn tại trong bang user thì yêu cầu họ đăng nhập hoặc quên mật khẩu. ( Hiện gợi ý trên web )
                //************************************************************************************************************
                // start namdh

                if($create_new_acc) {

                    $data_check_email = [
                        'fields'    => 'email',
                        'value'     => $buyerEmail
                    ];

                    $check_email = $ModelCustomer->checkExistsRecord($data_check_email);

                    $data_check_phone_number = [
                        'fields'    => 'phone_number',
                        'value'     => $buyerPhone
                    ];

                    $check_phone_number = $ModelCustomer->checkExistsRecord($data_check_phone_number);

                    if ($check_email['response'] != null || $check_phone_number['response'] != null ) {

                        // sđt hoặc email đã tồn tại, yêu cầu khách hàng đăng nhập hoặc quên mật khẩu
                        $data_output_validate_param['meta']['success']  = false;
                        $data_output_validate_param['meta']['code']     = '0034';
                        $data_output_validate_param['meta']['msg']      = ['create-acc' => Lang::get('message.web.error.0034')];
                        $data_output_validate_param['response']         = [];

                        return $data_output_validate_param;
                    }

                    $data_new_user              = $dataBuyer;
                    $pass                       = random_bytes(8);
                    $data_new_user['password']  = Hash::make($pass);
                    $idBuyer                    = $ModelCustomer->insertData($data_new_user)['response'];
                    $where_inserted_user = [
                        [
                            'fields'    => 'id',
                            'operator'  => '=',
                            'value'     => $idBuyer,
                        ]
                    ];

                    $inserted_user                      = $ModelCustomer->selectData('users', $where_inserted_user);
                    $transaction_password_for_new_user  = $EmailController->sendMail(Config::get('spr.system.email_types.transaction_password_for_new_user'), $inserted_user, $buyerEmail);

                }
                // end namdh

                $newDataTransactionAddress              = $dataBuyer;
                $newDataTransactionAddress['users_id']  = $idBuyer;
                $idAddressBuyer                         = $ModelTransactionAddress->insertData($newDataTransactionAddress)['response'];
                //******************************************************************************************************
                // Send email mật khẩu đăng nhập cho khách hàng. Ở đây login bằng email hoặc sđt không sử dụng username
                //******************************************************************************************************
                // start namdh




                // end namdh
            }

            if($receiverInfo) {
                //******************************************************************************************************************
                // Nếu người mua click vào nút người nhận khác người mua sẽ chạy vào đây
                // Validate Thông tin của nnguwowifnhaanj như validate của người mua mở file config ra xem người mua validate cái gì
                //******************************************************************************************************************
                // start namdh

                $validator = Validator::make(
                    [
                        'first_name'        => $receiverFirstname,
                        'last_name'         => $receiverLastname,
                        'phone_number'      => $receiverPhone,
                        'address'           => $receiverAddress,
                        'email'             => $receiverEmail,
                        'city_id'           => $receiverCityID,
                        'district_id'       => $receiverDistrictID,
                        'ward_id'           => $receiverWardID
                    ],
                    [
                        'first_name'    => 'required',
                        'last_name'     => 'required',
                        'phone_number'  => 'required|numeric',
                        'address'       => 'required',
                        'email'         => 'required|email',
                        'city_id'       => 'required|numeric',
                        'district_id'   => 'required|numeric',
                        'ward_id'       => 'required|numeric',
                    ]
                );

                if ($validator->fails())
                {
                    $messages = $validator->messages();

                    $data_output_validate_param['meta']['success']  = false;
                    $data_output_validate_param['meta']['code']     = '0035';
                    $data_output_validate_param['meta']['msg']      = ['message' => $message];
                    $data_output_validate_param['response']         = [];

                    return $data_output_validate_param;

                } else {

                    $idAddressReceiver = $ModelTransactionAddress->insertData($dataReceiver)['response'];
                }


                // end namdh

            }else {

                $dataReceiver       = $dataBuyer;
                $idAddressReceiver  = $idAddressBuyer;
            }

            // transation

            $dataShoppingCart = Cache::get('shopping_cart_'.$_COOKIE['shopping_cart']);

            // get priceList && paymentType
            $payment_type  = 1;
            $payment_type_detail  = 1;
            $price_list_id = 1;


            // get total price and price list detail
            $total_price        =   0;
            $total_price_in_jp  =   0;
            $price_list_detail  =   null;
            $total_fee          =   0;


            if($groupUser != null) {

                $ModelGroupCustomer         = new ModelGroupCustomer();
                $dataGroupuser              = $ModelGroupCustomer->getDataById($groupUser);
                $price_list_id              = $dataGroupuser['response'][0]->price_list_id;
                $payment_type               = $dataGroupuser['response'][0]->payment_type_id;

            }else {

                $ModelPriceList             = new ModelPriceList();
                $ModelPaymentType           = new ModelPaymentType();
                $dataPriceList              = $ModelPriceList->getPriceListDefault();
                $price_list_id              = $dataPriceList['response'][0]->id;
                $dataPaymentTypeDefault     = $ModelPaymentType->getDefault();
                $payment_type               = $dataPaymentTypeDefault['response'][0]->id;

            }

            $ModelPaymentTypeDetail     = new ModelPaymentTypeDetail();
            $data_payment_type_default  = $ModelPaymentTypeDetail->getPaymentTypeDetailDefaultByPaymentTypeID($payment_type);
            $payment_type_detail        = $data_payment_type_default['response']->id;
            // Doan duoi nay se lu ly gia Total chua co happy code vs promotion code

            if(count($dataShoppingCart['products']) > 0){

                $ModelPriceListDetail       = new ModelPriceListDetail();
                $price_list_detail          = $ModelPriceListDetail->selectData($price_list_id)['response'];

                foreach ($dataShoppingCart['products'] as $k_product => $val_product) {

                    $price_product              =   ceil(((float)$val_product['price_jp'] * (float)$val_product['exchange-rate']) * $val_product['quantity']);
                    $temp_price_list_detail     =   [];
                    $fee                        =   0;

                    foreach ($price_list_detail as $k_price_list => $val_price_list) {

                        $tmp            = [];
                        $price          = ceil((($price_product * (float)$val_price_list->value))/100);

                        (float)$fee    +=   $price;

                        $tmp['id']      = $val_price_list->id;
                        $tmp['title']   = $val_price_list->key;
                        $tmp['price']   = $price;

                        array_push($temp_price_list_detail,$tmp);

                    }

                    $dataShoppingCart['products'][$k_product]['total_price']        =   ($price_product + $fee);
                    $dataShoppingCart['products'][$k_product]['price_list_detail']  =   json_encode($temp_price_list_detail);
                    $total_price_in_jp  += $price_product;
                    $total_price        += ($price_product + $fee);
                    $total_fee          += $fee;

                }
            }

            // Xu ly cua promotion code
            $promotion = null;
            $price_list_promotion_code  =   0;
            if($dataShoppingCart['promotion']['code'] != "") {

                $ModelPromotion = new ModelPromotion();
                $data_promotion = $ModelPromotion->getDataByCode($dataShoppingCart['promotion']['code']);

                if($data_promotion['meta']['success'] && COUNT($data_promotion['response']) > 0 ) {

                    if($data_promotion['response'][0]->used_by == null && $data_promotion['response'][0]->expired_time <= strtotime(\Carbon\Carbon::now()->toDateTimeString()) ) {

                        $promotion = $data_promotion['response'][0]->id;

                        $discount   =   0;

                        if($data_promotion['response'][0]->discount > 100){

                            $discount   =   $data_promotion['response'][0]->discount;


                        }else{

                            $discount  =   ceil(((float)$data_promotion['response'][0]->discount * $total_price)/100);

                        }

                        $price_list_promotion_code  = $discount;
                        $total_price -= $discount;

                    }
                }
            }

            // Xu ly cua happy code
            $happy_code = null;
            $price_list_happy_code  =   0;
            if($dataShoppingCart['happy_code']['code'] != "") {

                $ModelHappyCode     = new ModelHappyCode();
                $data_happy_code    = $ModelHappyCode->getDataByCode($dataShoppingCart['happy_code']['code']);

                if($data_happy_code['meta']['success'] && COUNT($data_happy_code['response']) > 0 ) {

                    if($data_happy_code['response'][0]->used_by == null && $data_happy_code['response'][0]->expired_time <= strtotime(\Carbon\Carbon::now()->toDateTimeString()) ) {

                        $happy_code = $data_happy_code['response'][0]->id;

                        $discount   =   0;

                        if($data_happy_code['response'][0]->discount > 100){

                            $discount   =   $data_happy_code['response'][0]->discount;


                        }else{

                            $discount  =   ceil(((float)$data_happy_code['response'][0]->discount * $total_price)/100);

                        }
                        $price_list_happy_code  = $discount;
                        $total_price -= $discount;
                    }
                }
            }
            $ModelTransactionStatus = new ModelTransactionStatus();
            $data_status = $ModelTransactionStatus->getDataDefault();
            $status = '';
            if($data_status['meta']['success'] && COUNT($data_status['response']) > 0) {

                $status = $data_status['response']['0']->id;
            }else {

                $data_output_validate_param['meta']['success'] = false;
                $data_output_validate_param['meta']['code'] = 501;
                $data_output_validate_param['meta']['msg'] = ['id' => "Giao dịch thất bại vui lòng gửi yêu cầu hỗ trợ để giải quyết đơn hàng"];
                $data_output_validate_param['response'] = [];
                return $data_output_validate_param;

            }
            $created_at =   strtotime(\Carbon\Carbon::now()->toDateTimeString());
            $code = "AM-" . strtoupper(bin2hex(random_bytes(4))).'-'. substr($created_at, 4, 7);
            $dataTransaction = [

                'code'                      => $code,
                'buyer_address_id'          => $idAddressBuyer,
                'receiver_address_id'       => $idAddressReceiver,
                'payment_method'            => Config::get('spr.type.type.payment.online.value'),
                'payment_type'              => $payment_type,
                'payment_type_detail'       => $payment_type_detail,
                'price_list_id'             => $price_list_id, 
                'promotion'                 => $promotion,
                'happy_code'                => $happy_code,
                'price_list_happy_code'     => $price_list_happy_code,
                'price_list_promotion_code' => $price_list_promotion_code,
                'exchange_rate'             => $dataShoppingCart['products'][0]['exchange-rate'],
                'total_price_in_vn'         => $total_price,
                'total_price_in_jp'         => $total_price_in_jp,
                'real_price'                => $total_price_in_jp,
                'total_fee'                 => $total_fee,
                'total_amount'              => $total_price ,
                'amount_unpaid'             => $total_price ,
                'paid_before'               => $total_price ,
                'status'                    => $status,
                'verify'                    => false,
                'payment_status'            => Config::get('spt.status.payment.unpaid'),
                'created_at'                => strtotime(\Carbon\Carbon::now()->toDateTimeString()),
                'updated_at'                => strtotime(\Carbon\Carbon::now()->toDateTimeString())

            ];

            $data_email_transaction_status['dataTransaction']   = $dataTransaction;
            $dataTransaction                                    = $ModelTransaction->newTransaction($dataTransaction);

            // update promotion
            $dataListProduct = [];
            foreach ($dataShoppingCart['products'] as $key => $value) {

                $item =  [
                    'transaction_id'            => $dataTransaction['response'],
                    'product_code'              => $value['code'],
                    'quantity'                  => $value['quantity'],
                    'price'                     => $value['price_jp'],
                    'price_save'                => $value['price_save_jp'],
                    'price_list_detail'         => $value['price_list_detail'],
                    'price_in_vn'               => $value['total_price'],
                    'type_product'              => json_encode($value['type_product']),
                    'img'                       => $value['img'],
                    'name'                      => $value['name'],
                    'created_at'                => strtotime(\Carbon\Carbon::now()->toDateTimeString()),
                ];

                array_push($dataListProduct, $item);
            }

            $ModelTransactionDetail                 = new ModelTransactionDetail();
            $data_output_validate_param             = $ModelTransactionDetail->insertData($dataListProduct);
            $transaction_code                       = $ModelTransaction->getCodeById($dataTransaction['response']);
            $data_output_validate_param['response']     = [$dataTransaction['response']];
            $data_output_validate_param['meta']['code'] = [$transaction_code['response']->code];

            //************************************************************************************************************
            // Gửi email tình trạng đơn hàng về cho người dùng thông qua email..
            // template email thì sẽ lấy của fado. Tạo một đơn hàng trên fado và sẽ lấy temlate ở đó
            //************************************************************************************************************
            // start namdh

            $data_email_transaction_status['dataBuyer']         = $dataBuyer;
            $data_email_transaction_status['dataReceiver']      = $dataReceiver;
            $data_email_transaction_status['dataListProduct']   = $dataListProduct;

            $transaction_status = $EmailController->sendMail(Config::get('spr.system.email_types.transaction_status'), $data_email_transaction_status, $buyerEmail);

            // dd($data_email_transaction_status);
            // end namdh

        }

        return $data_output_validate_param;
    }

    public function Update_Transaction($data_output_validate_param) {

        if ($data_output_validate_param['meta']['success']) {
            $id                     = $data_output_validate_param['response']['id'];
            $status                 = $data_output_validate_param['response']['status'];
            $amazon_id              = $data_output_validate_param['response']['amazon_id'];
            $expected_date          = $data_output_validate_param['response']['expected_date'];
            $payment                = $data_output_validate_param['response']['payment'];
            $real_price             = $data_output_validate_param['response']['real_price'];
            $updated_at             = $data_output_validate_param['response']['updated_at'];

            $ModelTransaction       =   new ModelTransaction();
            $data_transaction   = $ModelTransaction->getDataByID($id);

            if($data_transaction['meta']['success'] && COUNT($data_transaction['response']) > 0){

                $where  =   [

                    [
                        'fields'    =>  'id',
                        'operator'  =>  '=',
                        'value'     =>  $id,
                    ]
                ];

                $data   =   [

                    'status'     =>  $status,
                    'amazon_id'  =>  $amazon_id,
                    'real_price' =>  $real_price,
                ];
                if($status != $data_transaction['response']->status) {

                    $data['updated_at'] = $updated_at;
                }

                if($expected_date != null && $expected_date != ""){

                    $data['expected_day']   =   strtotime($expected_date);
                }

                if($payment != 0){

                    $data['amount_paid']    =   ceil((float)$data_transaction['response']->amount_paid + (float)$payment);
                    $data['amount_unpaid']  =   ceil((float)$data_transaction['response']->amount_unpaid - (float)$payment);
                }

                $data_update    =   $ModelTransaction->updateData($data,$where);

                if($data_update['meta']['success']  == false){

                    $data_output_validate_param['meta']['success']  = false;
                }
            }
        }

        return $data_output_validate_param;
    }

    public function updateTransactionByCode($data_output_validate_param){

        if($data_output_validate_param['meta']['success']){

            $code                       =   $data_output_validate_param['response']['transaction_code'];
            $payment_method             =   $data_output_validate_param['response']['payment_method'];
            $payment_type_detail        =   $data_output_validate_param['response']['payment_type_detail'];
            $payment                    =   $data_output_validate_param['response']['payment'];
            $cost_incurred              =   $data_output_validate_param['response']['cost_incurred'];
            $bank                       =   $data_output_validate_param['response']['bankID'];
            $solution_payment           =   $data_output_validate_param['response']['solution_payment'];


            $ModelTransaction   =   new ModelTransaction();

            Cache::forget('shopping_cart_'.$_COOKIE['shopping_cart']);

            if($ModelTransaction->checkCodeExist($code)['response'] > 0){

                $data_info              =   $ModelTransaction->getInfoByCode($code);
                $data_transaction       =   $ModelTransaction->getDataByCode($code);

                $vnpSecureHash = '';
                $vnp_Url = '';

                if($payment_method == 0) {

                    $vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
                    $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
                    $vnp_OrderInfo = "Thanh Toán đơn hàng ". $code;
                    $vnp_TxnRef = $code;
                    $vnp_Amount = (int)$payment * 100;
                    $vnp_BankCode = $bank;
                    $vnpay_hash_secret = Config::get('spr.system.vnpay.vnp_HashSecret');
                    $inputData = array(
                        "vnp_TmnCode" => Config::get('spr.system.vnpay.vnp_TmnCode'), //Tham so nay lay tu VNPAY
                        "vnp_Amount" => $vnp_Amount,
                        "vnp_Command" => "pay",
                        "vnp_CreateDate" => date('YmdHis'),
                        "vnp_CurrCode" => "VND",
                        "vnp_IpAddr" => $vnp_IpAddr,
                        "vnp_Locale" => 'vn',
                        "vnp_OrderInfo" => $vnp_OrderInfo,
                        "vnp_OrderType" => Config::get('spr.system.vnpay.type'),
                        "vnp_ReturnUrl" =>  URL::Route('web-get-callback-payment-online'),
                        "vnp_TxnRef" => $vnp_TxnRef,
                        "vnp_Version" => "2.0.0"
                    );
                    $out = array_merge($inputData, array("vnp_BankCode" => $vnp_BankCode));
                    ksort($out);
                    $query = "";
                    $i = 0;
                    $hashdata = "";

                    foreach ($out as $key => $value) {
                        if ($i == 1) {

                            $hashdata .= '&' . $key . "=" . $value;
                        } else {

                            $hashdata .= $key . "=" . $value;
                            $i = 1;
                        }
                        $query .= urlencode($key) . "=" . urlencode($value) . '&';
                    }

                    $vnp_Url = $vnp_Url . "?" . $query;

                    if (isset($vnpay_hash_secret)) {

                        $vnpSecureHash = md5($vnpay_hash_secret . $hashdata);
                        $vnp_Url .= 'vnp_SecureHashType=MD5&vnp_SecureHash=' . $vnpSecureHash;
                    }
                }

                $data_update    =  [

                    'payment_method'        =>  $payment_method,
                    'payment_type_detail'   =>  $payment_type_detail,
                    'total_amount'          =>  ((float)$data_transaction['response'][0]->total_price_in_vn + (float)$cost_incurred),
                    'amount_unpaid'         =>  ((float)$data_transaction['response'][0]->total_price_in_vn + (float)$cost_incurred),
                    'cost_incurred'         =>  $cost_incurred,
                    'paid_before'           =>  $payment,
                    'vnpSecureHash'         =>  $vnpSecureHash,
                    'bank'                  =>  $bank,
                    'solution_payment'      =>  $solution_payment,

                ];

                $where =   [

                    [

                        'fields'    =>  'code',
                        'operator'  =>  '=',
                        'value'     =>  $code
                    ]

                ];

                $data   =   $ModelTransaction->updateData($data_update,$where);

                if($data['meta']['success'] == false){

                    $data_output_validate_param['meta']['success'] = false;

                }else{

                    if($data['meta']['success']){

                        $data_output_validate_param['response']['info'] = $data_info['response'];
                        $data_output_validate_param['response']['url'] = $vnp_Url;

                    }
                }

            }
        }else{
 
            $data_output_validate_param['meta']['success'] = false;
        }

        return $data_output_validate_param;
    }

    public function getData($data_output_validate_param) {

        $sort           = $data_output_validate_param['response']['sort'];
        $limit          = $data_output_validate_param['response']['limit'];
        $sort_type      = $data_output_validate_param['response']['sort_type'];
        $key_search     = $data_output_validate_param['response']['key_search'];
        $status         = $data_output_validate_param['response']['status'];

        if($data_output_validate_param['meta']['success']) {

            $ModelTransaction = new ModelTransaction();

            $data = $ModelTransaction->getDataManage($key_search,$status, $limit, $sort, $sort_type);

            $data_output_validate_param['response']['data'] = $data;
        }else {

            $data_output_validate_param['response'] = array();
            $data_output_validate_param['response']['data'] = [];
        }

        // dd($data_output_validate_param['response']);

        return $data_output_validate_param['response'];

    }

    public function getDataExport ($data_output_validate_param) {

        $sort           = $data_output_validate_param['response']['sort'];
        $limit          = $data_output_validate_param['response']['limit'];
        $sort_type      = $data_output_validate_param['response']['sort_type'];
        $key_search     = $data_output_validate_param['response']['key_search'];
        $status         = $data_output_validate_param['response']['status'];

        if($data_output_validate_param['meta']['success']) {

            $ModelTransaction = new ModelTransaction();

            $data = $ModelTransaction->getDataManage($key_search,$status, $limit, $sort, $sort_type, true);

            $data_output_validate_param['response'] = $data['response'];
        }else {

            $data_output_validate_param['response'] = array();
        }

        return $data_output_validate_param;
    }

    public function deleteData($data_output_validate_param){

        $results    =   Response::response();

        if($data_output_validate_param['meta']['success']){

            $id                 =   $data_output_validate_param['response']['id'];
            $comment            =   $data_output_validate_param['response']['comment'];
            $deleted_at         =   $data_output_validate_param['response']['updated_at'];

            $ModelTransaction       =   new ModelTransaction();
            $ModelTransactionDetail =   new ModelTransactionDetail();

            if($ModelTransaction->checkIdExist($id)['response']->total > 0){

                $where = [

                        [

                            'fields'    =>  'id',
                            'operator'  =>  '=',
                            'value'     =>  $id,
                        ]
                ];

                $where_sub  = [

                        [

                            'fields'    =>  'transaction_id',
                            'operator'  =>  '=',
                            'value'     =>  $id,

                        ]

                ];

                $data   =   [

                        'comment'       =>  $comment,
                        'deleted_at'    =>  $deleted_at

                ];

                $results    =   $ModelTransactionDetail->updateData($data,$where_sub);

                if($results['meta']['success']){

                    $data_output_validate_param    =   $ModelTransaction->updateData($data,$where);

                    if($data_output_validate_param['meta']['success'] == false ){

                        $data_output_validate_param['meta']['msg'] = Lang::get('message.web.error.0019');
                        Session::flash('msg', $data_output_validate_param['meta']['msg']);

                        return $data_output_validate_param;

                    }else{

                        $data_output_validate_param['meta']['msg'] = Lang::get('message.web.success.0004');
                        Session::flash('msg', $data_output_validate_param['meta']['msg']);
                        return $data_output_validate_param;

                    }

                }else{

                        $data_output_validate_param['meta']['msg'] = Lang::get('message.web.error.0019');
                        Session::flash('msg', $data_output_validate_param['meta']['msg']);

                        return $data_output_validate_param;

                }

            }else{

                $data_output_validate_param['meta']['success']      =   false;
                $data_output_validate_param['meta']['msg']['id']    =   Lang::get('message.web.error.0011');;
                Session::flash('msg', $data_output_validate_param['meta']['msg']);

                return $data_output_validate_param;

            }

        }else{

            Session::flash('msg', $data_output_validate_param['meta']['msg']);

        }

        return $data_output_validate_param;

    }

    public function getTransactionPending($data_output_validate_param){

        if($data_output_validate_param['meta']['success']){

            $ModelTransaction       =   new ModelTransaction();

            $results                        =   $ModelTransaction->getPending();

            $data_output_validate_param['response']['data']     =    $results['response'];

        }
        return $data_output_validate_param;
    }

    public function getTransactionReport($data_output_validate_param){

        if($data_output_validate_param['meta']['success']){

            $beginDate      =   $data_output_validate_param['response']['beginDate'];
            $endDate        =   $data_output_validate_param['response']['endDate'];
        }
    }

    public function getPaymentInformation ($data_output_validate_param) {

        if($data_output_validate_param['meta']['success']) {

            $code = $data_output_validate_param['response']['order_code'];

            $ModelTransaction               = new ModelTransaction();
            $ModelTransactionDetail         = new ModelTransactionDetail();
            $ModelPaymentTypeDetail         = new ModelPaymentTypeDetail();
            $ModelSetting                   = new ModelSetting();

            $dataTransaction = $ModelTransaction->getInformationTransactionByCode($code);

            if($dataTransaction['meta']['success'] && !empty($dataTransaction['response'])) {

                $id_transaction     =   $dataTransaction['response']->id;
                $id_payment_type    =   $dataTransaction['response']->payment_type;

                $dataDetail             = $ModelTransactionDetail->getDataByTransactionId($id_transaction);
                $dataPaymentTypeDetail  = $ModelPaymentTypeDetail->getPaymentTypeDetailByPaymentTypeID($id_payment_type);
                $rules                  = $ModelSetting->getCompanyInfo(Config::get('spr.type.setting.company-info.rules.key'));

                if($dataDetail['meta']['success'] && !empty($dataDetail['response']) && $dataPaymentTypeDetail['meta']['success'] && !empty($dataPaymentTypeDetail['response']) && $rules['meta']['success'] && !empty($rules['response'])) {

                    $data_output_validate_param['response']['transaction']          = $dataTransaction['response'];
                    $data_output_validate_param['response']['detail_transaction']   = $dataDetail['response'];
                    $data_output_validate_param['response']['payment_type_detail']  = $dataPaymentTypeDetail['response'];
                    $data_output_validate_param['response']['rules']                = $rules['response'];

                }else {

                    $validatebase['meta']['success'] = false;
                    $validatebase['meta']['code']    = '0032';
                    $validatebase['meta']['msg']     = ['Transaction' => Lang::get('message.web.error.0032')];
                    $validatebase['response']        = [];
                }

            }else {

                $validatebase['meta']['success'] = false;
                $validatebase['meta']['code']    = '0032';
                $validatebase['meta']['msg']     = ['Transaction' => Lang::get('message.web.error.0032')];
                $validatebase['response']        = [];
            }

        }
        return $data_output_validate_param;

    }

    public function getInformationTransactionDetail($data_output_validate_param){

        if($data_output_validate_param['meta']['success']){

            $code               =   $data_output_validate_param['response']['code'];
            $payment_type       =   $data_output_validate_param['response']['payment_type'];
            $payment_method     =   $data_output_validate_param['response']['payment_method'];

            $ModelTransaction   =   new   ModelTransaction();
            $data               =   [];

            $data_info              =   $ModelTransaction->getInfoTransactionDetail($code,$payment_type);
            $data_payment_method    =   Config::get('spr.type.type.payment');
            $verify                 =   Config::get('spr.type.type.verify');

            if($data_info['meta']['success']){

                $temp_payment_method    =   "";

                foreach ($data_payment_method as $k => $val) {

                    if($val['value'] == $payment_method){

                        $temp_payment_method =  $val['title'];

                    }
                }

                $data_info['response']->verify            =  Lang::get($verify[$data_info['response']->verify]);
                $data_info['response']->status            =  Cache::get('transaction_status')[$data_info['response']->status];
                $data_info['response']->payment_method    =  $temp_payment_method;

                $data_output_validate_param['response']     =   $data_info['response'];

            }else{

                $data_output_validate_param['meta']['success'] = false;
            }
        }
        return $data_output_validate_param;


    }

    public function verifyTransaction($data_output_validate_param){

        if($data_output_validate_param){

            $verify             =   $data_output_validate_param['response']['verify'];
            $id                 =   $data_output_validate_param['response']['id'];
            $updated_at         =   $data_output_validate_param['response']['updated_at'];

            $ModelTransaction   =   new ModelTransaction();
            $check              =   $ModelTransaction->checkIdExist($id);

            if($check['response']->total > 0){

                $data   =   [

                    'verify'        =>  $verify,
                    'updated_at'    =>  $updated_at,
                ];

                $where  =   [
                    [
                        'fields'    =>  'id',
                        'operator'  =>  '=',
                        'value'     =>  $id,
                    ]
                ];

                $data_update    =   $ModelTransaction->updateData($data,$where);

                if($data_update['meta']['success'] == false){

                    $data_output_validate_param['meta']['success'] = false;
                }
            }
        }
        return $data_output_validate_param;
    }


    public function orderCheckingDetail($code,$phone_number){

        $results                    =   Response::response();
        $ModelTransaction           =   new ModelTransaction();

        $ModelTransactionDetail     =   new ModelTransactionDetail();


        $data_status        =   $ModelTransaction->getInfoTransactionDetail($code);

        if($data_status['meta']['success'] && COUNT($data_status['response']) > 0){

            $data_payment_method    =   Config::get('spr.type.type.payment');
            $verify                 =   Config::get('spr.type.type.verify');

            foreach ($data_payment_method as $k => $val) {

                if($val['value'] == $data_status['response']->payment_method){

                    $data_status['response']->payment_method=  $val['title'];

                }
            }

            $data_status['response']->verify       =  Lang::get($verify[$data_status['response']->verify]);
            $data_status['response']->status       =  Cache::get('transaction_status')[$data_status['response']->status];

            $results['response']['data_status']    =  $data_status['response'];

        }else {

            $results['meta']['success']             = false;
            $results['response']['data_status']     =   [];
            $results['response']['data_cus_info']     =   [];
            $results['response']['data_order_info']     =   [];
            $results['response']['data_order_detail']     =   [];
            return $results;
        }

        $data_cus_info        =   $ModelTransaction->getInfoByCode($code,$phone_number);

        if($data_cus_info['meta']['success']){

            $results['response']['data_cus_info']    =  $data_cus_info['response'];

        }else{

            $results['meta']['success']             = false;
            $results['response']['data_status']     =   [];
            $results['response']['data_cus_info']     =   [];
            $results['response']['data_order_info']     =   [];
            $results['response']['data_order_detail']     =   [];
            return $results;
        }

        $data_order_info        =   $ModelTransaction->getDataByCode($code);

        if($data_cus_info['meta']['success']){

            $results['response']['data_order_info']    =  $data_order_info['response'];

        }

        $data_order_detail       =   $ModelTransactionDetail->getDataByTransactionCode($code);

        if($data_cus_info['meta']['success']){

            $results['response']['data_order_detail']    =  $data_order_detail['response'];

        }

        return $results;

    }

    public function orderCheckingDetail2($code,$phone_number){

        $results                    =   Response::response();
        $ModelTransaction           =   new ModelTransaction();

        $ModelTransactionDetail     =   new ModelTransactionDetail();


        $data_transaction = $ModelTransaction->getInformationTransactionByCode($code);

        if($data_transaction['meta']['success']){

            $results['response']['data_transaction']    =  $data_transaction['response'];

        }
        

        $data_order_detail       =   $ModelTransactionDetail->getDataByTransactionCode($code);

        if($data_order_detail['meta']['success']){

            $results['response']['data_order_detail']    =  $data_order_detail['response'];

        }
        
        return $results;
    }
}
?>