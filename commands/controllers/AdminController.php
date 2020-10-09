<?php

namespace app\commands\controllers;

use app\models\ActiveRecord\Country;
use app\models\ActiveRecord\Film\Film;
use app\models\ActiveRecord\Film\FilmComment;
use app\models\ActiveRecord\Film\FilmGenre;
use app\models\ActiveRecord\Film\Genre;
use app\models\ActiveRecord\Film\Znak;
use app\models\ActiveRecord\Media\MediaCategory;
use app\models\ActiveRecord\Occupation;
use app\models\ActiveRecord\Person;
use app\models\ActiveRecord\Person\FilmPersonOccupation;
use app\models\ActiveRecord\PersonOccupation;
use app\models\ActiveRecord\User;
use app\models\ActiveRecord\UserType;
use Exception;
use Yii;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\Console;

/**
 * Набор сервисных команд
 *
 * @author kotov
 */
class AdminController extends Controller
{
    
    /**
     * Очистка таблиц базы данных
     * @return type
     */ 
    public function actionClearTables() {
        $prefix = Yii::$app->db->tablePrefix;
        $sql = 'TRUNCATE TABLE '.$prefix.'users;
                TRUNCATE TABLE '.$prefix.'album_genre;
                TRUNCATE TABLE '.$prefix.'music_genre;
                TRUNCATE TABLE '.$prefix.'albums;
                TRUNCATE TABLE '.$prefix.'gallery;
                TRUNCATE TABLE '.$prefix.'trailers;
                TRUNCATE TABLE '.$prefix.'media_category;
                TRUNCATE TABLE '.$prefix.'media;
                TRUNCATE TABLE '.$prefix.'country;
                TRUNCATE TABLE '.$prefix.'film_person_occupation;
                TRUNCATE TABLE '.$prefix.'film_genre;
                TRUNCATE TABLE '.$prefix.'film_comment;
                TRUNCATE TABLE '.$prefix.'person_occupation;
                TRUNCATE TABLE '.$prefix.'occupation;
                TRUNCATE TABLE '.$prefix.'films;
                TRUNCATE TABLE '.$prefix.'person;
                TRUNCATE TABLE '.$prefix.'genre;
                TRUNCATE TABLE '.$prefix.'favorites_films;
                TRUNCATE TABLE '.$prefix.'categories;';
        try {     
            $this->query($sql);
            echo "Tables cleared\n";
        } catch (Exception $ex) {
            echo "Request error\n";
        }        
        return ExitCode::OK;
    }
    /**
     * Удаление таблиц БД
     * @return type
     */
    public function actionDropTables() {
        $prefix = Yii::$app->db->tablePrefix;
        $sql = 'TRUNCATE TABLE '.$prefix.'migration;  
                DROP TABLE '.$prefix.'album_genre;
                DROP TABLE '.$prefix.'music_genre;
                DROP TABLE '.$prefix.'albums;
                DROP TABLE '.$prefix.'gallery;
                DROP TABLE '.$prefix.'trailers;
                DROP TABLE '.$prefix.'media_category;
                DROP TABLE '.$prefix.'media;
                DROP TABLE '.$prefix.'users;
                DROP TABLE '.$prefix.'country;
                DROP TABLE '.$prefix.'categories;
                DROP TABLE '.$prefix.'film_person_occupation;
                DROP TABLE '.$prefix.'film_genre;
                DROP TABLE '.$prefix.'film_comment;
                DROP TABLE '.$prefix.'person_occupation;
                DROP TABLE '.$prefix.'films;
                DROP TABLE '.$prefix.'person;
                DROP TABLE '.$prefix.'genre;
                DROP TABLE '.$prefix.'favorites_films;
                DROP TABLE '.$prefix.'occupation;';
                try {     
        $this->query($sql);
            echo "Tables dropped\n";
        } catch (Exception $ex) {
            echo "Request error\n";
        }      
        
        return ExitCode::OK;
    } 
    /**
     * Заполнение БД данными фикстур
     * @return type
     */
    public function actionAddData() 
    {                   
        $this->setData(Znak::class, './../fixtures/categories.php');
        $this->setData(Film::class, './../fixtures/film.php');
        $this->setData(Occupation::class, './../fixtures/occupation.php');
        $this->setData(Person::class, './../fixtures/person.php');
        $this->setData(Genre::class, './../fixtures/genre.php');
        $this->setData(PersonOccupation::class, './../fixtures/person_occupation.php');
        $this->setData(FilmPersonOccupation::class, './../fixtures/film_person_occupation.php');
        $this->setData(FilmGenre::class, './../fixtures/film_genre.php');
        $this->setData(FilmComment::class, './../fixtures/film_comment.php');
        $this->setData(Country::class, './../fixtures/countries.php');
        $this->setData(MediaCategory::class, './../fixtures/media_category.php');
        $this->addDefaultAdmin();
        echo 'Data Added' . "\n";

        return ExitCode::OK;
    }
    
    public function actionSetDirectory() 
    {
        UserType::deleteAll();
        $this->setData(UserType::class, './../fixtures/user_types.php');
    }
    protected function query($sql) {
        $link = Yii::$app->db;
        $link->open();
        $state = $link->createCommand($sql);
        return $state->query();
    }
   
    protected function setData($className,$fixture)
    {
        chdir(__DIR__);
        $items = require $fixture;
        foreach ($items as $item) {
            $model = new $className();
            $model->setAttributes($item,false);
            $model->save(false);
            unset($model);
        }                    
    }

    /**
     * Первоначаьная установка ролей для пользователей
     */
    public function actionSetUserRoles()
    {
        $adminList = Yii::$app->params['rootUsers'] ?? [];
        $usersWithUndefinedRoles = User::findAll(['user_type_id' => null]);
        foreach ($usersWithUndefinedRoles as $currentUser) {
            /** @var User $currentUser */
            if (in_array($currentUser->login, $adminList)) {
                $currentUser->user_type_id = UserType::ROOT_USER_ID;
            } else {
                $currentUser->user_type_id = UserType::DEFAULT_USER_ID;
            }
            $currentUser->save();
        }
        
        $auth = Yii::$app->authManager;
        $auth->removeAllAssignments();
        $adminRole = $auth->getRole(UserType::ROOT_USER_TYPE);
        $userRole = $auth->getRole(UserType::DEFAULT_USER_TYPE);
        
        $users = User::find()->all();
        
        foreach ($users as $user)
        {
        /**
         * User $user
         */
            switch ($user->user_type_id) {
                case UserType::ROOT_USER_ID:
                    Console::output("Установлена роль 'Администратор' для пользователя {$user->login}");
                    $auth->assign($adminRole, $user->id);
                    break;
                case UserType::DEFAULT_USER_ID:
                    $auth->assign($userRole, $user->id);
                     Console::output("Установлена роль 'Пользователь' для пользователя {$user->login}");
                    break;
            }
        }
        return ExitCode::OK;
        
    }
    
    protected function addDefaultAdmin() 
    {
        $user = new User();
        $user->login = 'admin';
        $user->setPassword('123');
        $user->setAuthKey();
        $user->save(false);
        $auth = Yii::$app->authManager;
        $auth->removeAllAssignments();
        $adminRole = $auth->getRole('admin');
        $auth->assign($adminRole, $user->id);        
    }
}
