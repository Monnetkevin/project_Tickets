function showTicket(ticket){
    document.getElementById(ticket).style.height = "200px"
    document.getElementById(ticket).style.marginTop = "-50px"
    document.getElementById(ticket).style.marginBottom = "-50px"
    document.getElementById(ticket).querySelector(".ticket__description").style.visibility = "visible"


}

function hiddeTicket(ticket){
    document.getElementById(ticket).style.height = "100px"
    document.getElementById(ticket).style.marginTop = "0"
    document.getElementById(ticket).style.marginBottom = "50px"
    document.getElementById(ticket).querySelector(".ticket__description").style.visibility = "hidden"

}