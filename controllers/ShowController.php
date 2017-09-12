<?php
/**
 * Created by PhpStorm.
 * User: Phong
 * Date: 6/14/2017
 * Time: 2:10 PM
 */

namespace app\controllers;

use app\components\Curl;
use yii\web\Controller;
use yii\web\response;

class ShowController extends Controller {
	public function actionIndex() {
		return $this->render('index.php');
	}

	public function actionTest() {
		\Yii::$app->response->format = Response::FORMAT_JSON;
		$url = "https://exchangeno1.com";
		$curl = new Curl();
		$string = $curl->get($url);
		$buy_start = '<span class="text-success">';
		$buy_end = ' VND';
		$data_buy = $curl->get_string_between_all($string, $buy_start, $buy_end);

		$sell_start = '<i class="fa fa-angle-double-right fa-fw" aria-hidden="true"></i> ';
		$sell_end = ' VND';
		$data_sell = $curl->get_string_between_all($string, $sell_start, $sell_end);
		$data = [
			'data_buy' => $data_buy,
			'data_sell' => $data_sell,
		];
		return $data;
	}

	public function actionExchangno1() {
		\Yii::$app->response->format = Response::FORMAT_JSON;
		$url = "https://exchangeno1.com";
		$curl = new Curl();
		$string = $curl->get($url);
		$buy_start = '<span class="text-success">';
		$buy_end = ' VND';
		$data_buy = $curl->get_string_between_all($string, $buy_start, $buy_end);

		$sell_start = '<i class="fa fa-angle-double-right fa-fw" aria-hidden="true"></i> ';
		$sell_end = ' VND';
		$data_sell = $curl->get_string_between_all($string, $sell_start, $sell_end);
		$data = [
			'data_buy' => $data_buy,
			'data_sell' => $data_sell,
		];
		return $data;
	}

	public function actionMmo4me() {
		\Yii::$app->response->format = Response::FORMAT_JSON;
		$curl = new Curl();
		$data = $curl->get("https://santienao.com/api/v1/rates/buy_sell.json");
		$content = json_decode($data, true);
		$result = array();
		$result = [
			'data_buy' => $content['asks'],
			'data_sell' => $content['bids'],
		];
		return $result;
	}

	public function actionSantienao() {
		\Yii::$app->response->format = Response::FORMAT_JSON;
		$curl = new Curl();
		// $data = $curl->get("https://santienao.com/api/v1/rates.json");
		$data = $curl->get("https://santienao.com/api/v1/rates.json");
		$content = json_decode($data, true);

		$data_buy = [
			'btc' => $content['ask_btc'],
			'btce' => $content['ask_btce'],
			'wmz' => $content['ask_wmz'],
			'pm' => $content['ask_pm'],
			'eth' => $content['ask_eth'],
		];

		$data_sell = [
			'btc' => $content['bid_btc'],
			'btce' => $content['bid_btce'],
			'wmz' => $content['bid_wmz'],
			'pm' => $content['bid_pm'],
			'eth' => $content['bid_eth'],
		];

		$result = array();
		$result = [
			'data_buy' => $data_buy,
			'data_sell' => $data_sell,
		];
		return $result;
	}

	public function actionTiktakbtc() {
		\Yii::$app->response->format = Response::FORMAT_JSON;
		$curl = new Curl();

		//data bitcoin
		$string = $curl->get('https://tiktakbtc.com/coin/BTC/VCB');
		$startUsdt = '<span class="label">Mua</span> <a href="https://tiktakbtc.com/coin/USDT/VCB">';
		$endUsdt = '</a>';
		$usdt = $curl->get_string_between_all($string, $startUsdt, $endUsdt);

		$startUsdt1 = '<span class="label">Bán</span> <a href="https://tiktakbtc.com/coin/USDT/VCB">';
		$endUsdt1 = '</a>';
		$usdt1 = $curl->get_string_between_all($string, $startUsdt1, $endUsdt1);

		$usdt_buy = $usdt[0];
		$usdt_sell = $usdt1[0];

		// $btce_sell = $btce[1];
		$josn = $curl->get('https://tiktakbtc.com/api/ty-gia');
		$data = json_decode($josn);

		$data_buy = [
			'btc' => $data->BTC->Mua,
			'eth' => $data->ETH->Mua,
			'ltc' => $data->LTC->Mua,
			'usdt' => $usdt_buy,
		];

		$data_sell = [
			'btc' => $data->BTC->Ban,
			'eth' => $data->ETH->Ban,
			'ltc' => $data->LTC->Ban,
			'usdt' => $usdt_sell,
		];

		$result = [
			'data_buy' => $data_buy,
			'data_sell' => $data_sell,
		];
		return $result;
	}

