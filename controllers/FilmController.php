<?php

namespace app\controllers;

use app\models\FilmForm;
use app\models\Films;
use app\models\Images;
use app\models\NewsForm;
use app\models\Seo;
use Yii;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\MyForm;
use yii\helpers\Html;
use yii\web\UploadedFile;


class FilmController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionFilms(){

        $films = Films::find()->all();

        return $this->render('films',['films'=>$films]);

    }

    public function actionFilm($id){
        $query = new Query;

        $query  ->select('*')

        ->from('films')

        ->join('LEFT OUTER JOIN','seo', 'seo.seo_id = films.seo_id')

        ->join('LEFT OUTER JOIN','images', 'images.post_id = films.id')

        ->where('films.id = '.$id)

        ->where('images.post_type = "film" ');



$command = $query->createCommand();

$data = $command->queryAll();


        return $this->render('film',['film'=>$data]);

    }

    public function actionShow(){

        $model = new FilmForm();
        if($model->load(Yii::$app->request->post())){

            $title = Html::encode($model->title);
            $description = Html::encode($model->description);
            $trailer_url = Html::encode($model->trailer_url);
           // $film_type = Html::encode($model->film_type);
            $seo_url = Html::encode($model->seo_url);
            $seo_title = Html::encode($model->seo_title);
            $seo_keywords = Html::encode($model->seo_keywords);
            $seo_description = Html::encode($model->seo_description);


            $seo = new Seo();

            $seo->seo_url = $seo_url;
            $seo->seo_title = $seo_title;
            $seo->seo_keywords = $seo_keywords;
            $seo->seo_description = $seo_description;

            $seo->save();

            $film = new Films();

            $film->title = $title;
            $film->discription = $description;
            $film->trailer_url = $trailer_url;
            $film->seo_id = $seo->seo_id;


            foreach ($model->film_type as $type) {
              $types[] = $type;
            }
            if(isset($types))
            $film->film_type = $types;

            $model->image = UploadedFile::getInstance($model, 'image');
            if($model->image)
            if($model->uploadOne()) {
                $film->image = 'photo/' . $model->image->baseName . '.' . $model->image->extension;
            }

            $film->save();


            $model->gallery = UploadedFile::getInstances($model, 'gallery');
            if($model->gallery)
                foreach ($model->gallery as $file) {
                    $file->saveAs('photo/' . $file->baseName . '.' . $file->extension);
                    $image = new Images();
                    $image->images_url = 'photo/' . $file->baseName . '.' . $file->extension;
                    $image->post_id = $film->id;
                    $image->post_type = 'film';
                    $image->save();

                }
        }else{
            $title = '';
            $description = '';
            $trailer_url = '';
            $film_type = '';
            $seo_url = '';
            $seo_title = '';
            $seo_keywords = '';
            $seo_description = '';

        }
        return $this->render('add', ['form'=>$model,
            'title' => $title,
            'description' => $description,
            'trailer_url' => $trailer_url,
            'film_type' => $film_type,
            'seo_url' => $seo_url,
            'seo_title' => $seo_title,
            'seo_keywords' => $seo_keywords,
            'seo_description' => $seo_description,

        ]);
    }


    public function actionDelete($id){
        $model = Films::findOne($id);
       // var_dump($model);
        $seo = Seo::findOne($model->seo_id);
        $seo->delete();

        $images = Images::deleteAll(['post_id = '.$id ,'post_type = film']);
        $model ->delete();
        return $this->render('delete', ['form'=>$model

        ]);
    }

    public function actionEdit($id){

        $model = new FilmForm();
        if($model->load(Yii::$app->request->post())){

            $title = Html::encode($model->title);
            $description = Html::encode($model->description);
            $trailer_url = Html::encode($model->trailer_url);
            // $film_type = Html::encode($model->film_type);
            $seo_url = Html::encode($model->seo_url);
            $seo_title = Html::encode($model->seo_title);
            $seo_keywords = Html::encode($model->seo_keywords);
            $seo_description = Html::encode($model->seo_description);

            $film = Films::findOne($id);

            $film->title = $title;
            $film->discription = $description;
            $film->trailer_url = $trailer_url;




            $model->image = UploadedFile::getInstance($model, 'image');
            if($model->image)
                if($model->uploadOne()) {
                    $film->image = 'photo/' . $model->image->baseName . '.' . $model->image->extension;
                }

            $film->save();

            $seo = Seo::findOne($film->seo_id);

            $seo->seo_url = $seo_url;
            $seo->seo_title = $seo_title;
            $seo->seo_keywords = $seo_keywords;
            $seo->seo_description = $seo_description;

            $seo->save();

            $model->gallery = UploadedFile::getInstances($model, 'gallery');
            if($model->gallery) {
                $images = Images::deleteAll(['post_id = '.$id,'post_type = film']);
                foreach ($model->gallery as $file) {
                    $file->saveAs('photo/' . $file->baseName . '.' . $file->extension);
                    $image = new Images();
                    $image->images_url = 'photo/' . $file->baseName . '.' . $file->extension;
                    $image->post_id = $film->id;
                    $image->post_type = 'film';
                    $image->save();

                }
            }
            return $this->actionFilms();
        }else{
            $film = Films::findOne($id);
            // var_dump($model);
            $title = $film -> title;
            $description = $film -> discription;
            $image = $film -> image;
            $trailer_url = $film -> trailer_url;
            $film_type = '';

            $seo = Seo::findOne($film->seo_id);
            $seo_url = $seo->seo_url;
            $seo_title = $seo->seo_title;
            $seo_keywords = $seo->seo_keywords;
            $seo_description = $seo->seo_description;

            $gallery = Images::find() -> where('post_id = '.$id) -> where('post_type = "film"') -> all();



            return $this->render('edit', ['form'=>$model,
                
                'title' => $title,
                'description' => $description,
                'trailer_url' => $trailer_url,
                'film_type' => $film_type,
                'seo_url' => $seo_url,
                'seo_title' => $seo_title,
                'seo_keywords' => $seo_keywords,
                'seo_description' => $seo_description,
                'gallery' => $gallery,
                'image' => $image,

            ]);

        }


    }

}