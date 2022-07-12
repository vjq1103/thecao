<?php 
	function aObj($aPayload){
		return json_decode(json_encode($aPayload));
	}
    function createRequest_Cuoc3MienCom($oPayload){
        $curl = curl_init();
		if($oPayload->selProvider == "vtt"){
			$urlRequest = "https://cuoc3mien.com/Service/S1ViettelRechargeController/createTask";
		}elseif($oPayload->selProvider == "vnp"){
			$urlRequest = "https://cuoc3mien.com/Service/S1VinaRechargeController/createTask";
		}else{
			$urlRequest = "https://cuoc3mien.com/Service/S1MobiRechargeController/createTask";
		}
		curl_setopt_array($curl, array(
		  CURLOPT_URL => $urlRequest,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_SSL_VERIFYPEER =>false,
		  CURLOPT_SSL_VERIFYHOST => false,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => json_encode([
			"authUsername" => $oPayload->authUsername,
			"authPassword" => $oPayload->authPassword,
			"txtCardValue" => $oPayload->txtCardValue,
			"txtCardNumber" => $oPayload->txtCardNumber,
			"txtCardSeri" => $oPayload->txtCardSeri
		  ]),
		  CURLOPT_HTTPHEADER => array(
			"Content-Type: application/json",
			"cache-control: no-cache",
			"Origin: https://cuoc3mien.com",
			"Referer: https://cuoc3mien.com",
		  ),
		));

		return $rs = curl_exec($curl);
    }
    function requestRecharge_Cuoc3MienCom($aPayload){
        $oPayload = aObj($aPayload);
        if(!isset($oPayload->authUsername) OR !isset($oPayload->authPassword) OR !isset($oPayload->selProvider) OR !isset($oPayload->txtCardNumber) OR !isset($oPayload->txtCardSeri) OR !isset($oPayload->txtCardValue)){
            return json_encode([
                "errorCode" => 0,
                "Bạn truyền thiếu tham số"
            ],JSON_UNESCAPED_UNICODE);
        }
        while(1){
            $res = json_decode(createRequest_Cuoc3MienCom($oPayload));
            if($res->errorCode == 1){
                return json_encode($res,JSON_UNESCAPED_UNICODE);
                break;
            }else{
                if($res->errorMessage == "Lỗi xác thực, vui lòng thử lại sau" OR $res->errorMessage == "Bảo trì hệ thống" OR $res->errorMessage == "Thẻ cào không hợp lệ hoặc đã được sử dụng" OR $res->errorMessage == "Dịch vụ của bạn bị khóa, vui lòng liên hệ Quản Trị Viên để giải quyết" OR $res->errorMessage == "Tài khoản bạn bị khóa, vui lòng liên hệ Quản Trị Viên để giải quyết" OR $res->errorMessage == "Vui lòng lựa chọn mệnh giá")    return json_encode($res, JSON_UNESCAPED_UNICODE);
            }
        }        
    }
?>