	public function actionEx24h() {
		\Yii::$app->response->format = Response::FORMAT_JSON;
		$curl = new Curl();

		$string = $curl->get('https://ex24h.com/api/v1/rates.json');
		$data = json_decode($string, true);

		//data sell
		// $btc_sell = $data['bid_btc'];
		// $btce_sell = $data['bid_btce'];
		// $eth_sell = $data['bid_eth'];
		$pm_sell = $data['bid_pm'];
		$data_sell = array();
		$data_sell = [
			// 'btc' => $btc_sell,
			// 'btce' => $btce_sell,
			// 'eth' => $eth_sell,
			'pm' => $pm_sell,
		];

		//data buy
		// $btc_buy = $data['ask_btc'];
		// $btce_buy = $data['ask_btce'];
		// $eth_buy = $data['ask_eth'];
		$pm_buy = $data['ask_pm'];
		$data_buy = array();
		$data_buy = [
			// 'btc' => $btc_buy,
			// 'btce' => $btce_buy,
			// 'eth' => $eth_buy,
			'pm' => $pm_buy,
		];

		$result = array();
		$result = [
			'data_buy' => $data_buy,
			'data_sell' => $data_sell,
		];
		return $result;
	}

	public function actionBitcoinvietnam() {
		\Yii::$app->response->format = Response::FORMAT_JSON;
		$curl = new Curl();
		$string = $curl->get('https://www.bitcoinvietnam.com.vn/user/login/buy');

		$startBitBuy = 'Mua - <span class="label label-success">';
		$endBitBuy = ' VND</span>';
		$btc_buy = $curl->get_string_between($string, $startBitBuy, $endBitBuy);

		$startBitSell = 'Bán - <span class="label label-danger">';
		$endBitSell = ' VND</span>';
		$btc_sell = $curl->get_string_between($string, $startBitSell, $endBitSell);

		$result = array();
		$result = [
			'btc_buy' => $btc_buy,
			'btc_sell' => $btc_sell,
		];
		return $result;
	}

	public function actionExbtcvn() {
		\Yii::$app->response->format = Response::FORMAT_JSON;
		$curl = new Curl();
		$string_bit = $curl->get('https://www.exbtcvn.com/');
		// data eth
		$startBitBuy = '<th colspan="3">MUA ETH</th>';
		$endBitBuy = '</tbody>';
		$data_eth_buy = $curl->get_string_between($string_bit, $startBitBuy, $endBitBuy);

		$startBitBuy = '<th colspan="3">BÁN ETH</th>';
		$endBitBuy = '</tbody>';
		$data_eth_sell = $curl->get_string_between($string_bit, $startBitBuy, $endBitBuy);

		// data pm
		$startBitBuy = '<th colspan="3">MUA PM</th>';
		$endBitBuy = '</tbody>';
		$data_pm_buy = $curl->get_string_between($string_bit, $startBitBuy, $endBitBuy);

		$startBitBuy = '<th colspan="3">BÁN PM</th>';
		$endBitBuy = '</tbody>';
		$data_pm_sell = $curl->get_string_between($string_bit, $startBitBuy, $endBitBuy);

		//DATA ETH
		$data_eth_buy = explode(" ", $data_eth_buy);
		$a = array();
		$b = array();
		for ($i = 0; $i < count($data_eth_buy); $i++) {
			if (!($data_eth_buy[$i] == '')) {
				preg_match("/[0-9,.]+/", $data_eth_buy[$i], $a[$i]);
				if (!empty($a[$i])) {
					array_push($b, $a[$i]);
				}
			}
		}
		$eth_buy = array(
			'from' => $b[0][0],
			'to' => $b[1][0],
			'price' => $b[2][0],
		);

		$data_eth_sell = explode(" ", $data_eth_sell);
		$a = array();
		$b = array();
		for ($i = 0; $i < count($data_eth_sell); $i++) {
			if (!($data_eth_sell[$i] == '')) {
				preg_match("/[0-9,.]+/", $data_eth_sell[$i], $a[$i]);
				if (!empty($a[$i])) {
					array_push($b, $a[$i]);
				}
			}
		}
		$eth_sell = array(
			'from' => $b[0][0],
			'to' => $b[1][0],
			'price' => $b[2][0],
		);

		// DATA PM
		$data_pm_buy = explode(" ", $data_pm_buy);
		$a = array();
		$b = array();
		$pm_buy = array();
		for ($i = 0; $i < count($data_pm_buy); $i++) {
			if (!($data_pm_buy[$i] == '')) {
				preg_match("/[0-9,.]+/", $data_pm_buy[$i], $a[$i]);
				if (!empty($a[$i])) {
					array_push($b, $a[$i]);
				}
			}
		}
		for ($i = 0; $i < count($b); $i++) {
			array_push($pm_buy, $b[$i][0]);
		}

		$data_pm_sell = explode(" ", $data_pm_sell);
		$a = array();
		$b = array();
		$pm_sell = array();
		for ($i = 0; $i < count($data_pm_sell); $i++) {
			if (!($data_pm_sell[$i] == '')) {
				preg_match("/[0-9,.]+/", $data_pm_sell[$i], $a[$i]);
				if (!empty($a[$i])) {
					array_push($b, $a[$i]);
				}
			}
		}
		for ($i = 0; $i < count($b); $i++) {
			array_push($pm_sell, $b[$i][0]);
		}
		$result = array();
		$result = [
			'eth_buy' => $eth_buy,
			'eth_sell' => $eth_sell,
			'pm_buy' => $pm_buy,
			'pm_sell' => $pm_sell,
		];
		return $result;
	}

