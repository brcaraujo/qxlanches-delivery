<?php
session_start();

//valores

$valor_total = $_SESSION["valor-total"] + 8;


$valor_desconto = round($valor_total / 100 *10, 2);


$total_pagamento = $valor_total - $valor_desconto;

$valorParaAPI = str_replace(".", ".", $total_pagamento);

// echo($valorParaAPI);




//criando o recurso cURL
$cr = curl_init();
 
//definindo a url de busca 
curl_setopt($cr, CURLOPT_URL, "https://gerarqrcodepix.com.br/api/v1?nome=brfood&cidade=brasil&valor={$valorParaAPI}&saida=br&chave=1a403769-29cc-4185-a4f9-2018721f77b6");
 
//definindo a url de busca 
curl_setopt($cr, CURLOPT_RETURNTRANSFER, true);
 
//definindo uma variável para receber o conteúdo da página...
$retorno = curl_exec($cr);
 
//fechando-o para liberação do sistema.
curl_close($cr); //fechamos o recurso e liberamos o sistema...
 
//mostrando o conteúdo...
// echo $retorno;


$linkdepagamento = json_decode($retorno, true);

// var_dump($linkdepagamento['brcode']);

?>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap');
  /* font-family: 'Roboto', sans-serif; */

  .header {
    background-color: #EA1D2C;
    height: 150px;
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;

  }

  .boxTXT {
    font-size: 22px;
    /* background-color: red; */
    width: 180px;
    text-align: center;
    font-weight: bold;
    font-family: 'Roboto', sans-serif;
    color: white;
    position: relative;
    display: flex;
  }

  .boxTXT img {
    margin-top: 80px;
    height: 90px;
    position: absolute;
    /* box-shadow: 1px 1px 1px 1px black; */
    /* background-color: red; */
  }


  .boxtime {
    /* background-color: red; */
    margin-top: 90px;
    justify-content: center;
    align-items: center;
    display: flex;
  }

  .boxtime p {
    width: 80%;
    /* background-color: yellow; */
    font-family: 'Roboto', sans-serif;
    font-size: 12px;
    text-align: center;
  }



  .boxQRpix {
    /* background-color: red; */
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;

  }

  .moldIMG {
    /* background-color: yellow; */
    /* width: 60%; */
    margin-top: 10px;
    padding: 10px;
    border-radius: 5px;
    justify-content: center;
    align-items: center;
    display: flex;

    -webkit-box-shadow: 0px 0px 20px -7px rgba(0, 0, 0, 0.75);
    -moz-box-shadow: 0px 0px 20px -7px rgba(0, 0, 0, 0.75);
    box-shadow: 0px 0px 20px -7px rgba(0, 0, 0, 0.75);
  }

  .moldIMG img {
    max-height: 200px;
  }

  .boxTXTpix {
    /* background-color: red; */
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    margin-top: 25px;
  }

  .boxTXTpix input {
    width: 70%;
    margin-bottom: 20px;
    height: 25px;
    /* position: absolute; */
  }

  .boxTXTpix button {
    z-index: 999;
    background-color: #EA1D2C;
    color: white;
  }

  .boxTXTpix button:hover {
    background-color: #EA1D2C;
    color: white;
  }




  .boxResumoPedido {
    margin-top: 25px;
  }

  .footer {
    margin-top: 50px;
    background-color: black;
    color: white;
    justify-content: center;
    align-items: center;
    display: flex;
    height: 90px;
  }
</style>
<div class="header">
  <div class="boxTXT">
    <p>Pague com PIX e GANHE</p>
    <img src="../images/10.png" alt="">
  </div>
</div>

<div class="boxtime">
  <p>Pague o Qrcode em até <b id="time"> </b> após o prazo
    será redirecionado para pagina de <b>inicio.</b></p>
</div>


<div class="boxQRpix">
  <div class="moldIMG">
    <img id="qrcode" src="<?php echo("https://gerarqrcodepix.com.br/api/v1?nome=Cec%C3%ADlia%20Dev%C3%AAza&cidade=Ouro%20Preto&valor=".$valorParaAPI."&saida=qr&chave=1a403769-29cc-4185-a4f9-2018721f77b6");?> alt="">
  </div>
</div>

<div class="boxTXTpix">
  <input id="txtCopiaCola" type="text" value="<?php echo($linkdepagamento['brcode']);?>">
  <button id="btnCopiaCola" class="btn btn">Copiar Chave</button>
</div>




