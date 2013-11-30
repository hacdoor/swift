<?php
$admin = Yii::app()->user->getState('admin');
?>
<div class="row">
    <div class="col-md-12">
        <div id="content-inner">
            <h1 class="page-title"><span class="icon-user"></span> Admin</h1>

            <div class="row">
                <div class="col-md-10">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped list">
                            <thead>
                                <tr>
                                    <th class="list-number">#</th>
                                    <th>Username</th>
                                    <th class="wrap">Real Name</th>
                                    <th class="wrap">Email</th>
                                    <th class="wrap">Group</th>
                                    <th class="wrap">Active</th>
                                    <th class="wrap">Created Time</th>
                                    <th class="list-actions">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $currentPage = $pages->currentPage + 1;
                                if ($data):
                                    ?>
                                    <?php
                                    $i = ($currentPage - 1) * $pages->pageSize;
                                    foreach ($data as $d):
                                        $i++;
                                        ?>
                                        <?php
                                        $dPerms = array();
                                        $formattedPerms = array();
                                        $listPerms = $d->getPermissions();
                                        foreach ($listPerms as $lp)
                                            $dPerms[] = $lp['name'];
                                        foreach ($dPerms as $dp) {
                                            $ps = explode('.', $dp);
                                            switch ($ps[0]) {
                                                case 'content':
                                                    $key = 'Content';
                                                    break;
                                                case 'comment':
                                                    $key = 'Comment';
                                                    break;
                                                case 'taxonomy':
                                                case 'classification':
                                                    $key = 'Category';
                                                    break;
                                                case 'media':
                                                    $key = 'Media';
                                                    break;
                                                case 'user':
                                                    $key = 'User';
                                                    break;
                                                case 'admin':
                                                    $key = 'Admin';
                                                    break;
                                                default:
                                                    $key = 'System';
                                                    break;
                                            }
                                            $formattedPerms[$key][] = $dp;
                                        }
                                        ?>
                                        <tr>
                                            <td class="list-number"><?php echo $i; ?>.</td>
                                            <td>
                                                <?php echo Yii::app()->util->purify($d->username); ?>

                                                <div class="modal modal-permission" id="modal-permission-<?php echo $d->id; ?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                <h4 class="modal-title">Permissions: <?php echo Yii::app()->util->purify($d->username); ?> <span class="badge"><?php echo count($listPerms); ?></span></h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>
                                                                <dl>
                                                                    <?php foreach ($formattedPerms as $k => $v): ?>
                                                                        <dt><?php echo Yii::app()->util->purify($k); ?></dt>
                                                                        <dd>
                                                                            <?php foreach ($v as $fp): ?>
                                                                                <span class="label label-default"><?php echo Yii::app()->util->purify($fp); ?></span>
                                                                            <?php endforeach; ?>
                                                                        </dd>
                                                                    <?php endforeach; ?>
                                                                </dl>
                                                                </p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="wrap"><?php echo Yii::app()->util->purify($d->realname); ?></td>
                                            <td class="wrap"><?php echo Yii::app()->util->purify($d->email); ?></td>
                                            <td class="wrap"><?php echo Yii::app()->util->purify($d->group->name); ?></td>
                                            <td class="wrap"><?php if ($d->is_active): ?><span class="label label-success">Yes</span><?php else: ?><span class="label label-danger">No</span><?php endif; ?></td>
                                            <td class="wrap"><?php echo Yii::app()->dateFormatter->formatDateTime($d->create_time, 'medium'); ?></td>
                                            <td class="list-actions">
                                                <a href="#modal-permission-<?php echo $d->id; ?>" data-toggle="modal" class="btn btn-xs btn-default bootip" title="Effective Permissions <strong>(<?php echo count($listPerms); ?>)</strong>"><span class="icon icon-key"></span></a>
                                                <?php if ($admin->hasPermissions('admin.update')): ?>
                                                    <a href="<?php echo $this->vars['backendUrl']; ?>admin/update/<?php echo $d->id; ?>" class="btn btn-xs btn-default bootip" title="Update"><span class="icon icon-pencil"></span></a>
                                                <?php endif; ?>
                                                <?php if ($admin->hasPermissions('admin.delete')): ?>
                                                    <a href="<?php echo $this->vars['backendUrl']; ?>admin/delete/<?php echo $d->id; ?>" class="btn btn-xs btn-default btn-delete bootip" title="Delete" data-confirm="Are you sure want to delete this record?"><span class="icon icon-trash"></span></a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="8">
                                            <div class="alert alert-warning">No record found.</div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-2">
                    <?php
                    if ($pages->pageCount > 1):
                        $qs = array();
                        foreach ($filters as $k => $v) {
                            $qs[] = 'Filter[' . $k . ']=' . $v;
                        }
                        $qs = implode('&', $qs);
                        ?>
                        <div class="row paginator">
                            <form method="get">
                                <div class="col-md-4 col-sm-4 col-xs-4">
                                    <?php
                                    $disabled = 'disabled';
                                    $goto = $currentPage - 1;
                                    if ($currentPage > 1)
                                        $disabled = '';
                                    ?>
                                    <a href="<?php echo $this->vars['backendUrl']; ?>admin?page=<?php echo $goto; ?>&<?php echo $qs; ?>" class="btn btn-warning btn-sm btn-block <?php echo $disabled; ?> bootip" title="Previous page"><span class="icon icon-chevron-left"></span></a>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-4 input">
                                    <input type="text" class="form-control input-sm" name="page" value="<?php echo $currentPage; ?>">
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-4">
                                    <?php
                                    $disabled = 'disabled';
                                    $goto = $currentPage + 1;
                                    if ($currentPage < $pages->pageCount)
                                        $disabled = '';
                                    ?>
                                    <a href="<?php echo $this->vars['backendUrl']; ?>admin?page=<?php echo $goto; ?>&<?php echo $qs; ?>" class="btn btn-warning btn-sm btn-block <?php echo $disabled; ?> bootip" title="Next page"><span class="icon icon-chevron-right"></span></a>
                                </div>
                                <input type="hidden" name="Filter[username]" value="<?php echo $filters['username']; ?>">
                                <input type="hidden" name="Filter[is_active]" value="<?php echo $filters['is_active']; ?>">
                                <input type="hidden" name="Filter[group_id]" value="<?php echo $filters['group_id']; ?>">
                                <input type="hidden" name="Filter[created_start]" value="<?php echo $filters['created_start']; ?>">
                                <input type="hidden" name="Filter[created_end]" value="<?php echo $filters['created_end']; ?>">
                            </form>
                        </div>
                    <?php endif; ?>

                    <div class="panel panel-default panel-backend">
                        <div class="panel-heading"><span class="glyphicon glyphicon-flag"></span> Summary</div>
                        <div class="panel-body">
                            <?php echo $pages->itemCount; ?> record(s) found.<br>Showing page <?php echo $currentPage; ?> of <?php echo $pages->pageCount; ?>.
                        </div>
                    </div>

                    <div class="panel panel-default panel-backend">
                        <div class="panel-heading"><span class="glyphicon glyphicon-filter"></span> Filter</div>
                        <div class="panel-body">
                            <form method="get" class="form-filter">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="Filter[username]" placeholder="Username contains ..." value="<?php echo $filters['username']; ?>">
                                </div>
                                <div class="form-group">
                                    <select class="form-control" name="Filter[is_active]">
                                        <?php
                                        $sel = array(
                                            'all' => 'selected="selected"',
                                            '1' => '',
                                            '0' => '',
                                        );
                                        if ($filters['is_active'] == '1' || $filters['is_active'] == '0') {
                                            $sel['all'] = '';
                                            $sel[$filters['is_active']] = 'selected="selected"';
                                        }
                                        ?>
                                        <option value="all" <?php echo $sel['all']; ?>>- Active (All)</option>
                                        <option value="1" <?php echo $sel['1']; ?>>Yes</option>
                                        <option value="0" <?php echo $sel['0']; ?>>No</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" name="Filter[group_id]">
                                        <option value="all" <?php if ($filters['group_id'] == 'all'): ?>selected="selected"<?php endif; ?>>- Group (All)</option>
                                        <?php foreach ($groups as $g): ?>
                                            <option value="<?php echo $g->id; ?>" <?php if ($filters['group_id'] == $g->id): ?>selected="selected"<?php endif; ?>><?php echo Yii::app()->util->purify($g->name); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input class="form-control datepicker" type="text" name="Filter[created_start]" placeholder="Created between ..." value="<?php echo $filters['created_start']; ?>" readonly="readonly" data-date-format="yyyy-mm-dd">
                                </div>
                                <div class="form-group">
                                    <input class="form-control datepicker" type="text" name="Filter[created_end]" placeholder="... until ..." value="<?php echo $filters['created_end']; ?>" readonly="readonly" data-date-format="yyyy-mm-dd">
                                </div>
                                <hr>
                                <button class="btn btn-danger btn-lg btn-block"><span class="icon icon-filter"></span> Filter</button>
                            </form>
                        </div>
                    </div>
                    <?php if ($admin->hasPermissions('admin.create')): ?>
                        <hr>
                        <a href="<?php echo $this->vars['backendUrl']; ?>admin/create" class="btn btn-primary btn-lg btn-block"><span class="icon icon-plus"></span> Create new</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>