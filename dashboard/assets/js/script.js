const sidebar = document.querySelector('.sidebar');
const menuBtn = document.getElementById('menutoggle');

menuBtn.addEventListener("click", () => {
    sidebar.style.left = "0px";
});

document.addEventListener("click", (event) =>{
    const isCLickInside = sidebar.contains(event.target) || menuBtn.contains(event.target);

    if(!isCLickInside){
        sidebar.style.left = "-172px";
    }
});