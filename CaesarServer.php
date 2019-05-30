<!DOCTYPE html>
 <html lang="pt-br">
  <head>
    <title>Exercício PHP</title>
    <meta charset="utf-8">
    <style>
      form 
      {
        margin: 8px;
      }

      div 
      {
        width:   350px;
        padding: 10px;
        border: 5px solid rgb(216, 45, 188);
        margin: 8;
      }
    </style>
  </head>
<body>

<?php

$texto = $_POST["mssg"];			
$texto = strtoupper($texto);
$mode  = $_POST["mode"];

function cesar($mssg, $offset)
/*
processa uma string de entrada($mssg) deslocando $offset 
posições cada letra da string.
*/
{
  #retorna em erro se $mssg nao for somente letras
  #tratamento solicitado quando foi criado a função
  if (!ctype_alpha($mssg))
  {
    return "Erro!\nAlgum não alfabetico foi digitado.";
  }

  #torna a string em array:
  $mssg = str_split($mssg);

  #spawna o array 'caixaAlta[...]' :
  $caixaAlta = array();

  #populando 'caixaAlta' :
  foreach(range('A', 'Z') as $letra) array_push($caixaAlta, $letra);
  unset($letra);

  #array q reservará o resultado:
  $decodificado = array();

  #para cada letra da palavra a ser codificada...
  foreach($mssg as $letra)
  {
    /* se (posição_da_letra_no_alfabeto + deslocamento) <= 25:
    então e´ possível trocar a letra  possivel trocar
    diretamente pela sua equivalente deslocada e add ao vetor resultado,*/ 
    if(array_search($letra,$caixaAlta) + $offset <= 25)
      array_push($decodificado, $caixaAlta[array_search($letra,$caixaAlta)+$offset]);

    /* senão:
    desloca-se de posição_da_letra_no_alfabeto até 25, e volta em 0 continua avançando até alcançar os
    posição_da_letra_no_alfabeto_+_deslocamento movimentos. adicionando a letra dessa 'casa' ao vetor resultado*/
    else
      array_push($decodificado, $caixaAlta[array_search($letra,$caixaAlta)+$offset-26]);
  }
  unset($letra);

  #juntando os elementos numa unica string:
  return implode($decodificado);
}

#fim php;
?>


      <div>
            Simula o disco para "Cifra de Cesar" com 26 caracteres(A até Z) girando
        dentro de um circulo fixo com os mesmos 26 caracteres que coincidem entre si.<br>
            Para alterar número de posições do deslocamento para n,
        altere o value da opção ''Criptografar'' da lista de opções
        para esse novo n desejado, e ''Descriptograafar'' para 26 - n.<br>
            Embora pareça ser intuitivo -n para deslocar para trás, esse algoritmo
        só 'gira para frente', ou seja:<br>
        #_ Sendo 'a' letra para se Criptografar com 3 avanços,
        teremos 'd' como saída;<br>
        #_ Para Descriptografar 'd' com 3 casas, voltaríamos tres
        posições(ou n = -3). Como se trata de "ratched move"(com apenas avanços positivos),
        giramos 26 - n posições, resultando em 23 avanços que passará por uma volta 
        inteira do disco e chegando na casa "a";<br>
        #_ Alterar simultaneamente o valor na lista de opçoes do formulario no
        index.html e do server/api.<br>
    
      </div>

      <div><p>
        Entrada: <?php print $texto; ?>
      </p>
      <p>
        Resultado: 
        <?php 
          print cesar($texto,$mode);
          
        ?>
      </p></div>

      <div>
			<form method="post" action="CaesarServer.php">
        <p>Rodar novamente:</p>


        <input type="text" name="mssg" placeholder="apenas letras" required/>

        <select multiple name="mode">
          <option value="5">Criptografar</option>
			    <option value="21" selected>Descriptografar</option>
        </select>
        <br>
        
        <input name="submit" type="submit" value="send" />
      </form>
      </div>



</body>
</html>