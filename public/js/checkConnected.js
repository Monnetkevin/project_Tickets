var lastAction = null;

document.addEventListener('mousemove', function() {
    lastAction = new Date().getTime();
});


function isActive(){

    let now = new Date().getTime();
    let timeWithoutActivities = now - lastAction

    if(timeWithoutActivities >= 2000){//if user is inactive for more than 1 hour 
        return(0)
    }else{// if user is active
        return(1)
    }
    
}

function setUserInactive(userId, newStatus){
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/user/"+userId+"/edit-status", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    var params = newStatus
    // if(newStatus==0){
    //     var params = "isConnected=false";
    // }else{
    //     var params = "isConnected=true"; 
    // }
    

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            console.log("Réponse du serveur :", response);
            // if (response.user) {
            //     app.user = response.user;
            // }

            //getUserData();

        }
    };

    

    // send request with parameters
    xhr.send(params);
    //window.location.reload();
}

function getUserData() {
    var userXhr = new XMLHttpRequest();
    userXhr.open("GET", "/user/", true); // Utilisez la route appropriée pour récupérer les données utilisateur
    
    userXhr.onreadystatechange = function () {
        if (userXhr.readyState == 4) {
            if (userXhr.status == 200) {
                //var userData = JSON.parse(userXhr.responseText);
                console.log("Données utilisateur actualisées :", userXhr);

                // Mettez à jour app.user avec les nouvelles données
                app.user = userData;

                // Faites quelque chose avec les données utilisateur actualisées
            } else {
                console.error("Erreur HTTP :", userXhr.status, userXhr.statusText);
            }
        }
    };

    // Envoyez la requête pour obtenir les données utilisateur
    userXhr.send();
}


// window.addEventListener('beforeunload', function() {
//     var lastAction = new Date().getTime();
//     console.log("Last action before page reload: ", lastAction);
//     // Ajoutez ici le code pour suivre l'action de l'utilisateur avant le rechargement
// });
