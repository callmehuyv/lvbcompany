<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\helpers\Url;

    $this->title = 'List Stations';
    $this->params['breadcrumbs'][] = ['label' => 'Station', 'url' => ['station/index']];
    $this->params['breadcrumbs'][] = $this->title;
    
?>
<div class="site-create">
    
        <a class="btn btn-success" href="<?php echo Url::toRoute('station/create') ?>">Create new Station</a>
        <?php
            if ($selected_line != null) {
                ?>
                    <a class="btn btn-primary" href="<?php echo Url::toRoute('station/index') ?>">View all Station</a>
                    <script type="text/javascript">
                        $(document).ready(function() {
                            $('#selectLine').val(<?= $selected_line ?>);
                        });
                    </script>
                <?php
            }
        ?>
        <div class="form-group" style="float: right; width: 300px;">
            <div class="input-group">
                <div class="input-group-addon">Filter by Line</div>
                <input id="currentUrl" type="hidden" value="<?php echo Url::toRoute('station/index') ?>">
                <select id="selectLine" class="form-control">
                    <?php
                        foreach($list_lines as $line) {
                            ?>
                                <option value="<?php echo $line->line_id ?>"><?php echo $line->line_name ?></option>
                            <?php
                        }
                    ?>
                </select>
            </div>
        </div>

        <?php if(Yii::$app->session->get('message') != null) : ?>
            <p class="bg-success"> <?php echo htmlentities(Yii::$app->session->getFlash('message')); ?></p>
        <?php endif; ?>

        <br><br>
        <?php
            if (isset($_GET['message'])) {
                ?>
                    <style type="text/css">
                        .bg-primary {
                            padding: 15px;
                        }
                    </style>
                    <p class="bg-primary"> <?php echo htmlentities($_GET['message']); ?></p>
                <?php
            }
        ?>
        <table class="table table-hover">
            <tr>
                <th>ID</th>
                <th>Station Name</th>
                <th>Station Description</th>
                <th>Belong Line</th>
                <th>Station Image</th>
                <th>Action</th>
            </tr>
            <?php
                foreach ($stations as $station) {
                    ?>
                        <tr>
                            <td>
                                <?php echo $station->station_id ?>
                            </td>
                            <td>
                                <?php echo $station->station_name ?>
                            </td>
                            <td>
                                <?php echo $station->station_description ?>
                            </td>
                            <td>
                                <a href="<?php echo Url::toRoute('station/index').'?line='.$station->line->line_id; ?>"><?php echo $station->line->line_name; ?></a>
                            </td>
                            <td>
                                <a href="<?php echo Url::to('@web/'.$station->station_image); ?>" data-toggle="lightbox" data-title="View Full Size">
                                    <img width="100px" src="<?php echo Url::to('@web/'.$station->station_image); ?>" class="img-responsive">
                                </a>
                            </td>
                            <td>
                                <?php if(!Yii::$app->user->isGuest) : ?>
                                    <a title="Edit" class="btn btn-warning" href="<?php echo Url::toRoute('station/edit').'?station='.$station->station_id ?>">
                                        <i class="glyphicon glyphicon-edit"></i>
                                    </a>
                                    <a data-confirm="Are you sure you want to delete?" title="Remove" class="btn btn-danger" href="<?php echo Url::toRoute('station/delete').'?station='.$station->station_id ?> ">
                                        <i class="glyphicon glyphicon-remove"></i>
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php
                }
            ?>
        </table>

</div>
