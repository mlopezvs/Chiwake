@extends('layouts.admin')

{{-- page level styles --}}
@section('header_styles')
{!! HTML::style('admin/vendors/jasny-bootstrap/css/jasny-bootstrap.css') !!}
{!! HTML::style('admin/css/pages/form_layouts.css') !!}
@stop

{{-- Page content --}}
@section('content_admin')
<section class="content-header">
    <!--section starts-->
    <h1>
        Agregar nuevo registro
    </h1>
</section>
<!--section ends-->
<section class="content">
    <!--main content-->
    <div class="row">
        <!--row starts-->
        <div class="col-lg-12">

            <!--basic form starts-->
            <div class="panel panel-danger">
                <div class="panel-body border">
                    {!! Form::open(['route' => 'administrador.menus_categories.store', 'method' => 'POST', 'class' => 'form-horizontal form-bordered']) !!}

                            <div class="form-group">
                                {!! Form::label('titulo', 'Titulo', ['class' => 'col-md-3 control-label']) !!}
                                <div class="col-md-9">
                                    {!! Form::text('titulo', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('publicar', 'Publicar', ['class' => 'col-md-3 control-label']) !!}
                                <div class="col-md-9">
                                    <label class="checkbox-inline">
                                        {!! Form::radio('publicar', '1', null,  ['id' => 'publicar']) !!}
                                        Si
                                    </label>
                                    <label class="checkbox-inline">
                                        {!! Form::radio('publicar', '0', null,  ['id' => 'publicar']) !!}
                                        No
                                    </label>
                                </div>
                            </div>

                            <!-- Form actions -->
                            <div class="form-group">
                                <div class="col-md-12 text-right">
                                    {!! Form::submit('Guardar', ['class' => 'btn btn-responsive btn-primary btn-md']) !!}
                                    <a href="{{ route('administrador.menus_categories.index') }}" class="btn btn-responsive btn-default btn-md">Cancelar</a>
                                </div>
                            </div>

                    {!! Form::close() !!}
                </div>
            </div>

        </div>
        <!--md-6 ends-->

    </div>
    <!--main content ends-->
</section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
{!! HTML::script('admin/vendors/jasny-bootstrap/js/jasny-bootstrap.js') !!}
@stop