	public function actionVnexmoney() {
		\Yii::$app->response->format = Response::FORMAT_JSON;
		$curl = new Curl();
		$html = $curl->get('https://vnexmoney.com/');
		//VND
		$start1 = "<div class=\"vnd\">";
		$end1 = "VND						</div>";
		$currencyUnit = $curl->get_string_between_all($html, $start1, $end1);
		//CURRENCY
		$start2 = "<div class=\"currency\">";
		$end2 = "						</div>";
		$currency = $curl->get_string_between_all($html, $start2, $end2);
		$result = array($currencyUnit, $currency);
		return $result;

	}

	public function actionMuabantienao() {
		\Yii::$app->response->format = Response::FORMAT_JSON;
		$curl = new Curl();
		//data buy
		$string = $curl->get('http://muabantienao.com/rate.html');
		$start_buy = "td align=\"center\"> ";
		$end_buy = " VND = 1";
		$result_buy = $curl->get_string_between_all($string, $start_buy, $end_buy);
		$array_buy = [];
		$data_buy = [];
		foreach ($result_buy as $item) {
			$array_buy = explode(' ', $item);
			array_push($data_buy, $array_buy);
		}

		$start_sell = '<td align="center"> 1 ';
		$end_sell = " VND</td>";
		$result_sell = $curl->get_string_between_all($string, $start_sell, $end_sell);
		$array_sell = [];
		$data_sell = [];
		foreach ($result_sell as $item) {
			$array_sell = explode(' ', $item);
			array_push($data_sell, $array_sell);
		}

		$response = [
			'data_buy' => $data_buy,
			'data_sell' => $data_sell,
		];

		return $response;
	}

	public function actionHamirex() {
		$curl = new Curl();
		//data buy
		$data = $curl->get('https://hamirex.org/api/v1/rates.json');
		return $data;
	}

	public function actionBuyselleth() {
		$curl = new Curl();
		//data buy
		$string = $curl->get('https://buyselleth.com/api/v1/rates.json');
		return $string;
	}

	public function actionThumuatienao() {
		\Yii::$app->response->format = Response::FORMAT_JSON;
		$curl = new Curl();
		$data = $curl->get('http://thumuatienao.com/api/v1/rates.json');
		$data_coin = json_decode($data, true);
		array_splice($data_coin, 2, 1);
		$array_sell = [];
		$array_buy = [];
		$array_name = ["BTCE", "BTC", "ETH"];
		foreach ($data_coin as $key => $value) {
			if (strpos($key, "bid_") !== false) {
				array_push($array_sell, $value);
			} else {
				array_push($array_buy, $value);
			}
		}
		$data_thumuatienao = [];
		for ($i = 0; $i < count($array_sell); $i++) {
			$data_thumuatienao[] = [
				"name" => $array_name[$i],
				"sell" => $array_sell[$i],
				"buy" => $array_buy[$i],
			];
		}
		return $data_thumuatienao;
	}

