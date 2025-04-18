<div class="row">
    @foreach ([
        'Segunda',
        'Terça',
        'Quarta',
        'Quinta',
        'Sexta',
        'Sábado',
        'Domingo',
    ] as $day)
    <div class="col">
        <div class="card mb-4">
            <div class="card-header p-3">
                <span class="title-header">
                    {{ $day }}
                </span>
            </div>
            <div class="card-body p-3">
                <div class="d-flex justify-content-between mb-2">
                    <span class="fw-bold text-gray-800">
                        8:30
                    </span>
                    <span class="fw-bold text-gray-800">
                        Ovos Mexidos
                    </span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="fw-bold text-gray-800">
                        8:30
                    </span>
                    <span class="fw-bold text-gray-800">
                        Ovos Mexidos
                    </span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="fw-bold text-gray-800">
                        8:30
                    </span>
                    <span class="fw-bold text-gray-800">
                        Ovos Mexidos
                    </span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="fw-bold text-gray-800">
                        8:30
                    </span>
                    <span class="fw-bold text-gray-800">
                        Ovos Mexidos
                    </span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="fw-bold text-gray-800">
                        8:30
                    </span>
                    <span class="fw-bold text-gray-800">
                        Ovos Mexidos
                    </span>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>