function toggleSubmit(val){
    var sbmtBtn = document.getElementsByName("submit")[0]
    if (val.checked){
        sbmtBtn.disabled = false
    } else {
        sbmtBtn.disabled = true
    }
}