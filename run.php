<?php 
include 'slackercode.php';
function headers($token = null) {
	$huruf = '0123456789ABCDEFGHIJKLMOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    	$uniq = '';
    	for ($i = 0; $i < 16; $i++) {
        $uniq .= $huruf[mt_rand(0, strlen($huruf) - 1)];
    	}

    if  ($token != "") {

        $headers = array(
        'Accept: application/json',
        'X-Session-ID: 28667f0c-80e8-43db-9ab4-c6d411f00a86',
        'X-AppVersion: 3.39.1',
        'X-AppId: com.gojek.app',
        'X-Platform: Android',
        'X-UniqueId: '.$uniq,
        'D1: 41:ED:AC:6E:29:0D:B2:24:C4:89:42:02:4D:C5:0F:33:72:DC:D1:9D:14:68:45:AD:84:9C:74:6E:3F:0E:8D:4C',
        'Authorization: Bearer '.$token,
        'X-DeviceOS: Android,8.1.0',
        'User-uuid: 654547255d',
        'X-DeviceToken: dTmJ6tjtkoE:APA91bGxQ4LePlAcxfk5s8UKuohf-M27J7qIUfYmjEbg47BhMOozw9yC7hbg7c0nHCSMMxxF_FS2m7-_fe27a_XUVwXWVV4wPEfZuelTH2x0OFLS6CQEil8c3SFGNLPjXCYLTQ-hZirW',
        'X-PushTokenType: FCM',
        'X-PhoneModel: xiaomi,Redmi 6',
        'Accept-Language: id-ID',
        'X-User-Locale: id_ID',
        'X-Location: -6.9212751658159934,107.62244586389556',
        'X-Location-Accuracy: 0.1',
        'X-M1: 1:__b7d2f5195e984b97943895084f44d115,2:c71b9b0b7d24,3:1571508895362-7518963721879435750,4:24519,5:mt6765|2001|8,6:0C:98:38:CB:1A:87,7:"XLGO-83C6",8:720x1344,9:passive\,network\,gps,10:0,11:sHLp9psghlEJimfsIzXKhptQnGhigYRUifllHhizjNg=',
        'Content-Type: application/json; charset=UTF-8',
        'Host: api.gojekapi.com',
        'User-Agent: okhttp/3.12.1'
        );

        return $headers;

    } else {

        $headers = array(
        'Accept: application/json',
        'D1: 41:ED:AC:6E:29:0D:B2:24:C4:89:42:02:4D:C5:0F:33:72:DC:D1:9D:14:68:45:AD:84:9C:74:6E:3F:0E:8D:4C',
        'X-Session-ID: 28667f0c-80e8-43db-9ab4-c6d411f00a86',
        'X-AppVersion: 3.39.1',
        'X-AppId: com.gojek.app',
        'X-Platform: Android',
        'X-UniqueId: '.$uniq,
        'Authorization: Bearer ',
        'X-DeviceOS: Android,8.1.0',
        'User-uuid: ',
        'X-DeviceToken: dTmJ6tjtkoE:APA91bGxQ4LePlAcxfk5s8UKuohf-M27J7qIUfYmjEbg47BhMOozw9yC7hbg7c0nHCSMMxxF_FS2m7-_fe27a_XUVwXWVV4wPEfZuelTH2x0OFLS6CQEil8c3SFGNLPjXCYLTQ-hZirW',
        'X-PushTokenType: FCM',
        'X-PhoneModel: xiaomi,Redmi 6',
        'Accept-Language: id-ID',
        'X-User-Locale: id_ID',
        'X-M1: 1:__b7d2f5195e984b97943895084f44d115,2:c71b9b0b7d24,3:1571508895362-7518963721879435750,4:24519,5:mt6765|2001|8,6:0C:98:38:CB:1A:87,7:"XLGO-83C6",8:720x1344,9:passive\,network\,gps,10:0,11:sHLp9psghlEJimfsIzXKhptQnGhigYRUifllHhizjNg=',
        'Content-Type: application/json; charset=UTF-8',
        'Host: api.gojekapi.com',
        'User-Agent: okhttp/3.12.1'
        );

        return $headers; 

    }

}

