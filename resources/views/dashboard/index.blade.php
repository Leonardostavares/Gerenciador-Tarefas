@extends('layout')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h5 class="mb-0">Distribuição de Tarefas</h5>
                </div>
                <div class="card-body">
                    <div style="position: relative; height:350px;">
                        <canvas id="meuGraficoDePizza"></canvas>
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