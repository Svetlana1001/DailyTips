<?php

use yii\db\Migration;

/**
 * Class m200105_111456_add_date_to_comment
 */
class m200105_111456_add_date_to_comment extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
       $this->addColumn('comment','date',$this->date());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $this->dripColumn('comment','date');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200105_111456_add_date_to_comment cannot be reverted.\n";

        return false;
    }
    */
}
