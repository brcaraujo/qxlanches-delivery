//inicicando as variaveis
let codigoPostal=document.getElementById('codigoPostal');
let Pais=document.getElementById('Pais');
let endereco1=document.getElementById('endereco1');
let endereco2=document.getElementById('endereco2');
let endereco3=document.getElementById('endereco3');
let cidade=document.getElementById('cidade');
let estado=document.getElementById('estado');


codigoPostal.addEventListener('keyup', ()=>{
    buscarCEP(codigoPostal.value);
});

function buscarCEP(cep){
    let ajax = new XMLHttpRequest();
    ajax.open('GET', `https://viacep.com.br/ws/${cep}/json/`);
    ajax.onreadystatechange = ()=>{
        if(ajax.readyState=4&&ajax.status==200){
            let resposta = JSON.parse(ajax.response);
            console.log(resposta);

            endereco1.value=resposta.logradouro;
            endereco2.value=resposta.bairro;
            endereco3.value="";
            // estado.value=resposta.uf;
            cidade.value=resposta.localidade;

            localStorage.setItem('logradouro',resposta.logradouro);
            localStorage.setItem('bairro',resposta.bairro);
            localStorage.setItem('uf',resposta.uf);
            localStorage.setItem('localidade',resposta.localidade);
            localStorage.setItem('cep', resposta.cep);


            let validaendereco = document.getElementById('validaendereco');
            validaendereco.innerText = ` Tempo de Entrega - ${resposta.bairro} de 40 a 60 MINUTOS. `;
            validaendereco.style="color: #61a12a; text-align:center; font-weight: bold";
        }
    }
    ajax.send();
}