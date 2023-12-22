
var lastAction = null;


document.addEventListener('mousemove', function() {
    lastAction = new Date().getTime();
});


function isActive(user){

    setInterval(function(){
        let now = new Date().getTime();
        let timeWithoutActivities = now - lastAction
        if(timeWithoutActivities >= 3600000){//if user is inactive for more than 1 hour 
            if(user == 1){// set isConnected false
                return(0)
            }
        }else{// if user is active
            if(user == 0){// set isConnected true
                return(1)
            }
        }
    }, 2000);
    
}


// window.addEventListener('beforeunload', function() {
//     var lastAction = new Date().getTime();
//     console.log("Last action before page reload: ", lastAction);
//     // Ajoutez ici le code pour suivre l'action de l'utilisateur avant le rechargement
// });
