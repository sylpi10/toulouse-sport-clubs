const districts = document.querySelectorAll('.district');
const checkboxes = document.querySelectorAll('.checkbox');

const allTitles = document.querySelectorAll('.text > h3');
const allText = document.querySelectorAll('.text > ul');

// Set all hidden text to height = 0
allText.forEach(text => text.style.height = "0");

const showText = (dis, txt, title, check) => {
    const toggleText = () => {
        const isChecked = check.checked;
        txt.style.height = isChecked ? 'auto' : '0';
        txt.style.transform = isChecked ? 'scaleY(1)' : 'scaleY(0)';
        title.style.color = isChecked ? '#003F87' : '#333';
        dis.style.fill = isChecked ? '#5993E5' : '#7EB6FF';
    };

    // Display text when hovering over district
    dis.addEventListener('mouseenter', () => {
        dis.style.fill = "#88ACE0";
        txt.style.color = "#003F87";
        title.style.color = "#003F87";
        txt.style.transform = "scaleY(1)";
        txt.style.height = "auto";
    });

    // Reset colors and hide text on mouse leave
    dis.addEventListener('mouseleave', () => {
        if (!check.checked) {
            title.style.color = "#333";
            dis.style.fill = "#7EB6FF";
            txt.style.transform = "scaleY(0)";
            txt.style.height = "0";
        } else {
            dis.style.fill = "#5993E5";
        }
    });

    // Toggle checkbox and colors on district click
    dis.addEventListener('click', () => {
        check.checked = !check.checked;
        toggleText();
    });

    // Same events on title hover
    title.addEventListener('mouseenter', () => {
        dis.style.fill = "#88ACE0";
        title.style.color = "#003F87";
    });

    title.addEventListener('mouseleave', () => {
        if (!check.checked) {
            dis.style.fill = "#7EB6FF";
            title.style.color = "#333";
        } else {
            dis.style.fill = "#5993E5";
        }
    });

    // Toggle text visibility and district color on title click
    title.addEventListener('click', () => {
        check.checked = !check.checked;
        toggleText();
    });
};

const districtsData = [
    { district: '.district31000', text: '.text-31000 > ul', title: '.text-31000 > h3 > label', check: '#postals_1' },
    { district: '.district31100', text: '.text-31100 > ul', title: '.text-31100 > h3 > label', check: '#postals_2' },
    { district: '.district31200', text: '.text-31200 > ul', title: '.text-31200 > h3 > label', check: '#postals_4' },
    { district: '.district31300', text: '.text-31300 > ul', title: '.text-31300 > h3', check: '#postals_5' },
    { district: '.district31400', text: '.text-31400 > ul', title: '.text-31400 > h3', check: '#postals_6' },
    { district: '.district31500', text: '.text-31500 > ul', title: '.text-31500 > h3', check: '#postals_7' }
];

// Initialize all district elements
districtsData.forEach(({ district, text, title, check }) => {
    const dis = document.querySelector(district);
    const txt = document.querySelector(text);
    const titleElement = document.querySelector(title);
    const checkbox = document.querySelector(check);
    showText(dis, txt, titleElement, checkbox);
});

// All districts toggle
const allDistrictsInput = document.getElementById('all');

allDistrictsInput.addEventListener('click', () => {
    const isChecked = allDistrictsInput.checked;

    districts.forEach(d => {
        const checkbox = d.querySelector('input[type="checkbox"]');
        checkbox.checked = isChecked;
        d.style.fill = isChecked ? '#5993E5' : '#7EB6FF';
    });

    allTitles.forEach(title => {
        title.style.color = isChecked ? '#003F87' : '#333';
    });
});
