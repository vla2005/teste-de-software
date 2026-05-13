@php
    $meal = $meal ?? [];
    $index = $index ?? 0;
@endphp

<fieldset class="meal-fieldset" data-meal-fieldset>
    <legend>Refeicao {{ $index + 1 }}</legend>

    <div class="fieldset-header">
        <span class="meta">Preencha nome, horario, alimentos e orientacoes.</span>
        <button class="btn danger meal-remove" type="button" data-remove-meal>Remover</button>
    </div>

    <div class="form-grid">
        <label>
            Nome da refeicao
            <input data-meal-input="name" name="meals[{{ $index }}][name]" value="{{ $meal['name'] ?? '' }}" required>
        </label>

        <label>
            Horario
            <input data-meal-input="time" type="time" name="meals[{{ $index }}][time]" value="{{ isset($meal['time']) ? substr($meal['time'], 0, 5) : '' }}">
        </label>

        <label class="full">
            Descricao dos alimentos
            <textarea data-meal-input="description" name="meals[{{ $index }}][description]" required>{{ $meal['description'] ?? '' }}</textarea>
        </label>

        <label class="full">
            Orientacoes
            <textarea data-meal-input="instructions" name="meals[{{ $index }}][instructions]">{{ $meal['instructions'] ?? '' }}</textarea>
        </label>
    </div>
</fieldset>
