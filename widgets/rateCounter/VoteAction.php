<?php

    namespace app\widgets\rateCounter;

    use app\models\Coments;
    use app\models\Event;
    use app\models\User;
    use app\models\Vote;
    use Yii;
    use yii\base\Action;
    use yii\base\Exception;
    use yii\base\Model;
    use yii\db\ActiveRecord;

    class VoteAction extends Action{
        public $model_id;
        public $type;
        public $rate;
        public $rate_type;

        public function init(){
            parent::init();
            $this->rate = Yii::$app->request->post('rate');
            $this->rate_type = Yii::$app->request->post('rate_type');
            $this->model_id = Yii::$app->request->get('model_id');
        }

        public function run(){
            $vote = new Vote();
            $vote->user_id = Yii::$app->user->id;
            $vote->model_name = $this->type;
            $vote->model_id = $this->model_id;
            $vote->rate_type = $this->rate_type;
            $transaction = Yii::$app->db->beginTransaction();

            try{
                if(!$vote->validate()){
                    throw new \Exception($vote->getFirstError('model_id'));
                }
                /** @var ActiveRecord $model */
                $this->type = 'app\models\\'.ucfirst($this->type);
                $model = new $this->type;

                $model = $model::findOne($this->model_id);
                if($this->rate_type == 'up'){
                    $model->rate++;
                }else{
                    $model->rate--;
                }
                if(!$model->save()){
                    throw new \Exception($model->getFirstError('rate'));
                }
                $vote->save();
                $transaction->commit();
            }catch(Exception $e){
                $transaction->rollBack();
            }

            return $this->controller->redirect(Yii::$app->request->post('goBack'));
        }
    }