<?php

namespace common\models;

use Faker\Provider\File;
use Yii;

/**
 * This is the model class for table "files".
 *
 * @property int $id
 * @property string $filename
 * @property int $size
 * @property string $ext
 * @property string $filetype
 */
class Files extends \yii\db\ActiveRecord
{


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'files';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['filename', 'size', 'ext', 'filetype'], 'required'],
            [['size'], 'integer'],
            [['filename'], 'string', 'max' => 250],
            [['ext'], 'string', 'max' => 5],
            [['filetype'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('main', 'ID'),
            'filename' => Yii::t('main', 'Filename'),
            'size' => Yii::t('main', 'Size'),
            'ext' => Yii::t('main', 'Ext'),
            'filetype' => Yii::t('main', 'Filetype'),
        ];
    }

    public function getHasFile() {
        $fullpath = $this->fullpath;
        return !is_dir($fullpath) && is_file($fullpath);
    }

    public function getFullPath() {
        return Files::getDir().$this->name;
    }

    public function getAbsoluteLink() {
        return Yii::$app->params['protocol'].'://'.Yii::$app->params['backend'].$this->relativeLink;
    }

    public function getRelativeLink() {
        return '/'.Files::getDirName().'/'.$this->name;
    }

    public function getName() {
        return $this->filename.'.'.$this->ext;
    }

    public static function getDirName() {
        return 'files';
    }

    public static function getDir() {
        return realpath(dirname(__FILE__)).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'backend'.DIRECTORY_SEPARATOR.'web'.DIRECTORY_SEPARATOR.Files::getDirName().'/';
    }

    public static function generateMd5($str) {
        return md5(time().rand(1,1000000).rand(1,1000000).$str);
    }

    public static function saveFile($file,$model_id) {
        $name = Files::generateMd5($file->name);
        $dir = Files::getDir();
        $filename = $dir . $name . '.' . $file->extension;

        if($file->saveAs($filename)) {
            $model = Files::findOne($model_id);

            if(empty($model))
                $model = new Files();
            else
                Files::deleteFile($model->id);

            $model->filename = $name;
            $model->ext = $file->extension;
            $model->filetype = "File type";
            $model->size = $file->size;
            if($model->save()) {
                return $model->id;
            } else {
                print_r($model->errors);
            }
        }
        return false;
    }

    public static function saveFromFile($id) {
        $file = realpath(dirname(__FILE__)).'/../../backend/web/avatars/'.$id.'.jpg';
        $md5 = Files::generateMd5((string)rand(1,1000000));
        $newFile = Files::getDir().$md5.'.jpg';
        copy($file,$newFile);
        $model = new Files();
        $model->filename = $md5;
        $model->ext = 'jpg';
        $model->filetype = "File type";
        $model->size = filesize($newFile);
        $model->save();
        return $model->id;

    }

    public static function deleteFile($id) {
        $model = Files::findOne($id);
        if(!empty($model) && $model->hasFile)
            unlink($model->fullpath);
    }

    public function beforeDelete()
    {
        Files::deleteFile($this->id);
        return parent::beforeDelete(); // TODO: Change the autogenerated stub
    }
}