function register_gojek() {
     $fakename = curl('https://fakenametool.net/random-name-generator/random/id_ID/indonesia/1');
     preg_match('/<span>(.*?)<\/span>/s', $fakename, $name);
     $email = strtolower(str_replace(' ',  '', $name[1])).rand(0000,1111).'@gmail.com';

     echo "\n\e[0;37m[-] Nomor  : ";
     $number = trim(fgets(STDIN));
     $register = curl('https://api.gojekapi.com/v5/customers', '{"email":"'.$email.'","name":"'.$name[1].'","phone":"+'.$number.'","signed_up_country":"ID"}', headers());

    if (stripos($register, '"success":true')) {
        $otp_token = fetch_value($register,  '"otp_token":"', '"');
        echo "\e[0;37m[-] OTP : ";
        $otp_code = trim(fgets(STDIN));

        $verify = curl('https://api.gojekapi.com/v5/customers/phone/verify', '{"client_name":"gojek:cons:android","client_secret":"83415d06-ec4e-11e6-a41b-6c40088ab51e","data":{"otp":"'.$otp_code.'","otp_token":"'.$otp_token.'"}}', headers());

        if (stripos($verify, '"access_token"')) {
            $access_token = fetch_value($verify, '"access_token":"','"');
            
                  $claim1 = curl('https://api.gojekapi.com/go-promotions/v1/promotions/enrollments', '{"promo_code":"GOFOODSANTAI19"}', headers($access_token));
                  echo "\n\e[0;33m[-] Authorization Bearer : ".$access_token; 
                  echo "\n\n\e[0;37m[-] Mencoba Reedem Voucher 20k (25k) Pertama";
                    for ($i=0; $i < 3 ; $i++) { 
                        sleep(1);
                        echo ".";
                    }
                    echo "\n\e[45m[-] Everything is ok boss?\n";
                    sleep(3);
					if (stripos($claim1, '"success":true')) {	
                        echo "\e[0;32m[-] Berhasil Claim!\n";
                    } else {
                        echo "\e[0;31m[-] Gagal Claim!\n";
                }			
				  $claim2 = curl('https://api.gojekapi.com/go-promotions/v1/promotions/enrollments', '{"promo_code":"WADAWGOJEK"}', headers($access_token));
                  echo "\n\e[0;37m[-] Mencoba Reedem Voucher 20k Kedua";
                    for ($i=0; $i < 3 ; $i++) { 
                        sleep(1);
                        echo ".";
                    }
                    echo "\n\e[45m[-] Everything is ok boss?\n";
                    sleep(3);
					if (stripos($claim2, '"success":true')) {	
                        echo "\e[0;32m[-] Berhasil Claim!\n";
                    } else {
                        echo "\e[0;31m[-] Gagal Claim!\n";
                }			
					
          	
						
            } else { 
                echo "\n\e[0;31m[-] OTP SALAH BOSSKU\n";
            }
    } else {
        echo "\n\e[0;31m[-] Gagal Mendaftar No HP / Email Sudah Terdaftar\n";
    }
		
}
echo "\n\e[0;36m[-] KAWANBAJINGAN Tools - Gojek Register\n";
echo "\e[0;36m[-] KETERANGAN MINIMAL PEMBELIAN VOC = VOC 20(25) - VOC 15(20) - VOC 10(15)\n";
echo "\e[0;36m[-] Gunakan 62 Jika Memakai Nomor Indonesia & 1 Jika Memakai Nomor US\n";
echo "\e[0;36m[-] Jika Ada Pertanyaan, Contact Me => vladeastgaming@gmail.com\n";
register_gojek();

?>