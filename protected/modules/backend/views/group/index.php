<?php
$admin = Yii::app()->user->getState('admin');
?>

<?php echo Yii::app()->util->ahdaBreadcrumbGridForm($breadcrumb) ?>

<div class="row">
    <div class="col-md-12">
        <div id="content-inner">
            <h1 class="page-title"><span class="icon-group"></span> Group</h1>
            <div class="row">
                <div class="col-md-10">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-condensed list">
                            <thead>
                                <tr>
                                    <th class="list-number">#</th>
                                    <th>Name</th>
                                    <th class="wrap">Slug</th>
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
                                        <tr>
                                            <td class="list-number"><?php echo $i; ?>.</td>
                                            <td><?php echo Yii::app()->util->purify($d->name); ?></td>
                                            <td class="wrap"><?php echo $d->slug; ?></td>
                                            <td class="list-actions">
                                                <?php if ($admin->hasPermissions('admin.view')): ?>
                                                    <a href="<?php echo $this->vars['backendUrl']; ?>admin?Filter[username]=&Filter[is_active]=all&Filter[group_id]=<?php echo $d->id; ?>&Filter[created_start]=&Filter[created_end]=" class="btn btn-xs btn-default bootip" title="View admin <strong>(<?php echo Admin::model()->count('group_id = ' . $d->id); ?>)</strong>"><span class="icon icon-user"></span></a>
                                                <?php endif; ?>
                                                <?php if ($admin->hasPermissions('admin.group.update')): ?>
                                                    <a href="<?php echo $this->vars['backendUrl']; ?>group/update/<?php echo $d->slug; ?>" class="btn btn-xs btn-default bootip" title="Update"><span class="icon icon-pencil"></span></a>
                                                <?php endif; ?>
                                                <?php if ($admin->hasPermissions('media.group.delete')): ?>
                                                    <a href="<?php echo $this->vars['backendUrl']; ?>group/delete/<?php echo $d->slug; ?>" class="btn btn-xs btn-default btn-delete bootip" title="Delete" data-confirm="Are you sure want to delete this record?"><span class="icon icon-trash"></span></a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4">
                                            <div class="alert alert-warning">No record found.</div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-2">

                    <?php if ($admin->hasPermissions('admin.group.create')): ?>
                        <a href="<?php echo $this->vars['backendUrl']; ?>group/create" class="btn btn-primary btn-lg btn-block"><span class="icon icon-plus"></span> Buat Baru</a>
                        <hr>
                    <?php endif; ?>

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
                                    <a href="<?php echo $this->vars['backendUrl']; ?>group?page=<?php echo $goto; ?>&<?php echo $qs; ?>" class="btn btn-warning btn-sm btn-block <?php echo $disabled; ?> bootip" title="Previous page"><span class="icon icon-chevron-left"></span></a>
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
                                    <a href="<?php echo $this->vars['backendUrl']; ?>group?page=<?php echo $goto; ?>&<?php echo $qs; ?>" class="btn btn-warning btn-sm btn-block <?php echo $disabled; ?> bootip" title="Next page"><span class="icon icon-chevron-right"></span></a>
                                </div>
                                <input type="hidden" name="Filter[name]" value="<?php echo $filters['name']; ?>">
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
                                    <input class="form-control" type="text" name="Filter[name]" placeholder="Name contains ..." value="<?php echo $filters['name']; ?>">
                                </div>
                                <hr>
                                <button class="btn btn-danger btn-lg btn-block"><span class="icon icon-filter"></span> Filter</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>