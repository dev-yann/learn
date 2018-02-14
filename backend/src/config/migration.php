<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 14/02/18
 * Time: 18:41
 */

require __DIR__ .'/../vendor/autoload.php';
use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'learn',
    'database'  => 'learn',
    'username'  => 'admin',
    'password'  => 'admin',
    'charset'   => 'utf8',
    'collation' => 'utf8_general_ci',
    'prefix'    => 'learn_',
]);

$capsule->setAsGlobal();

$capsule->bootEloquent();


class Migrator {

    /**
     * migrate the database schema
     */
    public function migrate() {

        /**
         * create table for user*
         */
        if (!Capsule::schema()->hasTable('user')) {
            Capsule::schema()->create('user', function($table)
            {
                $table->integer('id', true);
                $table->string('username');
                $table->string('password');

                $table->engine = 'InnoDB';
            });
        }

        /**
         * create table for series
         */
       /* if (!Capsule::schema()->hasTable('serie')) {
            Capsule::schema()->create('serie', function($table)
            {

                $table->integer('id', true);
                $table->string('distance')->default('');
                $table->string('image')->default('');
                $table->string('name')->default('');
                $table->timestamp('updated_at')->default(Capsule::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
                $table->timestamp('created_at')->default(Capsule::raw('CURRENT_TIMESTAMP'));
                //FK
                $table->integer('city_id');

                $table->engine = 'InnoDB';

                //Foreign keys declaration
                $table->foreign('city_id')->references('id')->on('city')->onDelete('cascade');
                // We'll need to ensure that MySQL uses the InnoDB engine to
                // support the indexes, other engines aren't affected.
                $table->engine = 'InnoDB';
            });
        }*/
    }
}

$migrator = new Migrator();

$migrator->migrate();

header('Content-type: application/json');
echo json_encode(array('message' => 'Le schéma de la base de données a bien été créé'));