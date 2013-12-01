<?php

class AdminController extends BackendController {

    protected function beforeAction($action) {
        $this->checkAccess();
        return parent::beforeAction($action);
    }

    public function actionIndex() {
        $this->checkAccess('admin.view');

        $data = null;
        $pages = null;
        $filters = array(
            'username' => '',
            'is_active' => 'all',
            'group_id' => 'all',
            'created_start' => '',
            'created_end' => '',
        );

        $criteria = new CDbCriteria;
        $criteria->order = 'create_time DESC';

        if (isset($_GET['Filter']))
            $filters = $_GET['Filter'];
        if ($filters['username'])
            $criteria->addSearchCondition('username', $filters['username']);
        if ($filters['is_active'] != 'all')
            $criteria->addCondition('is_active = ' . mysql_escape_string($filters['is_active']));
        if ($filters['created_start'] || $filters['created_end'])
            $criteria->addBetweenCondition('create_time', $filters['created_start'] . ' 00:00:00', $filters['created_end'] . ' 23:59:59');

        $dataCount = Admin::model()->count($criteria);

        $pages = new CPagination($dataCount);
        $pages->setPageSize(Yii::app()->setting->get('list_size'));
        $pages->applyLimit($criteria);

        $data = Admin::model()->findAll($criteria);

        // Groups
        $groups = array();
        $allGroups = Group::model()->findAll();
        foreach ($allGroups as $ag) {
            $groups[] = $ag;
        }

        $breadcrumb = array(
            0 => array('url' => '', 'label' => 'System'),
            1 => array('url' => '', 'label' => 'Daftar Pengguna')
        );

        $vars = array(
            'data' => $data,
            'pages' => $pages,
            'filters' => $filters,
            'groups' => $groups,
            'breadcrumb' => $breadcrumb
        );

        $this->render('index', $vars);
    }

    public function actionCreate() {
        $this->checkAccess('admin.create');

        $model = new Admin;
        $tstamp = date('Y-m-d H:i:s');

        // Groups
        $groups = Group::model()->findAll();

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

        if (isset($_POST['Admin'])) {
            $model->attributes = $_POST['Admin'];
            $model->create_time = $model->update_time = $tstamp;
            $model->is_active = (isset($_POST['Admin']['is_active'])) ? 1 : 0;

            if ($model->validate()) {
                $model->password = $model->confirm_password = Yii::app()->util->encryptPassword($model->password);
                if ($model->save()) {
                    // Save permissions
                    if (isset($_POST['Admin']['permissions'])) {
                        foreach ($_POST['Admin']['permissions'] as $p) {
                            $gp = new AdminPermission;
                            $gp->admin_id = $model->id;
                            $gp->permission_id = $p;
                            $gp->save();
                        }
                    }

                    // Redirect
                    Yii::app()->user->setFlash('success', 'Success!|' . 'New Admin has been created.');
                    $this->redirect($this->vars['backendUrl'] . 'admin');
                } else {
                    Yii::app()->user->setFlash('warning', 'Failed!|' . 'Failed creating Admin, please try again.');
                }
            } else {
                Yii::app()->user->setFlash('danger', 'Error!|' . 'Failed creating Admin, please check below for errors.');
            }
        }

        $breadcrumb = array(
            0 => array('url' => '', 'label' => 'System'),
            1 => array('url' => 'admin', 'label' => 'Daftar Pengguna'),
            2 => array('url' => '', 'label' => 'Buat Baru Admin')
        );

        $vars = array(
            'model' => $model,
            'groups' => $groups,
            'permissions' => $permissions,
            'breadcrumb' => $breadcrumb
        );

        $this->render('create', $vars);
    }

