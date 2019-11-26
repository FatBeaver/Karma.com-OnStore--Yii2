<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\imagine\Image;

class UploadUserImg extends Model
{
    public $user_image;

    public function rules() 
    {
        return [
            [['user_image'], 'image', 'maxSize' => 1024 * 1024 * 4,],
        ];
    }

    public function upload($segmentPath, $oldImg = null)
    {
        if ($this->validate()) {
            $fileName = $this->user_image->baseName . time() . 
            '.' . $this->user_image->extension;
            $path = "/web/uploads/images/$segmentPath/" . $fileName; 
            
            @unlink(Yii::getAlias('@frontend') . "/web/uploads/images/$segmentPath/" . $oldImg);
            @unlink(Yii::getAlias('@frontend') . "/web/uploads/images/$segmentPath/for_profile/" . $oldImg);
            $this->user_image->saveAs(Yii::getAlias('@frontend') . $path);

            $pathToMainFile = Yii::getAlias('@frontend') . $path;
            $mainImage = Image::getImagine()->open($pathToMainFile);
            
            Image::thumbnail($mainImage, 70, 70)
            ->save(Yii::getAlias(Yii::getAlias('@frontend') . 
                "/web/uploads/images/$segmentPath/for_profile/$fileName"), [
                'quality' => 85
            ]);

            return $fileName;
        } else {
            return null;
        }
    }
}