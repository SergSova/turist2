<?php

    namespace app\commands;

    use Yii;
    use yii\console\Controller;

    class RbacController extends Controller{
        public function actionInit(){
            $auth = Yii::$app->authManager;

            // добавляем разрешение "createPost"
            $createPost = $auth->createPermission('createPost');
            $createPost->description = 'Create a post';
            $auth->add($createPost);

            // добавляем разрешение "updatePost"
            $updatePost = $auth->createPermission('updatePost');
            $updatePost->description = 'Update post';
            $auth->add($updatePost);

            // добавляем роль "author" и даём роли разрешение "createPost"
            $author = $auth->createRole('user');
            $auth->add($author);
            $auth->addChild($author, $createPost);

            $rule = new AuthorRule();
            $auth->add($rule);

            // добавляем разрешение "updateOwnPost" и привязываем к нему правило.
            $updateOwnPost = $auth->createPermission('updateOwnPost');
            $updateOwnPost->description = 'Update own post';
            $updateOwnPost->ruleName = $rule->name;
            $auth->add($updateOwnPost);

            // "updateOwnPost" будет использоваться из "updatePost"
            $auth->addChild($updateOwnPost, $updatePost);

            // разрешаем "автору" обновлять его посты
            $auth->addChild($author, $updateOwnPost);

            //добавляем правило на добавление фото
            $photo = new ParticipantRule();
            $auth->add($photo);

            //добавляем разрешение "addPhoto"  и привязываем к нему правило
            $addPhoto = $auth->createPermission('addPhoto');
            $addPhoto->description = 'Add photo to post';
            $addPhoto->ruleName = $photo->name;
            $auth->add($addPhoto);

            // добавляем роль "participant" и даём роли разрешение "addPhoto"
            $participant = $auth->createRole('participant');
            $auth->add($participant);
            $auth->addChild($participant, $addPhoto);

            $auth->addChild($author, $addPhoto);

            // добавляем роль "admin" и даём роли разрешение "updatePost"
            // а также все разрешения роли "author"
            $admin = $auth->createRole('admin');
            $auth->add($admin);
            $auth->addChild($admin, $updatePost);
            $auth->addChild($admin, $author);

            $moder = $auth->createRole('moder');
            $auth->add($moder);
            $auth->addChild($moder, $admin);

            //            // Назначение ролей пользователям. 1 и 2 это IDs возвращаемые IdentityInterface::getId()
            //            // обычно реализуемый в модели User.
            //            $auth->assign($author, 2);
            //            $auth->assign($admin, 1);
        }
    }