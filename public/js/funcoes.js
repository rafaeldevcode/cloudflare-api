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
        let urlsSelecionadas = document.querySelectorAll('input[type="checkbox"]');
        let id = document.getElementById('id').value
        let token = document.querySelector('.btn-limpar-urls-selecionadas > input[name="_token"]').value;
        let url = `/cloudflare/${id}/purge-urls-selecionadas`;
        let formData = new FormData();
        let urls = [];

        for(let i = 0; i < urlsSelecionadas.length; i++){
            if((urlsSelecionadas[i].checked === true) && 
                (urlsSelecionadas[i].value !== 'on') && 
                (urlsSelecionadas[i].value !== '')){

                urls.push(urlsSelecionadas[i].value);
            }
        }

        if(urls == ''){

            setTimeout(() => {
                exibirMensagem('Nenhuma domínio selecionado!', 'danger', urls);
            }, 3000);
        }else{
            formData.append('_token', token);
            formData.append('urls', urls);
    
            fetch(url, {
                method: 'POST',
                body: formData
            }).then((response)=>{
    
                limparInputsSelecionados(urlsSelecionadas);

                if(response.ok){

                    exibirMensagem('Cache limpado com sucesso!', 'success', urls);
                }else{

                    exibirMensagem('Erro ao efetuar a limpeza de cache!', 'danger', urls);
                }
            }).catch(function(error){
                console.error(`Ocorreu um problema com sua operação de busca: ${error.message}`);
            });
        }
    })
}

////////// EXIBIR MENSAGEM ////////////
function exibirMensagem(mensagem, cor, urls){
    urls = [];
    window.scrollTo({top:0, left:0, behavior:'smooth'});
    let divMensagem = document.querySelector('.mensagem');
    let div = document.createElement('div');
    
        divMensagem.innerHTML = '';

        div.setAttribute('class', `alert alert-${cor}`);
        div.innerHTML = mensagem;

    divMensagem.appendChild(div)
    removerClass();
}

//////// REMOVER CLASSE ///////////////
function removerClass(){
    document.querySelector('.load').remove();
    let btnLoad = document.querySelectorAll('.btn-load');

    for(let i = 0; i < btnLoad.length; i++){
        btnLoad[i].classList.remove('transparent');
    };
}

///////////// LIMPAR INPUTS SELECIONADOS ///////////
function limparInputsSelecionados(urlsSelecionadas){
    document.getElementById('flexSwitchCheckChecked').click();
    for(let i = 0; i < urlsSelecionadas.length; i++){
        urlsSelecionadas[i].checked = false;
    };
}

///////// EXIBIR MENU LATERAL ASIDE ////////////
function exibirMenu(){
    document.querySelector('aside').addEventListener('mouseover', ()=>{
        let exibirLink = document.querySelectorAll('.exibir-link');

        setTimeout(() => {
            for(let i = 0; i < exibirLink.length; i++){
                exibirLink[i].removeAttribute('hidden');

                exibirLink[i].classList.add('opacidadeMenuAside');
            } 
        }, 300);

        ocultarMenu();
    });
}

//////// OCULTAR MENU LATERAL ASIDE //////////
function ocultarMenu(){
    document.querySelector('aside').addEventListener('mouseout', ()=>{
        let exibirLink = document.querySelectorAll('.exibir-link');

        for(let i = 0; i < exibirLink.length; i++){
            exibirLink[i].hidden = true;

            exibirLink[i].classList.remove('opacidadeMenuAside');
        }
    })
}

///////////// REMOVER MENSAGEM DE RETORNO DA LIMEZA DE CACHE ////////////
function removerMensagem(){
    document.getElementById('remover').addEventListener('click', ()=>{
        document.querySelector('.mensagem').remove();
    })
}

//////////// ADICIONAR IMAGEM DO USUARIO /////////////////
function adicionarImagemUsuario(){
    let formularioImagen = document.getElementById('formulario-imagen');
    document.getElementById('editar-imagen').addEventListener('click', ()=>{

        formularioImagen.removeAttribute('hidden');
        formularioImagen.classList.remove('opacidadeReversa')
        formularioImagen.classList.add('d-flex', 'opacidade')
    })

    document.getElementById('fechar-formulario-imagen').addEventListener('click', ()=>{

        formularioImagen.classList.remove('opacidade')
        formularioImagen.classList.add('opacidadeReversa')

        setTimeout(() => {
            formularioImagen.hidden = true;
            formularioImagen.classList.remove('d-flex')
        }, 400);
    })
}

//////////// ACIONAR O LOAD DO BOTÃO /////////////////
function acionarLoad(){
    let btnLoad = document.querySelectorAll('.btn-load');
    let sessionLoad = document.querySelectorAll('.session-load');

    for(let i = 0; i < btnLoad.length; i++){
        btnLoad[i].addEventListener('click', ()=>{
            let div = document.createElement('div');
                div.setAttribute('class', 'load');

                btnLoad[i].classList.add('transparent');
                sessionLoad[i].appendChild(div);
        })
    }
}

//////// ABILITAR INPUTS PARA EDITAR USUARIO ////////////
function editarUsuario(){
    document.getElementById('editar-usuario').addEventListener('click', ()=>{
        let inputs = document.querySelectorAll('form * input');
        
        for(let i = 0; i < inputs.length; i++){
            if(inputs[i].hasAttribute('disabled')){
                inputs[i].removeAttribute('disabled');
            }else{
                inputs[i].disabled = true;
            }
        }
    })
}

/////////////// DELETAR CONTA //////////////////
function deletarConta(){
    document.getElementById('deletar-conta').addEventListener('click', (event)=>{
        event.preventDefault();
        
        let formDeletarConta = document.getElementById('form-deletar-conta');
            formDeletarConta.removeAttribute('hidden');
            formDeletarConta.classList.remove('opacidadeReversa')
            formDeletarConta.classList.add('opacidade')

            fecaharFormDeletarConta(formDeletarConta);
    })
}

////////////// FECHAR FORMULÁRIO DE DELETAR CONTA ////////////
function fecaharFormDeletarConta(formDeletarConta){
    document.getElementById('cancelar').addEventListener('click', ()=>{
        formDeletarConta.classList.remove('opacidade')
        formDeletarConta.classList.add('opacidadeReversa')
    
        setTimeout(() => {
            formDeletarConta.hidden = true;
        }, 400);
    })
}