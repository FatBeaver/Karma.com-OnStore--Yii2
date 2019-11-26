<?php 

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\imagine\Image;
use Imagine\Image\Box;

class UploadFiles extends Model 
{
    public $images = [];
    public $main_image;
    public $recomm_image;

    public function rules()
    {
        return [
            [['images'], 'image', 'maxFiles' => 3],
            [['main_image'], 'image'],
            [['recomm_image'], 'image'],
        ];
    }
    
    /**
     * @return array
     * 
     * Метод загрузки изображений в каталоги и их названий в БД.
     * 
     * Названия всех изображений сохраняются в колонке images при помоши ф-ии Serialize([$fileName]);
     * 
     * Данный метод возвращает массив имеющий следющую структуру:
     * 
     * Images => [
     *      Recommended => [
     *          'fileName' => fileName,
     *          'width' => (float) width,
     *      ],
     * 
     *      Main => "Mainfile_Name",
     * 
     *      Additional => [
     *          [0] => 'FirstFile_Name',
     *          [1] => 'SecondFile_Name',
     *          [2] => 'ThirdFile_Name',
     *      ],
     * ];
     *      
     * Загружает оригинал изображения и на его основе делает вторичные изображения для вывода на сайт.
     * Функция принимает 2 аргумента: 
     *  - Сегмент пути до нужной дирректории;
     *  - Список названия страрых изображений;
     * 
     * Вторичные изображения сохраняются в определенных дирректориях:
     *  - Для вывода в карточке товара - в папке "Main";
     *  - Изображения для товара отмеченного как рекомендуемый - в папке "Recommended";
     *  - Вторичные изображения для single product page - в папке "additional";
     */
    public function upload($segmentPath, $dbImages)
    {   
        if ($this->images) {
            if ($dbImages['additional']) {
                foreach($dbImages['additional'] as $image) {
                    @unlink(Yii::getAlias('@frontend') . "/web/uploads/images/$segmentPath/" . $image);
                    @unlink(Yii::getAlias('@frontend') . "/web/uploads/images/$segmentPath/additional/" . $image);
                }
            }
           $dbImages['additional'] = $this->uploadImages($segmentPath, $this->images);
        }
        if ($this->main_image) {
            @unlink(Yii::getAlias('@frontend') . "/web/uploads/images/$segmentPath/" . $dbImages['main']);
            @unlink(Yii::getAlias('@frontend') . "/web/uploads/images/$segmentPath/main/" . $dbImages['main']);
            $dbImages['main'] = $this->uploadImage($segmentPath, $this->main_image);
        }
        if ($this->recomm_image) {
            @unlink(Yii::getAlias('@frontend') . "/web/uploads/images/$segmentPath/" 
            . $dbImages['recommended']['fileName']);
            @unlink(Yii::getAlias('@frontend') . "/web/uploads/images/$segmentPath/recommended/" 
            . $dbImages['recommended']['fileName']);
            $dbImages['recommended'] = $this->uploadRecommImage($segmentPath, $this->recomm_image);
        }

       // print_r($dbImages);exit;
        $dbImages = serialize($dbImages);
        return $dbImages;
    }
    


    protected function uploadImage($segmentPath, $main_image)
    {
        $fileName = $main_image->baseName . time() . rand(0, 1000) . 
        '.' . $main_image->extension;
        $pathToNewFile = "/web/uploads/images/$segmentPath/$fileName";

        $main_image->saveAs(Yii::getAlias('@frontend'). $pathToNewFile);

        $path = Yii::getAlias('@frontend'). $pathToNewFile;
        $mainImage = Image::getImagine()->open($path);
        Image::thumbnail($mainImage, 262, 280)
            ->save(Yii::getAlias(Yii::getAlias('@frontend') . 
                "/web/uploads/images/$segmentPath/main/$fileName"), [
                'quality' => 85
            ]);

        return $fileName;
    }

    protected function uploadImages($segmentPath, $images)
    {   
        $additionalImg = [];

        foreach($images as $image) 
        {
            $fileName = $image->baseName . time() . rand(0, 1000) . '.' . $image->extension;
            $pathToNewFile = "/web/uploads/images/$segmentPath/$fileName";

            $image->saveAs(Yii::getAlias('@frontend'). $pathToNewFile);
            $additionalImg[] = $fileName;

            $path = Yii::getAlias('@frontend'). $pathToNewFile;

            $mainImage = Image::getImagine()->open($path);
            $sizes = getimagesize($path);

            $width = 555;
            $height = round($sizes[1] * $width/$sizes[0]);
            $mainImage->resize(new Box($width, $height))->thumbnail(new Box(555, 600))
                ->save(Yii::getAlias(Yii::getAlias('@frontend') . 
                    "/web/uploads/images/$segmentPath/additional/$fileName"), [
                    'quality' => 85
                ]);
        }
        return $additionalImg;
    }

    protected function uploadRecommImage($segmentPath, $recomm_image)
    {
        $reccomended_data = [];
        
        $fileName = $recomm_image->baseName . time() . rand(0, 1000) . 
        '.' . $recomm_image->extension;
        $pathToNewFile = "/web/uploads/images/$segmentPath/$fileName";
        $reccomended_data['fileName'] = $fileName;

        $recomm_image->saveAs(Yii::getAlias('@frontend'). $pathToNewFile);

        $path = Yii::getAlias('@frontend'). $pathToNewFile;
        $mainImage = Image::getImagine()->open($path);
        $sizes = getimagesize($path);

        $coefficient = $sizes[1] / $sizes[0];

        if ($coefficient <= 1) {
            $reccomended_data['width'] = 80;
        } else {
            $width = 85 / $coefficient;
            $reccomended_data['width'] = $width;
        }
        Image::thumbnail($mainImage, null, 400)
            ->save(Yii::getAlias(Yii::getAlias('@frontend') . 
                "/web/uploads/images/$segmentPath/recommended/$fileName"), [
                'quality' => 85
            ]);
        
        return $reccomended_data;
    }

}