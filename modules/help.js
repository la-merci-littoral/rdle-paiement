const helpWidget = document.getElementsByClassName('help-widget');

helpWidget[0].addEventListener("mouseover", (element) => {
    const helpText = document.getElementsByClassName('help-text')[0];
    // console.log(helpText);
    setTimeout(() => {
        helpText.style.opacity = '1';
    }, 200)
    helpText.style.display = "flex"
})

helpWidget[0].addEventListener("mouseleave", (element) => {
    const helpText = document.getElementsByClassName('help-text')[0];
    setTimeout(() => {
        helpText.style.opacity = '0';
        helpText.style.display = 'none';
    }, 300)
})