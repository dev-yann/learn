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
         * create table for user
         */
        if (!Capsule::schema()->hasTable('user')) {
            Capsule::schema()->create('user', function($table)
            {
                $table->integer('id', true);
                $table->string('username');
                $table->string('password');
                $table->bigInteger('exp')->default(0);
                $table->boolean('author')->default(0);

                $table->engine = 'InnoDB';
            });
        }


        /**
         * create table for parcours
         */
        if (!Capsule::schema()->hasTable('parcours')) {
            Capsule::schema()->create('parcours', function($table)
            {

                $table->integer('id', true);
                $table->string('author_id');
                $table->integer('temps');
                $table->integer('level');
                $table->string('title')->default('');
                $table->string('description')->default('');
                $table->timestamp('updated_at')->default(Capsule::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
                $table->timestamp('created_at')->default(Capsule::raw('CURRENT_TIMESTAMP'));

                $table->engine = 'InnoDB';
                //Foreign keys declaration
                $table->foreign('author_id')->references('id')->on('user')->onDelete('cascade');
            });


        }

        /**
         * create table for exercices
         */
        if (!Capsule::schema()->hasTable('exercices')) {
            Capsule::schema()->create('exercices', function($table)
            {

                $table->integer('id', true);
                $table->string('title')->default('');
                $table->string('description')->default('');
                $table->timestamp('updated_at')->default(Capsule::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
                $table->timestamp('created_at')->default(Capsule::raw('CURRENT_TIMESTAMP'));
                $table->boolean('fillinType')->default(false);
                     $table->boolean('unit_test')->default(false);
                //FK
                $table->integer('parcours_id');

                $table->engine = 'InnoDB';

                //Foreign keys declaration
                $table->foreign('parcours_id')->references('id')->on('parcours')->onDelete('cascade');


            });
        }

        /**
         * create table for posts
         */
        if (!Capsule::schema()->hasTable('posts')) {
            Capsule::schema()->create('posts', function($table)
            {

                $table->integer('id', true);
                $table->string('message')->default('');
                $table->timestamp('updated_at')->default(Capsule::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
                $table->timestamp('created_at')->default(Capsule::raw('CURRENT_TIMESTAMP'));
                //FK
                $table->integer('parcours_id');
                $table->integer('user_id');

                $table->engine = 'InnoDB';

                //Foreign keys declaration
                $table->foreign('parcours_id')->references('id')->on('parcours')->onDelete('cascade');
                $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');


            });
        }
        /**
         * create table for parcours to users
         */
        if (!Capsule::schema()->hasTable('parcours2users')) {
            Capsule::schema()->create('parcours2users', function($table)
            {

                //FK
                $table->integer('parcours_id');
                $table->integer('user_id');

                $table->engine = 'InnoDB';

                //Foreign keys declaration
                $table->foreign('parcours_id')->references('id')->on('parcours')->onDelete('cascade');
                $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');


            });
        }

           if (!Capsule::schema()->hasTable('groupes')) {
            Capsule::schema()->create('groupes', function($table)
            {

                $table->integer('id', true);
                $table->string('name')->default('');
                $table->boolean('user_id');
                $table->engine = 'InnoDB';


            });
        }
        if (!Capsule::schema()->hasTable('user2groupe')) {
            Capsule::schema()->create('user2groupe', function($table)
            {

                $table->integer('user_id');
                $table->integer('groupe_id');
                $table->engine = 'InnoDB';


            });
        }
                if (!Capsule::schema()->hasTable('user2exercice')) {
            Capsule::schema()->create('user2exercice', function($table)
            {

                $table->integer('user_id');
                $table->integer('exercice_id');
                $table->integer('state')->default(0);
                $table->engine = 'InnoDB';


            });
        }

        /**
         * create table for sous-exercice
         */
        if (!Capsule::schema()->hasTable('fill')) {
             Capsule::schema()->create('fill', function($table)
             {

                 $table->integer('id', true);
                 $table->string('codeTrue');
                 $table->string('codeFalse');

                 //FK
                 $table->integer('exercices_id');

                 $table->engine = 'InnoDB';

                 //Foreign keys declaration
                 $table->foreign('exercices_id')->references('id')->on('exercices')->onDelete('cascade');
                 // We'll need to ensure that MySQL uses the InnoDB engine to
                 // support the indexes, other engines aren't affected.
                 $table->engine = 'InnoDB';
             });
         }

                 if (!Capsule::schema()->hasTable('unit_test')) {
             Capsule::schema()->create('unit_test', function($table)
             {

                 $table->integer('id', true);
                 $table->string('file');
                        $table->string('variable_test')->default('');

                 //FK
                 $table->integer('exercices_id');

                 $table->engine = 'InnoDB';

                 //Foreign keys declaration
                 $table->foreign('exercices_id')->references('id')->on('exercices')->onDelete('cascade');
              
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