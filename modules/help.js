const helpWidget = document.getElementsByClassName('help-widget');

helpWidget[0].addEventListener("mouseover", (element) => {
    const helpText = document.getElementsByClassName('help-text')[0];
    // console.log(helpText);
    setTimeout(() => {
        helpText.classList.remove('hidden');
    }, 100)
})

helpWidget[0].addEventListener("mouseleave", (element) => {
    const helpText = document.getElementsByClassName('help-text')[0];
    setTimeout(() => {
        helpText.classList.add('hidden');
    }, 300)
})