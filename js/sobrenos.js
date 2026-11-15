var seta = document.querySelector('#seta_btn1');
var currentScreen;
const scrollableDiv = document.getElementById('scrollableDiv');
const h2Focus = document.getElementById('focus');


if (localStorage.getItem("currentScreen")){
    currentScreen = parseInt(localStorage.getItem("currentScreen"));
    if(currentScreen > 5){
        currentScreen = 1;
    }
}else{
    currentScreen = 1;
}

function navigateScreens(direction){
  if(direction === "ArrowDown"){
    if (currentScreen < 5){
        currentScreen++;
        if(currentScreen > 4){
            seta.style.display = 'none';
            scrollableDiv.style.overflowY = 'visible';
            scrollableDiv.scrollTop = 0;
        }
    }
    }else if(direction === "ArrowUp"){
        if(currentScreen > 1){
            currentScreen--;
            seta.style.display = 'block';
            scrollableDiv.style.overflowY = 'hidden';
            scrollableDiv.scrollTop = scrollableDiv.scrollHeight;
        }
    }

  localStorage.setItem("currentScreen", currentScreen.toString());

  var targetScreen = document.getElementById("body" + currentScreen);
  targetScreen.scrollIntoView();
}

document.addEventListener("keydown", function(event) {
    
    switch (event.key) {
        case "ArrowDown":
        case "ArrowUp":
        navigateScreens(event.key);
        break;
    }
});
    if(currentScreen > 1){
        seta.style.display = 'none';
    }
seta.addEventListener('click', function(){
    if (currentScreen < 5){
        currentScreen++;
        localStorage.setItem("currentScreen", currentScreen.toString());
        targetScreen = document.getElementById("body" + currentScreen);
        targetScreen.scrollIntoView();
        seta.style.display = 'block';
    }
    if(currentScreen > 4){
        seta.style.display = 'none';
    }
});

document.addEventListener('DOMContentLoaded', function() {
    targetScreen = document.getElementById("body" + currentScreen);
    targetScreen.scrollIntoView();
});