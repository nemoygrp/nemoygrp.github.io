<?php
/**
 * Created by PhpStorm.
 * User: NEMOY
 * Date: 18.03.2019
 * Time: 14:03
 */

namespace app\controllers;
use app\model\Feedback;

class FeedbackController extends Controller
{
    public function actionAllFeedback(){
        $allFeedback = Feedback::getAll();
        //var_dump($allFeedback);
        echo $this->render("feedback",['allFeedback'=> $allFeedback]);
    }

}