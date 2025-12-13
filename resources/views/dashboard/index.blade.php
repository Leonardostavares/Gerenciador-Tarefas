@extends('layout')

@section('content')

{{-- Área Principal do Dashboard --}}
<div class="container py-4">

    <div class="row justify-content-center">
        {{-- BLOC0 1: VOLUME POR CATEGORIA (Mantendo col-md-6) --}}
        <div class="col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Volume de Tarefas por Categoria</h6>
                </div>
                <div class="card-body">
                    {{-- Sua área de canvas com altura fixa --}}
                    <div style="position: relative; height:350px;"> 
                        <canvas id="graficoCategorias"></canvas> 
                    </div>
                </div>
            </div>
        </div>
        
        {{-- BLOC0 2: TEMPO MÉDIO DE CONCLUSÃO (Mantendo col-md-6) --}}
        <div class="col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-success">Tempo Médio de Conclusão</h6>
                </div>
                <div class="card-body">
                    {{-- Sua área de canvas com altura fixa --}}
                    <div style="position: relative; height:350px;">
                        <canvas id="graficoEficiencia"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- NOVA LINHA para o gráfico de status --}}
    <div class="row justify-content-center">
        
        {{-- BLOC0 3: DISTRIBUIÇÃO POR STATUS (CORRIGIDO: Agora usa col-md-6) --}}
        <div class="col-md-6 mb-4"> 
            <div class="card shadow">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-info">Distribuição de Tarefas por Status</h6>
                </div>
                <div class="card-body">
                    {{-- Sua área de canvas com altura fixa --}}
                    <div style="position: relative; height:350px;"> 
                        <canvas id="graficoStatus"></canvas> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ------------------------------------------------ --}}
{{-- Scripts (Mantidos na ordem correta para evitar o erro "Chart is not defined") --}}
{{-- ------------------------------------------------ --}}

{{-- 1. Carrega a biblioteca Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

{{-- 2. Carrega o seu código --}}
<script src="{{ asset('js/grafico.js') }}"></script>

@endsection