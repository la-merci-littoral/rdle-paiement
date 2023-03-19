const helpWidget = document.getElementsByClassName('help-widget');
const helpText = document.getElementsByClassName('help-text')[0];
helpText.style.display = "none";
helpText.style.opacity = '0';

helpWidget[0].addEventListener("mouseover", (element) => {
    // console.log("Opacity: ", helpText.style.opacity, " | Display: ", helpText.style.display)
    if ((helpText.style.opacity == 0) && (helpText.style.display == "none")) {
        helpText.style.opacity = '1';
        setTimeout(() => {
            helpText.style.display = "flex"
        }, 200)
    }
})

helpWidget[0].addEventListener("mouseleave", (element) => {
    if ((helpText.style.opacity == 1) && (helpText.style.display == "flex")) {
        helpText.style.opacity = '0';
        setTimeout(() => {
            helpText.style.display = 'none';
        }, 300)
    }
})