const menu = () => {
    var x = document.getElementById("menu");
    if (x.className === "nav-menu") {
        x.className += "responsive";
    } else {
        x.className = "nav-menu";
    }
}