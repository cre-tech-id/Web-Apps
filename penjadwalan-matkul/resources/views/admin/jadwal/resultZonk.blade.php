@extends('admin.layouts.master')

@section('title')
{{ $title= 'Hasil Generate Algoritma' }}
@stop

@section('style')
<style type="text/css">
.panel-body{
       width:auto;
       height:auto;
       overflow:auto;
    }
</style>
@stop

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            {{ $title }}
                        </h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse" type="button">
                                <i class="fa fa-minus">
                                </i>
                            </button>
                            <button class="btn btn-box-tool" data-widget="remove" type="button">
                                <i class="fa fa-times">
                                </i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-12">
                                <center>
                                    Yah, Hasil generate belum ada. Di generate dulu yaaa ...
                                    <br>
                                    <br>
                                    <br>
                                    <div style="align-content: center">
                                        <a class="btn btn-primary" href="{{ route('admin.generates', Input::all()) }}">
                                            <span class="glyphicon glyphicon-cogs">
                                            </span>
                                            Generate
                                        </a>
                                    </div>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@stop