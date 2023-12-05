<x-layout title="Login">
    <form method="post">
        @csrf

        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="text" class="form-control" name="email" id="email" aria-describedby="helpId"
                placeholder="">
        </div>

        <div class="form-group">
            <label for="password">Senha</label>
            <input type="password" class="form-control" name="password" id="password" aria-describedby="helpId"
                placeholder="">
        </div>
        
        <button class="btn btn-primary mt-3">
            Entrar
        </button>
    </form>
</x-layout>
