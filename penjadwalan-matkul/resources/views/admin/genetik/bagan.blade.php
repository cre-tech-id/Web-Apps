@extends('admin.layouts.master')

@section('title')
{{ $title= 'Bagan Jadwal' }}
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

@section('script')
<script type="text/javascript">
    $('#myAction').change(function(){
        var action =  $(this).val();
        window.location = action;
    });
</script>
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
                                <div class="panel-body table-responsive">
                                    <a class="btn btn-info mb-10" href="{{ route('admin.generates.print', $id) }}" target="_blank">
                                        <span class="glyphicon glyphicon-download">
                                        </span>
                                        Print
                                    </a>
                                    <br>
                                    @php $tot = 0; @endphp
                                    <br>
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr class="info">
                                                <th style="text-align:center;">
                                                    Hari
                                                </th>
                                                <th style="text-align:center;">
                                                    Jam Ke-
                                                </th>
                                                <th style="text-align:center;">
                                                    Waktu
                                                </th>
                                                @foreach ($kelas as $k)
                                                    <th style="text-align:center;">
                                                        {{ $k->name }}
                                                    </th>
                                                @endforeach                                                                                                
                                            </tr>
                                        </thead>
                                        <tbody style="text-align: center">
                                            @foreach ($hari as $h)
                                                @php 
                                                    $kon = App\Models\Schedule::whereDaysId($h->id)->count();                                               
                                                    $kontime = App\Models\Time::count();     
                                                    $colspan = 3+count($kelas)+1;                                          
                                                @endphp
                                                <tr>
                                                    <td style="vertical-align : middle;text-align:center;" rowspan="{{ $kontime+1 }}">{{ $h->name_day }}</td>
                                                </tr>
                                                @php 
                                                    $time = App\Models\Time::orderBy('id','ASC')->get();   
                                                    $jamke= 1;                                                 
                                                @endphp
                                                @foreach ($time as $t)
                                                    <tr>
                                                        <td>{{ $jamke }}</td>       
                                                        <td>{{ $t->time_begin }} - {{ $t->time_finish }}</td>
                                                        @foreach ($kelas as $k)
                                                            @php 
                                                                $jadwal = App\Models\Schedule::whereDaysId($h->id)->whereTimesId($t->id)->whereRoomsId($k->id)->first();                                                            
                                                            @endphp
                                                            @if($jadwal)
                                                                @php $tot += 1 @endphp
                                                                @if($jadwal->log_kosong == 1)
                                                                    <td style="text-align: center;background-color:red">{{ $jadwal->teach->course->code_courses ?? '-' }} - {{ $jadwal->teach->class_room ?? '-' }} &nbsp;&nbsp;<a href="{{ route('admin.bagan.isi',['id' => $jadwal->id]) }}" title="Tandai Ruangan Terisi"><i class="fa fa-check" style="color: black"></i></a></td>                                                                                                    
                                                                @else
                                                                    <td style="text-align: center">{{ $jadwal->teach->course->code_courses ?? '-' }} - {{ $jadwal->teach->class_room ?? '-' }} &nbsp;&nbsp;<a href="{{ route('admin.bagan.kosong',['id' => $jadwal->id]) }}" title="Tandai Ruangan Kosong"><i class="fa fa-times" style="color: black"></i></a></td>                                                                                                    
                                                                @endif
                                                            @else                                                                
                                                                <td style="background-color: rgba(127, 153, 13, 0.943)"><a href="{{ route('admin.bagan.change',['day' => $h->id ,'times' => $t->id ,'room' => $k->id]) }}" title="Pindah Jadwal"><i class="fa fa-pencil" style="color: white"></i></a></td>
                                                            @endif                                                            
                                                        @endforeach                                                        
                                                    </tr>
                                                    @php $jamke = $jamke + 1; @endphp
                                                @endforeach          
                                                <tr>
                                                    <td colspan="{{ $colspan }}" style="background-color: grey"></td>
                                                </tr>                                      
                                            @endforeach                               
                                             
                                        </tbody>
                                    </table>
                                    {{-- {!! $schedules->appends(Input::all())->render() !!} --}}
                                    {{-- Total Jadwal Masuk Bagan : {{ $tot }} --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@stop
