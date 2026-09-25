
@extends('layouts.app')

@section('title', 'Painel de Chamados - Help Desk')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Painel de Chamados</h1>

            <p class="text-muted mb-0">
                Gerencie e acompanhe as solicitações
                de suporte técnico.
            </p>
        </div>

        <a href="{{ route('tickets.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i>
            Novo Chamado
        </a>
    </div>

    <!-- Filtros -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">

            <form method="GET" action="{{ route('tickets.index') }}">
                <div class="row g-3 align-items-end">

                    <!-- Departamento -->
                    <div class="col-md-4">
                        <label for="department_id" class="form-label">
                            Departamento
                        </label>

                        <select
                            name="department_id"
                            id="department_id"
                            class="form-select"
                        >
                            <option value="">
                                Todos os Departamentos
                            </option>

                            @foreach ($departments as $dept)
                                <option
                                    value="{{ $dept->id }}"
                                    {{ request('department_id') == $dept->id ? 'selected' : '' }}
                                >
                                    {{ $dept->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Status -->
                    <div class="col-md-4">
                        <label for="status" class="form-label">
                            Status
                        </label>

                        <select
                            name="status"
                            id="status"
                            class="form-select"
                        >
                            <option value="">
                                Todos os Status
                            </option>

                            <option
                                value="Aberto"
                                {{ request('status') == 'Aberto' ? 'selected' : '' }}
                            >
                                Aberto
                            </option>

                            <option
                                value="Em Atendimento"
                                {{ request('status') == 'Em Atendimento' ? 'selected' : '' }}
                            >
                                Em Atendimento
                            </option>

                            <option
                                value="Concluído"
                                {{ request('status') == 'Concluído' ? 'selected' : '' }}
                            >
                                Concluído
                            </option>
                        </select>
                    </div>

                    <!-- Botão Filtrar -->
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-funnel-fill me-1"></i>
                            Filtrar
                        </button>
                    </div>

                </div>
            </form>

        </div>
    </div>

    <!-- Tabela de Chamados -->
    <div class="card shadow-sm border-0">

        <div class="card-body p-0">

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">
                        <tr>
                            <th>ID / Título</th>
                            <th>Departamento</th>
                            <th>Solicitante</th>
                            <th>Prioridade</th>
                            <th>Status</th>
                            <th>Abertura</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($tickets as $ticket)

                            <tr>

                                <!-- ID / Título -->
                                <td>
                                    <strong>
                                        #{{ $ticket->id }}
                                    </strong>

                                    <br>

                                    <span class="text-muted">
                                        {{ $ticket->title }}
                                    </span>
                                </td>

                                <!-- Departamento -->
                                <td>
                                    {{ $ticket->department->name ?? 'N/A' }}
                                </td>

                                <!-- Solicitante -->
                                <td>
                                    {{ $ticket->requester_name }}
                                </td>

                                <!-- Prioridade -->
                                <td>
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
                                </td>

                                <!-- Status -->
                                <td>
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
                                </td>

                                <!-- Data de Abertura -->
                                <td>
                                    {{ $ticket->created_at->format('d/m/Y H:i') }}
                                </td>

                                <!-- Ações -->
                                <td class="text-center">

                                    <a
                                        href="{{ route('tickets.show', $ticket) }}"
                                        class="btn btn-sm btn-outline-primary"
                                        title="Visualizar"
                                    >
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <a
                                        href="{{ route('tickets.edit', $ticket) }}"
                                        class="btn btn-sm btn-outline-warning"
                                        title="Editar"
                                    >
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <form
                                        action="{{ route('tickets.destroy', $ticket) }}"
                                        method="POST"
                                        class="d-inline"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-outline-danger"
                                            title="Excluir"
                                            onclick="return confirm('Tem certeza que deseja excluir este chamado?')"
                                        >
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td
                                    colspan="7"
                                    class="text-center text-muted py-5"
                                >
                                    <i class="bi bi-inbox fs-1 d-block mb-3"></i>

                                    Nenhum chamado encontrado para os filtros
                                    selecionados.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>
            </div>

        </div>

        <!-- Paginação -->
        @if ($tickets->hasPages())
            <div class="card-footer bg-white border-0">
                {{ $tickets->links() }}
            </div>
        @endif

    </div>

@endsection
