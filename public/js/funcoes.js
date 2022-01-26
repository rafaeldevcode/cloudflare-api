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
    let urls = [];
    document.getElementById('limpar-urls-selecionadas').addEventListener('click', ()=>{
        let urlsSelecionadas = document.querySelectorAll('input[type="checkbox"]');
        let id = document.getElementById('id').value
        let token = document.querySelector('.btn-limpar-urls-selecionadas > input[name="_token"]').value;
        let url = `/cloudflare/${id}/purge-urls-selecionadas`;
        let formData = new FormData();

        for(let i = 0; i < urlsSelecionadas.length; i++){
            if((urlsSelecionadas[i].checked === true) && 
                (urlsSelecionadas[i].value !== 'on') && 
                (urlsSelecionadas[i].value !== '')){

                urls.push(urlsSelecionadas[i].value);
            }
        }

        if(urls == ''){

            exibirMensagem('Nenhuma domínio selecionado!', 'danger');
        }else{
            formData.append('_token', token);
            formData.append('urls', urls);
    
            fetch(url, {
                method: 'POST',
                body: formData
            }).then((response)=>{
    
                limparInputsSelecionados(urlsSelecionadas);

                if(response.ok){

                    exibirMensagem('Cache limpado com sucesso!', 'success');
                }else{

                    exibirMensagem('Erro ao efetuar a limpeza de cache!', 'danger');
                }
            }).catch(function(error){
                console.error(`Ocorreu um problema com sua operação de busca: ${error.message}`);
            });
        }
    })
}

////////// EXIBIR MENSAGEM ////////////
function exibirMensagem(mensagem, cor){
    window.scrollTo({top:0, left:0, behavior:'smooth'});
    let divMensagem = document.querySelector('.mensagem');
    let div = document.createElement('div');
        divMensagem.innerHTML = '';

        div.setAttribute('class', `alert alert-${cor}`);
        div.innerHTML = mensagem;

    divMensagem.appendChild(div)
}

///////////// LIMPAR INPUTS SELECIONADOS ///////////
function limparInputsSelecionados(urlsSelecionadas){
    document.getElementById('flexSwitchCheckChecked').click();
    for(let i = 0; i < urlsSelecionadas.length; i++){
        urlsSelecionadas[i].checked = false;
    };
}