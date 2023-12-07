
async function getResponse(bmi,gener) {


    let response = await fetch("http://127.0.0.1:3000", {
        method: "POST",
        max_tokens: 1000,
        max: 1000,
        headers: new Headers({'content-type': 'application/json'}),
        //question for chatgpt
        body: JSON.stringify({question: 'With a limit 150 words. My bmi is '+bmi+' is good or bad? My gener is '+gener+'and can you give us a detail example of a diet with 1 recipe for each? can you recommend us a examples for inside activity?'})
    })

    //text  = questão respondida
    let text = await response.text()

    mudarFundo()

    function mudarFundo() {
        // Abre o script de document.write
        document.write('<html><head><style>');
        // Adiciona o estilo para mudar o fundo
        document.write('body { background-color: #64fcc9; }');
        // Fecha as tags de estilo e cabeçalho
        document.write('</style></head><body>');
        // Adiciona o conteúdo da página
        document.write('<font face="MV Boli" size="4"><p>The ChatGPT think: <p>'+text+'</p></p></font>')
        document.write('<img class="rounded float-start" src="transferir.png" alt="">')
        document.write('<img style="margin-left: 700px" src="Cute_Vector.png" alt="">')
        // Fecha a tag do corpo e do HTML
        document.write('</body></html>')}
    
}
