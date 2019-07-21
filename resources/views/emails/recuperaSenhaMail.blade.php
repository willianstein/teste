@component('mail::message')
@component('mail::panel')
### Foi solicitado uma troca de senha para sua conta no portal da maxipas, clique no botão abaixo para trocar a senha!
@endcomponent
@component('mail::button', ['url' => route('viewTrocarSenha', $usuario->token_troca_senha) , 'color' => 'success'])
Trocar Senha
@endcomponent
@endcomponent