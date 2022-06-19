<style>
    table{
        border-collapse: collapse;
        font-size: 7px;
    }
    th, td{
        border: solid .2px #a6a6a6;
        padding: 10px;
    } 
</style>
<table width="100%" style="padding: 3px;">
    <thead>
        <tr style="background-color: skyblue">
            <th><b>PILARES</b></th>
            <th><b>METAS</b></th>
            <th><b>RESULTADOS</b></th>
            <th><b>ACCIONES MEDIANO PLAZO</b></th>
        </tr>
    </thead>
    <tbody>
        @forelse ($pilares as $pilar)
            <tr>
                <td
                <?php $row_pil = 0;
                    if ($pilar->metas->count() > 1) { $row_pil += $pilar->metas->count() - 1; }
                    foreach ($pilar->metas as $meta) {
                        if ($meta->resultados->count() > 1) { $row_pil += $meta->resultados->count() - 1; }
                        foreach ($meta->resultados as $res) {
                            if($res->acciones_mediano_plazo->count() > 1){ $row_pil +=  $res->acciones_mediano_plazo->count() - 1; }
                        }
                    }
                echo($row_pil > 1 ? 'rowspan="'.($row_pil + 1).'"' : '');
                ?>
                >{{$pilar->nombre_pilar}}</td>
                @foreach ($pilar->metas as $meta)
                    @if ($loop->first)
                    <?php $var_meta = $meta; ?>
                        {{-- primera meta primer pilar --}}
                        <td
                        <?php $row_meta = 0;
                            if($meta->resultados->count() > 1){ $row_meta += $meta->resultados->count() - 1; }
                            foreach ($meta->resultados as $res) {
                                if($res->acciones_mediano_plazo->count() > 1){ $row_meta += $res->acciones_mediano_plazo->count() - 1; }
                            }
                            echo($row_meta > 1 ? 'rowspan="'.($row_meta + 1).'"' : '');
                        ?>
                        >{{$meta->nombre_meta}}</td>
                        @foreach ($meta->resultados as $res)
                            @if ($loop->first)
                            <?php $var_result = $res; ?>
                                {{-- primer resultado primera meta --}}
                                <td
                                <?php 
                                    echo($res->acciones_mediano_plazo->count() > 1 ? 'rowspan="'.$res->acciones_mediano_plazo->count().'"' : ''); 
                                ?>
                                >{{$res->nombre_resultado}}</td>
                                @foreach ($res->acciones_mediano_plazo as $amp)
                                    @if ($loop->first)
                                        {{-- primera accion mediano plazo primer resultado --}}
                                        <td>{{$amp->accion_mediano_plazo}}</td>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </tr>
            {{-- demas acciones mediano plazo primer resultado --}}
            @if (isset($var_result))
                @foreach ($var_result->acciones_mediano_plazo as $amp)
                    @if (! $loop->first)
                        <tr>
                            <td>{{$amp->accion_mediano_plazo}}</td>
                        </tr>
                    @endif
                @endforeach
                <?php $var_result = null; ?>
            @endif

            {{-- demas resultados primera meta--}}
            @if (isset($var_meta))
                @foreach ($var_meta->resultados as $res)
                    @if (! $loop->first)
                        <tr>
                            <td
                            <?php
                            echo($res->acciones_mediano_plazo->count() > 1 ? 'rowspan="'.$res->acciones_mediano_plazo->count().'"' : '');    
                            ?>
                            >{{$res->nombre_resultado}}</td>
                            {{-- primera accion mediano plazo demas resultados primera meta --}}
                            @foreach ($res->acciones_mediano_plazo as $amp)
                                @if ($loop->first)
                                    <td>{{$amp->accion_mediano_plazo}}</td>
                                @endif
                            @endforeach
                        </tr>
                        {{-- demas acciones mediano plazo demas resultados primera meta --}}
                        @foreach ($res->acciones_mediano_plazo as $amp)
                            @if (! $loop->first)
                                <tr>
                                    <td>{{$amp->accion_mediano_plazo}}</td>
                                </tr>
                            @endif
                        @endforeach
                    @endif
                @endforeach
                <?php $var_meta = null; ?>
            @endif

            {{-- demas metas --}}
            @foreach ($pilar->metas as $meta)
                @if (! $loop->first)
                    <tr>
                        <td
                        <?php $row_meta = 0;
                            if($meta->resultados->count() > 1){ $row_meta += $meta->resultados->count() - 1; }
                            foreach ($meta->resultados as $res) {
                                if ($res->acciones_mediano_plazo->count() > 1) { $row_meta += $res->acciones_mediano_plazo->count() - 1; }
                            }
                            echo($row_meta > 1 ? 'rowspan="'.($row_meta + 1).'"' : '');
                        ?>
                        >{{$meta->nombre_meta}}</td>
                        {{-- primer resultado demas metas --}}
                        @foreach ($meta->resultados as $res)
                            @if ($loop->first)
                            <?php $var_res = $res; ?>
                                <td
                                <?php
                                    echo($res->acciones_mediano_plazo->count() > 1 ? 'rowspan="'.$res->acciones_mediano_plazo->count().'"' : '');    
                                ?>
                                >{{$res->nombre_resultado}}</td>
                                {{-- primera accion mediano plazo primer resultado demas metas --}}
                                @foreach ($res->acciones_mediano_plazo as $amp)
                                    @if ($loop->first)
                                        <td>{{$amp->accion_mediano_plazo}}</td>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </tr>
                    {{-- demas acciones mediano plazo primera operacion demas metas --}}
                    @if (isset($var_res))
                        @foreach ($var_res->acciones_mediano_plazo as $amp)
                            @if (! $loop->first)
                            <tr>
                                <td>{{$amp->accion_mediano_plazo}}</td>
                            </tr>
                            @endif
                        @endforeach
                        <?php $var_res = null; ?>
                    @endif

                    {{-- demas resultados demas metas --}}
                    @foreach ($meta->resultados as $res)
                        @if (! $loop->first)
                            <tr>
                                <td
                                <?php
                                    echo($res->acciones_mediano_plazo->count() > 1 ? 'rowspan="'.$res->acciones_mediano_plazo->count().'"' : '');
                                ?>
                                >{{$res->nombre_resultado}}</td>
                                {{-- primera accion mediano plazo demas resultados demas metas --}}
                                @foreach ($res->acciones_mediano_plazo as $amp)
                                    @if ($loop->first)
                                        <td>{{$amp->accion_mediano_plazo}}</td>
                                    @endif
                                @endforeach
                            </tr>
                            @foreach ($res->acciones_mediano_plazo as $amp)
                                @if (! $loop->first)
                                    <tr>
                                        <td>{{$amp->accion_mediano_plazo}}</td>
                                    </tr>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                    {{--  --}}
                @endif
            @endforeach
        @empty
            <tr>
                <td colspan="4" style="text-align: center;">No se encontraron resultados.</td>
            </tr>
        @endforelse
    </tbody>
</table>