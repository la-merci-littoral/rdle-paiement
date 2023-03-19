const helpWidget = document.getElementsByClassName('help-widget');
const helpText = document.getElementsByClassName('help-text')[0];
helpText.style.display = "none";
helpText.style.opacity = '0';

// Creates a sleep function that works through the use of a Promise : Non-intrusive function
function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms))
}

// On Hover event shows a text bubble
helpWidget[0].addEventListener("mouseover", (element) => {
    if ((helpText.style.opacity == 0) && (helpText.style.display == "none")) {
        helpText.style.display = "flex"
        // Timeout is necessary for animation, don't ask why
        setTimeout(() => {
            helpText.style.opacity = '1';
        }, 1)
    }
})

// Hides text bubble when hover stops
helpWidget[0].addEventListener("mouseleave", (element) => {
    if ((helpText.style.opacity == 1) && (helpText.style.display == "flex")) {
        // Adds waiting time so that text still shows up if someone went over button quickly
        sleep(300).then(() => {
            helpText.style.opacity = '0';
            // Timeout is necessary to let the opacity animation take place
            setTimeout(() => {
                helpText.style.display = 'none';
            }, 300)
        })
    }
})