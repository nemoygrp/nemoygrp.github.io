<?php
/**
 * Created by PhpStorm.
 * User: NEMOY
 * Date: 05.09.2019
 * Time: 20:53
 */

namespace app\widgets;


use app\models\tables\Groups;
use app\models\tables\MediaContentPhoto;
use app\models\tables\PostFinal;
use app\models\tables\PostSchedule;
use yii\base\Widget;
use yii\helpers\Html;

class PublishPreview extends Widget
{
    public $model;


    public function run(){
        $user_id = \Yii::$app->user->identity->getId();

        if(is_a($this->model, PostFinal::class)){
            foreach ($this->getPhotoArray($this->model->id) as $one){
                    if ($one) {
                        $url = $one['url'];
                }
            }
            return $this->render('publish_preview', [
                'user_id' => $user_id,
                'model' => $this->model,
                'photo' => $url,
                'carouselItems' => $this->getItemsCarousel($this->model->id),
                'photoArray' => $this->getPhotoArray($this->model->id),
                'groups' => $this->getGroupsArray($user_id),
                'scheduleArray' => $this->getScheduleArray($this->model->id,$user_id),
                'scheduleForm' => new PostSchedule()
            ]);
        }
    }

    private function getItemsCarousel($id_item){
        $itemsCarousel = [];
        foreach ($this->getPhotoArray($id_item) as $one){
            $itemsCarousel[] = [
                'content' => Html::img($one['url']),
            ];
        }

        return $itemsCarousel;
    }

    private function getPhotoArray($id_item){

        $photoArray = [];
        foreach (MediaContentPhoto::findAll(['id_post_final' => $id_item]) as $one) {

            $once = $one->getAttributes($one->photoSizes);
            $id_photo = $one->getAttribute('id');
            foreach ($once as $item) {
                if ($item) {
                    $url = $item;
                }
            }
            $photoArray[] = [
                'id' => $id_photo,
                'url' => $url
            ];
        }
       return  $photoArray;
    }

    private function getScheduleArray($id_post,$userID){

        $scheduleArray =[];
        foreach (PostSchedule::findAll(['post_final_id' => $id_post]) as $one) {


            $once = $one->getAttributes();
            if ($once['user_id'] === $userID){
                $scheduleArray[] = $once;
            }
        }
        return $scheduleArray;
    }


    private function getGroupsArray($userID){
        $groupsArray =[];
        foreach (Groups::findAll(['user_id' => $userID]) as $one) {
            if (isset($one)){
                $onceID = $one->getAttribute('id');
                $onceTitle = $one->getAttribute('title');
                $groupsArray[] = [
                    $onceID => $onceTitle
                ];
            } else {
                $groupsArray[] = 'Нет групп';
            }

        }

        return $groupsArray['0'];

    }
}
/*echo "<pre>";
  var_dump($model);
  echo "</pre>";
  exit();*/