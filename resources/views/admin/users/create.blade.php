@extends('layouts.admin')

{{-- page level styles --}}
@section('header_styles')
<!--page level css -->
{!! HTML::style('admin/vendors/jasny-bootstrap/css/jasny-bootstrap.css') !!}
{!! HTML::style('admin/css/pages/form_layouts.css') !!}
<!--end of page level css-->
@stop

{{-- Page content --}}
@section('content_admin')
<section class="content-header">
    <h1>Agregar nuevo usuario</h1>
</section>

<section class="content">

    <div class="row">

        <div class="col-lg-12">

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <button class="close" data-close="alert"></button>
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
            @endif

            <div class="panel panel-danger">

                <div class="panel-body border">

                    {!! Form::open(['route' => 'administrador.users.store', 'method' => 'post', 'class' => 'form-horizontal form-bordered']) !!}

                        <div class="form-group">
                            {!! Form::label('first_name', 'Nombre *', ['class' => 'col-md-3 control-label']) !!}
                            <div class="col-md-9">
                                {!! Form::text('first_name', null, ['class' => 'form-control required']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('last_name', 'Apellidos *', ['class' => 'col-md-3 control-label']) !!}
                            <div class="col-md-9">
                                {!! Form::text('last_name', null, ['class' => 'form-control required']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('email', 'Email *', ['class' => 'col-md-3 control-label']) !!}
                            <div class="col-md-9">
                                {!! Form::email('email', null, ['class' => 'form-control required']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('password', 'Contraseña *', ['class' => 'col-md-3 control-label']) !!}
                            <div class="col-md-9">
                                {!! Form::password('password', ['class' => 'form-control required']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('password_confirmation', 'Confirmar contraseña *', ['class' => 'col-md-3 control-label']) !!}
                            <div class="col-md-9">
                                {!! Form::password('password_confirmation', ['class' => 'form-control required']) !!}
                            </div>
                        </div>

                        <!-- Form actions -->
                        <div class="form-group">
                            <div class="col-md-12 text-right">
                                {!! Form::submit('Guardar', ['class' => 'btn btn-responsive btn-primary btn-md']) !!}
                                <a href="{{ route('administrador.users.index') }}" class="btn btn-responsive btn-default btn-md">Cancelar</a>
                            </div>
                        </div>

                    {!! Form::close() !!}
                    <!-- END FORM WIZARD WITH VALIDATION -->

                </div>
            </div>
        </div>
    </div>
    <!--row end-->
</section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
{!! HTML::script('admin/vendors/wizard/jquery-steps/js/jquery.validate.min.js') !!}
{!! HTML::script('admin/vendors/wizard/jquery-steps/js/wizard.js') !!}
{!! HTML::script('admin/vendors/wizard/jquery-steps/js/jquery.steps.js') !!}
{!! HTML::script('admin/vendors/wizard/jquery-steps/js/form_wizard.js') !!}
@stop