	public function actionVncex() {
		\Yii::$app->response->format = Response::FORMAT_JSON;
		$curl = new Curl();
		$data_btc = $curl->get('http://vncex.com/coin/BTC/ty-gia');
		$data_coin_btc = json_decode($data_btc, true);

		$data_btc = $curl->get('http://vncex.com/coin/ETH/ty-gia');
		$data_coin_eth = json_decode($data_btc, true);

		$data_btc = $curl->get('http://vncex.com/coin/LTC/ty-gia');
		$data_coin_ltc = json_decode($data_btc, true);

		$data_btc = $curl->get('https://www.vncex.com/coin/USDT/ty-gia');
		$data_coin_usdt = json_decode($data_btc, true);

		$array_buy = [];
		$array_sell = [];
		$array_coin = ["BTC", "ETH", "LTC", "USDT"];
		$array_vncex = [];
		array_push($array_buy, $data_coin_btc["Mua"], $data_coin_eth["Mua"], $data_coin_ltc["Mua"], $data_coin_usdt["Mua"]);
		array_push($array_sell, $data_coin_btc["Ban"], $data_coin_eth["Ban"], $data_coin_ltc["Ban"], $data_coin_usdt["Ban"]);
		for ($i = 0; $i < count($array_sell); $i++) {
			$array_vncex[] = [
				'name' => $array_coin[$i],
				'Buy' => $array_buy[$i],
				'Sell' => $array_sell[$i],
			];
		}
		return $array_vncex;

	}

	public function actionMuabitcoin() {
		$curl = new Curl();
		$string = $curl->get('https://mua-bitcoin.com/ajax_rate/');
		return $string;
	}

	public function actionBanwmz() {
		\Yii::$app->response->format = Response::FORMAT_JSON;
		$curl = new Curl();
		$data = $curl->get("https://banwmz.com/");
		preg_match("/<span class\=\"rate-buy\">Buy (.*?)<\/span>/si", $data, $buy);
		preg_match("/<span class\=\"rate-sell\">Sell (.*?)<\/span>/si", $data, $sell);
		$result = [
			'buy' => $buy[1],
			'sell' => $sell[1],
		];
		return $result;
	}

	public function actionBanpm() {
		\Yii::$app->response->format = Response::FORMAT_JSON;
		$curl = new Curl();
		$data = $curl->get("https://banpm.com/");
		preg_match("/<span class\=\"rate-buy\">Buy (.*?)<\/span>/si", $data, $buy);
		preg_match("/<span class\=\"rate-sell\">Sell (.*?)<\/span>/si", $data, $sell);
		$result = [
			'buy' => $buy[1],
			'sell' => $sell[1],
		];
		return $result;
	}

	public function actionMuatienao() {
		\Yii::$app->response->format = Response::FORMAT_JSON;
		$curl = new Curl();
		$string_bit = $curl->get('https://muatienao.com/');
		$startBitBuy = '<div class="exchange-rate-vn">';
		$endBitBuy = '<div class="clear mt20 "></div>';
		$all_data = $curl->get_string_between($string_bit, $startBitBuy, $endBitBuy);

		$all_data = json_encode($all_data);
		$all_data = substr(preg_replace('/[^0-9, ]/', '', $all_data), 0, -1);
		$all_data = (explode(" ", $all_data));
		$all_data1 = array(
			'buy_pm' => $all_data[8],
			'sell_pm' => $all_data[20],
			'buy_wmz' => $all_data[64],
			'sell_wmz' => $all_data[76],
			'buy_btc' => $all_data[99],
			'sell_btc' => $all_data[111],
		);
		return $all_data1;
	}
	public function actionBosspm() {
		\Yii::$app->response->format = Response::FORMAT_JSON;
		$curl = new Curl();
		$html = $curl->get('https://bosspm.com/');
		$data = preg_match_all("/<div class\=\"exchange-rate-rate\" style\=\"color:#dd4b39\"><strong>(.*?)<\/strong>/si", $html, $result);
		$data1 = array(
			'buypm' => $result[1][3],
			'sellpm' => $result[1][2],
		);
		return $data1;
	}
	public function actionChimcugay() {
		\Yii::$app->response->format = Response::FORMAT_JSON;
		$curl = new Curl();
		$html = $curl->get('https://chimcugay.com/');
		$dataBuy = preg_match_all("/<span class\=\"fa fa-paper-plane-o\"><\/span>Mua vào: (.*?)<\/span>/si", $html, $resultSell);
		$dataSell = preg_match_all("/<span class\=\"fa fa-plus\"><\/span>Bán ra: (.*?)<\/span>/si", $html, $resultBuy);
		$buy = array(
			'btcB' => $resultBuy[1][0],
			'ethB' => $resultBuy[1][1],
			'ltcB' => $resultBuy[1][2],
			'xprB' => $resultBuy[1][3],
			'usdtB' => $resultBuy[1][4],
		);
		$sell = array(
			'btcS' => $resultSell[1][0],
			'ethS' => $resultSell[1][1],
			'ltcS' => $resultSell[1][2],
			'xprS' => $resultSell[1][3],
			'usdtS' => $resultSell[1][4],
		);
		$kq = array(
			'buy' => $buy,
			'sell' => $sell,

		);
		return $kq;
	}
}