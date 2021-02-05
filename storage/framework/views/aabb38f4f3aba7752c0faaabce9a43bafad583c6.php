<?php $__env->startSection('content'); ?>
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo e(config('app.name','SMAPAC')); ?></a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">USUARIOS</a></li>
                    <li class="breadcrumb-item active">LISTA</li>
                </ol>
            </div>
            <h4 class="page-title"></h4>
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
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create_users')): ?>
                            <a href="<?php echo e(route('usuarios.create')); ?>"
                                class="btn btn-sm btn-success waves-effect waves-light mb-2 float-right">Crear nuevo usuario</a>
                            <?php endif; ?>
                        </div>
                    </div><!-- end col-->
                </div>
                    <table id="users-table" class="table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th style="text-align: center" >ID</th>
                                <th style="text-align: center">No.Empleado</NoEmpleadoth>
                                <th style="text-align: center">Nombre</th>
                                <th style="text-align: center">Correo</th>
                                <th style="text-align: center">&nbsp;</th>
                            </tr>
                        </thead>
                    </table>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col -->
</div>
    <!-- end row -->
<?php $__env->startPush('scripts'); ?>
<script>
    $(document).ready( function () {
      $('#users-table').DataTable( {
        processing: true,
        serverSide : true,
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        ajax: '<?php echo route('usuarios.index'); ?>',
        columns:[
            {data: 'id', name : 'id'},
            {data: 'NoEmpleado', name : 'NoEmpleado'},
            {data: 'name', name : 'name'},
            {data: 'email', name : 'email'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
      } );
    } );

</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/bernacantun/Documents/Proyectos/urm/resources/views/users/index.blade.php ENDPATH**/ ?>