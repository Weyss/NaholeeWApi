const { fromEvent, map } = rxjs;

function subMenu() {
    const categories = document.querySelectorAll('.category');
    const mouseEnter$ = fromEvent (categories, 'mouseenter');
    const mouseLeave$ = fromEvent (categories, 'mouseleave');

    mouseEnter$
    .subscribe(e => {
       const target = e.target
       const data = target.getAttribute('data-category');

        if(target.children.length < 1){
            // Création des éléments pour le sous-menu
            let ul = document.createElement('ul');
            let liSeen = document.createElement('li');
            let liToSee = document.createElement('li');
            let aSeen = document.createElement('a');
            let aToSee = document.createElement('a');

            target.appendChild(ul).appendChild(liSeen).appendChild(aSeen).setAttribute('href', 'results/seen/' + data);
            aSeen.innerText = 'Vu';
            target.appendChild(ul).appendChild(liToSee).appendChild(aToSee).setAttribute('href', 'results/tosee/' + data);
            aToSee.innerText = 'A Voir';
        }
        
        e.stopPropagation();  
    });

    mouseLeave$
    .pipe(map(e => e.target))
    .subscribe((target) => {
        target.classList.remove("js-actived");
        target.removeChild(target.lastChild);
    })
}

document.addEventListener('DOMContentLoaded', subMenu);

// Code lié au clique
// function subMenu () {
//     // Constantes liées au script
//     const categories = document.querySelectorAll('.category');
//     const click$ = fromEvent (categories, 'click');
//     let actuallyTarget = null;
//     // Code
//     click$
//     .pipe(map(e => e.target))
//     .subscribe((target) =>  {
//         if (!target.classList.contains("js-actived") && actuallyTarget == null){
//                actived(target);
//                actuallyTarget = target;
//             }
//         else if (actuallyTarget.classList.contains("js-actived") && actuallyTarget != target){
//             target.classList.add("js-actived");
//             actived(target);
//             removeActuallyTarget(actuallyTarget);
//             actuallyTarget = target;
//         }
//         else if (actuallyTarget.classList.contains("js-actived") && actuallyTarget == target){
//             removeActuallyTarget(actuallyTarget);
//             actuallyTarget = null;
//         }      
//     })
// }

// function actived (target) {
//     // Création des éléments pour le sous-menu
//     let ul = document.createElement('ul');
//     let livu = document.createElement('li');
//     let livoir = document.createElement('li');
//     let avu = document.createElement('a');
//     let avoir = document.createElement('a');

//     target.classList.add("js-actived");
//     const data = target.getAttribute('data-category');
 
//     target.appendChild(ul).appendChild(livu).appendChild(avu).setAttribute('href',"/results/vu/" + data);
//     avu.innerText = 'Vu';
//     target.appendChild(ul).appendChild(livoir).appendChild(avoir).setAttribute('href', '{{ patch(\'avoir\') }}');
//     avoir.innerText = 'A Voir';

//     return target;
// }

function removeActuallyTarget(actuallyTarget) {
    // Suppréssion du sous-menu
    actuallyTarget.classList.remove("js-actived");
    actuallyTarget.removeChild(actuallyTarget.lastChild);

    return actuallyTarget;
}



// Le Code fonctionne, mais ce n'est pas la bonne méthode
// le forEach est utilisé en cas de promesse (ex : requète HTTP)
// cf doc : https://rxjs.dev/api/index/class/Observable
// click$.forEach(e => {
    //     let target = e.target;
    //     let ul = document.createElement('ul');
    //     let livu = document.createElement('li');
    //     let livoir = document.createElement('li');
    //     let avu = document.createElement('a');
    //     let avoir = document.createElement('a');
        
    //     console.log(actuallyTarget);
    //     // Création du sous-menu

    //     // Suppression du sous-menu
    //     if (!target.classList.contains("js-actived") && actuallyTarget == null){
    //             target.classList.add("js-actived");
    //             // Création du lien Vu & insertion du texte
    //             target.appendChild(ul).appendChild(livu).appendChild(avu).setAttribute('href', '{{ patch(\'vu\') }}');
    //             avu.innerText = 'Vu';
    //             // Création du lien A voir & insertion du texte
    //             target.appendChild(ul).appendChild(livoir).appendChild(avoir).setAttribute('href', '{{ patch(\'avoir\') }}');
    //             avoir.innerText = 'A Voir';
    //             actuallyTarget = target;
    //         }
    //     else if (actuallyTarget.classList.contains("js-actived") && actuallyTarget != target){
    //         actuallyTarget.classList.remove("js-actived");
    //         actuallyTarget.removeChild(actuallyTarget.lastChild);
    //         target.classList.add("js-actived");
        
    //         // Création du lien Vu & insertion du texte
    //         target.appendChild(ul).appendChild(livu).appendChild(avu).setAttribute('href', '{{ patch(\'vu\') }}');
    //         avu.innerText = 'Vu';
    //         // Création du lien A voir & insertion du texte
    //         target.appendChild(ul).appendChild(livoir).appendChild(avoir).setAttribute('href', '{{ patch(\'avoir\') }}');
    //         avoir.innerText = 'A Voir';
    //         actuallyTarget = target;
    //     }
    //     else if (actuallyTarget.classList.contains("js-actived") && actuallyTarget == target){
    //         actuallyTarget.classList.remove("js-actived");
    //         actuallyTarget.removeChild(actuallyTarget.lastChild);
    //         actuallyTarget = null;
    //         console.log(actuallyTarget);
    //     }        
    // });
