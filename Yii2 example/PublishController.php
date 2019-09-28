<?php
/**
 * Created by PhpStorm.
 * User: NEMOY
 * Date: 03.09.2019
 * Time: 17:35
 */

namespace app\controllers;


use app\models\ReplacePosts;
use app\models\tables\MediaContentAudio;
use app\models\tables\MediaContentPhoto;
use app\models\tables\MediaContentVideo;
use app\models\tables\PostFinal;
use app\models\tables\PostSchedule;
use app\models\tables\TempPhoto;
use yii\web\Controller;

class PublishController extends Controller
{
    public function actionIndex()
    {
        $dataProvider = (new PostFinal())->providerFinalPosts();
        $addedPosts = ReplacePosts::$postsSaved;

        return $this->render('index.php', [
            'dataProvider' => $dataProvider,
            'addedPosts' => $addedPosts,
        ]);
    }


    public function actionDelete()
    {
        $user = \Yii::$app->user->identity->getId();
        if (\Yii::$app->request->isAjax) {
           foreach(PostFinal::findAll(['id_user' => $user]) as $one){
               TempPhoto::deleteAll(['id_post_intermediate' => $one->id]);
           }
            PostFinal::deleteAll(['id_user' => $user]);

            return 'Все посты удалены';
        }
    }
    public function actionEditPost($id)
    {
        $model = PostFinal::findOne($id);
            $model->load(\Yii::$app->request->post());
            $model->save();

        return $this->redirect('/publish');

    }
    public function actionCreateSchedule($id,$user_id,$status)
    {
        $model = new PostSchedule();
        $model->post_final_id = $id;
        $model->user_id = $user_id;
        $model ->status = $status;
        $model->load(\Yii::$app->request->post());
        $model->save();

        return $this->redirect('/publish');

    }
    public function actionCopyPost($id)
    {
        $model = new PostFinal();
        $model->attributes = PostFinal::findOne($id)->attributes;
        $model->id = null;
        $model->save();
        foreach (MediaContentPhoto::findAll(['id_post_final' =>$id]) as $one){
            $modelPhoto = new MediaContentPhoto();
            $modelPhoto->attributes = $one->attributes;
            $modelPhoto->id = null;
            $modelPhoto->id_post_final = $model->id;
            $modelPhoto->save();
        }
        return $this->redirect('/publish');
    }


    public function actionDeletePost($id)
    {
        $model = PostFinal::findOne($id);
        $model->delete();
        PostSchedule::deleteAll(['post_final_id' => $id]);
        MediaContentPhoto::deleteAll(['id_post_final' => $id]);
        MediaContentAudio::deleteAll(['id_post_final' => $id]);
        MediaContentVideo::deleteAll(['id_post_final' => $id]);

        return $this->redirect('/publish');
    }


    public function actionDeleteSchedule($id){
        $model = PostSchedule::findOne($id);
        $model->delete();

        return $this->redirect('/publish');
    }
}