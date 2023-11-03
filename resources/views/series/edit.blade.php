<x-layout title="Editar Série '{!! $serie->name !!}'">
        <form action="{{ route('series.update', $serie->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Nome:</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $serie->name }}">
            </div>
        
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
</x-layout>