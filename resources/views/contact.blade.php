<h1>Páginina de Contato</h1>
<form action="/register" method="post">
    @csrf <!-- {{ csrf_field() }} -->  <!--Sempre coloque isto no inicio dos formularios com POST-->
    <input type="text" placeholder="Insira seu nome" name="nome" id="nome">
    <button type="submit">Ir ao POST</button>
</form>
