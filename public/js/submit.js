'use strict';

function radio()
{
    let radios = document.querySelectorAll('input[type=radio]');
    radios.forEach((radio) => {
        radio.addEventListener('click', submitData)
    })
}


function submitData()
{ 
    let form = document.querySelector('form[name=tv]');

    let data = new FormData(form);
    let httpRequest = new XMLHttpRequest();
    let info = document.getElementById('js-info');
    

    httpRequest.onreadystatechange = function(){
        if (httpRequest.readyState === httpRequest.DONE && httpRequest.status == 200){}
            info.innerText = httpRequest.responseText
    }
    httpRequest.open('POST', form.action , true);
    httpRequest.send(data); 
}


document.addEventListener('DOMContentLoaded', radio);