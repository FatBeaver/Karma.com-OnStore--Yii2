<?php 

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\imagine\Image;
use Imagine\Image\Box;

class UploadFile extends Model 
{
    public $image;

    public function rules()
    {
        return [
            [['image'], 'image'],
        ];
    }

    public function upload($segmentPath, $oldImg = null, $type)
    {   
        if ($type === 'category') {
            return $this->uploadCategoryImage($segmentPath, $oldImg);
        }
        if ($type === 'blog_post') {
           return $this->uploadMainBlogImage($segmentPath, $oldImg);
        }
        if ($type === 'blog_category') {
            return $this->uploadCategoryBlogImage($segmentPath, $oldImg);
        }
    }


    protected function uploadCategoryBlogImage($segmentPath, $oldImg = null)
    {
        if ($this->validate()) {
            $this->unlinkFile($oldImg, $segmentPath);

            $fileName = $this->image->baseName . time() . 
            '.' . $this->image->extension;
            $path = "/web/uploads/images/$segmentPath/" . $fileName; 

            $this->image->saveAs(Yii::getAlias('@frontend') . $path);

            $mainImage = Image::getImagine()->open(Yii::getAlias('@frontend') . $path);
            $sizes = getimagesize(Yii::getAlias('@frontend') . $path);

            $height = 220;
            $width = round($sizes[0] * $sizes[1]/$height);
            
            Image::resize($mainImage, $width, $height, false)
                ->save(Yii::getAlias(Yii::getAlias('@frontend') . 
                    "/web/uploads/images/$segmentPath/main/$fileName"), [
                    'quality' => 85
                ]);

            $path = "/web/uploads/images/$segmentPath/main/" . $fileName; 
            $mainImage = Image::getImagine()->open(Yii::getAlias('@frontend') . $path);
            @unlink(Yii::getAlias('@frontend') . "/web/uploads/images/$segmentPath/main/" . $fileName);
            
            Image::thumbnail($mainImage, 360, 220)
                ->save(Yii::getAlias(Yii::getAlias('@frontend') . 
                    "/web/uploads/images/$segmentPath/main/$fileName"), [
                    'quality' => 85
                ]);

            return $fileName;
        } else {
            return false;
        }
    }

    protected function uploadMainBlogImage($segmentPath, $oldImg = null)
    {   
        if ($this->validate()) {
            $this->unlinkFile($oldImg, $segmentPath); 

            $fileName = $this->image->baseName . time() . 
            '.' . $this->image->extension;
            $path = "/web/uploads/images/$segmentPath/" . $fileName; 

            $this->image->saveAs(Yii::getAlias('@frontend') . $path);

            $mainImage = Image::getImagine()->open(Yii::getAlias('@frontend') . $path);
            Image::thumbnail($mainImage, 555, 280)
            ->save(Yii::getAlias(Yii::getAlias('@frontend') . 
                "/web/uploads/images/$segmentPath/main/$fileName"), [
                'quality' => 85,
            ]);

            Image::thumbnail($mainImage, 60, 60)
            ->save(Yii::getAlias(Yii::getAlias('@frontend') . 
                "/web/uploads/images/$segmentPath/for_nav/$fileName"), [
                'quality' => 85,
            ]);

            return $fileName;
        } else {
            return false;
        }
    }

    protected function uploadCategoryImage($segmentPath, $oldImg)
    {
        if ($this->validate()) {
            $fileName = $this->image->baseName . time() . 
            '.' . $this->image->extension;
            $path = "/web/uploads/images/$segmentPath/" . $fileName; 

            $this->image->saveAs(Yii::getAlias('@frontend') . $path);
            $this->unlinkFile($oldImg, $segmentPath);

            return $fileName;
        } else {
            return false;
        }
    }


    protected function unlinkFile($oldImg = null, $segmentPath)
    {
        @unlink(Yii::getAlias('@frontend') . "/web/uploads/images/$segmentPath/" . $oldImg);
        @unlink(Yii::getAlias('@frontend') . "/web/uploads/images/$segmentPath/main/" . $oldImg);
        @unlink(Yii::getAlias('@frontend') . "/web/uploads/images/$segmentPath/for_nav/" . $oldImg);
    }
}