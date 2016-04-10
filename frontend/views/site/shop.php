<?php

use yii\helpers\Url;
use yii\helpers\Html;
?>
<!-- coniner start -->

<section id="inner_pages_white_back">
    <div class="container paddng0">
        <div class="shop_sect">
            <div class="plan_inner_sec">
                <h2>Shop</h2>
                <h5>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec gravida convallis metus,</h5>
            </div>
        </div>
        <div class="plan_catg">
            <h3 align="center">Coming soon... </h3>

        </div>

        <div class="add_banner">
            <?= Html::img("@web/images/explore_banner.jpg") ?>
        </div>

    </div>
</section>
<!-- continer end -->

<?php
// category display dynamic
/* foreach ($category as $key => $value) { ?>
  <li>
  <a href="<?= Url::to('products/'.$value['slug']); ?>" title="<?= $value['category_name'] ?>">
  <span class="<?= $value['slug'] ?>" style="background: url(../../images/sprit2.png) -3px -17px no-repeat;display: inline-block;
  width: 100%;  height: 50px;"></span>
  <span class="responsi_common"><?= $value['category_name'] ?></span>
  </a>
  </li>
  <?php } */
?>

<!-- REMOVE THE SCRIPT ONCE PAGE WORKOUT !IMPORTANT-->
<script>
// Window load event used just in case window height is dependant upon images
    if (jQuery(window).width() > 991) {
        $(window).bind("load", function () {

            var footerHeight = 0,
                    footerTop = 0,
                    $footer = $("#footer_sections");

            positionFooter();

            function positionFooter() {

                footerHeight = $footer.height();
                footerTop = ($(window).scrollTop() + $(window).height() - footerHeight) + "px";

                if (($(document.body).height() + footerHeight) < $(window).height()) {
                    $footer.css({
                        position: "absolute"
                    })
                } else {
                    $footer.css({
                        position: "static"
                    })
                }

            }

            $(window)
                    .scroll(positionFooter)
                    .resize(positionFooter)

        });
    }
</script>
<!-- END REMOVE THE SCRIPT ONCE PAGE WORKOUT !IMPORTANT-->
<!--end footer sticky-->