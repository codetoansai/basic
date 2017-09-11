<button id="reset" class="btn btn-success">Cập nhật giá coin</button>
<br><br>
<div class="row">
    <div class="col-md-6">
        <?php
echo $this->render('type-coin/btc.php');
?>
    </div>
    <div class="col-md-6">
<?php echo $this->render('type-coin/usdt.php'); ?>
    </div>
    <div class="">

    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <?php
echo $this->render('type-coin/dsh.php');
?>
    </div>
    <div class="col-md-6">
        <?php
echo $this->render('type-coin/ltc.php');
?>

    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <?php
echo $this->render('type-coin/eth.php');
?>
    </div>

    <div class="col-md-6">
        <?php
echo $this->render('type-coin/wmz.php');
?>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <?php
echo $this->render('type-coin/pm.php');
?>
    </div>
    <div class="col-md-6">
        <?php
echo $this->render('type-coin/bch.php');
?>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <?php
echo $this->render('type-coin/zec.php');
?>
    </div>
    <div class="col-md-6">
        <?php
echo $this->render('type-coin/etc.php');
?>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <?php
echo $this->render('type-coin/xrp.php');
?>
    </div>
    <div class="col-md-6">
        <?php
echo $this->render('type-coin/xmr.php');
?>
    </div>
</div>

<?php

$app_css = <<<CSS
table{
        width: 95%;
    }

    table tr th{
        border-bottom: 1px solid black;
        height:20px;
        padding-left: 10px;
        padding-right: 10px;
    }

    table tr td{
        border: 1px solid #b2b2b2;
        height: 35px;
        padding-left: 10px;
        padding-right: 10px;
    }

    .col-md-6{
        padding: 20px 0px;
    }
CSS;
$this->registerCss($app_css);

