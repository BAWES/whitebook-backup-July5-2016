<?php

use yii\db\Migration;

class m160620_113539_alter_category_ad_fields extends Migration
{
    public function up()
    {
        $this->alterColumn("whitebook_category", "top_ad", $this->text());
        $this->alterColumn("whitebook_category", "bottom_ad", $this->text());
    }

    public function down()
    {
        echo "m160620_113539_alter_category_ad_fields cannot be reverted.\n";

        return false;
    }
}
