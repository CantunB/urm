<?php $__env->startSection('content'); ?>
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo e(config('app.name','SMAPAC')); ?></a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">COTIZACIONES</a></li>
                    <li class="breadcrumb-item active">LISTA</li>
                </ol>
            </div>
            <h4 class="page-title">COTIZACIONES</h4>
        </div>
    </div>
</div>
<!-- end page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <div class="text-sm-right">
                        </div>
                    </div><!-- end col-->
                </div>
                <div class="table-responsive">
                    <table id="quotes-table" class="table dt-responsive nowrap w-100">
                        <thead>
                            <th style="text-align: center">Departamento</th>
                            <th style="text-align: center">No.Cotizaciones</th>
                            <th style="text-align: center">Opciones</th>
                        </thead>
                        <?php $__currentLoopData = $quotes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $q): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <tbody>
                            <td style="text-align: start"><strong><?php echo e($q->department->name); ?></strong></td>
                            <td style="text-align: center"> <button type="button" class="btn btn-pill btn-sm btn-info    "><strong><?php echo e($counts[$key]); ?></strong></button></td>
                            <td style="text-align: center; width: 10px">
                                <a href="<?php echo e(route('cotizaciones.list',$q->department->id)); ?>"
                                   title="Lista de cotizaciones"
                                   class="action-icon  btn btn-soft-info ">
                                   <i class="mdi mdi-currency-eth"></i></a>
                                </a>
                            </td>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col -->
</div>
<!-- end row -->
<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).ready(function() {
            $('#quotes-table').DataTable({
            });
        } );
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\PHP\Laravel\urm\resources\views/cotizaciones/index.blade.php ENDPATH**/ ?>