    public function actionUpdate($id) {
        $this->checkAccess('admin.create');

        $model = Admin::model()->findByPk($id);
        $userPwd = $model->password;

        if (!$model) {
            $this->redirect($this->vars['backendUrl'] . 'user');
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

        $tstamp = date('Y-m-d H:i:s');
        $groupPerms = array();
        foreach ($model->group->groupPermissions as $gp) {
            $groupPerms[] = $gp->permission_id;
        }

        if (isset($_POST['Admin'])) {
            $model->attributes = $_POST['Admin'];
            $model->update_time = $tstamp;
            $model->is_active = (isset($_POST['Admin']['is_active'])) ? 1 : 0;

            $changePwd = true;
            if (!isset($_POST['Admin']['change_password'])) {
                $changePwd = false;
            } else {
                if ($_POST['Admin']['change_password'] !== '1')
                    $changePwd = false;
            }

            if (!$changePwd)
                $model->password = $model->confirm_password = $userPwd;

            if ($model->validate()) {
                if ($changePwd)
                    $model->password = $model->confirm_password = Yii::app()->util->encryptPassword($model->password);
                if ($model->save()) {
                    // Delete all permissions
                    $criteria = new CDbCriteria;
                    $criteria->condition = 'admin_id = :adminId';
                    $criteria->params = array(':adminId' => $model->id);
                    AdminPermission::model()->deleteAll($criteria);

                    // Override group permissions
                    $overrides = isset($_POST['Admin']['group_permissions']) ? $_POST['Admin']['group_permissions'] : array();
                    foreach ($groupPerms as $ogp) {
                        if (!in_array($ogp, $overrides)) {
                            $gp = new AdminPermission;
                            $gp->allow = 0;
                            $gp->admin_id = $model->id;
                            $gp->permission_id = $ogp;
                            $gp->save();
                        }
                    }

                    // Save new permissions
                    if (isset($_POST['Admin']['permissions'])) {
                        foreach ($_POST['Admin']['permissions'] as $p) {
                            $gp = new AdminPermission;
                            $gp->admin_id = $model->id;
                            $gp->permission_id = $p;
                            $gp->save();
                        }
                    }

                    // Redirect
                    Yii::app()->user->setFlash('success', 'Success!|' . 'Admin has been updated.');
                    $this->redirect($this->vars['backendUrl'] . 'admin');
                } else {
                    Yii::app()->user->setFlash('warning', 'Failed!|' . 'Failed updating Admin, please try again.');
                }
            } else {
                Yii::app()->user->setFlash('danger', 'Error!|' . 'Failed updating Admin, please check below for errors.');
            }
        }

        $breadcrumb = array(
            0 => array('url' => '', 'label' => 'System'),
            1 => array('url' => 'admin', 'label' => 'Daftar Pengguna'),
            2 => array('url' => '', 'label' => 'Buat Baru Admin')
        );

        $vars = array(
            'model' => $model,
            'permissions' => $permissions,
            'breadcrumb' => $breadcrumb
        );

        $this->render('update', $vars);
    }

    public function actionDelete($id) {
        $this->checkAccess('admin.delete');

        $model = Admin::model()->findByPk($id);

        if (!$model) {
            $this->redirect($this->vars['backendUrl'] . 'admin');
            Yii::app()->end();
        }

        $tstamp = date('Y-m-d H:i:s');

        $admin = Yii::app()->user->getState('admin');
        if ($model->id == $admin->id) {
            Yii::app()->user->setFlash('warning', 'Failed!|' . 'Failed deleting Admin, you cannot delete your own account.');
            $this->redirect($this->vars['backendUrl'] . 'admin');
        }

        if ($model->group->id == 1 && $admin->group->id != 1) {
            Yii::app()->user->setFlash('warning', 'Failed!|' . 'Failed deleting Admin, you cannot delete this user.');
            $this->redirect($this->vars['backendUrl'] . 'admin');
        }

        // Delete admin
        $modelId = $model->id;
        if ($model->delete()) {
            // Delete all permissions
            $criteria = new CDbCriteria;
            $criteria->condition = 'admin_id = :adminId';
            $criteria->params = array(':adminId' => $modelId);
            AdminPermission::model()->deleteAll($criteria);

            Yii::app()->user->setFlash('success', 'Success!|' . 'Admin has been deleted.');
            $this->redirect($this->vars['backendUrl'] . 'admin');
        } else {
            Yii::app()->user->setFlash('warning', 'Failed!|' . 'Failed deleting Admin, please try again.');
            $this->redirect($this->vars['backendUrl'] . 'admin');
        }

        Yii::app()->end();
    }

}