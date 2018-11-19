<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"
 xmlns:v="urn:schemas-microsoft-com:vml"
 xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <!--[if gte mso 9]><xml>
    <o:OfficeDocumentSettings>
    <o:AllowPNG/>
    <o:PixelsPerInch>96</o:PixelsPerInch>
    </o:OfficeDocumentSettings>
    </xml><![endif]-->
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="format-detection" content="date=no" />
    <meta name="format-detection" content="address=no" />
    <meta name="format-detection" content="telephone=no" />
    <title>Email Template</title>
    

    <style type="text/css" media="screen">
        /* Linked Styles */


    /* Mobile styles */
    </style>
    <style media="only screen and (max-device-width: 480px), only screen and (max-width: 480px)" type="text/css">
    @media only screen and (max-device-width: 480px), only screen and (max-width: 480px) { 
        
        td {
            word-wrap: break-word;
            
        }

        .word-wrap {
            word-wrap: break-word;
        }
        
        .information {
        
            height:260px;
        }
    } 
    </style>
</head>
<body>
@if(isset($data))
<table class="m_-7286815952245177816m_17059706780914326email-tb" align="center">
    <thead style="margin:0;padding:0">
        <tr style="margin:0;padding:0">
            <td class="m_-7286815952245177816m_17059706780914326header-tb-td" style="margin:0;padding:20px 20px 0">
                <table class="m_-7286815952245177816m_17059706780914326header-tb" style="border-collapse:collapse;margin:0;padding:0;width:100%">
                    <tbody style="margin:0;padding:0">
                        <tr style="margin:0;padding:0">
                            <td style="margin:0;padding:0">
                                <table class="m_-7286815952245177816m_17059706780914326row-1-tb" style="border-collapse:collapse;margin:0;margin-bottom:20px;padding:0;width:100%">
                                    <tbody style="margin:0;padding:0">
                                        <tr style="margin:0;padding:0">
                                            <td class="m_-7286815952245177816m_17059706780914326logo-td" style="margin:0;padding:0;text-align:left;width:400px">
                                                <a href="https://click.pstmrk.it/2/fado.vn/IjAUaw/2zEk/FaTRHYK-Ho" style="color:#333;margin:0;padding:0;text-decoration:none" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=https://click.pstmrk.it/2/fado.vn/IjAUaw/2zEk/FaTRHYK-Ho&amp;source=gmail&amp;ust=1500435490875000&amp;usg=AFQjCNFpHBb-MquGDj1TLED0P1KwolEhaA">
                                                <?php 
                                                    $logo  = "";
                                                    if(!empty(Cache::get('logo'))){
                                                        $logo   = Cache::get('logo');  
                                                    }
                                                 ?>
                                                <img src="{{ URL::asset( $logo ) }}" alt="" style="display:inline;margin:0;padding:0;vertical-align:middle; width: 200px;" class="CToWUd"></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </thead>
    <tbody style="margin:0;padding:0">
        <tr style="margin:0;padding:0">
            <td style="margin:0;padding:0 20px">
                <table class="m_-7286815952245177816m_17059706780914326banner-tb" style="border-collapse:collapse;margin:0;padding:0;width:100%">
                    <tbody style="margin:0;padding:0">
                        <tr>
                            <td style="margin:0;padding:0">
                                <table class="m_-7286815952245177816m_17059706780914326row-1-tb" style="border-collapse:collapse;margin:0;margin-bottom:20px;padding:0;width:100%">
                                    <tbody style="margin:0;padding:0">
                                        <tr style="margin:0;padding:0">
                                            <td style="margin:0;padding:0">
                                                <img src="https://ci6.googleusercontent.com/proxy/MgJGxlsb1sfCgsraph_SaW6uU6C0yjtbGnMifpyaXlkjyway5puORVo0CFrza1lQ33cr38-K5qR6FD_ZgYyrY6zeMqXtE_MAdgmw4A=s0-d-e1-ft#http://static.fado.vn/email/v1/images/title-banner.png" alt="" style="display:inline;margin:0;padding:0;vertical-align:middle;width:100%" class="CToWUd a6T" tabindex="0">
                                                <div class="a6S" dir="ltr" style="opacity: 1; left: 763px; top: 351px;">
                                                    <div id=":tc" class="T-I J-J5-Ji aQv T-I-ax7 L3 a5q" role="button" tabindex="0" aria-label="Download attachment " data-tooltip-class="a1V" data-tooltip="Download">
                                                        <div class="aSK J-J5-Ji aYr"></div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="m_-7286815952245177816m_17059706780914326row-2-tb" style="border-collapse:collapse;line-height:24px;margin:0;margin-bottom:20px;padding:0;width:100%">
                                    <tbody style="margin:0;padding:0">
                                        <tr style="margin:0;padding:0">
                                            <td style="margin:0;padding:0">
                                                Kính chào quý khách {{ $data['dataBuyer']['first_name'] . ' ' . $data['dataBuyer']['last_name'] }} !<br style="margin:0;padding:0">
                                                Chân thành cảm ơn Quý khách đã mua sắm tại Sumoshipping.vn,<br style="margin:0;padding:0">
                                                Chúng tôi hy vọng Quý khách hài lòng với trải nghiệm mua sắm
                                                và các sản phẩm đã chọn.<br style="margin:0;padding:0">
                                                Vào thời điểm hiện tại, thông tin về trạng thái đơn hàng
                                                của Quý khách như sau:
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="m_-7286815952245177816m_17059706780914326row-3-tb" style="border-collapse:collapse;margin:0;margin-bottom:20px;padding:0;width:100%">
                                    <tbody style="margin:0;padding:0">
                                        <tr style="margin:0;padding:0">
                                            <td class="m_-7286815952245177816m_17059706780914326col-1-td word-wrap" style="margin:0;padding:0;padding-right:13px;text-align:left;vertical-align:top;width:33.3333%">
                                                <div class="m_-7286815952245177816m_17059706780914326icon" style="height:50px;margin:0;margin-bottom:5px;padding:0;text-align:center">
                                                    <img src="https://ci4.googleusercontent.com/proxy/OwuFHSqHTCD8qu-ePGckzkChSJIin4ElWiMWavdBYg85QynTwdcV_gJAv3bsJ72ubU_WKfMLVRIohYHLUamX7RrXCs5I-M659-c=s0-d-e1-ft#http://static.fado.vn/email/v1/images/icon-box-1.png" alt="" style="display:inline;height:50px;margin:0;padding:0;vertical-align:middle;width:50px" class="CToWUd">
                                                </div>
                                                <div class="m_-7286815952245177816m_17059706780914326box m_-7286815952245177816m_17059706780914326box-1 information" style="background:#e9ebee;border-radius:5px;line-height:25px;margin:0;padding:30px 10px 10px">
                                                    <div class="m_-7286815952245177816m_17059706780914326title" style="font-size:14px;font-weight:700;margin:0;padding:0;text-align:center">Thông tin đơn hàng</div>
                                                    <div class="m_-7286815952245177816m_17059706780914326line" style="height:3px;line-height:3px;margin:5px 0 10px;padding:0;text-align:center"><img src="https://ci5.googleusercontent.com/proxy/vmiPp2IHzg1oVtTpz7T4ZsGvnQPqo2YVjM1ym4-lt8cZ07_6-RkDSH1lkz9r_XPXV95tN-v1NFqRgx7acJPyTnKQ6AY=s0-d-e1-ft#http://static.fado.vn/email/v1/images/line.png" alt="" style="display:inline;margin:0;padding:0;vertical-align:middle" class="CToWUd"></div>
                                                    <div class="m_-7286815952245177816m_17059706780914326desc" style="margin:0;padding:0">
                                                        Mã đơn hàng:
                                                        <span class="m_-7286815952245177816m_17059706780914326text-blue" style="color:#006cff;margin:0;padding:0">
                                                            {{ $data['dataTransaction']['code'] }}
                                                        </span>
                                                        <br style="margin:0;padding:0">
                                                        Ngày đặt: {{ gmdate("YY-m-d", $data['dataTransaction']['created_at']) }}
                                                        <br style="margin:0;padding:0">
                                                        Giá trị:
                                                        <span class="m_-7286815952245177816m_17059706780914326text-red" style="color:#b11e22;margin:0;padding:0">
                                                            {{ $data['dataTransaction']['total_price_in_vn'] }}<sup style="margin:0;padding:0">đ</sup>
                                                        </span>
                                                        <br style="margin:0;padding:0">
                                                        <!-- <a href="#" target="_blank" data-saferedirecturl="#">
                                                            <font color="#419641">Thanh toán tại nhà</font>
                                                            <br style="margin:0;padding:0">
                                                        </a> -->
                                                        Trạng thái:  
                                                        <font color="red">
                                                            @if( (Config::get('spr.system.transaction_status')) != null )
                                                                @foreach ( Config::get('spr.system.transaction_status') as $key => $item )
                                                                    {{ ($data['dataTransaction']['status'] == $key) ? $item : '' }}
                                                                @endforeach
                                                            @endif
                                                        </font>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="m_-7286815952245177816m_17059706780914326col-2-td word-wrap" style="margin:0;padding:0 6.5px;text-align:left;vertical-align:top;width:33.3333%">
                                                <div class="m_-7286815952245177816m_17059706780914326icon" style="height:50px;margin:0;margin-bottom:5px;padding:0;text-align:center">
                                                    <img src="https://ci6.googleusercontent.com/proxy/kEMuUdmxfp33WpeCjs3IeX0fn66VJXQquFF3ypRLstRfq0q0OmQftInYfvaF9iQkkHXj5OpLa_1YDvE2IEED9Dd6uPGHLpHfz5Y=s0-d-e1-ft#http://static.fado.vn/email/v1/images/icon-box-2.png" alt="" style="display:inline;height:50px;margin:0;padding:0;vertical-align:middle;width:50px" class="CToWUd">
                                                </div>
                                                <div class="m_-7286815952245177816m_17059706780914326box m_-7286815952245177816m_17059706780914326box-2 information" style="background:#e9ebee;border-radius:5px;line-height:25px;margin:0;padding:30px 10px 10px">
                                                    <div class="m_-7286815952245177816m_17059706780914326title" style="font-size:14px;font-weight:700;margin:0;padding:0;text-align:center">
                                                        Thông tin đặt hàng
                                                    </div>
                                                    <div class="m_-7286815952245177816m_17059706780914326line" style="height:3px;line-height:3px;margin:5px 0 10px;padding:0;text-align:center">
                                                        <img src="https://ci5.googleusercontent.com/proxy/vmiPp2IHzg1oVtTpz7T4ZsGvnQPqo2YVjM1ym4-lt8cZ07_6-RkDSH1lkz9r_XPXV95tN-v1NFqRgx7acJPyTnKQ6AY=s0-d-e1-ft#http://static.fado.vn/email/v1/images/line.png" alt="" style="display:inline;margin:0;padding:0;vertical-align:middle" class="CToWUd">
                                                    </div>
                                                    <div class="m_-7286815952245177816m_17059706780914326desc" style="margin:0;padding:0">
                                                        Họ và Tên: {{ $data['dataBuyer']['first_name'] . ' ' . $data['dataBuyer']['last_name'] }}
                                                        <br style="margin:0;padding:0">
                                                        Email: <a href="{{ $data['dataBuyer']['email'] }}" target="_blank">{{ $data['dataBuyer']['email'] }}</a>
                                                        <br style="margin:0;padding:0">
                                                        Điện thoại: {{ $data['dataBuyer']['phone_number'] }}
                                                        <br style="margin:0;padding:0">
                                                        Địa chỉ: {{ $data['dataBuyer']['address'] }}
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="m_-7286815952245177816m_17059706780914326col-3-td word-wrap" style="margin:0;padding:0;padding-left:13px;text-align:left;vertical-align:top;width:33.3333%">
                                                <div class="m_-7286815952245177816m_17059706780914326icon" style="height:50px;margin:0;margin-bottom:5px;padding:0;text-align:center">
                                                    <img src="https://ci3.googleusercontent.com/proxy/REQti1nZ4D42XDxZdwpUjnCCBfO2HjE2JrdjjG-76ZVTFrrnyOJS5Z5AQU8UpUa9PJKX53y_ECb-7dPv1dPrzX8pe1yt0Uz2-74=s0-d-e1-ft#http://static.fado.vn/email/v1/images/icon-box-3.png" alt="" style="display:inline;height:50px;margin:0;padding:0;vertical-align:middle;width:50px" class="CToWUd">
                                                </div>
                                                <div class="m_-7286815952245177816m_17059706780914326box m_-7286815952245177816m_17059706780914326box-3 information" style="background:#e9ebee;border-radius:5px;line-height:25px;margin:0;padding:30px 10px 10px">
                                                    <div class="m_-7286815952245177816m_17059706780914326title" style="font-size:14px;font-weight:700;margin:0;padding:0;text-align:center">
                                                        Thông tin nhận hàng
                                                    </div>
                                                    <div class="m_-7286815952245177816m_17059706780914326line" style="height:3px;line-height:3px;margin:5px 0 10px;padding:0;text-align:center">
                                                        <img src="https://ci5.googleusercontent.com/proxy/vmiPp2IHzg1oVtTpz7T4ZsGvnQPqo2YVjM1ym4-lt8cZ07_6-RkDSH1lkz9r_XPXV95tN-v1NFqRgx7acJPyTnKQ6AY=s0-d-e1-ft#http://static.fado.vn/email/v1/images/line.png" alt="" style="display:inline;margin:0;padding:0;vertical-align:middle" class="CToWUd">
                                                    </div>
                                                    <div class="m_-7286815952245177816m_17059706780914326desc" style="margin:0;padding:0">
                                                        Họ và Tên: {{ $data['dataReceiver']['first_name'] . ' ' . $data['dataReceiver']['last_name'] }}
                                                        <br style="margin:0;padding:0">
                                                        Email: <a href="{{ $data['dataReceiver']['email'] }}" target="_blank">{{ $data['dataReceiver']['email'] }}</a>
                                                        <br style="margin:0;padding:0">
                                                        Điện thoại: {{ $data['dataReceiver']['phone_number'] }}
                                                        <br style="margin:0;padding:0">
                                                        Địa chỉ: {{ $data['dataReceiver']['address'] }}
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="m_-7286815952245177816m_17059706780914326bill-tb" style="border-collapse:collapse;margin:0;padding:0;width:100%">
                    <tbody style="margin:0;padding:0">
                        <tr>
                            <td style="margin:0;padding:0">
                                <table class="m_-7286815952245177816m_17059706780914326row-1-tb" style="border-collapse:collapse;margin:0;margin-bottom:20px;padding:0;width:100%">
                                    <thead style="margin:0;padding:0">
                                        <tr>
                                            <th style="background:#e9ebee;margin:0;min-width:100px;padding:10px 5px;white-space:nowrap">Tên sản phẩm</th>
                                            <th style="background:#e9ebee;margin:0;padding:10px 5px;width:80px">Giá</th>
                                            <th style="background:#e9ebee;margin:0;padding:10px 5px;width:80px">Tiết kiệm</th>
                                            <th style="background:#e9ebee;margin:0;padding:10px 5px;width:80px">Ảnh minh hoạ</th>
                                            <th style="background:#e9ebee;margin:0;padding:10px 5px;width:80px">Thành tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody style="margin:0;padding:0">
                                        @if(isset($data['dataListProduct']))
                                            @foreach($data['dataListProduct'] as $key => $item)
                                            <tr style="margin:0;padding:0" class="word-wrap">
                                                <td class="m_-7286815952245177816m_17059706780914326info-td" style="border:1px solid #e9ebee;margin:0;padding:10px;text-align:left">
                                                    <a class="m_-7286815952245177816m_17059706780914326title" style="color:#006cff;display:block;margin:0;margin-bottom:5px;padding:0;text-decoration:none">
                                                    {{ $item['name'] }}
                                                    </a>
                                                    <div class="m_-7286815952245177816m_17059706780914326note" style="color:#b11e22;margin:0;margin-bottom:5px;padding:0"></div>
                                                    Số lượng: {{ $item['quantity'] }}
                                                </td>
                                                <td class="m_-7286815952245177816m_17059706780914326price-val-td" style="border:1px solid #e9ebee;margin:0;padding:10px;text-align:right">
                                                    {{ ceil( (float)$item['price'] * (float)$data['dataTransaction']['exchange_rate']) }}
                                                    <sup style="margin:0;padding:0">đ</sup>
                                                </td>
                                                <td class="m_-7286815952245177816m_17059706780914326price-val-td" style="border:1px solid #e9ebee;margin:0;padding:10px;text-align:right">
                                                    {{ ceil( (float)$item['price_save'] * (float)$data['dataTransaction']['exchange_rate']) }}
                                                    <sup style="margin:0;padding:0">đ</sup>
                                                </td>
                                                <td class="m_-7286815952245177816m_17059706780914326price-val-td" style="border:1px solid #e9ebee;margin:0;padding:10px;text-align:right; width: 100px">
                                                    <img src="{{ $item['img'] }}">
                                                </td>
                                                <td class="m_-7286815952245177816m_17059706780914326price-val-td" style="border:1px solid #e9ebee;margin:0;padding:10px;text-align:right">
                                                    {{ ceil(((float)$item['price'] * (float)$data['dataTransaction']['exchange_rate']) * $item['quantity']) }}
                                                    <sup style="margin:0;padding:0">đ</sup>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @endif
                                        <tr style="margin:0;padding:0" class="word-wrap">
                                            <td colspan="4" class="m_-7286815952245177816m_17059706780914326info-td" style="border:1px solid #e9ebee;margin:0;padding:10px;text-align:right">Phụ phí đơn hàng
                                            </td>
                                            <td class="m_-7286815952245177816m_17059706780914326price-val-td" style="border:1px solid #e9ebee;margin:0;padding:10px;text-align:right">
                                                
                                            </td>
                                        </tr>
                                        <tr style="margin:0;padding:0" class="word-wrap">
                                            <td colspan="4" class="m_-7286815952245177816m_17059706780914326info-td" style="border:1px solid #e9ebee;margin:0;padding:10px;text-align:right">Phí xử lý giao dịch
                                            </td>
                                            <td class="m_-7286815952245177816m_17059706780914326price-val-td" style="border:1px solid #e9ebee;margin:0;padding:10px;text-align:right">
                                                
                                            </td>
                                        </tr>
                                        <tr style="margin:0;padding:0" class="word-wrap">
                                            <td colspan="4" class="m_-7286815952245177816m_17059706780914326info-td" style="border:1px solid #e9ebee;margin:0;padding:10px;text-align:right">Phí thu tiền tại nhà
                                            </td>
                                            <td class="m_-7286815952245177816m_17059706780914326price-val-td" style="border:1px solid #e9ebee;margin:0;padding:10px;text-align:right">
                                                
                                            </td>
                                        </tr>
                                        <tr style="margin:0;padding:0" class="word-wrap">
                                            <td colspan="4" class="m_-7286815952245177816m_17059706780914326info-td" style="border:1px solid #e9ebee;margin:0;padding:10px;text-align:right">Tổng cộng chi phí khi về Việt Nam
                                            </td>
                                            <td class="m_-7286815952245177816m_17059706780914326price-val-td" style="border:1px solid #e9ebee;margin:0;padding:10px;text-align:right">
                                                {{ $data['dataTransaction']['total_price_in_vn'] }}
                                                <sup style="margin:0;padding:0">đ</sup>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <!-- <tfoot style="margin:0;padding:0">
                                        <tr style="margin:0;padding:0">
                                            <td class="m_-7286815952245177816m_17059706780914326text-right" colspan="6" style="border:1px solid #e9ebee;margin:0;padding:10px;text-align:right!important">Tổng cộng</td>
                                            <td class="m_-7286815952245177816m_17059706780914326price-val-td" style="border:1px solid #e9ebee;margin:0;padding:10px;text-align:right"><span class="m_-7286815952245177816m_17059706780914326text-red" style="color:#b11e22;margin:0;padding:0">676,546<sup style="margin:0;padding:0">đ</sup></span></td>
                                        </tr>
                                        <tr style="margin:0;padding:0">
                                            <td class="m_-7286815952245177816m_17059706780914326text-right" colspan="6" style="border:1px solid #e9ebee;margin:0;padding:10px;text-align:right!important">Phụ phí đơn hàng <span class="m_-7286815952245177816m_17059706780914326text-red" style="color:#b11e22;margin:0;padding:0">(*)</span></td>
                                            <td class="m_-7286815952245177816m_17059706780914326price-val-td" style="border:1px solid #e9ebee;margin:0;padding:10px;text-align:right">+ 15,107<sup style="margin:0;padding:0">đ</sup></td>
                                        </tr>
                                        <tr style="margin:0;padding:0">
                                            <td class="m_-7286815952245177816m_17059706780914326text-right" colspan="6" style="border:1px solid #e9ebee;margin:0;padding:10px;text-align:right!important">Phí xử lý giao dịch
                                                <span class="m_-7286815952245177816m_17059706780914326text-red" style="color:#b11e22;margin:0;padding:0">(*)</span>
                                            </td>
                                            <td class="m_-7286815952245177816m_17059706780914326price-val-td" style="border:1px solid #e9ebee;margin:0;padding:10px;text-align:right">+ 14,409<sup style="margin:0;padding:0">đ</sup></td>
                                        </tr>
                                        <tr style="margin:0;padding:0">
                                            <td class="m_-7286815952245177816m_17059706780914326text-right" colspan="6" style="border:1px solid #e9ebee;margin:0;padding:10px;text-align:right!important">Phí thu tiền tại
                                                nhà
                                            </td>
                                            <td class="m_-7286815952245177816m_17059706780914326price-val-td" style="border:1px solid #e9ebee;margin:0;padding:10px;text-align:right">+ 30,000<sup style="margin:0;padding:0">đ</sup></td>
                                        </tr>
                                        <tr style="margin:0;padding:0">
                                            <td class="m_-7286815952245177816m_17059706780914326text-right" colspan="6" style="border:1px solid #e9ebee;margin:0;padding:10px;text-align:right!important"><b style="margin:0;padding:0">Tổng cộng chi phí đơn hàng khi về
                                                Việt Nam</b>
                                            </td>
                                            <td class="m_-7286815952245177816m_17059706780914326price-val-td" style="border:1px solid #e9ebee;margin:0;padding:10px;text-align:right"><b class="m_-7286815952245177816m_17059706780914326text-red" style="color:#b11e22;margin:0;padding:0">736,042<sup style="margin:0;padding:0">đ</sup></b></td>
                                        </tr>
                                        <tr>
                                            <td class="m_-7286815952245177816m_17059706780914326text-right" colspan="6" style="border:1px solid #e9ebee;margin:0;padding:10px;text-align:right!important"><b style="margin:0;padding:0">Phải thanh toán trước</b></td>
                                            <td class="m_-7286815952245177816m_17059706780914326price-val-td" style="border:1px solid #e9ebee;margin:0;padding:10px;text-align:right"><b class="m_-7286815952245177816m_17059706780914326text-red" style="color:#b11e22;margin:0;padding:0">240,544<sup style="margin:0;padding:0">đ</sup></b></td>
                                        </tr>
                                        <tr style="margin:0;padding:0">
                                            <td class="m_-7286815952245177816m_17059706780914326text-right" colspan="6" style="border:1px solid #e9ebee;margin:0;padding:10px;text-align:right!important"><b style="margin:0;padding:0">Số tiền còn lại phải thanh
                                                toán</b>
                                            </td>
                                            <td class="m_-7286815952245177816m_17059706780914326price-val-td" style="border:1px solid #e9ebee;margin:0;padding:10px;text-align:right"><b class="m_-7286815952245177816m_17059706780914326text-red" style="color:#b11e22;margin:0;padding:0">495,498<sup style="margin:0;padding:0">đ</sup></b></td>
                                        </tr>
                                    </tfoot> -->
                                </table>
                                <table class="m_-7286815952245177816m_17059706780914326row-4-tb" style="border-collapse:collapse;line-height:24px;margin:0;margin-bottom:20px;padding:0;text-align:left;width:100%">
                                    <tbody style="margin:0;padding:0">
                                        <tr style="margin:0;padding:0">
                                            <td style="margin:0;padding:0">
                                                <div class="m_-7286815952245177816m_17059706780914326title" style="font-size:14px;font-weight:700;margin:0;padding:0">Ghi chú:</div>
                                                <div class="m_-7286815952245177816m_17059706780914326line" style="height:3px;line-height:3px;margin:0;margin-bottom:8px;padding:0"><img src="https://ci5.googleusercontent.com/proxy/vmiPp2IHzg1oVtTpz7T4ZsGvnQPqo2YVjM1ym4-lt8cZ07_6-RkDSH1lkz9r_XPXV95tN-v1NFqRgx7acJPyTnKQ6AY=s0-d-e1-ft#http://static.fado.vn/email/v1/images/line.png" alt="" style="display:inline;margin:0;padding:0;vertical-align:middle" class="CToWUd"><br style="margin:0;padding:0"></div>
                                                <b style="margin:0;padding:0">Phí xử lý giao dịch:</b> [3%] giá
                                                sản phẩm sau thuế Mỹ/ Nhật/ Đức<br style="margin:0;padding:0">
                                                <b style="margin:0;padding:0">Phụ phí đơn hàng</b> là số tiền
                                                cộng thêm để đạt phí mua hộ(phí thông quan, phí vận
                                                chuyển của đơn) tối thiểu $10 cho đơn hàng. Quý khách có thể
                                                chọn mua thêm sản phẩm để trừ phụ phí
                                                này
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
    <tfoot style="margin:0;padding:0">
        <tr style="margin:0;padding:0">
            <td style="margin:0;padding:0 20px">
                <table class="m_-7286815952245177816m_17059706780914326footer-info-tb" style="border-collapse:collapse;margin:0;padding:0;width:100%">
                    <tbody style="margin:0;padding:0">
                        <tr style="margin:0;padding:0">
                            <td style="margin:0;padding:0">
                                <table class="m_-7286815952245177816m_17059706780914326row-1-tb" style="border-collapse:collapse;margin:0;margin-bottom:20px;padding:0;width:100%">
                                    <tbody style="margin:0;padding:0">
                                        <tr style="margin:0;padding:0">
                                            <td class="m_-7286815952245177816m_17059706780914326col-2-td" style="margin:0;padding:0 6.5px;width:33.3333%">
                                                <img src="https://ci3.googleusercontent.com/proxy/BmMkw2mr198gHqyPHElUuBiTjGVHFR3B5F5V6GQEeE4xsmyx6Un4tf6QVP4gRu66jd0503dcKqTjeoTgTerrVMoSAiqtMX7y6wTsFQ=s0-d-e1-ft#http://static.fado.vn/email/v1/images/img-banner-2.png" alt="" style="display:inline;height:100px;margin:0;padding:0;vertical-align:middle;width:100%" class="CToWUd">
                                            </td>
                                            <td class="m_-7286815952245177816m_17059706780914326col-3-td" style="margin:0;padding:0;padding-left:13px;width:33.3333%">
                                                <img src="https://ci6.googleusercontent.com/proxy/BsuCjjqNSMKIzfGweKdW4DMxmiVErAzHdVjfr_wz97eew3hmv--WYRNzRtdcN61PzlooeQxJ-ty_LOG_-6KzfmhyyY_zxn7PYlG7Bg=s0-d-e1-ft#http://static.fado.vn/email/v1/images/img-banner-3.png" alt="" style="display:inline;height:100px;margin:0;padding:0;vertical-align:middle;width:100%" class="CToWUd">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="m_-7286815952245177816m_17059706780914326row-2-tb" style="border-collapse:collapse;line-height:24px;margin:0;margin-bottom:20px;padding:0;text-align:left;width:100%">
                                    <tbody style="margin:0;padding:0">
                                        <tr style="margin:0;padding:0">
                                            <td style="margin:0;padding:0">
                                                Summoshipping trân trọng cảm ơn và rất hân hạnh được phục vụ Quý
                                                khách.<br style="margin:0;padding:0">
                                                Mọi thắc mắc và góp ý, xin Quý khách vui lòng liên hệ với
                                                chúng tôi qua:<br style="margin:0;padding:0">
                                                Email hỗ trợ: <b style="margin:0;padding:0"><a href="support@summoshipping.vn" target="_blank">support@summoshipping.vn</a></b> hoặc <br style="margin:0;padding:0">
                                                Tổng đài tư vấn miễn phí: <b style="margin:0;padding:0">xxxx xxxx (Hồ Chí Minh)</b>  - <b style="margin:0;padding:0">xxxx xxxx (Hà
                                                Nội)</b>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="m_-7286815952245177816m_17059706780914326footer-tb" style="border-collapse:collapse;margin:0;padding:0;width:100%">
                    <tbody style="margin:0;padding:0">
                        <tr style="margin:0;padding:0">
                            <td style="background:#e9ebee;border-top:3px solid #b11e22;margin:0;padding:0">
                                <table class="m_-7286815952245177816m_17059706780914326row-1-tb" style="border-collapse:collapse;margin:0;margin-bottom:5px;padding:0;width:100%">
                                    <tbody style="margin:0;padding:0">
                                        <tr style="margin:0;padding:0">
                                            <td style="line-height:40px;margin:0;padding:0 10px"><a href="#" style="color:#333;margin:0;padding:0;text-decoration:none" target="_blank" data-saferedirecturl="#">Phương
                                                thức thanh toán</a>
                                            </td>
                                            <td style="line-height:40px;margin:0;padding:0 10px">|</td>
                                            <td style="line-height:40px;margin:0;padding:0 10px"><a href="#" style="color:#333;margin:0;padding:0;text-decoration:none" target="_blank" data-saferedirecturl="#">Hướng dẫn mua
                                                hàng</a>
                                            </td>
                                            <td style="line-height:40px;margin:0;padding:0 10px">|</td>
                                            <td style="line-height:40px;margin:0;padding:0 10px"><a href="#" style="color:#333;margin:0;padding:0;text-decoration:none" target="_blank" data-saferedirecturl="#">Hỗ trợ khách hàng</a></td>
                                            <td style="line-height:40px;margin:0;padding:0 10px">|</td>
                                            <td style="line-height:40px;margin:0;padding:0 10px"><a href="#" style="color:#333;margin:0;padding:0;text-decoration:none" target="_blank" data-saferedirecturl="#">Cách thức mua
                                                hàng</a>
                                            </td>
                                            <td style="line-height:40px;margin:0;padding:0 10px">|</td>
                                            <td style="line-height:40px;margin:0;padding:0 10px"><a href="#" style="color:#333;margin:0;padding:0;text-decoration:none" target="_blank" data-saferedirecturl="#">Liên
                                                hệ</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="m_-7286815952245177816m_17059706780914326row-2-tb" style="border-collapse:collapse;margin:0;margin-bottom:20px;padding:0;width:100%">
                                    <tbody style="margin:0;padding:0">
                                        <tr style="margin:0;padding:0">
                                            <td style="line-height:20px;margin:0;padding:0">
                                                Bản quyền © 2016 - 2020. Sumoshipping.vn - Sàn thương mại điện tử
                                                xuyên biên giới hàng đầu Việt Nam<br style="margin:0;padding:0">
                                                Chịu trách nhiệm: Sumoshipping Việt Nam
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="m_-7286815952245177816m_17059706780914326row-3-tb" style="border-collapse:collapse;margin:0;padding:0;width:100%">
                                    <tbody style="margin:0;padding:0">
                                        <tr style="margin:0;padding:0">
                                            <td style="margin:0;padding:0 10px 20px;text-align:left;width:33.3333%">
                                                <div class="m_-7286815952245177816m_17059706780914326title" style="font-weight:700;margin:0;margin-bottom:7px;padding:0">Trụ sở TP. Hồ Chí Minh</div>
                                                85 Thăng Long, Phường 4, Quận Tân Bình, Tp Hồ Chí Minh <i>(
                                                Cổng Phan Thúc Duyện, góc đường Thăng Long, Phan Thúc
                                                Duyện)</i>
                                            </td>
                                            <td style="margin:0;padding:0 10px 20px;text-align:left;width:33.3333%">
                                                <div class="m_-7286815952245177816m_17059706780914326title" style="font-weight:700;margin:0;margin-bottom:7px;padding:0">Trụ sở TP. Hà Nội</div>
                                                Số 4, Ngõ 26, Nguyên Hồng, Đống Đa, Hà Nội.
                                            </td>
                                            <td style="margin:0;padding:0 10px 20px;text-align:left;width:33.3333%">
                                                <div class="m_-7286815952245177816m_17059706780914326title" style="font-weight:700;margin:0;margin-bottom:7px;padding:0">Trụ sở TP. Đà Nẵng</div>
                                                75 Lư Giang, P. Hòa Xuân, Quận Cẩm lệ, TP Đà
                                                Nẵng.
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="m_-7286815952245177816m_17059706780914326note-tb" style="border-collapse:collapse;margin:0;padding:0;width:100%">
                    <tbody style="margin:0;padding:0">
                        <tr style="margin:0;padding:0">
                            <td style="font-style:italic;line-height:40px;margin:0;padding:0">
                                Đây là mail tự động, Quý khách vui lòng không trả lời
                                .
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="m_-7286815952245177816m_17059706780914326note-tb" style="border-collapse:collapse;margin:0;padding:0;width:100%">
                    <tbody style="margin:0;padding:0">
                        <tr style="margin:0;padding:0">
                            <td style="font-style:italic;line-height:40px;margin:0;padding:0">
                                <a style="font-size:11px;color:#a5a5a5">Unsubscribe</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tfoot>
</table>
@endif

</body>
