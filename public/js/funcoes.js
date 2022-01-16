/////////// FUNCOES PARA FAZER A TRCA DE FORMULARIOS //////////
function clickTrocarFormulario() {
    let formularios = document.getElementById('formularios');
    let registar = document.getElementById('registrar');
    let entrar = document.getElementById('entrar');

    document.getElementById('click-registrar').addEventListener('click', (event)=>{
        event.preventDefault();

        trocarFormulario(formularios, registar, entrar);
    })

    document.getElementById('click-entrar').addEventListener('click', (event)=>{
        event.preventDefault();

        trocarFormulario(formularios, registar, entrar);
    })
}

function trocarFormulario(formularios, registar, entrar) {
    formularios.classList.remove('animacaoEntrada');
    formularios.classList.add('animacaoSaida');

    setTimeout(() => {
        if(registar.hasAttribute('hidden')){
            registar.removeAttribute('hidden');
            entrar.hidden = true;
        }else{
            entrar.removeAttribute('hidden');
            registar.hidden = true;
        }

        formularios.classList.remove('animacaoSaida');
        formularios.classList.add('animacaoEntrada');
    }, 400);
}

function retornarAno() {
    let data = new Date();
    let ano = data.getFullYear();

    return ano;
}