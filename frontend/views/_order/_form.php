<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\ProductList;

/* @var $this yii\web\View */
/* @var $model common\models\OrderList */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-list-form">
    <table class="table table-dark">
        <tbody>
            <?php
            $modelItem = ProductList::find()->all();

            foreach ($modelItem as $item) {
                if (isset($_COOKIE['item' . $item->id]) && $_COOKIE['item' . $item->id] > 0) {
                    $val = $_COOKIE['item' . $item->id];
                    $class_sel = "display:block;";
                    $class_xsel = "display:none;";
                    $style_sel = "background-color: #e31c79; color: #f0e848;";
                } else {
                    $val = "";
                    setcookie('item' . $item->id, "0", time() - 3600);
                    $class_sel = "display:none;";
                    $class_xsel = "display:block;";
                    $style_sel = "";
                }

            ?>
                <tr id="itemselect_<?= $item->id ?>" style="<?= $style_sel ?>">
                    <th style="width:75%" scope="row">
                        <div class="row">
                            <div class="col-md-4 col-lg-4"><img src="<?= $item->getImageUrl() ?>" style="width:100%;"></div>
                            <div class="col-md-8 col-lg-8">
                                <span style="font-family: 'Pattaya';font-size: 48px;padding-top: 39px;"><?= $item->name ?></span><br>
                                <span><?= $item->name ?></span>
                            </div>
                        </div>
                    </th>
                    <td style="width:10%;vertical-align: middle;text-align: center;">
                        <div class="carousel-caption-right" style="height: 120px;width: 120px;background-color: #f0e848;color:#e31c79;border-radius: 50%;text-align: center;vertical-align: middle;">
                            <?php if ($item->discount > 0) { ?>
                                <h2 style="font-family: 'Pattaya';font-size: 24px;padding-top: 22px;text-decoration: line-through;"><?= $item->price ?>฿</h2>
                                <h2 style="font-family: 'Pattaya';font-size: 48px;"><?= $item->discount ?>฿</h2>
                            <?php } else { ?>
                                <h2 style="font-family: 'Pattaya';font-size: 48px;padding-top: 39px;"><?= $item->price ?>฿</h2>
                            <?php } ?>
                        </div>
                    </td>
                    <td style="width:15%;vertical-align: middle;text-align: center;">
                        <div class="form-group" id="addnew_<?= $item->id ?>" style="<?= $class_xsel ?>">
                            <button type="button" class="btn btn-success" onclick="Addnew(<?= $item->id ?>,<?= ($item->discount > 0) ? $item->discount : $item->price ?>)">เพิ่ม</button>
                        </div>

                        <div class="form-group" id="showplus_<?= $item->id ?>" style="<?= $class_sel ?>">
                            <button type="button" class="btn btn-success" onclick="PressIt('minus',<?= $item->id ?>,<?= ($item->discount > 0) ? $item->discount : $item->price ?>)"><i class="fa fa-minus"></i></button>
                            <input class="" type="text" id="getCal_<?= $item->id ?>" name="getCal_<?= $item->id ?>" value="<?= $val ?>" style="width: 38px;border-style: none;color: rgb(227, 28, 121);">
                            <button type="button" class="btn btn-success" onclick="PressIt('plus',<?= $item->id ?>,<?= ($item->discount > 0) ? $item->discount : $item->price ?>)"><i class="fa fa-plus"></i></button>
                        </div>
                    </td>
                </tr>
            <?php } ?>
            <tr style="height: 100px;">
                <th style="width:75%;text-align: right;vertical-align: middle;font-size: 20px;" scope="row">มีสินค้า <span id="totalCart"><?= isset($_COOKIE['totalCart']) ? $_COOKIE['totalCart'] : 0 ?></span> รายการ</th>
                <td style="width:10%;vertical-align: middle;font-size: 20px;"><span id="totalPrice"><?= isset($_COOKIE['totalPrice']) ? $_COOKIE['totalPrice'] : 0 ?></span>.00 ฿</td>
                <td style="width:15%;text-align: center;vertical-align: middle;">
                    <?= Html::a('สั่งซื้อเลย', ['order/create'], ['class' => 'btn btn-success', 'style' => 'font-size:24px;']) ?>
                </td>
            </tr>
        </tbody>
    </table>
    <script language="JavaScript">
        function setCookie(cname, cvalue, exdays) {
            var d = new Date();
            d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
            var expires = "expires=" + d.toUTCString();
            document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
        }

        function getCookie(cname) {
            var name = cname + "=";
            var decodedCookie = decodeURIComponent(document.cookie);
            var ca = decodedCookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }

        function AddCookie(id, price) {
            var input = parseInt(document.getElementById("getCal_" + id).value);
            var cookies = 'item' + id + '=' + input;

            var totalCart = parseInt(document.getElementById("totalCart").innerHTML);
            var totalPrice = parseInt(document.getElementById("totalPrice").innerHTML);


            if (getCookie('item' + id) > 0) {
                var cook = parseInt(getCookie('item' + id));
                document.getElementById("totalCart").innerHTML = parseInt(totalCart + (input - cook));
                document.getElementById("totalPrice").innerHTML = totalPrice + (price * (input - cook));

            } else {
                document.getElementById("totalCart").innerHTML = parseInt(totalCart + input);
                document.getElementById("totalPrice").innerHTML = totalPrice + (price * input);
            }

            var totalCart = parseInt(document.getElementById("totalCart").innerHTML);
            var totalPrice = parseInt(document.getElementById("totalPrice").innerHTML);

            setCookie('item' + id, input, 1);
            setCookie('totalCart', totalCart, 1);
            setCookie('totalPrice', totalPrice, 1);

        }

        function Addnew(id, price) {
            document.getElementById('addnew_' + id).style.display = "none";
            document.getElementById('showplus_' + id).style.display = "block";
            document.getElementById("getCal_" + id).value = 1;
            document.getElementById('itemselect_' + id).style.backgroundColor = "#e31c79";
            document.getElementById('itemselect_' + id).style.color = "#f0e848";
            AddCookie(id, price);
        }

        function PressIt(t, id, price) {
            type = t;
            var input = document.getElementById("getCal_" + id).value;
            var currentVal = parseInt(input);
            if (!isNaN(currentVal)) {
                if (type == 'minus') {
                    if (currentVal > 1) {
                        currentVal = currentVal - 1;
                        document.getElementById("getCal_" + id).value = currentVal;
                    } else {
                        currentVal = currentVal - 1;
                        document.getElementById("getCal_" + id).value = currentVal;
                        document.getElementById('addnew_' + id).style.display = "block";
                        document.getElementById('showplus_' + id).style.display = "none";
                        document.getElementById('itemselect_' + id).style.backgroundColor = "";
                        document.getElementById('itemselect_' + id).style.color = "#424242";
                    }
                } else if (type == 'plus') {
                    if (currentVal < 10000) {
                        currentVal = currentVal + 1;
                        document.getElementById("getCal_" + id).value = currentVal;
                    }
                }
                AddCookie(id, price);
            } else {
                document.getElementById("getCal_" + id).value = 0;
                document.getElementById('addnew_' + id).style.display = "block";
                document.getElementById('showplus_' + id).style.display = "none";
                document.getElementById('itemselect_' + id).style.backgroundColor = "#000";
            }
        }
    </script>
</div>