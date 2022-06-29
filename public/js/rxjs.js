const { fromEvent } = rxjs;

// Constantes liées au script
const categories = document.querySelectorAll('.category');
const click$ = fromEvent (categories, 'click');

// Code
click$.forEach(e => {
    let target = e.target;
    let ul = document.createElement('ul');
    let livu = document.createElement('li');
    let livoir = document.createElement('li');
    let avu = document.createElement('a');
    let avoir = document.createElement('a');
    
    e.preventDefault();

    // Création du sous-menu
    if (target.parentElement.children.length < 2){
        // Création du lien Vu & insertion du texte
        target.parentElement.appendChild(ul).appendChild(livu).appendChild(avu).setAttribute('href', '{{ patch(\'vu\') }}');
        avu.innerText = 'Vu';
        // Création du lien A voir & insertion du texte
        target.parentElement.appendChild(ul).appendChild(livoir).appendChild(avoir).setAttribute('href', '{{ patch(\'avoir\') }}');
        avoir.innerText = 'A Voir';
    } 
    // Suppression du sous-menu
    else {
       target.parentElement.removeChild(target.parentElement.lastChild)
    }
});
