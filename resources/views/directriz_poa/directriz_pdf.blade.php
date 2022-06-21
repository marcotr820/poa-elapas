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
        @forelse ($pilares as $p)
            <tr>
                <td
                <?php 
                $row_pilar = 0;
                if ($p->metas->count() >= 1) { $row_pilar += $p->metas->count(); }
                foreach ($p->metas as $m) {
                    if($m->resultados->count() > 1){
                        $row_pilar += $m->resultados->count() - 1;
                        foreach ($m->resultados as $r) {
                            if ($r->acciones_mediano_plazo->count() > 1) {
                                $row_pilar += $r->acciones_mediano_plazo->count() - 1;
                            }
                        }
                    }
                }
                echo $row_pilar > 1 ? 'rowspan="'.$row_pilar.'"' : '';
                ?>
                >{{ $p->nombre_pilar }}</td>
                @forelse ($p->metas as $m)
                    @if ($loop->first)
                        {{-- primera meta --}}
                        <td
                        <?php $row_meta = 0;
                        if ($m->resultados->count() >= 1) { $row_meta += $m->resultados->count(); }
                        foreach ($m->resultados as $r) {
                            if ($r->acciones_mediano_plazo->count() > 1) {
                                $row_meta += $r->acciones_mediano_plazo->count() - 1;
                            }
                        }
                        echo  $row_meta > 1 ? 'rowspan="'.$row_meta.'"' : '';
                        ?>
                        >{{ $m->nombre_meta }}</td>
                        @forelse ($m->resultados as $r)
                            {{-- primer resultado primera meta --}}
                            <?php $var_m = $m; ?>
                            @if ($loop->first)
                                <td
                                <?php $row_resultado = 0;
                                if ($r->acciones_mediano_plazo->count() >= 1) { $row_resultado += $r->acciones_mediano_plazo->count(); }
                                echo  $row_resultado > 1 ? 'rowspan="'.$row_resultado.'"' : '';
                                ?>
                                >{{ $r->nombre_resultado }}</td>
                                @forelse ($r->acciones_mediano_plazo as $amp)
                                {{-- primera accion mediano plazo primer resultado --}}
                                    <?php $var_r = $r; ?>
                                    @if ($loop->first)
                                        <td>{{ $amp->accion_mediano_plazo }}</td>
                                    @endif
                                @empty
                                @endforelse
                            @endif
                        @empty
                        @endforelse
                    @endif
                @empty
                @endforelse
            </tr>

            @if (isset($var_r))
                @forelse ($var_r->acciones_mediano_plazo as $amp)
                    @if (!$loop->first)
                        <tr>
                            <td>{{ $amp->accion_mediano_plazo }}</td>
                        </tr>
                    @endif
                @empty
                @endforelse
                <?php unset($var_r) ?>
            @endif

            @if (isset($var_m))
                @foreach ($var_m->resultados as $r)
                    @if (!$loop->first)
                        {{-- demas resultados primera meta --}}
                        <tr>
                            <td
                            <?php $row_resultado = 0;
                            if ($r->acciones_mediano_plazo->count() >= 1) { $row_resultado += $r->acciones_mediano_plazo->count(); }
                            echo  $row_resultado > 1 ? 'rowspan="'.$row_resultado.'"' : '';
                            ?>
                            >{{ $r->nombre_resultado }}###</td>
                            {{-- primer accion mediano plazo demas resultados --}}
                            @foreach ($r->acciones_mediano_plazo as $amp)
                            <?php $var_r = $r; ?>
                                @if ($loop->first)
                                    <td>{{ $amp->accion_mediano_plazo }}</td>
                                @endif
                            @endforeach
                        </tr>

                        {{-- demas acciones mediano plazo demas resultados --}}
                        @if (isset($var_r))
                            @foreach ($var_r->acciones_mediano_plazo as $amp)
                                @if (!$loop->first)
                                    <tr>
                                        <td>{{ $amp->accion_mediano_plazo }}_00</td>
                                    </tr>
                                @endif
                            @endforeach
                            <?php unset($var_r) ?>
                        @endif

                    @endif
                @endforeach
                <?php unset($var_m) ?>
            @endif

            @forelse ($p->metas as $m)
                @if (!$loop->first)
                    {{-- demas metas --}}
                    <tr>
                        <td
                        <?php $row_meta = 0;
                        if ($m->resultados->count() >= 1) { $row_meta += $m->resultados->count(); }
                        foreach ($m->resultados as $r) {
                            if ($r->acciones_mediano_plazo->count() > 1) {
                                $row_meta += $r->acciones_mediano_plazo->count() - 1;
                            }
                        }
                        echo  $row_meta > 1 ? 'rowspan="'.$row_meta.'"' : '';
                        ?>
                        >{{ $m->nombre_meta }}</td>
                        {{-- demas metas primer resultado --}}
                        @foreach ($m->resultados as $r)
                            @if ($loop->first)
                                <?php $var_m = $m; ?>
                                {{-- primer resultado demas metas --}}
                                <td
                                <?php $row_resultado = 0;
                                if ($r->acciones_mediano_plazo->count() >= 1) { $row_resultado += $r->acciones_mediano_plazo->count(); }
                                echo  $row_resultado > 1 ? 'rowspan="'.$row_resultado.'"' : '';
                                ?>
                                >{{ $r->nombre_resultado }}+</td>

                                {{-- primer accion mediano plazo  --}}
                                @foreach ($r->acciones_mediano_plazo as $amp)
                                    <?php $var_r = $r; ?>
                                    @if ($loop->first)
                                        <td>{{ $amp->accion_mediano_plazo }}</td>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </tr>

                    {{-- demas acciones mediano primer resultado --}}
                    @if (isset($var_r))
                        @foreach ($var_r->acciones_mediano_plazo as $amp)
                            @if (!$loop->first)
                            <tr>
                                <td>{{ $amp->accion_mediano_plazo }}</td>
                            </tr>
                            @endif
                        @endforeach
                        <?php unset($var_r) ?>
                    @endif

                    @if (isset($var_m))
                        @foreach ($m->resultados as $r)
                            {{-- demas resultados demas metas --}}
                            @if (!$loop->first)
                            <tr>
                                <td
                                <?php $row_resultado = 0;
                                if ($r->acciones_mediano_plazo->count() >= 1) { $row_resultado += $r->acciones_mediano_plazo->count(); }
                                echo  $row_resultado > 1 ? 'rowspan="'.$row_resultado.'"' : '';
                                ?>
                                >{{ $r->nombre_resultado }}1</td>
                                {{--  --}}
                                @foreach ($r->acciones_mediano_plazo as $amp)
                                    <?php $var_r = $r; ?>
                                    @if ($loop->first)
                                        <td>{{ $amp->accion_mediano_plazo }}</td>
                                    @endif
                                @endforeach
                            </tr>

                            {{--  --}}
                            @if (isset($var_r))
                                @foreach ($var_r->acciones_mediano_plazo as $amp)
                                    @if (!$loop->first)
                                        <tr>
                                            <td>{{ $amp->accion_mediano_plazo }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                                <?php unset($var_r) ?>
                            @endif

                            @endif
                        @endforeach
                        <?php unset($var_m) ?>
                    @endif

                @endif
            @empty
            @endforelse
        @empty
            <tr>
                <td colspan="4" style="text-align: center;">No se encontraron resultados.</td>
            </tr>
        @endforelse
    </tbody>
</table>