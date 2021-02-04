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
            <h4 class="page-title">COTIZACIONES DEL DEPARTAMENTO</h4>
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
                            <a href="<?php echo e(url()->previous()); ?>"
                                class="btn btn-sm btn-danger waves-effect waves-light mb-2">
                                <i class="mdi mdi-menu-left-outline"></i> Regresar</a>
                        </div>
                    </div><!-- end col-->
                </div>
                <div class="table-responsive">
                    <table id="quotes-table" class="table dt-responsive nowrap w-100">
                        <thead>
                            <th style="text-align: center">Folio de requisicion</th>
                            <th style="text-align: center">Fecha de cotizacion</th>
                            <th style="text-align: center">No.Cotizaciones</th>
                            <th style="text-align: center">Opciones</th>
                        </thead>
                        <?php $__currentLoopData = $quotes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $q): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tbody>
                            <td style="text-align: center"><?php echo e($q->requisition->folio); ?></td>
                            <td style="text-align: center"><?php echo e(\Carbon\Carbon::parse($q->requisition->created_at)->format('Y/m/d')); ?></td>
                            <td style="text-align: center">
                                <a href="#" class="badge badge-dark"><?php echo e($count[$key]); ?></a></td>
                            <td style="text-align: center">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read_quotes')): ?>
                                    <a title="Ver cotizaciones" href="<?php echo e(route('cotizaciones.show',$q->requisition->id)); ?>"
                                    class="action-icon">
                                        <i style="center" class="mdi mdi-archive"></i></a>
                                    </a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read_compras')): ?>
                                    <a title="Generar orden de compra" href="<?php echo e(route('ordenes.show', $q->requisition->id)); ?>"
                                    class="action-icon">
                                        <i  class="mdi mdi-clipboard-text-multiple"></i></a>
                                    </a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete_quotes')): ?>
                                    <a title="Eliminar cotización"
                                    class="action-icon" data-toggle="modal" data-target="#delete">
                                        <i class="mdi mdi-delete"></i>
                                    </a>
                                <?php endif; ?>
                            </td>

                            <!-- INICIO DEL MODAL-->
                            <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"><strong>Eliminar Cotizacion</strong></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h5>¿Desea eliminar la cotizacion?</h5>
                                            <p><strong><?php echo e($q->requisition->folio); ?> </strong></p>
                                            <p>Eliminaras las cotizaciones de los proveedores</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                                            <!-- Inicio btn para eliminar-->
                                            <form style="display:inline"
                                                method="POST"
                                                
                                                action="<?php echo e(route('cotizaciones.destroy', $q->requisition->id)); ?>">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button class="btn btn-outline-danger btn-xs" type="submit">Eliminar</button>
                                            </form>
                                            <!-- Final btn para eliminar-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- FINAL DEL MODAL-->
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\PHP\Laravel\urm\resources\views/cotizaciones/list.blade.php ENDPATH**/ ?>