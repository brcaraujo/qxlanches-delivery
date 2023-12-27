<style>
  .container-form {
    width: 100%;
    /* background-color: red; */
    display: flex;
    justify-content: center;
  }

  .container-form form {
    width: 90%;
    display: flex;
    flex-direction: column;
  }

  .containe-img-produto {
    /* background-color: red; */
    display: flex;
    justify-content: center;
    margin-top: 80px;
  }
</style>
<br>
<div class="container">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item" style="filter: grayscale(1);"><a href="../">&#127969;</a></li>
      <!-- <li class="breadcrumb-item" style="filter: grayscale(1);"><a href="#">&#128222;</a></li> -->
      <li class="breadcrumb-item active" aria-current="page">Endereço</li>
    </ol>
  </nav>
  <br>
  <div class="container-form">
    <form id="myForm" action="">
      <h3 class="class=" primary-heading mg-bottom-small>Entrega</h3>
      <br>
      <input type="text" class="form-control" placeholder="CEP/CODIGO POSTAL" id="codigoPostal" required/><br>
      <input type="text" class="form-control" placeholder="Brazil" disabled id="Pais"><br>
      <input type="text" class="form-control" placeholder="ENDEREÇO DE ENTREGA" id="endereco1" /><br>
      <input type="text" class="form-control" placeholder="LINHA 2" id="endereco2" /><br>
      <input type="text" class="form-control" placeholder="(Complemento ou Ponto de Ref.)" id="endereco3" /><br>
      <input type="text" class="form-control" placeholder="CIDADE" id="cidade" /><br>
      <input type="text" class="form-control" placeholder="NOME DO CLIENTE" id="estado" require/><br>
      <input type="text" class="form-control" placeholder="TELEFONE" id="" require/><br>
      <br>
      <p id="validaendereco" class="secondary-para center" style="color: red;text-align:start;">Insira um endereço válido.</P>
      <br>
      <button id="btnProximo" class="btn btn-danger">Próximo</button><br><br>
    </form>
  </div>
</div>
<style>
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
<div class="footer">
  <p>QX food 2023 - todos os direitos reservados.</p>
</div>

<script>
  let btnProximo = document.getElementById('btnProximo');
  let myform = document.getElementById('myForm');
  myform.addEventListener('submit', (e) => {
    e.preventDefault();
    btnProximo.innerText = "Processando..."
    setTimeout(() => {
      window.location.href = "https://qxlanches.com.br/faturamento/";
    }, 2000);
  })
</script>