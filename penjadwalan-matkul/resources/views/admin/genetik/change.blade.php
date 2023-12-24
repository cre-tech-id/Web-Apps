@extends('admin.layouts.master')

@section('title')
{{ $title= 'Ganti Jadwal' }}
@stop

@section('style')
<style type="text/css">
.panel-body{
       width:auto;
       height:auto;
       overflow-x:auto;
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
                        @include('admin._partials.notifications')
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Jadwal Untuk Jam {{ $times->time_begin }} - {{ $times->time_finish }} di Ruangan {{ $room->name }}</h3>
                            </div>                            
                            <form action="{{ route('admin.bagan.change.submit') }}" method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="day_new" id="day_new" value="{{ $day->id }}">
                                <input type="hidden" name="waktu_new" id="waktu_new" value="{{ $times->id }}">
                                <input type="hidden" name="ruangan_new" id="ruangan_new" value="{{ $room->id }}">

                             <div class="col-md-12">
                                <div class="form-group">
                                    <label>Jadwal</label>
                                    <select name="jadwal" id="jadwal" class="form-control select2 to-select required">
                                        @foreach($schedules as $s)
                                            <option value="{{ $s->id }}">{{ $s->day->name_day }} Jam {{ $s->time->time_begin.' - '.$s->time->time_finish }} Ruangan {{ $s->room->name }} , Mata Kuliah {{ $s->teach->course->name }} ( {{ $s->teach->course->code_courses }} - {{ $s->teach->class_room }} )</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>                   
                            <div class="col-md-6" style="padding-bottom: 15px;">
                                <button type="submit" class="btn btn-primary">Pindah Jadwal</button>
                            </div>
                            <div class="col-md-12">
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@stop
