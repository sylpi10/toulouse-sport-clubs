let districts = document.querySelectorAll('.district');
let checkboxes = document.querySelectorAll('.checkbox');
// let check31000 = document.getElementById('check31000');



let d31000 = document.querySelector('.district31000');

// function onCheck() {
//     if (check31000.checked == true) {
//         d31000.style.fill == '#ccc';
//     }else{
//         d31000.style.fill == "lightblue";
//     }
// }
// check31000.addEventListener('click', function(){
//     d31000.style.fill = "#ccc";
// })

let txt31000 = document.querySelector('.text-31000 > ul');
let title31000 = document.querySelector('.text-31000 > h2 > label');
let check31000 = document.querySelector('.check31000');

let d31100 = document.querySelector('.district31100');
let txt31100 = document.querySelector('.text-31100 > ul');
let title31100 = document.querySelector('.text-31100 > h2 > label');
let check31100 = document.querySelector('.check31100');

let d31200 = document.querySelector('.district31200');
let txt31200 = document.querySelector('.text-31200 > ul');
let title31200 = document.querySelector('.text-31200 > h2 > label');
let check31200 = document.querySelector('.check31200');

let d31300 = document.querySelector('.district31300');
let txt31300 = document.querySelector('.text-31300 > ul');
let title31300 = document.querySelector('.text-31300 > h2');
let check31300 = document.querySelector('.check31300');


let d31400 = document.querySelector('.district31400');
let txt31400 = document.querySelector('.text-31400 > ul');
let title31400 = document.querySelector('.text-31400 > h2');
let check31400 = document.querySelector('.check31400');


let d31500 = document.querySelector('.district31500');
let txt31500 = document.querySelector('.text-31500 > ul');
let title31500 = document.querySelector('.text-31500 > h2');
let check31500 = document.querySelector('.check31500');

  
function showText (dis, txt, title, check) {
    
    // display text when hover districk
        dis.addEventListener("mouseenter", function() {
            txt.style.display = "block";
            title.style.color = "navy";
            txt.style.color = "navy";
        });

        //set checkbox when click on district
        dis.addEventListener("click", function() {
            if (check.checked == false) {
                check.checked=true;
            }else{
                check.checked=false;
            }
        });

        // changes colors on click & display text details
        dis.addEventListener("click", function() {
            if (dis.hasAttribute("checked")) {
                dis.style.fill = "lightblue";
                dis.removeAttribute('checked', 'checked');
            }else{
                dis.setAttribute('checked', 'checked');
                dis.style.fill = "#ccc";
                txt.style.display = "block";
            }
        })

        // reset colors and hide text
        dis.addEventListener("mouseleave", function() {
            if (check.checked == false ) {
                txt.style.display = "none";
                title.style.color = "#333";
                dis.style.fill = "lightblue";
            }
        });
        dis.addEventListener("mouseenter", function() {
                dis.style.fill = "#ddd";
        });
    }   

    showText(d31000, txt31000, title31000, check31000);
    showText(d31100, txt31100, title31100, check31100);
    showText(d31200, txt31200, title31200, check31200);
    showText(d31300, txt31300, title31300, check31300);
    showText(d31400, txt31400, title31400, check31400);
    showText(d31500, txt31500, title31500, check31500);





