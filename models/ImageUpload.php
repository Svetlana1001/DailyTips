<?php
namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;


class ImageUpload extends Model{
	
	public $image;

public function rules()//правила выбора картинки определенных параметров и обязательно должен быть заполнен
{
	return [
       [['image'], 'required'],
       [['image'], 'file', 'extensions'=>'jpg,png']
	];
}

public function uploadFile(UploadedFile $file, $currentImage)
{
    $this->image = $file;
    if ($this->validate())//проверка валидации
    {
    	$this->deleteCurrentImage($currentImage);
        return $this->saveImage();
    }
}

private function getFolder()
{
	return Yii::getAlias('@web').'uploads/';
}

private function generateFilename()
{
	return strtolower(md5(uniqid($this->image->baseName)) . '.' . $this->image->extension);
}

public function deleteCurrentImage($currentImage)
{
	if($this->fileExists($currentImage))//если существует картинка
    {
       unlink($this->getFolder().$currentImage);//тогда удаляя предудыщий файл заменяем на новый
    }
}

public function fileExists($currentImage)
{
	if (!empty($currentImage)&& $currentImage != null)
	{
	return file_exists($this->getFolder().$currentImage);	
	}
}

public function saveImage()
{
	$filename = $this->generateFilename();//генерация названия картинки(чтобы не повторялось)
    $this->image->saveAs($this->getFolder().$filename);//сохранение в базу данных таблици статья
    return $filename;
}
}
