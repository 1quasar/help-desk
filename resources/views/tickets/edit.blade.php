
@extends('layouts.app')

@section('title', 'Editar Chamado #' . $ticket->id)

@section('content')

    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">
                Editar Chamado #{{ $ticket->id }}
            </h1>

            <p class="text-muted mb-0">
                Atualize as informações do chamado.
            </p>
        </div>

        <a
            href="{{ route('tickets.index') }}"
            class="btn btn-outline-secondary"
        >
            <i class="bi bi-arrow-left me-1"></i>
            Voltar
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-4">

            <form
                action="{{ route('tickets.update', $ticket) }}"
                method="POST"
            >
                @csrf
                @method('PUT')

                <div class="row g-4">

                    <!-- Título -->
                    <div class="col-12">
                        <label for="title" class="form-label">
                            Título do Chamado
                            <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="title"
                            id="title"
                            class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title', $ticket->title) }}"
                            required
                        >

                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Departamento -->
                    <div class="col-md-6">
                        <label for="department_id" class="form-label">
                            Departamento
                            <span class="text-danger">*</span>
                        </label>

                        <select
                            name="department_id"
                            id="department_id"
                            class="form-select @error('department_id') is-invalid @enderror"
                            required
                        >
                            @foreach ($departments as $dept)
                                <option
                                    value="{{ $dept->id }}"
                                    {{ old('department_id', $ticket->department_id) == $dept->id ? 'selected' : '' }}
                                >
                                    {{ $dept->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('department_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="col-md-6">
                        <label for="status" class="form-label">
                            Status do Atendimento
                            <span class="text-danger">*</span>
                        </label>

                        <select
                            name="status"
                            id="status"
                            class="form-select @error('status') is-invalid @enderror"
                            required
                        >
                            <option
                                value="Aberto"
                                {{ old('status', $ticket->status) == 'Aberto' ? 'selected' : '' }}
                            >
                                Aberto
                            </option>

                            <option
                                value="Em Atendimento"
                                {{ old('status', $ticket->status) == 'Em Atendimento' ? 'selected' : '' }}
                            >
                                Em Atendimento
                            </option>

                            <option
                                value="Concluído"
                                {{ old('status', $ticket->status) == 'Concluído' ? 'selected' : '' }}
                            >
                                Concluído
                            </option>
                        </select>

                        @error('status')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Solicitante -->
                    <div class="col-md-6">
                        <label for="requester_name" class="form-label">
                            Solicitante
                            <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="requester_name"
                            id="requester_name"
                            class="form-control @error('requester_name') is-invalid @enderror"
                            value="{{ old('requester_name', $ticket->requester_name) }}"
                            required
                        >

                        @error('requester_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Prioridade -->
                    <div class="col-md-6">
                        <label for="priority" class="form-label">
                            Prioridade
                            <span class="text-danger">*</span>
                        </label>

                        <select
                            name="priority"
                            id="priority"
                            class="form-select @error('priority') is-invalid @enderror"
                            required
                        >
                            <option
                                value="Baixa"
                                {{ old('priority', $ticket->priority) == 'Baixa' ? 'selected' : '' }}
                            >
                                Baixa
                            </option>

                            <option
                                value="Média"
                                {{ old('priority', $ticket->priority) == 'Média' ? 'selected' : '' }}
                            >
                                Média
                            </option>

                            <option
                                value="Alta"
                                {{ old('priority', $ticket->priority) == 'Alta' ? 'selected' : '' }}
                            >
                                Alta
                            </option>

                            <option
                                value="Urgente"
                                {{ old('priority', $ticket->priority) == 'Urgente' ? 'selected' : '' }}
                            >
                                Urgente
                            </option>
                        </select>

                        @error('priority')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Descrição -->
                    <div class="col-12">
                        <label for="description" class="form-label">
                            Descrição
                            <span class="text-danger">*</span>
                        </label>

                        <textarea
                            name="description"
                            id="description"
                            rows="6"
                            class="form-control @error('description') is-invalid @enderror"
                            required
                        >{{ old('description', $ticket->description) }}</textarea>

                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                </div>

                <!-- Botões -->
                <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">

                    <a
                        href="{{ route('tickets.index') }}"
                        class="btn btn-outline-secondary"
                    >
                        <i class="bi bi-x-circle me-1"></i>
                        Cancelar
                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        <i class="bi bi-check-circle me-1"></i>
                        Salvar Alterações
                    </button>

                </div>

            </form>

        </div>
    </div>

@endsection
