<?php  
error_reporting(0);
include 'curl.php';


function referral($nomer, $password) {


	$headers = [
		'Host: gm88k.com',
		'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:80.0) Gecko/20100101 Firefox/80.0',
		'Accept: */*',
		'Accept-Language: id,en-US;q=0.7,en;q=0.3',
		'Connection: keep-alive',
		'X-Requested-With: XMLHttpRequest'
	];


	echo "[!] Try to login ".$nomer."\n";
	$login = curl('https://gm88k.com/index/user/do_login.html?btwaf=25484903', 'tel='.$nomer.'&pwd='.$password.'&jizhu=1', $headers);
	$cookies = getcookies($login);

	if (stripos($login, '"info":"login berhasil!"')) {


		echo "[!] Login success\n";
		$headerx = [
			'Host: gm88k.com',
			'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:80.0) Gecko/20100101 Firefox/80.0',
			'Accept: */*',
			'Accept-Language: id,en-US;q=0.7,en;q=0.3',
			'Connection: keep-alive',
			'Cookie: s9671eded='.$cookies['s9671eded'].'; tel='.$cookies['tel'].'; pwd='.$cookies['pwd'],
			'X-Requested-With: XMLHttpRequest'
		];

		for ($i = 0; $i < 30 ; $i++) {
			a:
			$add = curl('https://gm88k.com/index/rot_order/submit_order.html?cid=1&m=0.127095457810890'.number(2), null, $headerx);
			preg_match('/"oid":"(.*?)"/s', $add, $oid);


			$order_info = curl('https://gm88k.com/index/order/order_info', 'id='.$oid[1], $headerx);
			preg_match('/"add_id":(.*?),"/s', $order_info, $a000dd_id);
			$do = curl('https://gm88k.com/index/order/do_order', 'oid='.$oid[1].'&add_id='.$add_id[1], $headerx);
			if (stripos($do, '"info":"Operasi berhasil!"')) {
				echo "[!] Success ".$i+1;
				echo "/30\n";
			} else {
				echo $data = "[!] Failed\n";
			}

		}

	} else {
		echo "[!] Login failed\n";
	}
}




?>
