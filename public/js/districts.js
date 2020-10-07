let districts = document.querySelectorAll('.district');
let checkboxes = document.querySelectorAll('.checkbox');

let d31000 = document.querySelector('.district31000');
let txt31000 = document.querySelector('.text-31000 > ul');
let title31000 = document.querySelector('.text-31000 > h3 > label');
let check31000 = document.querySelector('#postals_1');

let d31100 = document.querySelector('.district31100');
let txt31100 = document.querySelector('.text-31100 > ul');
let title31100 = document.querySelector('.text-31100 > h3 > label');
let check31100 = document.querySelector('#postals_2');

let d31200 = document.querySelector('.district31200');
let txt31200 = document.querySelector('.text-31200 > ul');
let title31200 = document.querySelector('.text-31200 > h3 > label');
let check31200 = document.querySelector('#postals_4');

let d31300 = document.querySelector('.district31300');
let txt31300 = document.querySelector('.text-31300 > ul');
let title31300 = document.querySelector('.text-31300 > h3');
let check31300 = document.querySelector('#postals_5');


let d31400 = document.querySelector('.district31400');
let txt31400 = document.querySelector('.text-31400 > ul');
let title31400 = document.querySelector('.text-31400 > h3');
let check31400 = document.querySelector('#postals_6');


let d31500 = document.querySelector('.district31500');
let txt31500 = document.querySelector('.text-31500 > ul');
let title31500 = document.querySelector('.text-31500 > h3');
let check31500 = document.querySelector('#postals_7');

// set all hidden text to heigh = (0)
let allText = document.querySelectorAll('.text > ul');
allText.forEach(text => {
    text.style.height = "0";
});

function showText (dis, txt, title, check) {
    
    // display text when hover district
        dis.addEventListener("mouseenter", function() {
            dis.style.fill = "#88ACE0";
            txt.style.color = "#003F87";
            title.style.color = "#003F87";
            txt.style.transform = "scaleY(1)";
            txt.style.height = "auto";
        });
         // reset colors and hide text on leave
         dis.addEventListener("mouseleave", function() {
            if (check.checked == false ) {
                title.style.color = "#333";
                dis.style.fill = "#7EB6FF";
                txt.style.transform = "scaleY(0)";
                txt.style.height = "0";
            }else{
                dis.style.fill = "#5993E5";
            }
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
                dis.style.fill = "#7EB6FF";
                dis.removeAttribute('checked', 'checked');
            }else{
                dis.setAttribute('checked', 'checked');
                dis.style.fill = "#5993E5";
                txt.style.display = "block";
            }
        });
        

        // same evts on title hover
        title.addEventListener("mouseenter", function () {
            dis.style.fill = "#88ACE0";
            title.style.color = "#003F87";
        });
        title.addEventListener("mouseleave", function () {
            if (check.checked == false ) {
                dis.style.fill = "#7EB6FF";
                title.style.color = "#333";
                // txt.style.display = "block";
            }else{
                dis.style.fill = "#5993E5";
            }
        });
        title.addEventListener("click", function () {
            // txt.style.display = "block";
            if (dis.hasAttribute("checked")) {
                dis.style.fill = "#7EB6FF";
                dis.removeAttribute('checked', 'checked');
            }else{
                dis.setAttribute('checked', 'checked');
                dis.style.fill = "#5993E5";
                txt.style.display = "block";
            }
        });
    
    }   

    showText(d31000, txt31000, title31000, check31000);
    showText(d31100, txt31100, title31100, check31100);
    showText(d31200, txt31200, title31200, check31200);
    showText(d31300, txt31300, title31300, check31300);
    showText(d31400, txt31400, title31400, check31400);
    showText(d31500, txt31500, title31500, check31500);





