var city = document.getElementById("city");

if (city.addEventListener) {
    city.addEventListener("change" , setSchools , false);
} else if (city.attachEvent)  {
    city.attachEvent("onchange" , setSchools);
}
function setSchools() {
    if(this.value.toUpperCase()==="КИЕВ") {
        var options = {

            url: "/city.json",

            //getValue: "name",

            list: {
                maxNumberOfElements: 10,
                match: {
                    enabled: true
                }
            },

            theme: "square"
        };

        $("#school").easyAutocomplete(options);

        //var token = document.getElementsByName("_token")[0].value;
        //sendRequest("POST", "/cityjson", token, displaySchools,true);
    }else {
        var school = document.getElementsByClassName("school")[0];
        school.innerHTML = '<label for="school">School</label>' +
            '<input class="form-control" type="text" name="school"  id="school"/>'
    }

}

function showOne() {
    var tab = document.getElementsByClassName("tab");
    var button = document.getElementsByClassName("tab-button");
    button[0].style.backgroundColor = "#f5f8fa";
    button[1].style.backgroundColor = "white";
    tab[0].style.display = "block";
    tab[1].style.display = "none";
}
function showTeam() {
    var tab = document.getElementsByClassName("tab");
    var button = document.getElementsByClassName("tab-button");
    button[1].style.backgroundColor = "#f5f8fa";
    button[0].style.backgroundColor = "white";
    tab[0].style.display = "none";
    tab[1].style.display = "block";
}


