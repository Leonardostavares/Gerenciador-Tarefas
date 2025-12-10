@extends('layout')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        
        <div class="col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h5 class="mb-0">Volume de Tarefas por Categoria</h5>
                </div>
                <div class="card-body">
                    <div style="position: relative; height:350px;">
                        <canvas id="graficoCategorias"></canvas> 
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-header bg-success text-white text-center">
                    <h5 class="mb-0">Tempo Médio de Conclusão (Dias)</h5>
                </div>
                <div class="card-body">
                    <div style="position: relative; height:350px;">
                        <canvas id="graficoEficiencia"></canvas> 
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>

{{-- Scripts necessários --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/grafico.js') }}"></script>
@endsection