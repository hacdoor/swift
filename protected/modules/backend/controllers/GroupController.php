<?php

class GroupController extends BackendController {

    protected function beforeAction($action) {
        $this->checkAccess();
        return parent::beforeAction($action);
    }

    public function actionIndex() {
        $this->checkAccess('admin.group.view');

        $data = null;
        $pages = null;
        $filters = array(
            'name' => '',
        );

        $criteria = new CDbCriteria;
        $criteria->order = Yii::app()->setting->get('default_sort');

        if (isset($_GET['Filter']))
            $filters = $_GET['Filter'];
        if ($filters['name'])
            $criteria->addSearchCondition('name', $filters['name']);

        $dataCount = Group::model()->count($criteria);

        $pages = new CPagination($dataCount);
        $pages->setPageSize(Yii::app()->setting->get('list_size'));
        $pages->applyLimit($criteria);

        $data = Group::model()->findAll($criteria);
        
        $breadcrumb = array(
            0 => array('url' => '', 'label' => 'System'),
            1 => array('url' => '', 'label' => 'Kelompok')
        );

        $vars = array(
            'data' => $data,
            'pages' => $pages,
            'filters' => $filters,
            'breadcrumb' => $breadcrumb
        );

        $this->render('index', $vars);
    }

    public function actionCreate() {
        $this->checkAccess('admin.group.create');

        $model = new Group;

        // Permissions
        $permissions = array();
        $rawPermissions = Permission::model()->findAll();
        foreach ($rawPermissions as $p) {
            $ps = explode('.', $p->name);
            switch ($ps[0]) {
                case 'negara':
                    $key = 'Negara';
                    break;
                case 'propinsi':
                    $key = 'Propinsi';
                    break;
                case 'admin':
                    $key = 'Admin';
                    break;
                default:
                    $key = 'System';
                    break;
            }
            $permissions[$key][] = $p;
        }

        if (isset($_POST['Group'])) {
            $model->attributes = $_POST['Group'];

            if ($model->validate()) {
                if ($model->save()) {
                    // Save permissions
                    if (isset($_POST['Group']['permissions'])) {
                        foreach ($_POST['Group']['permissions'] as $p) {
                            $gp = new GroupPermission;
                            $gp->group_id = $model->id;
                            $gp->permission_id = $p;
                            $gp->save();
                        }
                    }

                    // Redirect
                    Yii::app()->user->setFlash('success', 'Success!|' . 'New Group has been created.');
                    $this->redirect($this->vars['backendUrl'] . 'group');
                } else {
                    Yii::app()->user->setFlash('warning', 'Failed!|' . 'Failed creating Group, please try again.');
                }
            } else {
                Yii::app()->user->setFlash('danger', 'Error!|' . 'Failed creating Group, please check below for errors.');
            }
        }

        $vars = array(
            'model' => $model,
            'permissions' => $permissions,
        );

        $this->render('create', $vars);
    }

    public function actionUpdate($slug) {
        $this->checkAccess('admin.group.update');

        $model = Group::model()->findBySlug($slug);

        if (!$model) {
            $this->redirect($this->vars['backendUrl'] . 'group');
            Yii::app()->end();
        }

        // Permissions
        $permissions = array();
        $rawPermissions = Permission::model()->findAll();
        foreach ($rawPermissions as $p) {
            $ps = explode('.', $p->name);
            switch ($ps[0]) {
                case 'negara':
                    $key = 'Negara';
                    break;
                case 'propinsi':
                    $key = 'Propinsi';
                    break;
                case 'admin':
                    $key = 'Admin';
                    break;
                default:
                    $key = 'System';
                    break;
            }
            $permissions[$key][] = $p;
        }

        if (isset($_POST['Group'])) {
            $model->attributes = $_POST['Group'];

            if ($model->validate()) {
                if ($model->save()) {
                    // Delete all permissions
                    $criteria = new CDbCriteria;
                    $criteria->condition = 'group_id = :groupId';
                    $criteria->params = array(':groupId' => $model->id);
                    GroupPermission::model()->deleteAll($criteria);

                    // Save new permissions
                    if (isset($_POST['Group']['permissions'])) {
                        foreach ($_POST['Group']['permissions'] as $p) {
                            $gp = new GroupPermission;
                            $gp->group_id = $model->id;
                            $gp->permission_id = $p;
                            $gp->save();
                        }
                    }

                    // Redirect
                    Yii::app()->user->setFlash('success', 'Success!|' . 'Group has been updated.');
                    $this->redirect($this->vars['backendUrl'] . 'group');
                } else {
                    Yii::app()->user->setFlash('warning', 'Failed!|' . 'Failed updating Group, please try again.');
                }
            } else {
                Yii::app()->user->setFlash('danger', 'Error!|' . 'Failed updating Group, please check below for errors.');
            }
        }

        $vars = array(
            'model' => $model,
            'permissions' => $permissions,
        );

        $this->render('update', $vars);
    }

    public function actionDelete($slug) {
        $this->checkAccess('admin.group.delete');

        $model = Group::model()->findBySlug($slug);

        if (!$model) {
            $this->redirect($this->vars['backendUrl'] . 'group');
            Yii::app()->end();
        }

        // Check admin
        $adminCount = Admin::model()->count('group_id = ' . $model->id);
        if ($adminCount > 0) {
            Yii::app()->user->setFlash('danger', 'Failed!|' . 'Failed deleting Group, this Group has Admin.');
            $this->redirect($this->vars['backendUrl'] . 'group');
            Yii::app()->end();
        }

        $admin = Yii::app()->user->getState('admin');
        if ($model->id == $admin->group->id) {
            Yii::app()->user->setFlash('warning', 'Failed!|' . 'Failed deleting Group, you cannot delete your own group.');
            $this->redirect($this->vars['backendUrl'] . 'group');
        }

        if ($model->id == 1) {
            Yii::app()->user->setFlash('warning', 'Failed!|' . 'Failed deleting Group, you cannot delete this Group.');
            $this->redirect($this->vars['backendUrl'] . 'group');
        }

        // Delete group
        $modelId = $model->id;
        if ($model->delete()) {
            // Delete all permissions
            $criteria = new CDbCriteria;
            $criteria->condition = 'group_id = :groupId';
            $criteria->params = array(':groupId' => $modelId);
            GroupPermission::model()->deleteAll($criteria);

            Yii::app()->user->setFlash('success', 'Success!|' . 'Group has been deleted.');
            $this->redirect($this->vars['backendUrl'] . 'group');
        } else {
            Yii::app()->user->setFlash('warning', 'Failed!|' . 'Failed deleting Media Group, please try again.');
            $this->redirect($this->vars['backendUrl'] . 'group');
        }

        Yii::app()->end();
    }

}