const btnConquista =document.querySelector("#conquistaBtn");

btnConquista.onclick = () => {
    const conquista_container = document.querySelector(".container_finish");
    conquista_container.style.visibility = 'hidden';
}

const btnConquista2 = document.querySelector("#conquistaBtn2");

btnConquista2.onclick = () => {
    const conquista_container2 = document.querySelector(".container_finish_evolution_visible");
    conquista_container2.style.visibility = 'hidden';
    location. reload()
}