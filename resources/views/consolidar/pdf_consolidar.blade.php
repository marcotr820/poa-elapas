<style>
    table th, td{
        border: 0.5px solid #000;
        font-size: 6px;
        text-align: center;
        vertical-align: middle;
    }
    table td{
        font-size: 5px;
    }
</style>
<table cellspacing="0" cellpadding="5">
    <thead>
    <tr style="background-color:#686D76;color:white;font-weight:bold;">
        <th rowspan="2">Pilar</th>
        <th rowspan="2">Meta</th>
        <th rowspan="2">Resultado</th>
        <th rowspan="2">Accion mediano plazo</th>
        <th rowspan="2">Objetivo de Area</th>
        <th rowspan="2">Accion corto plazo</th>
        <th rowspan="2">Operaciones</th>
        <th rowspan="2">Actividades</th>
        <th rowspan="2">Tareas</th>
        <th rowspan="2">Requerimiento (bien / servicio)</th>
        <th colspan="2">Presupuesto</th>
        <th colspan="4">Cronograma de ejecucion por trimestre</th>
    </tr>
    <tr>
        <th>Gasto</th>
        <th>Invercion</th>
        <th>1ER</th>
        <th>2DO</th>
        <th>3RO</th>
        <th>4TO</th>
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
                            foreach ($r->acciones_mediano_plazo as $amp) {
                                if ($amp->pei_objetivos_especificos->count() > 1) {
                                    $row_pilar += $amp->pei_objetivos_especificos->count() - 1;
                                }
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
                            foreach ($r->acciones_mediano_plazo as $amp) {
                                if ($amp->pei_objetivos_especificos->count() > 1) {
                                    $row_meta += $amp->pei_objetivos_especificos->count() - 1;
                                }
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
                                foreach ($r->acciones_mediano_plazo as $amp) {
                                    if ($amp->pei_objetivos_especificos->count() > 1) {
                                        $row_resultado += $amp->pei_objetivos_especificos->count() - 1;
                                    }
                                }
                                echo  $row_resultado > 1 ? 'rowspan="'.$row_resultado.'"' : '';
                                ?>
                                >{{ $r->nombre_resultado }}</td>
                                @forelse ($r->acciones_mediano_plazo as $amp)
                                {{-- primera accion mediano plazo primer resultado --}}
                                    <?php $var_r = $r; ?>
                                    @if ($loop->first)
                                        <td
                                        <?php $row_accion_mediano_plazo = 0;
                                        if ($amp->pei_objetivos_especificos->count() >= 1) { $row_accion_mediano_plazo += $amp->pei_objetivos_especificos->count(); }
                                        echo  $row_accion_mediano_plazo > 1 ? 'rowspan="'.$row_accion_mediano_plazo.'"' : '';
                                        ?>
                                        >{{ $amp->accion_mediano_plazo }}</td>
                                        {{--  --}}
                                        @foreach ($amp->pei_objetivos_especificos as $obj)
                                            <?php $var_amp = $amp; ?>
                                            @if ($loop->first)
                                                <td>{{ $obj->objetivo_institucional }}</td>
                                                <td>{{ $obj->gerencia->nombre_gerencia }}</td>
                                            @endif
                                        @endforeach
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
            
            {{--  --}}
            @if (isset($var_amp))
                @foreach ($var_amp->pei_objetivos_especificos as $obj)
                    @if (!$loop->first)
                        <tr>
                            <td>{{ $obj->objetivo_institucional }}</td>
                            <td>{{ $obj->gerencia->nombre_gerencia }}</td>
                        </tr>
                    @endif
                @endforeach
                <?php unset($var_amp) ?>
            @endif
            
            {{--  --}}
            @if (isset($var_r))
                @forelse ($var_r->acciones_mediano_plazo as $amp)
                    @if (!$loop->first)
                        <tr>
                            <td
                            <?php $row_accion_mediano_plazo = 0;
                            if ($amp->pei_objetivos_especificos->count() >= 1) { $row_accion_mediano_plazo += $amp->pei_objetivos_especificos->count(); }
                            echo  $row_accion_mediano_plazo > 1 ? 'rowspan="'.$row_accion_mediano_plazo.'"' : '';
                            ?>
                            >{{ $amp->accion_mediano_plazo }}</td>
                            {{-- primer objetivo demas acciones mediano plazo primer resultado primera meta --}}
                            @foreach ($amp->pei_objetivos_especificos as $obj)
                                <?php $var_amp = $amp; ?>
                                @if ($loop->first)
                                <td>{{ $obj->objetivo_institucional }}222</td>
                                <td>{{ $obj->gerencia->nombre_gerencia }}</td>
                                @endif
                            @endforeach
                        </tr>

                        {{--  --}}
                        @if (isset($var_amp))
                            @foreach ($var_amp->pei_objetivos_especificos as $obj)
                                @if (!$loop->first)
                                    <tr>
                                        <td>{{ $obj->objetivo_institucional }}</td>
                                        <td>{{ $obj->gerencia->nombre_gerencia }}</td>
                                    </tr>
                                @endif
                            @endforeach
                            <?php unset($var_amp) ?>
                        @endif
                        
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
                            foreach ($r->acciones_mediano_plazo as $amp) {
                                if ($amp->pei_objetivos_especificos->count() > 1) {
                                    $row_resultado += $amp->pei_objetivos_especificos->count() - 1;
                                }
                            }
                            echo  $row_resultado > 1 ? 'rowspan="'.$row_resultado.'"' : '';
                            ?>
                            >{{ $r->nombre_resultado }}###</td>
                            {{-- primer accion mediano plazo demas resultados --}}
                            @foreach ($r->acciones_mediano_plazo as $amp)
                            <?php $var_r = $r; ?>
                                @if ($loop->first)
                                    <td
                                    <?php $row_accion_mediano_plazo = 0;
                                    if ($amp->pei_objetivos_especificos->count() >= 1) { $row_accion_mediano_plazo += $amp->pei_objetivos_especificos->count(); }
                                    echo  $row_accion_mediano_plazo > 1 ? 'rowspan="'.$row_accion_mediano_plazo.'"' : '';
                                    ?>
                                    >{{ $amp->accion_mediano_plazo }}</td>
                                    {{--  --}}
                                    @foreach ($amp->pei_objetivos_especificos as $obj)
                                        <?php $var_amp = $amp; ?>
                                        @if ($loop->first)
                                            <td>{{ $obj->objetivo_institucional }}</td>
                                            <td>{{ $obj->gerencia->nombre_gerencia }}</td>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        </tr>

                        {{--  --}}
                        @if (isset($var_amp))
                            @foreach ($var_amp->pei_objetivos_especificos as $obj)
                                @if (!$loop->first)
                                    <tr>
                                        <td>{{ $obj->objetivo_institucional }}</td>
                                        <td>{{ $obj->gerencia->nombre_gerencia }}</td>
                                    </tr>
                                @endif
                            @endforeach
                            <?php unset($var_amp) ?>
                        @endif

                        {{-- demas acciones mediano plazo demas resultados --}}
                        @if (isset($var_r))
                            @foreach ($var_r->acciones_mediano_plazo as $amp)
                                @if (!$loop->first)
                                    <tr>
                                        <td
                                        <?php $row_accion_mediano_plazo = 0;
                                        if ($amp->pei_objetivos_especificos->count() >= 1) { $row_accion_mediano_plazo += $amp->pei_objetivos_especificos->count(); }
                                        echo  $row_accion_mediano_plazo > 1 ? 'rowspan="'.$row_accion_mediano_plazo.'"' : '';
                                        ?>
                                        >{{ $amp->accion_mediano_plazo }}_00</td>
                                        {{--  --}}
                                        @foreach ($amp->pei_objetivos_especificos as $obj)
                                            <?php $var_amp = $amp ?>
                                            @if ($loop->first)
                                                <td>{{ $obj->objetivo_institucional }}</td>
                                                <td>{{ $obj->gerencia->nombre_gerencia }}</td>
                                            @endif
                                        @endforeach
                                    </tr>

                                    {{--  --}}
                                    @if (isset($var_amp))
                                        @foreach ($var_amp->pei_objetivos_especificos as $obj)
                                            @if (!$loop->first)
                                                <tr>
                                                    <td>{{ $obj->objetivo_institucional }}</td>
                                                    <td>{{ $obj->gerencia->nombre_gerencia }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        <?php unset($var_amp) ?>
                                    @endif

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
                            foreach ($r->acciones_mediano_plazo as $amp) {
                                if ($amp->pei_objetivos_especificos->count() > 1) {
                                    $row_meta += $amp->pei_objetivos_especificos->count() - 1;
                                }
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
                                foreach ($r->acciones_mediano_plazo as $amp) {
                                    if ($amp->pei_objetivos_especificos->count() > 1) {
                                        $row_resultado += $amp->pei_objetivos_especificos->count() - 1;
                                    }
                                }
                                echo  $row_resultado > 1 ? 'rowspan="'.$row_resultado.'"' : '';
                                ?>
                                >{{ $r->nombre_resultado }}+</td>

                                {{-- primer accion mediano plazo  --}}
                                @foreach ($r->acciones_mediano_plazo as $amp)
                                    <?php $var_r = $r; ?>
                                    @if ($loop->first)
                                        <td
                                        <?php $row_accion_mediano_plazo = 0;
                                        if ($amp->pei_objetivos_especificos->count() >= 1) { $row_accion_mediano_plazo += $amp->pei_objetivos_especificos->count(); }
                                        echo  $row_accion_mediano_plazo > 1 ? 'rowspan="'.$row_accion_mediano_plazo.'"' : '';
                                        ?>
                                        >{{ $amp->accion_mediano_plazo }}</td>
                                        {{--  --}}
                                        @foreach ($amp->pei_objetivos_especificos as $obj)
                                            <?php $var_amp = $amp; ?>
                                            @if ($loop->first)
                                                <td>{{ $obj->objetivo_institucional }}</td>
                                                <td>{{ $obj->gerencia->nombre_gerencia }}</td>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </tr>

                    {{--  --}}
                    @if (isset($var_amp))
                        @foreach ($var_amp->pei_objetivos_especificos as $obj)
                            @if (!$loop->first)
                                <tr>
                                    <td>{{ $obj->objetivo_institucional }}</td>
                                    <td>{{ $obj->gerencia->nombre_gerencia }}</td>
                                </tr>
                            @endif
                        @endforeach
                        <?php unset($var_amp) ?>
                    @endif

                    {{-- demas acciones mediano primer resultado --}}
                    @if (isset($var_r))
                        @foreach ($var_r->acciones_mediano_plazo as $amp)
                            @if (!$loop->first)
                            <tr>
                                <td
                                <?php $row_accion_mediano_plazo = 0;
                                if ($amp->pei_objetivos_especificos->count() >= 1) { $row_accion_mediano_plazo += $amp->pei_objetivos_especificos->count(); }
                                echo  $row_accion_mediano_plazo > 1 ? 'rowspan="'.$row_accion_mediano_plazo.'"' : '';
                                ?>
                                >{{ $amp->accion_mediano_plazo }}22</td>
                                {{--  --}}
                                @foreach ($amp->pei_objetivos_especificos as $obj)
                                    <?php $var_amp = $amp; ?>
                                    @if ($loop->first)
                                        <td>{{ $obj->objetivo_institucional }}</td>
                                        <td>{{ $obj->gerencia->nombre_gerencia }}</td>
                                    @endif
                                @endforeach
                            </tr>

                            {{--  --}}
                            @if (isset($var_amp))
                                @foreach ($var_amp->pei_objetivos_especificos as $obj)
                                    @if (!$loop->first)
                                        <tr>
                                            <td>{{ $obj->objetivo_institucional }}</td>
                                            <td>{{ $obj->gerencia->nombre_gerencia }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                                <?php unset($var_amp) ?>
                            @endif

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
                                foreach ($r->acciones_mediano_plazo as $amp) {
                                    if ($amp->pei_objetivos_especificos->count() > 1) {
                                        $row_resultado += $amp->pei_objetivos_especificos->count() - 1;
                                    }
                                }
                                echo  $row_resultado > 1 ? 'rowspan="'.$row_resultado.'"' : '';
                                ?>
                                >{{ $r->nombre_resultado }}1</td>
                                {{--  --}}
                                @foreach ($r->acciones_mediano_plazo as $amp)
                                    <?php $var_r = $r; ?>
                                    @if ($loop->first)
                                        <td
                                        <?php $row_accion_mediano_plazo = 0;
                                        if ($amp->pei_objetivos_especificos->count() >= 1) { $row_accion_mediano_plazo += $amp->pei_objetivos_especificos->count(); }
                                        echo  $row_accion_mediano_plazo > 1 ? 'rowspan="'.$row_accion_mediano_plazo.'"' : '';
                                        ?>
                                        >{{ $amp->accion_mediano_plazo }}33</td>
                                        {{--  --}}
                                        @foreach ($amp->pei_objetivos_especificos as $obj)
                                            <?php $var_amp = $amp; ?>
                                            @if ($loop->first)
                                                <td>{{ $obj->objetivo_institucional }}</td>
                                                <td>{{ $obj->gerencia->nombre_gerencia }}</td>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </tr>

                            {{--  --}}
                            @if (isset($var_amp))
                                @foreach ($var_amp->pei_objetivos_especificos as $obj)
                                    @if (!$loop->first)
                                        <tr>
                                            <td>{{ $obj->objetivo_institucional }}</td>
                                            <td>{{ $obj->gerencia->nombre_gerencia }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                                <?php unset($var_amp) ?>
                            @endif

                            {{--  --}}
                            @if (isset($var_r))
                                @foreach ($var_r->acciones_mediano_plazo as $amp)
                                    @if (!$loop->first)
                                        <tr>
                                            <td
                                            <?php $row_accion_mediano_plazo = 0;
                                            if ($amp->pei_objetivos_especificos->count() >= 1) { $row_accion_mediano_plazo += $amp->pei_objetivos_especificos->count(); }
                                            echo  $row_accion_mediano_plazo > 1 ? 'rowspan="'.$row_accion_mediano_plazo.'"' : '';
                                            ?>
                                            >{{ $amp->accion_mediano_plazo }}</td>
                                            {{--  --}}
                                            @foreach ($amp->pei_objetivos_especificos as $obj)
                                                <?php $var_amp = $amp; ?>
                                                @if ($loop->first)
                                                    <td>{{ $obj->objetivo_institucional }}</td>
                                                    <td>{{ $obj->gerencia->nombre_gerencia }}</td>
                                                @endif
                                            @endforeach
                                        </tr>

                                        {{--  --}}
                                        @if (isset($var_amp))
                                            @foreach ($var_amp->pei_objetivos_especificos as $obj)
                                                @if (!$loop->first)
                                                    <tr>
                                                        <td>{{ $obj->objetivo_institucional }}</td>
                                                        <td>{{ $obj->gerencia->nombre_gerencia }}</td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                            <?php unset($var_amp) ?>
                                        @endif

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