@extends('layouts.app')

@section('title-page', 'Dashboard')

@section('title-toolbar', 'Dashboard')

@section('content')
	<div class="app-main flex-column flex-row-fluid " id="kt_app_main">
		<div class="d-flex flex-column flex-column-fluid">                             
			<div id="kt_app_content" class="app-content  flex-column-fluid py-6" >
				<div id="kt_app_content_container" class="app-container  container-fluid ">
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-body">
                                    <h2 class="fs-4 text-uppercase text-gray-700 text-center mb-5">Desafio do mês: Ler 20 páginas todo dia</h2>
                                    <div class="d-flex justify-content-center">
                                        <div class="d-flex">
                                            @for ($i = $previousMonth->daysInMonth - 1; $i <= $previousMonth->daysInMonth; $i++)
                                                @if ($i > 0)
                                                    <div class="min-h-35px min-w-35px rounded-circle d-flex align-items-center justify-content-center mx-1 bg-light fw-bold text-gray-700 opacity-50">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</div>
                                                @endif
                                            @endfor
                                        
                                            @for ($day = 1; $day <= $actualMonth->daysInMonth; $day++)
                                                <div class="min-h-35px min-w-35px rounded-circle d-flex align-items-center justify-content-center mx-1 @if(str_pad($day, 2, '0', STR_PAD_LEFT) == date('d')) bg-primary text-white fw-bold @else bg-light fw-bold text-gray-700 @endif">
                                                    {{ str_pad($day, 2, '0', STR_PAD_LEFT) }}
                                                </div>
                                            @endfor
                                        
                                            @for ($i = 1; $i <= 2; $i++)
                                                <div class="min-h-35px min-w-35px rounded-circle d-flex align-items-center justify-content-center mx-1 bg-light fw-bold text-gray-700 opacity-50">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</div>
                                            @endfor
                                        </div>
                                        
                                    </div>
								</div>
							</div>

                            DEIXA COM DIA DA SEMANA NO DIA ATUAL
                            DEIIXAR COM HOVER NOS DIAS
                            CRIAR DESAFIOS DA SEMANA
                            ANOTAÇÕES
                            TAREFAS DDO DIAS
                            FRASES MOTIVADORAS
                            RELATORIO DE DESEMPENHO
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection