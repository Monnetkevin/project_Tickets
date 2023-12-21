
function showTicket(ticket){

    document.getElementById(ticket).querySelector(".ticket").style.height = "200px"
    document.getElementById(ticket).querySelector(".ticket").style.marginTop = "-50px"
    document.getElementById(ticket).querySelector(".ticket").style.marginBottom = "-50px"

    // document.getElementById(ticket).querySelector(".ticket__icons").style.top= "-58px"
    document.getElementById(ticket).querySelector(".ticket__icons").style.visibility= "hidden"

    document.getElementById(ticket).querySelector(".ticket__description").style.visibility = "visible"

    clearTimeout(hideTimeout);
}

function hiddeTicket(ticket){

    document.getElementById(ticket).querySelector(".ticket").style.height = "100px"
    document.getElementById(ticket).querySelector(".ticket").style.marginTop = "0"
    document.getElementById(ticket).querySelector(".ticket").style.marginBottom = "50px"

    // document.getElementById(ticket).querySelector(".ticket__icons").style.top= "-8px"
    

    document.getElementById(ticket).querySelector(".ticket__description").style.visibility = "hidden"
    hideTimeout = setTimeout(function() {
        document.getElementById(ticket).querySelector(".ticket__icons").style.visibility= "visible"
      }, 300);
    
}

function previousPage() {
    window.history.back();
}