<?php
/**
 * Created by PhpStorm.
 * User: Davron
 * Date: 2018/02/07
 * Time: 23:29
 */

namespace backend\controllers;

use backend\components\Controller;
use common\models\Faculty;
use common\models\Files;
use common\models\Student;
use common\models\Test;

class RandomDataController extends Controller
{
    public function actionRandomStudents() {
//        for($i=0;$i<100;$i++) {
//            $model = new Student();
//            $model->code = (string)rand(1000,9999);
//            $names = $this->getNames()[rand(0,1)];
//            $fnames = $names['names'];
//            $lnames = $names['last_names'];
//            $photos = $names['photos'];
//            $model->fname = $fnames[array_rand($fnames)];
//            $model->lname = $lnames[array_rand($lnames)];
//            $model->bdate = date('Y-m-d',rand(631219282,915216082));
//            $model->email = $model->fname.'-'.rand(1,10).'@mail.ru';
//            $model->passport = substr(str_shuffle(str_repeat("ABCDEFGHIJKLMNOPQRSTUVWXYZ",5)), 0, 2).rand(1000000,9999999);
//            $model->phone = $this->getPhone();
//            $model->created_at = date('Y-m-d H:i:s',time());
//            $model->updated_at = $model->created_at;
//            $model->address = $this->getAddres();
//            $model->avatar = Files::saveFromFile($photos[array_rand($photos)]);
//            if(!$model->save())
//                $this->dump($model->errors);
//        }
//        $this->dump('Finish');
    }

    public function actionDeleteAllStudents() {
//        $models = Student::find()->all();
//        foreach ($models as $model)
//            $model->delete();
    }

    public function actionRandomTeachers() {
//        for ($i=0;$i<10;$i++) {
//            $model = new Faculty();
//            $names = $this->getNames()[rand(0,1)];
//            $fnames = $names['names'];
//            $lnames = $names['last_names'];
//            $model->fname = $fnames[array_rand($fnames)];
//            $model->lname = $lnames[array_rand($lnames)];
//            $model->email = $model->fname.'-'.rand(1,10).'@mail.ru';
//            $model->phone = $this->getPhone();
//            $model->address = substr($this->getAddres(),0,50);
//            $model->full_available = rand(0,1);
//            $model->created_at = date('Y-m-d H:i:s',time());
//            $model->updated_at = $model->created_at;
//            if(!$model->save())
//                $this->dump($model->errors);
//        }
        $this->dump('Finish');
    }

    public function getNames() {
        return [
            0 => [
                'names' => [
                    'Mamlakat',
                    'Saodat',
                    'Nigora',
                    'Malika',
                    'Sevinch',
                    'Aziza',
                    'Shaxnoza',
                    'Lobar',
                    'Kamola',
                    'Maftuna',
                    'Sitora',
                ],
                'last_names' => [
                    'Djo\'rayeva',
                    'Raximova',
                    'Qodirova',
                    'Alimova',
                    'Latipova',
                    'Saidova',
                    'Hasanova',
                    'Mansurova',
                    'Yo\'ldosheva',
                    'Zokirova',
                ],
                'photos' => [
                    '11',
                    '12',
                    '13',
                    '14',
                    '15',
                    '16',
                    '17',
                    '18',
                    '19',
                    '20',
                ],
            ],
            1 => [
                'names' => [
                    'Davron',
                    'Alijon',
                    'Akbar',
                    'Jalol',
                    'Abdulla',
                    'Toxir',
                    'Kamol',
                    'Vali',
                    'Dilshod',
                    'Sarvar',

                ],
                'last_names' => [
                    'Djo\'rayev',
                    'Raximov',
                    'Qodirov',
                    'Alimov',
                    'Latipov',
                    'Saidov',
                    'Hasanov',
                    'Mansurov',
                    'Yo\'ldoshev',
                    'Zokirov',
                ],
                'photos' => [
                    '1',
                    '2',
                    '3',
                    '4',
                    '5',
                    '6',
                    '7',
                    '8',
                    '9',
                    '10',
                ],
            ]

        ];
    }

    public function getPhone() {
        $array = ['90','91','93','94','95','97','99'];
        return '998'.$array[array_rand($array)].rand(1000000,9999999);
    }

    public function getAddres() {
        $regions = [
             [
                 'name' => 'Toshkent shahri',
                'sub'=> [
                    'Yunusobod tumani',
                    'Mirzo Ulug\'bek tumani',
                    'Olmazor tumani',
                    'Sirg\'ali tumani',
                    'Mirobod tumani',
                    'Shayxontohur tumani',
                    'Chilonzor tumani',
            ]],
            [
                'name' => 'Sirdaryo viloyati',
                'sub' => [
                    'Sirdaryo shahri',
                    'Baxt shahri',
                    'Guliston shahri',
                    'Sardoba tumani',
                    'Sayxunobod tumani',
            ]],
            [
                'name' => 'Buxoro viloyati',
                'sub'=> [
                'G\'ijduvon tumani',
                'Buxoro shahri',
                'Kogon tumani',
                'Romitan tumani',
            ]],
            [
                'name' => 'Andijon viloyati',
                'sub' => [
                'Andijon shahri',
                'Asaka tumani',
                'Marhamat tumani',
                'Baliqchi shahri',
            ]]
        ];
        $streets = [
            'Navoi',
            'Mustaqillik',
            'O\'zbekiston',
            'Amir Temur',
            'Bunyodkor',
            'Pushkin',
            'Abdulla Avloniy'
        ];

        $region = $regions[array_rand($regions)];
        $regionName = $region['name'];
        $subRegionName = $region['sub'][array_rand($region['sub'])];
        $streetName = $streets[array_rand($streets)];
        $address = $regionName.', '.$subRegionName.', '.$streetName.' ko\'chasi, '.rand(1,300).'-uy.';
        return $address;
    }

    public function actionRandomTest() {
        for ($i=0;$i<100;$i++) {
            $model = new Test();
            $model->name = $this->getRandomStr();
            $model->lname = $this->getRandomStr();
            $model->save();
        }
        print_r("Finish");
    }

    public function getRandomStr() {
        $str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($str);
        $length = rand(4,10);
        $randomStr = '';
        for($j=0;$j<$length;$j++) {
            $rand = rand(0, $charactersLength - 1);
            $randomStr .= $str[$rand];
        }
        return $randomStr;

    }

}