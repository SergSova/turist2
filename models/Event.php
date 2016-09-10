<?php

    namespace app\models;

    use macgyer\yii2materializecss\lib\Html;
    use Yii;
    use yii\db\ActiveRecord;
    use yii\helpers\ArrayHelper;
    use yii\helpers\Json;
    use yii\helpers\Url;
    use yii\sergsova\fileManager\FileManager;
    use yii\web\UploadedFile;

    /**
     * This is the model class for table "tur_event".
     *
     * @property integer         $id
     * @property integer         $event_type_id
     * @property integer         $creator_id
     * @property string          $title
     * @property string          $photo
     * @property string          $desc
     * @property string          $organizators
     * @property string          $particip
     * @property string          $condition
     * @property string          $date_start
     * @property string          $date_end
     * @property string          $date_creation
     * @property string          $status
     * @property integer         $rate
     * @property string          $track_path
     * @property integer         $people_count
     * @property integer         $difficult
     *
     *
     * @property Comments[]      $comments
     * @property User            $creator
     * @property EventType       $eventType
     * @property ParticEvent[]   $particEvents
     * @property EventUserRule[] $eventUserRules
     */
    class Event extends ActiveRecord{
        const STATUS_ACTIVE   = 'ACTIVE';
        const STATUS_INACTIVE = 'INACTIVE';
        const STATUS_BLOCKED  = 'BLOCKED';
        const STATUS_FINISH   = 'FINISH';

        public $time_start;
        public $time_end;

        public $track;

        /**
         * @inheritdoc
         */
        public static function tableName(){
            return 'tur_event';
        }

        /**
         * @inheritdoc
         */
        public function rules(){
            return [
                [
                    [
                        'event_type_id',
                        'title',
                        'desc',
                        'date_start',
                        'date_end',
                        'time_start',
                        'time_end'
                    ],
                    'required'
                ],
                [
                    [
                        'event_type_id',
                        'creator_id',
                        'rate',
                        'people_count',
                        'difficult'
                    ],
                    'integer'
                ],
                [
                    [
                        'desc',
                        'particip',
                        'condition',
                        'status',
                        'track_path',
                        'photo'
                    ],
                    'string'
                ],
                [
                    [
                        'organizators',
                        'date_creation'
                    ],
                    'safe'
                ],
                [
                    ['title'],
                    'string',
                    'max' => 255
                ],
                [
                    ['event_type_id'],
                    'exist',
                    'skipOnError'     => true,
                    'targetClass'     => EventType::className(),
                    'targetAttribute' => ['event_type_id' => 'id']
                ],
                [
                    ['creator_id'],
                    'exist',
                    'skipOnError'     => true,
                    'targetClass'     => User::className(),
                    'targetAttribute' => ['creator_id' => 'id']
                ],
                [
                    ['creator_id'],
                    'default',
                    'value' => Yii::$app->user->id
                ],
                [
                    'date_creation',
                    'default',
                    'value' => date('Y-m-d H:i:s')
                ],
                [
                    'rate',
                    'default',
                    'value' => 0
                ],
                [
                    'status',
                    'default',
                    'value' => self::STATUS_INACTIVE
                ],
                [
                    'track',
                    'file',
                    'extensions' => 'kml, gpx, plt'
                ]

            ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels(){
            return [
                'id'            => 'ID',
                'event_type_id' => 'Тип события',
                'creator_id'    => 'Автор',
                'title'         => 'Название',
                'photo'         => 'Фотографии',
                'desc'          => 'Описание',
                'organizators'  => 'Организаторы',
                'particip'      => 'Должности помошников',
                'condition'     => 'Условия',
                'date_start'    => 'Дата начала',
                'date_end'      => 'Дата оклнчания',
                'date_creation' => 'Дата создания',
                'status'        => 'Статус',
                'rate'          => 'Регйтинг',
                'people_count'  => 'Максимальное количество участников',
                'difficult'     => 'Сложность'
            ];
        }

        public function afterFind(){
            $this->organizators = json_decode($this->organizators);
            $this->_countRate();

            if(strtotime($this->date_end) < strtotime(date('Y-m-d H:i:s'))){
                $this->status = self::STATUS_FINISH;
                $this->save(false);
            }

            $this->time_start = date('H:i', strtotime($this->date_start));
            $this->time_end = date('H:i', strtotime($this->date_end));
            parent::afterFind();
        }

        public function beforeSave($insert){
            if($this->time_start){
                $this->date_start = date('Y-m-d H:i:s', strtotime($this->date_start) + strtotime($this->time_start) - strtotime(date('Y-m-d')));
            }
            if($this->time_end){
                $this->date_end = date('Y-m-d H:i:s', strtotime($this->date_end) + strtotime($this->time_end) - strtotime(date('Y-m-d')));
            }

            $this->track = UploadedFile::getInstance($this, 'track');
            if($this->track){
                FileManager::getInstance()
                           ->createDirectory('event_track');
                $this->track->saveAs(FileManager::getInstance()
                                                ->getStoragePath().'event_track/'.$this->track->baseName.'.'.$this->track->extension);
                $this->track_path = Json::encode(['event_track/'.$this->track->baseName.'.'.$this->track->extension]);
            }

            return parent::beforeSave($insert);
        }

        public function afterSave($insert, $changedAttributes){

            if($insert){
                $participant = new ParticEvent();
                $participant->user_id = Yii::$app->user->id;
                $participant->event_id = $this->id;
                $participant->confirmed = true;
                $participant->insert();
                $m = new EventUserRule();
                $m->eventId = $this->id;
                $m->userId = Yii::$app->user->getId();;
                $m->ruleId = EventRule::ALL;
                $m->save();
            }else{
                if($this->organizators){
                    $orgs = json_decode($this->organizators);
                    foreach($orgs as $org){
                        $m = new EventUserRule();
                        $m->eventId = $this->id;
                        $m->userId = $org['id'];
                        $m->ruleId = EventRule::ALL;
                        $m->save();
                    }
                }
            }

            parent::afterSave($insert, $changedAttributes);
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getComments(){
            return $this->hasMany(Comments::className(), ['event_id' => 'id']);
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getCreator(){
            return $this->hasOne(User::className(), ['id' => 'creator_id']);
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getEventType(){
            return $this->hasOne(EventType::className(), ['id' => 'event_type_id']);
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getEventUserRule(){
            return $this->hasOne(EventUserRule::className(), ['eventId' => 'id']);
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getParticEvents(){
            return $this->hasMany(ParticEvent::className(), ['event_id' => 'id']);
        }

        public function getTypes(){
            return ArrayHelper::map(EventType::find()
                                             ->all(), 'id', 'name');
        }

        public function getParticToEvent(){
            $parcEvent = [];
            foreach($this->getParticEvents()
                         ->where(['confirmed' => 1])
                         ->all() as $key => $item){
                $parcEvent[$key] = [];
                $photo = json_decode($item->user->photo)[0];
                if(explode('/', $photo)[0] != 'http:'){
                    $parcEvent[$key][$item->user->username] = FileManager::getInstance()
                                                                         ->getStorageUrl().str_replace('\\', '/', $photo);
                }else{
                    $parcEvent[$key][$item->user->username] = $photo;
                }
            }

            return json_encode($parcEvent);
        }

        public function isRegistred(){
            return $this->getParticEvents()
                        ->where([
                                    'event_id' => $this->id,
                                    'user_id'  => Yii::$app->user->id
                                ])
                        ->one();
        }

        private function _countRate(){
            $comment = $this->getComments()
                            ->sum('rate');
            $user = $this->getParticEvents()
                         ->joinWith('user')
                         ->sum('rate');
            $this->rate += $comment + $user;
        }

        public static function getMaxRate(){
            return self::find()
                       ->max('rate');
        }


        public function canChangePhoto(){
            return $this->getEventUserRule()
                        ->where(['userId' => Yii::$app->user->getId()])
                        ->andWhere(['ruleId' => EventRule::PHOTO])
                        ->exists();
        }

        public function canParticipiat(){
            return $this->getEventUserRule()
                        ->where(['userId' => Yii::$app->user->getId()])
                        ->andWhere(['ruleId' => EventRule::PARTICIPIANT])
                        ->exists();
        }

        public function canAllChange(){
            return $this->getEventUserRule()
                        ->where(['userId' => Yii::$app->user->getId()])
                        ->andWhere(['ruleId' => EventRule::ALL])
                        ->all();
        }

        public function getButton(){
            /** @var \app\models\ParticEvent $particip если существует возвращает связку пользователь-событие */
            $particip = $this->isRegistred();
            switch($this->eventType->name){
                case 'free':
                    if($particip){
                        return Html::a('Отменить', [
                            'remove-particip',
                            'event_id'  => $this->id,
                            'returnUrl' => Url::to('')
                        ], ['class' => 'btn amber full-width waves-effect waves-light', 'data-pjax' => 0]);
                    }else{
                        return Html::a('Участвовать', [
                            'add-particip',
                            'event_id'  => $this->id,
                            'returnUrl' => Url::to('')
                        ], ['class' => 'btn blue full-width waves-effect waves-light', 'data-pjax' => 0]);
                    }
                    break;
                case 'cash':
                    return Html::tag('z', 'Заплатить', ['class' => 'btn red lighten-2 full-width waves-effect waves-light']);
                    break;
                case 'registred':
                    if($particip){
                        if(!$particip->confirmed){
                            return Html::tag('z', 'подтверждается', ['class' => 'btn tilt lighten-2 full-width waves-effect waves-light']);
                        }
                        return Html::a('Отменить', [
                            'remove-particip',
                            'event_id'  => $this->id,
                            'returnUrl' => Url::to('')
                        ], ['class' => 'btn amber full-width waves-effect waves-light', 'data-pjax' => 0]);
                    }else{
                        echo Yii::$app->getView()->render('/event/_confirmForm', ['model' => $this]);
                        return Html::a('Подать заявку!', '#confirmModal-'.$this->id, ['class' => "btn amber full-width waves-effect waves-light modal-trigger"]);
                    }
                    break;
            }
        }
    }
