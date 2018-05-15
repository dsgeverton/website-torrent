function verificarSenha() {
  if( senha.length < 8 ){
    return 1;
  }
  return 0;
}

function validarEmail() {
  var reg = /^[a-zA-Z0-9._-]+@[a-z]+\.\w{1,}[a-z]+(\.\w{1,}[a-z]+)?$/i;
    if ( ! reg.test(email)) {
      return 1;
    }
    return 0;
}

function verificarForm() {
  nome = registro.nome.value;
  usuario = registro.usuario.value;
  senha = registro.senha.value;
  email = registro.email.value;
  // window.alert(nome);
  erro = "";

  if ( verificarSenha() ) {
    erro = "A senha deve possuir no mínimo 8 caracteres.\n";
  }
  if ( validarEmail() ) {
    erro += "Formato de email inválido.\n";
  }

  if ( erro != "" ) {
    window.alert(erro);
  }
  else {
    registro.submit();
  }

}

function compararSenha() {

  erro = "";
  var senha = registro.senha.value;
  var senhaC = registro.senhaC.value;
  if ( senha.length < 8 ) {
      window.alert("A senha deve possuir no mínimo 8 caracteres.");
  }
  else {
    if ( senha.localeCompare(senhaC) ) {
      window.alert("As senhas devem ser iguais!");
    }
    else {
      registro.submit();
    }
  }
}
