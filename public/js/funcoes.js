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

/////////// ABILITAR FORMULÁRIO PARA LIMPAR URLS //////////
function abilitarFormulario(){
    let limparUrls = document.querySelectorAll('.limpar-urls');
    let formLimparUrls = document.querySelectorAll('.form-limpar-urls');
    let arrow = document.querySelectorAll('.arrow');

    for(let i = 0; i < limparUrls.length; i++){
        limparUrls[i].addEventListener('click', (event)=>{
            event.preventDefault();

            if(formLimparUrls[i].hasAttribute('hidden')){
                formLimparUrls[i].removeAttribute('hidden');

                formLimparUrls[i].classList.remove('dawnReverse')
                formLimparUrls[i].classList.add('dawn')

                arrow[i].classList.remove('rotateReverse');
                arrow[i].classList.add('rotate');
            }else{
                arrow[i].classList.remove('rotate');
                arrow[i].classList.add('rotateReverse');

                formLimparUrls[i].classList.remove('dawn')
                formLimparUrls[i].classList.add('dawnReverse')

                setTimeout(() => {
                    formLimparUrls[i].hidden = true;
                }, 400);
            }
        });
    }
}


///////////// ABILITAR INPUTS CHECKBOX PARA LIMPEZA DE VÁRIAS URLS //////////
function abilitarLimpezaPorUrl(){
    document.getElementById('flexSwitchCheckChecked').addEventListener('click', ()=>{
        let abilitar = document.querySelectorAll('.abilitar');

        for(let i = 0; i < abilitar.length; i++){
            if(abilitar[i].hasAttribute('hidden')){
                abilitar[i].removeAttribute('hidden');
            }else{
                abilitar[i].hidden = true;
            }
        }

        marcarTodosInputCheck();
    });
}

////////// MARCAR TODOS OS DOMINIOS COMO CHECKED ///////////
function marcarTodosInputCheck(){
    document.getElementById('flexCheckChecked').addEventListener('click', ()=>{
        let checked = document.querySelectorAll('input[type="checkbox"]');

        for(let i = 0; i < checked.length; i++){
            if(checked[i].hasAttribute('checked')){
                checked[i].removeAttribute('checked');
            }else{
                checked[i].setAttribute('checked', '');
            }
        }
    });
}

//////////// REQUISIÇÃO PARA LIMPAR AS URLS SELECIONADAS ////////////
function limparUrlsSelecionadas(){
    document.getElementById('limpar-urls-selecionadas').addEventListener('click', ()=>{
        let urlsSelecionadas = document.querySelectorAll('input[type="checkbox"]').value

        console.log(urlsSelecionadas);
    })
}