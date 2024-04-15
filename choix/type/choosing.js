const letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ"
// const colors = ["#E072A4",
//     "#3D3B8E",
//     "#4C1E4F",
//     "#4A8FE7",
//     "#4C2E05",
//     "#EE4266",
//     "#3CBBB1",
//     "#F07167",
//     "#90C3C8",
//     "#7CC6FE",
//     "#23C9FF",
//     "#9448BC",
//     "#512D38",
//     "#4A5159",
//     "#F4B860",
//     "#C83E4D",
//     "#720E07",
//     "#45050C",
//     "#58BC82",
//     "#801A86",
//     "#5C80BC",
//     "#7EBC89",
//     "#49DCB1",
//     "#456990",
//     "#A7A2A9",
//     "#222823",
//     "#9FC490",
//     "#011936",
//     "#A1674A",
//     "#D3B88C",
//     "#523249"
// ]
// Remains of a design attempt badly imagined...

/* 
 * YANNIS EXPLAIN THIS PLEASE
 */

document.querySelectorAll('.highlight').forEach(element => {
    element.onmouseover = event => {
        let iterations = 0;

        const interval = setInterval(() => {
            event.target.innerText = event.target.innerText.split("")
                .map((letter, index) => {
                    if (index < iterations) {
                        return event.target.dataset.value[index]
                    }

                    return letters[Math.floor(Math.random() * 26)]
                })
                .join("");

                if (iterations >= event.target.dataset.value.length) clearInterval(interval);

                iterations += 1/3;
        }, 30)
    }
})

function openAnonymous() { // pretty self-explanatory
    const everything = document.getElementsByTagName("*");
    for (let i = 0; i < everything.length; i++) {
        if (!(everything[i].hasAttribute('not-to-be-blurred'))) {
            everything[i].classList.add('blurred');
        }
    }
    document.getElementById("confirm-box").classList.remove("hidden");
    // document.getElementById("main").classList.add("blurred")
    // document.getElementsByClassName("header-wrapper").classList.add("blurred")
}

function toggleSubmit(val){ // noob JS, easy
    var sbmtBtn = document.getElementsByName("submit-anonymous")[0]
    if (val.checked){
        sbmtBtn.disabled = false
    } else {
        sbmtBtn.disabled = true
    }
}