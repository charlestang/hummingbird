<?php

use yii\db\Migration;

class m161210_114704_hummingbird_v1 extends Migration
{

    public function up()
    {

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%database}}',
            [
            'id'         => $this->primaryKey()->unsigned()->comment('ID'),
            'alias'      => $this->string(32)->notNull()->comment('alias of this database'),
            'host'       => $this->string(64)->notNull()->comment('database host'),
            'database'   => $this->string(64)->notNull()->comment('database name'),
            'username'   => $this->string(64)->comment('user name'),
            'password'   => $this->string(64)->comment('password'),
            'charset'    => $this->string(32)->comment('charset of database'),
            'created_at' => $this->dateTime()->defaultValue('1000-01-01 00:00:00'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
            ],
            $tableOptions
        );

        $this->createTable(
            '{{%report}}',
            [
            'id'          => $this->primaryKey()->unsigned()->comment('id'),
            'user_id'     => $this->integer()->notNull()->comment('user who created the report'),
            'database_id' => $this->integer()->unsigned()->notNull()->comment('database config id'),
            'name'        => $this->string(32)->notNull(),
            'sql'         => $this->text()->notNull(),
            'description' => $this->text(),
            'created_at'  => $this->dateTime()->defaultValue('1000-01-01 00:00:00'),
            'updated_at'  => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
            'FOREIGN KEY (database_id) REFERENCES {{%database}} (id)' .
            (' ON DELETE NO ACTION ON UPDATE NO ACTION'),
            ],
            $tableOptions
        );
        $this->createIndex('key_name', '{{%report}}', 'name');
    }

    public function down()
    {
        $this->dropTable('{{%report}}');
        $this->dropTable('{{%database}}');
    }
}