<div class="boxResumoPedido">
  <div class="container">
    <ol class="list-group list-group-numbered">
    <li class="list-group-item d-flex justify-content-between align-items-start">
        <div class="ms-2 me-auto">
          <div class="fw-bold">Total Itens: </div>
          <span id="totalItens">R$ <?php echo($_SESSION["valor-total"]);?></span>
        </div>
        <span class="badge bg-primary rounded-pill"></span>
      </li>
      <li class="list-group-item d-flex justify-content-between align-items-start">
        <div class="ms-2 me-auto">
          <div class="fw-bold">Taxa de Entrega </div>
          R$ 8,00
        </div>
        <span class="badge bg-primary rounded-pill">FIXO</span>
      </li>

      <li class="list-group-item d-flex justify-content-between align-items-start">
        <div class="ms-2 me-auto">
          <div class="fw-bold">Valor Bruto:</div>
          <span id="valorBruto">R$ <?php echo($_SESSION["valor-total"] + 8);?></span>
        </div>
        <span class="badge bg-primary rounded-pill"></span>
      </li>

      <li class="list-group-item d-flex justify-content-between align-items-start">
        <div class="ms-2 me-auto">
          <div class="fw-bold">Desconto Aplicado (PIX):</div>
          <!-- Valido somente no primeiro pedido -->
          <span id="renderDesconto">R$ <?php echo($valor_desconto);?></span>
        </div>
        <span class="badge bg-danger rounded-pill">10% OFF</span>
      </li>

      <li class="list-group-item d-flex justify-content-between align-items-end">
        <div class="ms-2 me-end">
          <div id="" class="fw-bold">TOTAL:</div>
          <span id="valorDesconto">R$ <?php echo($total_pagamento);?></span>
        </div>
        <span class="badge bg-primary rounded-pill"></span>
      </li>
    </ol>

    <nav aria-label="breadcrumb" style="margin-top: 50px;">
      <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Faturamento</li>
        <li class="breadcrumb-item" style="filter: grayscale(1);">Entrega</li>
      </ol>
    </nav>

  </div>
</div>


<div class="footer">
  <p>QX food 2023 - todos os direitos reservados.</p>
</div>













<script>
  function copiarTexto() {
    /* Selecionamos por ID o nosso input */
    var textoCopiado = document.getElementById("txtCopiaCola");
    textoCopiado.select();
    document.execCommand("copy");
    textoCopiado.setSelectionRange(0, 99999);

    alert("Chave Pix copiada!");
  }

  let btnCopiaCola = document.getElementById('btnCopiaCola');
  btnCopiaCola.addEventListener('click', (e)=>{
    e.preventDefault();
    copiarTexto();
  });



  function startTimer(duration, display) {
    var timer = duration,
      minutes, seconds;
    setInterval(function() {
      minutes = parseInt(timer / 60, 10);
      seconds = parseInt(timer % 60, 10);

      minutes = minutes < 10 ? "0" + minutes : minutes;
      seconds = seconds < 10 ? "0" + seconds : seconds;

      display.textContent = minutes + ":" + seconds;

      if (--timer < 0) {
        timer = duration;
      }
    }, 1000);
  }

  window.onload = function() {
    var fiveMinutes = 60 * 15,
      display = document.querySelector('#time');
    startTimer(fiveMinutes, display);
  };

  // function atualizaValor() {
  //   freteeProdutos = parseInt(window.localStorage.getItem('valor-total')) + 8;

  //   desconto = freteeProdutos / 100 * 10;
  //   totalCOMDESCONTO = freteeProdutos - desconto;

  //   let totalItens = document.getElementById('totalItens');
  //   let renderDesconto = document.getElementById('renderDesconto');
  //   let valorBruto = document.getElementById('valorBruto');
  //   let valorDesconto = document.getElementById('valorDesconto');

  //   totalItens.innerText = new Intl.NumberFormat('pt-BR', {
  //     style: 'currency',
  //     currency: 'BRL'
  //   }).format(window.localStorage.getItem('valor-total'));
  //   renderDesconto.innerText = new Intl.NumberFormat('pt-BR', {
  //     style: 'currency',
  //     currency: 'BRL'
  //   }).format(desconto);
  //   valorBruto.innerText = new Intl.NumberFormat('pt-BR', {
  //     style: 'currency',
  //     currency: 'BRL'
  //   }).format(freteeProdutos);
  //   valorDesconto.innerText = new Intl.NumberFormat('pt-BR', {
  //     style: 'currency',
  //     currency: 'BRL'
  //   }).format(totalCOMDESCONTO);


  //   let valorPIx = new Intl.NumberFormat('pt-BR', {
  //     style: 'currency',
  //     currency: 'BRL'
  //   }).format(totalCOMDESCONTO);

  //   let valorPIXSemRs = valorPIx.replace('R$', "").trim().replace(',', '.');
  //   console.log(valorPIXSemRs);


  //   //gerando qrcode
  //   let qrcode = document.getElementById('qrcode');
  //   qrcode.setAttribute('src', `https://gerarqrcodepix.com.br/api/v1?nome=Cec%C3%ADlia%20Dev%C3%AAza&cidade=Ouro%20Preto&valor=${valorPIXSemRs}&saida=qr&chave=1a403769-29cc-4185-a4f9-2018721f77b6`);


  //   //gerando copia cola
  //   let ajax = new XMLHttpRequest();
  //   ajax.open('POST', '../api/curl.php');
  //   ajax.onreadystatechange = () => {
  //     if (ajax.readyState == 4 && ajax.status == 200) {
  //       // console.log(JSON.parse(ajax.response).brcode);
  //       let txtCopiaCola = document.getElementById('txtCopiaCola');
  //       txtCopiaCola.setAttribute("value",  JSON.parse(ajax.response).brcode);
  //     }
  //   }
  //   ajax.send(JSON.stringify({
  //     "valorPIXSemRs" : valorPIXSemRs,
  //     "valorBruto": valorBruto,
  //     "valorDesconto": valorDesconto
  //   }));

  // }
  // atualizaValor();
</script>