
@extends('layouts.app')

@section('title', 'Abrir Chamado - Help Desk')

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
            <h1 class="h3 mb-1">Abrir Novo Chamado</h1>

            <p class="text-muted mb-0">
                Preencha os dados abaixo para registrar uma nova solicitação.
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
                action="{{ route('tickets.store') }}"
                method="POST"
            >
                @csrf

                <div class="row g-4">

                    <!-- Título -->
                    <div class="col-12">
                        <label for="title" class="form-label">
                            Título do Chamado <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="title"
                            id="title"
                            class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title') }}"
                            placeholder="Digite um título para o chamado"
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
                            Departamento Destino
                            <span class="text-danger">*</span>
                        </label>

                    
                        <select
                            name="department_id"
                            id="department_id"
                            class="form-select @error('department_id') is-invalid @enderror"
                            required
                        >
                            <option value="">
                                Selecione o setor...
                            </option>

                            @foreach ($departments as $dept)
                                <option
                                    value="{{ $dept['id'] }}"
                                    {{ old('department_id') == $dept['id'] ? 'selected' : '' }}
                                >
                                    {{ $dept['name'] }}
                                </option>
                            @endforeach
                        </select>


                        @error('department_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Solicitante -->
                    <div class="col-md-6">
                        <label for="requester_name" class="form-label">
                            Nome do Solicitante
                            <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="requester_name"
                            id="requester_name"
                            class="form-control @error('requester_name') is-invalid @enderror"
                            value="{{ old('requester_name') }}"
                            placeholder="Digite seu nome"
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
                            Nível de Prioridade
                            <span class="text-danger">*</span>
                        </label>

                        <select
                            name="priority"
                            id="priority"
                            class="form-select @error('priority') is-invalid @enderror"
                            required
                        >
                            <option value="">
                                Selecione...
                            </option>

                            <option
                                value="Baixa"
                                {{ old('priority') == 'Baixa' ? 'selected' : '' }}
                            >
                                Baixa
                            </option>

                            <option
                                value="Média"
                                {{ old('priority') == 'Média' ? 'selected' : '' }}
                            >
                                Média
                            </option>

                            <option
                                value="Alta"
                                {{ old('priority') == 'Alta' ? 'selected' : '' }}
                            >
                                Alta
                            </option>

                            <option
                                value="Urgente"
                                {{ old('priority') == 'Urgente' ? 'selected' : '' }}
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
                            Descrição Detalhada do Problema
                            <span class="text-danger">*</span>
                        </label>

                        <textarea
                            name="description"
                            id="description"
                            rows="6"
                            class="form-control @error('description') is-invalid @enderror"
                            placeholder="Descreva detalhadamente o problema..."
                            required
                        >{{ old('description') }}</textarea>

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
                        Confirmar Abertura
                    </button>

                </div>

            </form>

        </div>
    </div>

@endsection
