@extends('layouts.app')

@section('title', 'Chamado #' . $ticket->id)

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h1 class="h3 mb-1">
            Chamado #{{ $ticket->id }}
        </h1>

        <p class="text-muted mb-0">
            Visualize os detalhes deste chamado.
        </p>

    </div>

    <div class="d-flex gap-2">

        <a
            href="{{ route('tickets.index') }}"
            class="btn btn-outline-secondary"
        >
            <i class="bi bi-arrow-left me-1"></i>
            Voltar
        </a>

        <a
            href="{{ route('tickets.edit', $ticket) }}"
            class="btn btn-warning"
        >
            <i class="bi bi-pencil me-1"></i>
            Editar
        </a>

    </div>

</div>

<div class="card shadow-sm border-0">

    <div class="card-body p-4">

        <div class="row g-4">

            <!-- Título -->

            <div class="col-12">

                <label class="form-label text-muted">
                    Título do Chamado
                </label>

                <h4 class="mb-0">
                    {{ $ticket->title }}
                </h4>

            </div>

            <!-- Departamento -->

            <div class="col-md-6">

                <label class="form-label text-muted">
                    Departamento
                </label>

                <p class="mb-0">
                    {{ $ticket->department->name ?? 'N/A' }}
                </p>

            </div>

            <!-- Solicitante -->

            <div class="col-md-6">

                <label class="form-label text-muted">
                    Solicitante
                </label>

                <p class="mb-0">
                    {{ $ticket->requester_name }}
                </p>

            </div>

            <!-- Prioridade -->

            <div class="col-md-6">

                <label class="form-label text-muted">
                    Prioridade
                </label>

                <div>

                    @if ($ticket->priority == 'Urgente')

                        <span class="badge bg-danger">
                            Urgente
                        </span>

                    @elseif ($ticket->priority == 'Alta')

                        <span class="badge bg-warning text-dark">
                            Alta
                        </span>

                    @elseif ($ticket->priority == 'Média')

                        <span class="badge bg-info text-dark">
                            Média
                        </span>

                    @else

                        <span class="badge bg-secondary">
                            Baixa
                        </span>

                    @endif

                </div>

            </div>

            <!-- Status -->

            <div class="col-md-6">

                <label class="form-label text-muted">
                    Status do Atendimento
                </label>

                <div>

                    @if ($ticket->status == 'Aberto')

                        <span class="badge bg-primary">
                            Aberto
                        </span>

                    @elseif ($ticket->status == 'Em Atendimento')

                        <span class="badge bg-warning text-dark">
                            Em Atendimento
                        </span>

                    @else

                        <span class="badge bg-success">
                            Concluído
                        </span>

                    @endif

                </div>

            </div>

            <!-- Data de abertura -->

            <div class="col-md-6">

                <label class="form-label text-muted">
                    Data de Abertura
                </label>

                <p class="mb-0">
                    {{ $ticket->created_at->format('d/m/Y H:i') }}
                </p>

            </div>

            <!-- Última atualização -->

            <div class="col-md-6">

                <label class="form-label text-muted">
                    Última Atualização
                </label>

                <p class="mb-0">
                    {{ $ticket->updated_at->format('d/m/Y H:i') }}
                </p>

            </div>

            <!-- Descrição -->

            <div class="col-12">

                <label class="form-label text-muted">
                    Descrição
                </label>

                <div class="border rounded p-3 bg-light">
                    {{ $ticket->description }}
                </div>

            </div>

        </div>

    </div>

</div>

@endsection
