document.getElementById("myForm").onsubmit = function (e) {
    const fields = document.getElementsByTagName("input");
    for (let i = 0; i < fields.length; i++) {
        fields[i].addEventListener('change', (event) => {
            fields[i].classList.remove("highlight");
        });

        if (fields[i].value == null || fields[i].value == "") {
            e.preventDefault();
            fields[i].classList.add("highlight");
            alert("Form is incomplete!");
        }
    
        if (fields[i].type=="email"){
            if (!fields[i].checked) {
                fields[i].parentElement.classList.add("highlight");
                alert("Please accept the license!");
            } 
        }
    }
}

