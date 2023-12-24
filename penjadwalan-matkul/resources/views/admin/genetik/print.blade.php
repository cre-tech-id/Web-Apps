<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Jadwal Mata Kuliah</title>
    <style>
        table, th, td {
          border: 1px solid black;
          border-collapse: collapse;
        }
        th, td {
          padding-top: 8px;
          padding-bottom: 8px;
          padding-left: 8px;
          padding-right: 8px;
        }
        </style>
</head>
<body onload="window.print()">
    <center>
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
                                    @if($jadwal->log_kosong == 1)
                                        <td style="text-align: center;background-color:red">{{ $jadwal->teach->course->code_courses ?? '-' }} - {{ $jadwal->teach->class_room ?? '-' }}</td>                                                                                                    
                                    @else
                                        <td style="text-align: center">{{ $jadwal->teach->course->code_courses ?? '-' }} - {{ $jadwal->teach->class_room ?? '-' }}</a></td>                                                                                                    
                                    @endif
                                @else
                                    <td style="background-color: rgba(127, 153, 13, 0.943)"></td>
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
    </center>
    
</body>
</html>
