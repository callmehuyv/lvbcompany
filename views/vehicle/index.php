<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\helpers\Url;

    $this->title = 'List Vehicle';
    $this->params['breadcrumbs'][] = ['label' => 'Vehicle', 'url' => ['vehicle/index']];
    $this->params['breadcrumbs'][] = $this->title;
    
?>
<div class="site-create">
    
        <a class="btn btn-success" href="<?php echo Url::toRoute('vehicle/create') ?>">Create new Vehicle</a>
        <input id="currentUrl" type="hidden" value="<?php echo Url::toRoute('vehicle/index') ?>">

        <?php
            if ($selected_line != null) {
                ?>
                    <a class="btn btn-primary" href="<?php echo Url::toRoute('vehicle/index') ?>">View all Station</a>
                    <script type="text/javascript">
                        $(document).ready(function() {
                            $('#selectLine').val(<?= $selected_line ?>);
                        });
                    </script>
                <?php
            }
             if ($selected_company != null) {
                ?>
                    <a class="btn btn-primary" href="<?php echo Url::toRoute('station/index') ?>">View all Station</a>
                    <script type="text/javascript">
                        $(document).ready(function() {
                            $('#selectCompany').val(<?= $selected_company ?>);
                        });
                    </script>
                <?php
            }
             if ($selected_vehicletype != null) {
                ?>
                    <a class="btn btn-primary" href="<?php echo Url::toRoute('station/index') ?>">View all Station</a>
                    <script type="text/javascript">
                        $(document).ready(function() {
                            $('#selectVehicletype').val(<?= $selected_vehicletype ?>);
                        });
                    </script>
                <?php
            }
        ?>
        <div class="form-group" style="float: right; width: 300px; margin-left: 10px;">
            <div class="input-group">
                <div class="input-group-addon">Line</div>
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
        <div class="form-group" style="float: right; width: 300px; margin-left: 10px;">
            <div class="input-group">
                <div class="input-group-addon">Company</div>
                <select id="selectCompany" class="form-control">
                    <?php
                        foreach($list_companies as $company) {
                            ?>
                                <option value="<?php echo $company->company_id ?>"><?php echo $company->company_name ?></option>
                            <?php
                        }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group" style="float: right; width: 300px; margin-left: 10px;">
            <div class="input-group">
                <div class="input-group-addon">Vehicle Type</div>
                <select id="selectVehicletype" class="form-control">
                    <?php
                        foreach($list_vehicletypes as $vehicletype) {
                            ?>
                                <option value="<?php echo $vehicletype->vehicletype_id ?>"><?php echo $vehicletype->vehicletype_name ?></option>
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
                <th>Vehicle Number</th>
                <th>Company</th>
                <th>Line</th>
                <th>Vehicle Type</th>
                <th>Driver</th>
                <th>Vehicle Image</th>
                <th>Action</th>
            </tr>
            <?php
                foreach ($vehicles as $vehicle) {
                    ?>
                        <tr>
                            <td>
                                <?php echo $vehicle->vehicle_id ?>
                            </td>
                            <td>
                                <?php echo $vehicle->vehicle_number ?>
                            </td>
                            <td>
                                <?php echo $vehicle->company->company_name ?>
                            </td>
                            <td>
                                <?php echo $vehicle->line->line_name ?>
                            </td>
                            <td>
                                <?php echo $vehicle->vehicletype->vehicletype_name ?>
                            </td>
                            <td>
                                <?php echo $vehicle->driver->driver_name ?>
                            </td>
                            <td>
                                <a href="<?php echo Url::to('@web/'.$vehicle->vehicle_image); ?>" data-toggle="lightbox" data-title="View Full Size">
                                    <img width="100px" src="<?php echo Url::to('@web/'.$vehicle->vehicle_image); ?>" class="img-responsive">
                                </a>
                            </td>
                            <td>
                                <a title="Edit" class="btn btn-warning" href="<?php echo Url::toRoute('vehicle/edit').'?vehicle='.$vehicle->vehicle_id ?>">
                                    <i class="glyphicon glyphicon-refresh"></i>
                                </a>
                                <a data-confirm="Are you sure you want to delete?" title="Remove" class="btn btn-danger" href="<?php echo Url::toRoute('vehicle/delete').'?vehicle='.$vehicle->vehicle_id ?>">
                                    <i class="glyphicon glyphicon-remove"></i>
                                </a>
                            </td>
                        </tr>
                    <?php
                }
            ?>
        </table>

</div>
