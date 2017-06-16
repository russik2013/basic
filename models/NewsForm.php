<?php
namespace app\models;

use Yii;
use yii\base\Model;

class NewsForm extends Model {

    public $title;
    public $public_data;
    public $description;
    public $image;
    public $gallery;
    public $video_url;
    public $seo_url;
    public $seo_title;
    public $seo_keywords;
    public $seo_description;


    public function rules()
    {
        return [
            [['title', 'public_data', 'description', 'image', 'gallery', 'video_url', 'seo_url',
                'seo_title', 'seo_keywords', 'seo_description'], 'required'],
            [['image'], 'file','extensions' => 'gif, jpg, png']

        ];
    }


}