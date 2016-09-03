<?php

    namespace app\models;

    use app\components\Logging\Logging;
    use Yii;
    use yii\alexposseda\fileManager\FileManager;
    use yii\helpers\ArrayHelper;
    use yii\web\UploadedFile;

    /**
     * This is the model class for table "tur_event".
     *
     * @property integer       $id
     * @property integer       $event_type_id
     * @property integer       $creator_id
     * @property string        $title
     * @property string        $photo
     * @property string        $desc
     * @property string        $organizators
     * @property string        $particip
     * @property string        $condition
     * @property string        $date_start
     * @property string        $date_end
     * @property string        $date_creation
     * @property string        $status
     * @property integer       $rate
     *
     * @property Comments[]    $comments
     * @property EventType     $eventType
     * @property User          $creator
     * @property ParticEvent[] $particEvents
     */
    class Event extends \yii\db\ActiveRecord{
        const STATUS_ACTIVE   = 'ACTIVE';
        const STATUS_INACTIVE = 'INACTIVE';

        public $imageFiles;
        public $particip_temp;
        public $time_start;
        public $time_end;

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
                        'rate'
                    ],
                    'integer'
                ],
                [
                    [
                        'desc',
                        'particip',
                        'condition',
                        'status'
                    ],
                    'string'
                ],
                [
                    [
                        'particip_temp',
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
                    'skipOnError' => true,
                    'targetClass' => EventType::className(),
                    'targetAttribute' => ['event_type_id' => 'id']
                ],
                [
                    ['imageFiles'],
                    'file',
                    'skipOnEmpty' => true,
                    'extensions' => 'jpg, jpeg',
                    'maxFiles' => 4
                ],
                [
                    ['creator_id'],
                    'exist',
                    'skipOnError' => true,
                    'targetClass' => User::className(),
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

            ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels(){
            return [
                'id' => 'ID',
                'event_type_id' => 'Тип события',
                'creator_id' => 'Автор',
                'title' => 'Название',
                'photo' => 'Фотографии',
                'desc' => 'Описание',
                'organizators' => 'Организаторы',
                'particip' => 'Должности помошников',
                'condition' => 'Условия',
                'date_start' => 'Дата начала',
                'date_end' => 'Дата оклнчания',
                'date_creation' => 'Дата создания',
                'status' => 'Статус',
                'rate' => 'Регйтинг',
            ];
        }

        public function afterFind(){
            $this->organizators = json_decode($this->organizators);
            $this->_countRate();
            parent::afterFind();
        }

        public function beforeSave($insert){
            if(strpos($this->time_start, 'PM')){
                $h = 12 + substr($this->time_start, 0, strpos($this->time_start, ':'));
                $m = substr($this->time_start, strpos($this->time_start, ':')+1, -2);
            }else{
                $h = substr($this->time_start, 0, strpos($this->time_start, ':'));
                $m = substr($this->time_start, strpos($this->time_start, ':')+1, -2);
            }
            $this->date_start .= ' '.$h.':'.$m.':00';
            if(strpos($this->time_end, 'PM')){
                $h = 12 + substr($this->time_end, 0, strpos($this->time_end, ':'));
                $m = substr($this->time_end, strpos($this->time_end, ':')+1, -2);
            }else{
                $h = substr($this->time_end, 0, strpos($this->time_end, ':'));
                $m = substr($this->time_end, strpos($this->time_end, ':')+1, -2);
            }
            $this->date_end .= ' '.$h.':'.$m.':00';

            return parent::beforeSave($insert);
        }


        public function upload(){
            if($this->validate()){
                /** @var UploadedFile $file */
                foreach($this->imageFiles as $file){
                    $file->saveAs('uploads/'.$this->id.'_'.$file->baseName.'.'.$file->extension);
                }

                return true;
            }else{
                return false;
            }
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
        public function getEventType(){
            return $this->hasOne(EventType::className(), ['id' => 'event_type_id']);
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
        public function getParticEvents(){
            return $this->hasMany(ParticEvent::className(), ['event_id' => 'id']);
        }

        public function getAllOrganizators(){
            return ArrayHelper::map(User::find()
                                        ->filterWhere([
                                                          'not in',
                                                          'id',
                                                          $this->organizators
                                                      ])
                                        ->all(), 'id', 'username');
        }

        public function getOrganizatorsList(){
            $aa = User::findAll($this->organizators);
            $usen = '';
            foreach($aa as $item){
                //todo сделать ссылки на страницы пользователей
                $usen .= $item->username.', ';
            }

            return substr($usen, 0, -2);
        }

        public function getTypes(){
            return ArrayHelper::map(EventType::find()
                                             ->all(), 'id', 'name');
        }

        public function getOrganisatorById($id){
            return User::findOne($id)->username;
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
                                    'user_id' => Yii::$app->user->id
                                ])
                        ->one();
        }

        private function _countRate(){
            $comment = $this->getComments()
                            ->sum('rate');
            $user = $this->getParticEvents()
                         ->joinWith('user')
                         ->sum('rate');
            $this->rate = $comment + $user;
        }

    }
