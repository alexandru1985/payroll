function validateForm() {
    var nume_angajat= form.nume_angajat.value;
var letters =/^([a-zA-Z])+$/;
    if (nume_angajat.length<6) {
        alert("Campul 'Nume angajat' trebuie sa contina minim 6 caractere!");
        return false;
    }
     
       var varsta = form.varsta.value;
    if (varsta.length<2||varsta.length>2) {
        alert("Campul 'Varsta' trebuie sa contina doar 2 cifre!");
        return false;
    }
        var z = document.forms["form"]["vechime"].value;
    if (z===null || z==="") {
        alert("Nu ati completat campul Vechime!");
        return false;
    }
     var a = document.forms["form"]["salariu"].value;
    if (a===null || a==="") {
        alert("Nu ati completat campul Salariu!");
        return false;
    }
     var b = document.forms["form"]["impozit"].value;
    if (b===null || b==="") {
        alert("Nu ati completat campul Impozit!");
        return false;
    }
    
}

