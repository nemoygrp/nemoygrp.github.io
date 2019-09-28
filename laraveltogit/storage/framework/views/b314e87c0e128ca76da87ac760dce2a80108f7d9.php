<?php $__env->startSection('content'); ?>
    <?php if(!isset($authUser)): ?>
        <div class="jumbotron">
            <div class="container">
                <h1 class="display-3">Расписание отпусков сотрудников</h1>
                <p>Выберите пользователя (этакая заглушка на авторизацию =))</p>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <p><a class="btn btn-primary btn-lg" href="<?php echo e(route('vacationOne', ['id' => $user->id])); ?>"
                          role="button"><?php echo e($user->name); ?> &raquo;</a></p>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    <?php else: ?>
        <div class="jumbotron">
            <div class="container">
                <h3>Вы авторизованы как </h3>
                <h1 class="display-3"><?php echo e($authUser->name); ?> (<?php echo e($role); ?>)</h1>
                <p><a class="btn btn-primary btn-lg" href="<?php echo e(route('vacationAdd', ['id' => $authUser->id])); ?>" role="button">Личный кабинет</a></p>
                <p><a class="btn btn-primary btn-lg" href="<?php echo e(route('index')); ?>" role="button">&laquo; Назад к выбору пользователя </a></p>
            </div>
        </div>
        <div class="container">

            <div class="row">
                <div class="col-md-3">
                </div>
                <div class="col-md-6 vacation_list_block">
                    <h2>Расписание отпусков</h2>

                    <?php $__currentLoopData = $vacations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vacation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($vacation->id_user === $authUser->id): ?>
                            <div class="vacation_list_elem" style="background-color: rgba(122,223,50,0.49)">

                               <?php if($vacation->accept === 0): ?>
                                   <div class="buttons_control">
                                       <a class="btn btn-primary btn-sm btn_edit" href="<?php echo e(route('vacationEdit', ['id' => $vacation->id, 'id_user' => $authUser->id])); ?>" role="button"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> </a>
                                       <a class="btn btn-primary btn-sm btn_del" href="<?php echo e(route('vacationDelete', ['id' => $vacation->id])); ?>" role="button"> <i class="fa fa-times-circle-o" aria-hidden="true"></i> </a>

                                   </div>
                                   <div class="vacation_list_elem__user">Ваш отпуск &raquo;</div>
                               <?php else: ?>
                                    <div class="vacation_list_elem__user">Ваш отпуск одобрен!</div>
                               <?php endif; ?>
                        <?php else: ?>

                             <div class="vacation_list_elem">
                                 <?php if($authUser->role === 100): ?>

                                     <?php if($vacation->accept === 0): ?>
                                         <p><a class="btn btn-primary btn-sm" href="<?php echo e(route('vacationAccepted', ['id' => $vacation->id])); ?>" role="button"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> </a></p>
                                     <?php else: ?>
                                         <a class="btn btn-primary btn-sm btn_del" href="<?php echo e(route('vacationDelete', ['id' => $vacation->id])); ?>" role="button"> <i class="fa fa-times-circle-o" aria-hidden="true"></i> </a>
                                         <p>Одобрено!</p>
                                     <?php endif; ?>
                                 <?php endif; ?>
                                 <div class="vacation_list_elem__user"><?php echo e(\App\User::getUserName($vacation->id_user)->name); ?></div>

                        <?php endif; ?>
                                        <div class="vacation_list_elem__dates">c <?php echo e(App\Vacation::changeFormatDate($vacation->start_vacation)); ?>

                                            до <?php echo e(App\Vacation::changeFormatDate($vacation->finish_vacation)); ?></div>
                                    </div>
                                    <hr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </div>
                            <div class="col-md-3">
                            </div>
                </div>

                <hr>

            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.site', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>