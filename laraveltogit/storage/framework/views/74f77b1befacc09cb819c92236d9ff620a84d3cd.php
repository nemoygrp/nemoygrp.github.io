<?php $__env->startSection('content'); ?>

    <div class="jumbotron">
        <div class="container">
            <h1 class="display-3"><?php echo e($authUser->name); ?></h1>
            <p>На этой странице Вы можете добавить или редактировать отпуск</p>
            <p><a class="btn btn-primary btn-lg" href="<?php echo e(route('vacationOne', ['id' => $authUser->id])); ?>" role="button">&laquo; Назад к списку отпусков</a></p>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
            </div>
            <div class="form col-md-6">
                <form method="POST" action="<?php echo e(route('vacationSave')); ?>">
                    <div class="form-group ">
                        <input type="hidden" name="id_user" value="<?php echo e($authUser->id); ?>">
                        <input type="hidden" name="accept" value="0">

                        <label for="start_vacation">Начало отпуска</label>

                        <?php if(isset($editVacation)): ?>
                            <input type="date" id="start_vacation" name="start_vacation"
                                   value="<?php echo e($editVacation->start_vacation); ?>">
                            <input type="hidden" name="id" value="<?php echo e($editVacation->id); ?>">
                        <?php else: ?>
                            <input type="date" id="start_vacation" name="start_vacation" value="YYYY-MM-DD">
                        <?php endif; ?>
                    </div>
                    <div class="form-group ">
                        <label for="finish_vacation">Конец отпуска</label>
                        <?php if(isset($editVacation)): ?>
                            <input type="date" id="finish_vacation" name="finish_vacation"
                                   value="<?php echo e($editVacation->finish_vacation); ?>">
                        <?php else: ?>
                            <input type="date" id="finish_vacation" name="finish_vacation" placeholder="YYYY-MM-DD">
                        <?php endif; ?>
                    </div>
                    <button type="submit" class="btn btn-success ">Сохранить</button>
                    <?php echo e(csrf_field()); ?>

                </form>
                <div class="col-md-3">
                </div>
            </div>
        </div>

    </div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.site', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>