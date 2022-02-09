'use strict';

function radio()
{
    let radios = document.querySelectorAll('input[type=radio]');
    radios.forEach((radio) => {
        radio.addEventListener('click', submit)
    })
}

function data(){
    
}

function submit()
{
    const httpRequest = new XMLHttpRequest();
    const info = document.getElementById('js-info');
    const attribute = this.getAttribute("name")
    let form = '';

    if(attribute == 'tv[statue]')
        form = document.querySelector('form[name=tv]')

    if(attribute == 'film[statue]')
        form = document.querySelector('form[name=film]')
    
    const data = new FormData(form);
    
    httpRequest.onreadystatechange = function(){
        if (httpRequest.readyState === httpRequest.DONE && httpRequest.status == 200){
            info.innerText = httpRequest.responseText
        }    
    }
    httpRequest.open('POST', form.action , true);
    httpRequest.send(data); 
}


document.addEventListener('DOMContentLoaded', radio);