$app_js = <<<JS
$("#reset").click(function(){
    location.reload();
});
$(document).ready(function() {
        //Exchangeno1
        $.ajax({
            url: '../show/exchangno1',
            success: function (data) {
                $("#exchange_btc_buy").html(data.data_buy[0]);
                $("#exchange_btc_sell").html(data.data_sell[0]);
                $("#exchange_bch_buy").html(data.data_buy[1]);
                $("#exchange_bch_sell").html(data.data_sell[1]);
                $("#exchange_zec_buy").html(data.data_buy[3]);
                $("#exchange_zec_sell").html(data.data_sell[3]);
                $("#exchange_eth_buy").html(data.data_buy[2]);
                $("#exchange_eth_sell").html(data.data_sell[2]);
                $("#exchange_ltc_buy").html(data.data_buy[4]);
                $("#exchange_ltc_sell").html(data.data_sell[5]);
                $("#exchange_etc_buy").html(data.data_buy[5]);
                $("#exchange_pm_buy").html(data.data_buy[6]);
                $("#exchange_pm_sell").html(data.data_sell[6]);
                $("#exchange_etc_buy").html(data.data_buy[5]);
                $("#exchange_xmr_sell").html(data.data_sell[4]);
                $("#exchange_xrp_buy").html(data.data_buy[7]);
                $("#exchange_xrp_sell").html(data.data_sell[7]);

            }
        });

        //Mmo4me
        $.ajax({
            url: '../show/mmo4me',
            success: function (data) {
                //Fomat string
                var data_buy_btc = (data.data_buy.btc * 1000).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                var data_sell_btc = (data.data_sell.btc * 1000).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                var data_buy_btce = Math.round(data.data_buy.btce).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                var data_sell_btce = Math.round(data.data_sell.btce).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                var data_buy_wmz = Math.round(data.data_buy.wmz).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                var data_sell_wmz = Math.round(data.data_sell.wmz).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                var data_buy_pm = Math.round(data.data_buy.pm).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                var data_sell_pm = Math.round(data.data_sell.pm).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                var data_buy_eth = Math.round(data.data_buy.eth *1000).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                var data_sell_eth = Math.round(data.data_sell.eth*1000).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                $("#mmo4me_btc_buy").html(data_buy_btc);
                $("#mmo4me_btc_sell").html(data_sell_btc);
                $("#mmo4me_btce_buy").html(data_buy_btce);
                $("#mmo4me_btce_sell").html(data_sell_btce);
                $("#mmo4me_wmz_buy").html(data_buy_wmz);
                $("#mmo4me_wmz_sell").html(data_sell_wmz);
                $("#mmo4me_pm_buy").html(data_buy_pm);
                $("#mmo4me_pm_sell").html(data_sell_pm);
                $("#mmo4me_eth_buy").html(data_buy_eth);
                $("#mmo4me_eth_sell").html(data_sell_eth);
            }
        });

        //Santienao
        $.ajax({
            url: '../show/santienao',
            success: function (data) {
                //Fomat data
                var data_buy_btc = Math.round(data.data_buy.btc).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                var data_sell_btc = Math.round(data.data_sell.btc).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                var data_buy_btce = Math.round(data.data_buy.btce).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                var data_sell_btce = Math.round(data.data_sell.btce).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                var data_buy_wmz = Math.round(data.data_buy.wmz).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                var data_sell_wmz = Math.round(data.data_sell.wmz).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                var data_buy_pm = Math.round(data.data_buy.pm).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                var data_sell_pm = Math.round(data.data_sell.pm).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                var data_buy_eth = Math.round(data.data_buy.eth).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                var data_sell_eth = Math.round(data.data_sell.eth).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                $("#santienao_btc_buy").html(data_buy_btc);
                $("#santienao_btc_sell").html(data_sell_btc);
                $("#santienao_btce_buy").html(data_buy_btce);
                $("#santienao_btce_sell").html(data_sell_btce);
                $("#santienao_ltc_buy").html(data.data_buy.ltc);
                $("#santienao_ltc_sell").html(data.data_sell.ltc);
                $("#santienao_wmz_buy").html(data_buy_wmz);
                $("#santienao_wmz_sell").html(data_sell_wmz);
                $("#santienao_pm_buy").html(data_buy_pm);
                $("#santienao_pm_sell").html(data_sell_pm);
                $("#santienao_eth_buy").html(data_buy_eth);
                $("#santienao_eth_sell").html(data_sell_eth);
            }
        });

        //Tiktaskbtc
        $.ajax({
            url: '../show/tiktakbtc',
            success: function (data) {
                var btc_buy = data.data_buy.btc.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                var btc_sell = data.data_sell.btc.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                var eth_buy = data.data_buy.eth.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                var eth_sell = data.data_sell.eth.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                var ltc_buy = data.data_buy.ltc.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                var ltc_sell = data.data_sell.ltc.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $("#tiktakbtc_btc_buy").html(btc_buy);
                $("#tiktakbtc_btc_sell").html(btc_sell);
                $("#tiktakbtc_usdt_buy").html(data.data_buy.usdt);
                $("#tiktakbtc_usdt_sell").html(data.data_sell.usdt);
                $("#tiktakbtc_eth_buy").html(eth_buy);
                $("#tiktakbtc_eth_sell").html(eth_sell);
                $("#tiktakbtc_ltc_buy").html(ltc_buy);
                $("#tiktakbtc_ltc_sell").html(ltc_sell);
            }
        });

        //Ex24h
        $.ajax({
            url: '../show/ex24h',
            success: function (data) {
                //Fomat data
                // var data_buy_btc = data.data_buy.btc.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                // var data_sell_btc = data.data_sell.btc.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                // var data_buy_btce = data.data_buy.btce.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                // var data_sell_btce = data.data_sell.btce.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                // var data_buy_eth = data.data_buy.eth.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                // var data_sell_eth = data.data_sell.eth.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                var data_buy_pm = data.data_buy.pm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                var data_sell_pm = data.data_sell.pm.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                // $("#ex24h_btc_buy").html(data_buy_btc);
                // $("#ex24h_btc_sell").html(data_sell_btc);
                // $("#ex24h_btce_buy").html(data_buy_btce);
                // $("#ex24h_btce_sell").html(data_sell_btce);
                // $("#ex24h_eth_buy").html(data_buy_eth);
                // $("#ex24h_eth_sell").html(data_sell_eth);
                $("#ex24h_pm_buy").html(data_buy_pm);
                $("#ex24h_pm_sell").html(data_sell_pm);
            }
        });

        //Bitcoinvietnam
        $.ajax({
            url: '../show/bitcoinvietnam',
            success: function (data) {
                $("#bitcoinvietnam_btc_buy").html(data.btc_buy);
                $("#bitcoinvietnam_btc_sell").html(data.btc_sell);
            }
        });

        //Exbtcvn
        $.ajax({
            url: '../show/exbtcvn',
            success: function (data) {
                $("#exbtcvn_eth_base").html(data.eth_buy.from + " - " + data.eth_buy.to);
                $("#exbtcvn_eth_buy_base").html(data.eth_buy.price);
                $("#exbtcvn_eth_sell_base").html(data.eth_sell.price);



                // PM base 1
                $("#exbtcvn_pm_base1").html(data.pm_buy[0] + " - " + data.pm_buy[1]);
                $("#exbtcvn_pm_buy_base1").html(data.pm_buy[2]);
                $("#exbtcvn_pm_sell_base1").html(data.pm_sell[2]);

                //PM base 2
                $("#exbtcvn_pm_base2").html(data.pm_buy[3] + " - " + data.pm_buy[4]);
                $("#exbtcvn_pm_buy_base2").html(data.pm_buy[5]);
                $("#exbtcvn_pm_sell_base2").html(data.pm_sell[5]);

                //PM base3
                 $("#exbtcvn_pm_base3").html(data.pm_buy[6] + " - " + data.pm_buy[7]);
                 $("#exbtcvn_pm_buy_base3").html(data.pm_buy[8]);
                 $("#exbtcvn_pm_sell_base3").html(data.pm_sell[8]);
            }
        });


        //Muabantienao
        $.ajax({
            url: '../show/muabantienao',
            success: function (data) {

                $("#muabantienao_btc_buy").html(data.data_buy[1][8]);
                $("#muabantienao_btc_sell").html(data.data_sell[1][2]);
                $("#muabantienao_usdt_buy").html(data.data_buy[0][8]);
                $("#muabantienao_usdt_sell").html(data.data_sell[0][2]);
                $("#muabantienao_dsh_buy").html(data.data_buy[8][8]);
                $("#muabantienao_dsh_sell").html(data.data_sell[8][2]);
                $("#muabantienao_ltc_buy").html(data.data_buy[5][8]);
                $("#muabantienao_ltc_sell").html(data.data_sell[5][2]);
                $("#muabantienao_eth_buy").html(data.data_buy[4][8]);
                $("#muabantienao_eth_sell").html(data.data_sell[4][2]);
                $("#muabantienao_wmz_buy").html(data.data_buy[14][8]);
                $("#muabantienao_wmz_sell").html(data.data_sell[14][2]);
                $("#muabantienao_bch_buy").html(data.data_buy[2][8]);
                $("#muabantienao_bch_sell").html(data.data_sell[2][2]);
                $("#muabantienao_zec_buy").html(data.data_buy[7][8]);
                $("#muabantienao_zec_sell").html(data.data_sell[7][2]);
                $("#muabantienao_etc_buy").html(data.data_buy[6][8]);
                $("#muabantienao_etc_sell").html(data.data_sell[6][2]);
                $("#muabantienao_xmr_buy").html(data.data_buy[9][8]);
                $("#muabantienao_xmr_sell").html(data.data_sell[9][2]);
                $("#muabantienao_xrp_buy").html(data.data_buy[3][8]);
                $("#muabantienao_xrp_sell").html(data.data_sell[3][2]);


            }
        });

        //Hamirex
        $.ajax({
            url: '../show/hamirex',

            success: function (data) {
                var obj = JSON.parse(data);
                var btc_buy = obj.ask_btc.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                var btc_sell = obj.bid_btc.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $("#hamirex_btc_buy").html(btc_buy);
                $("#hamirex_btc_sell").html(btc_sell);
            }
        });


        //buyselleth
        $.ajax({
            url: '../show/buyselleth',
            success: function (data) {
                var obj = JSON.parse(data);
                var eth_buy = Math.round(obj.ask_eth).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                var eth_sell = Math.round(obj.bid_eth).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $("#buyselleth_eth_buy").html(eth_buy);
                $("#buyselleth_eth_sell").html(eth_sell);
            }
        });


        //thumuatienao
        $.ajax({
            url: '../show/thumuatienao',
            success: function (data) {
                var btc_buy = Math.round(data[1].buy).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                var btc_sell = Math.round(data[1].sell).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                var btce_buy = data[0].buy.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                var btce_sell = data[0].sell.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                var eth_buy = Math.round(data[2].buy).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                var eth_sell = Math.round(data[2].sell).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                $("#thumuatienao_btc_buy").html(btc_buy);
                $("#thumuatienao_btc_sell").html(btc_sell);
                $("#thumuatienao_btce_buy").html(btce_buy);
                $("#thumuatienao_btce_sell").html(btce_sell);
                $("#thumuatienao_eth_buy").html(eth_buy);
                $("#thumuatienao_eth_sell").html(eth_sell);
            }
        });

        //vncex
        $.ajax({
            url: '../show/vncex',
            success: function (data) {
                var btc_buy = data[0].Buy.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                var btc_sell = data[0].Sell.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                var btce_buy = data[3].Buy.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                var btce_sell = data[3].Sell.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                var eth_buy = data[1].Buy.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                var eth_sell = data[1].Sell.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                var ltc_buy = data[2].Buy.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                var ltc_sell = data[2].Sell.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                $("#vncex_btc_buy").html(btc_buy);
                $("#vncex_btc_sell").html(btc_sell);
                $("#vncex_btce_buy").html(btce_buy);
                $("#vncex_btce_sell").html(btce_sell);
                $("#vncex_eth_buy").html(eth_buy);
                $("#vncex_eth_sell").html(eth_sell);
                $("#vncex_ltc_buy").html(ltc_buy);
                $("#vncex_ltc_sell").html(ltc_sell);

            }
        });

        //muabitcoin
        $.ajax({
            url: '../show/muabitcoin',
                success: function (data) {
                var obj = JSON.parse(data);
                var btc_buy=Math.round(obj.btc.buy).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                var btc_sell=Math.round(obj.btc.sell).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                var eth_buy = Math.round(obj.eth.buy).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                var eth_sell = Math.round(obj.eth.sell).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                var ltc_buy = Math.round(obj.ltc.buy).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                var ltc_sell = Math.round(obj.ltc.sell).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $("#muabitcoin_btc_buy").html(btc_buy);
                $("#muabitcoin_btc_sell").html(btc_sell);
                $("#muabitcoin_eth_buy").html(eth_buy);
                $("#muabitcoin_eth_sell").html(eth_sell);
                $("#muabitcoin_ltc_buy").html(ltc_buy);
                $("#muabitcoin_ltc_sell").html(ltc_sell);
            }
        });

        //banwmz
        $.ajax({
            url: '../show/banwmz',
            success: function (data) {
                $("#banwmz_wmz_buy").html(data.buy);
                $("#banwmz_wmz_sell").html(data.sell);
            }
        });

         //banpm
        $.ajax({
            url: '../show/banpm',
            success: function (data) {
                $("#banpm_pm_buy").html(data.buy);
                $("#banpm_pm_sell").html(data.sell);
            }
        });


        //muatienao
        $.ajax({
            url: '../show/muatienao',
            success: function (data) {
                $("#muatienao_btc_buy").html(data.buy_btc);
                $("#muatienao_btc_sell").html(data.sell_btc);
                $("#muatienao_pm_buy").html(data.buy_pm);
                $("#muatienao_pm_sell").html(data.sell_pm);
                $("#muatienao_wmz_buy").html(data.buy_wmz);
                $("#muatienao_wmz_sell").html(data.sell_wmz);
            }
        });
        //Bosspm
        $.ajax({
            url: '../show/bosspm',
            success: function (data) {
                $("#bosspm_pm_buy").html(data.buypm);
                $("#bosspm_pm_sell").html(data.sellpm);
            }
        });
        //VNEXMONEY
        $.ajax({
            url: '../show/vnexmoney',
            success: function(data){
                //PM
                $("#vnexmoney_pm_base1").html(data[1][20]);
                $("#vnexmoney_pm_base2").html(data[1][21]);
                $("#vnexmoney_pm_base3").html(data[1][22]);

                $("#vnexmoney_pm_buy_base1").html(data[0][20]);
                $("#vnexmoney_pm_buy_base2").html(data[0][21]);
                $("#vnexmoney_pm_buy_base3").html(data[0][22]);

                $("#vnexmoney_pm_sell_base1").html(data[0][23]);
                $("#vnexmoney_pm_sell_base2").html(data[0][24]);
                $("#vnexmoney_pm_sell_base3").html(data[0][25]);
                //USDT
                $("#vnexmoney_usdt_base1").html(data[1][0]);
                $("#vnexmoney_usdt_base2").html(data[1][1]);
                $("#vnexmoney_usdt_base3").html(data[1][2]);
                $("#vnexmoney_usdt_base4").html(data[1][3]);
                $("#vnexmoney_usdt_base5").html(data[1][4]);
                $("#vnexmoney_usdt_base6").html(data[1][5]);
                $("#vnexmoney_usdt_base7").html(data[1][6]);
                $("#vnexmoney_usdt_base8").html(data[1][7]);
                $("#vnexmoney_usdt_base9").html(data[1][8]);
                $("#vnexmoney_usdt_base10").html(data[1][9]);

                $("#vnexmoney_usdt_buy_base1").html(data[0][0]);
                $("#vnexmoney_usdt_buy_base2").html(data[0][1]);
                $("#vnexmoney_usdt_buy_base3").html(data[0][2]);
                $("#vnexmoney_usdt_buy_base4").html(data[0][3]);
                $("#vnexmoney_usdt_buy_base5").html(data[0][4]);
                $("#vnexmoney_usdt_buy_base6").html(data[0][5]);
                $("#vnexmoney_usdt_buy_base7").html(data[0][6]);
                $("#vnexmoney_usdt_buy_base8").html(data[0][7]);
                $("#vnexmoney_usdt_buy_base9").html(data[0][8]);
                $("#vnexmoney_usdt_buy_base10").html(data[0][9]);

                $("#vnexmoney_usdt_sell_base1").html(data[0][10]);
                $("#vnexmoney_usdt_sell_base2").html(data[0][11]);
                $("#vnexmoney_usdt_sell_base3").html(data[0][12]);
                $("#vnexmoney_usdt_sell_base4").html(data[0][13]);
                $("#vnexmoney_usdt_sell_base5").html(data[0][14]);
                $("#vnexmoney_usdt_sell_base6").html(data[0][15]);
                $("#vnexmoney_usdt_sell_base7").html(data[0][16]);
                $("#vnexmoney_usdt_sell_base8").html(data[0][17]);
                $("#vnexmoney_usdt_sell_base9").html(data[0][18]);
                $("#vnexmoney_usdt_sell_base10").html(data[0][19]);

                //BTC
                $("#vnexmoney_btc_base1").html(data[1][34]);
                $("#vnexmoney_btc_base2").html(data[1][35]);
                $("#vnexmoney_btc_base3").html(data[1][36]);

                $("#vnexmoney_btc_buy_base1").html(data[0][34]);
                $("#vnexmoney_btc_buy_base2").html(data[0][35]);
                $("#vnexmoney_btc_buy_base3").html(data[0][36]);

                $("#vnexmoney_btc_sell_base1").html(data[0][37]);
                $("#vnexmoney_btc_sell_base2").html(data[0][38]);
                $("#vnexmoney_btc_sell_base3").html(data[0][39]);

            }
        });
});
JS;

$this->registerJs($app_js);
