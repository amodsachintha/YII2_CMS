<?php

use yii\db\Migration;

/**
 * Class m181220_091724_init_rbac
 */
class m181220_091724_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $auth = Yii::$app->authManager;

        // add "createDocument" permission
        $createDocument = $auth->createPermission('createDocument');
        $createDocument->description = 'Create a Document';
        $auth->add($createDocument);

        // add "readDocument" permission
        $readDocument = $auth->createPermission('readDocument');
        $readDocument->description = 'Read a Document';
        $auth->add($readDocument);

        // add "updateDocument" permission
        $updateDocument = $auth->createPermission('updateDocument');
        $updateDocument->description = 'Update Document';
        $auth->add($updateDocument);

        // add "deleteDocument" permission
        $deleteDocument = $auth->createPermission('deleteDocument');
        $deleteDocument->description = 'Update Document';
        $auth->add($deleteDocument);

        // ------------------------------------------------------------

        // add "createUser" permission
        $createUser = $auth->createPermission('createUser');
        $createUser->description = 'Create new User';
        $auth->add($createUser);

        // add "readUser" permission
        $readUser = $auth->createPermission('readUser');
        $readUser->description = 'Read user details';
        $auth->add($readUser);

        // add "updateUser" permission
        $updateUser = $auth->createPermission('updateUser');
        $updateUser->description = 'Update user details';
        $auth->add($updateUser);

        // add "deleteUser" permission
        $deleteUser = $auth->createPermission('deleteUser');
        $deleteUser->description = 'Delete user details';
        $auth->add($deleteUser);



        // add "editor" role and give permissions
        $editor = $auth->createRole('editor');
        $auth->add($editor);
        $auth->addChild($editor, $createDocument);
        $auth->addChild($editor, $readDocument);
        $auth->addChild($editor, $updateDocument);
        $auth->addChild($editor, $deleteDocument);

        // add "sadmin" role and give permissions
        // as well as the permissions of the "editor" role
        $sadmin = $auth->createRole('sadmin');
        $auth->add($sadmin);
        $auth->addChild($sadmin, $createUser);
        $auth->addChild($sadmin, $readUser);
        $auth->addChild($sadmin, $updateUser);
        $auth->addChild($sadmin, $deleteUser);
        $auth->addChild($sadmin, $editor);

        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
//        $auth->assign($editor, 2);
//        $auth->assign($sadmin, 1);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();
    }

}
