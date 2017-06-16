<?php
namespace app\models;

use Yii;
use yii\base\Model;

class FilmForm extends Model {

    public $title;
    public $description;
    public $image;
    public $gallery;
    public $trailer_url;
    public $film_type;
    public $seo_url;
    public $seo_title;
    public $seo_keywords;
    public $seo_description;


    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            [['seo_url','seo_title', 'seo_keywords', 'seo_description'], 'string'],
            [['film_type'], 'safe'],
            [['image'], 'file','extensions' => 'gif, jpg, png'],
            [['gallery'], 'file',  'extensions' => 'gif, jpg, png', 'maxFiles' => 4]

        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $mass = '';
            $ids = '';
            foreach ($this->gallery as $file) {
                $file->saveAs('photo/' . $file->baseName . '.' . $file->extension);
                $mass[] = 'photo/' . $file->baseName . '.' . $file->extension;
            }

            foreach($mass as $pictyre){
                $image = new Images();
                $image->url = $pictyre;
                $image->save();
                $ids[]=$image->id;
            }
            return true;
        } else {
            return false;
        }
    }

    public function uploadOne()
    {
        if ($this->validate()) {
            $this->image->saveAs('photo/' . $this->image->baseName . '.' . $this->image->extension);
            return true;
        } else {
            return false;
        }
    }

}