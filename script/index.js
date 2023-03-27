


window.addEventListener('DOMContentLoaded', (event) => {
    


    document.querySelector("#myForm").addEventListener("submit", function(e){
        const reqField = document.querySelectorAll("input");
        for (let i=0;i<reqField.length; i++){
            if(reqField[i].value==null || reqField[i].value==""){
                e.preventDefault();
                
                reqField[i].classList.add("highlight");
            }else {
                reqField[i].classList.remove("highlight");
            }
            if(reqField[i].type=="checkbox"){
                if(!reqField[i].checked){
                    e.preventDefault();
                    reqField[i].classList.add("highlight");
                }
            }


        }
        
    });

    document.querySelector("#myForm").addEventListener("input", function(e){
        const reqField = document.querySelectorAll("input");
        for (let i=0;i<reqField.length; i++){
            if(reqField[i].value!=null && reqField[i].value!=""){
                reqField[i].classList.remove("highlight");
            }
            if(reqField[i].type=="checkbox"){
                if(reqField[i].checked){
                    reqField[i].classList.remove("highlight");
                }
            }
        }
        
    });




});








