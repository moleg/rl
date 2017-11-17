/**
 * Created by Anton on 25.10.2017.
 */
var modal = document.getElementById('myModal');
var btn = document.getElementById("myBtn");
var span = document.getElementsByClassName("close")[0];

span.addEventListener("click",function() {
    modal.style.display = "none";
});

window.addEventListener("click",function(event) {
    if (event.target === modal) {
        modal.style.display = "none";
    }
});
/////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////
var search = document.getElementById("search-button");
if (search.addEventListener) {
    search.addEventListener("click" , searching , false);
} else if (search.attachEvent)  {
    search.attachEvent("onclick" , searching);
}

addEventListener("keydown", function (e) {
    if(e.keyCode === 13)
    {
        searching()
    }
});
function searching() {
    var field = document.getElementById("search-field");
    location.href ="http://rl.loc/home/"+field.value;
}

function marks(obj) {
    var token = document.getElementsByName("csrf-token")[0].content;
    var data = new FormData();
    var tr = document.getElementById("modal-table-tr");
    tr.setAttribute("data-id",obj.dataset.id);
    data.append("id", obj.dataset.id);
    sendRequest("POST","/home/getmarks",token,setMarks,data,true);
}
function setMarks(data) {
    var marksInput = document.getElementsByClassName("marks");
    var iterator = 0;
    var sum = 0;
    for (var key in data) {
        marksInput[iterator].value = data[key];
        sum += data[key];
        iterator++;
    }
    marksInput[iterator].innerText = sum;
    modal.style.display = "block";
}
function sendMarks(obj) {
    var data = new FormData();
    var marks = document.getElementsByClassName("marks");
    data.append("id",marks[0].parentNode.parentNode.dataset.id);
    var sum = 0;
    for(var i=0;i<marks.length-1;i++)
    {
        sum += parseInt(marks[i].value);
        data.append("test"+(i+1),marks[i].value)
    }
    marks[marks.length-1].innerText = sum;
    var token = document.getElementsByName("csrf-token")[0].content;
    sendRequest("POST","/home/updatemarks",token,undefined,data,true);
}

function edit(obj) {
    var parent = obj.parentNode.parentNode.childNodes;
    console.log(parent);
    console.log(document.getElementsByClassName("controls"));
    var count = document.getElementsByClassName("controls").length*2;
    for (var i = 1;i<parent.length-count;i+=2)
    {
        var data = parent[i].dataset.type.split(":");
        if(data[0] === "enum")
        {
            var enumerable = data[1].split(",");
            var fragment = document.createDocumentFragment();
            var select = document.createElement("select");
            //select.name = "school";
            //select.className = "form-control";
            //select.id = "school";
            var option = null;
            for(var j = 0;j<enumerable.length;j++)
            {
                option = document.createElement("option");
                option.value = enumerable[j];
                option.innerText = enumerable[j];
                fragment.appendChild(option);
            }
            select.appendChild(fragment);
            parent[i].innerText = "";
            parent[i].appendChild(select);
        }
        else {
            var input = document.createElement("input");
            input.type = "text";
            input.value = parent[i].innerText;
            input.size = parent[i].innerText.length;
            parent[i].innerText = "";
            parent[i].appendChild(input);
        }
    }
    var logo = document.createElement("i");
    logo.className ="fa fa-check fa-lg send ";
    logo.setAttribute("data-id",obj.dataset.id);
    logo.setAttribute("onclick","send(this)");
    logo.setAttribute("aria-hidden","true");
    obj.parentNode.replaceChild(logo,obj);
}

function send(obj) {
    //var data = {};
    var data = new FormData();
    data.append('id', obj.dataset.id);
    //data.id = obj.dataset.id;
    var parent = obj.parentNode.parentNode.childNodes;
    var count = document.getElementsByClassName("controls").length*2;
    for (var i = 1;i<parent.length-count;i+=2)
    {
        data.append(parent[i].dataset.name, parent[i].childNodes[0].value);
        //data[parent[i].dataset.name] = parent[i].childNodes[0].value;
    }
    var token = document.getElementsByName("csrf-token")[0].content;
    sendRequest("POST","home/update",token,reverse.bind(obj),data,true);

}
function deleting(obj) {
    var token = document.getElementsByName("csrf-token")[0].content;
    sendRequest("DELETE", "home/delete/"+obj.dataset.id,token,reload,true)
}
function reload() {
    location.reload(true);
}

function reverse() {
    var obj = this;
    var parent = obj.parentNode.parentNode.childNodes;
    var count = document.getElementsByClassName("controls").length*2;
    for (var i = 1;i<parent.length-count;i+=2)
    {
        parent[i].innerText = parent[i].childNodes[0].value;
        //parent[i].removeChild(parent[i].childNodes[0]);
    }
    var logo = document.createElement("i");
    //var oldLogo = document.getElementById("send");
    logo.className ="fa fa-pencil fa-lg edit ";
    logo.setAttribute("data-id",obj.dataset.id);
    logo.setAttribute("onclick","edit(this)");
    logo.setAttribute("aria-hidden","true");
    //var save = document.getElementsByClassName("")[0];
    obj.parentNode.replaceChild(logo,obj);
}

function sendRequest(type, url, header , callback ,data,async) {
    var xhr  = null;
    if (window.XMLHttpRequest) {
        //Gecko-совместимые браузеры, Safari, Konqueror
        xhr  = new XMLHttpRequest();

    } else if (window.ActiveXObject) {
        //Internet explorer
        try {
            xhr  = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (CatchException) {
            xhr  = new ActiveXObject("Msxml2.XMLHTTP");
        }
    }
    xhr.onreadystatechange = function(){
        if(this.readyState === 4){
            if(this.status === 200){
                if(callback != undefined || callback != null)
                {
                    this.responseText !== "" ? callback(JSON.parse(this.responseText)) : callback();
                }
            }
        }

    };
    xhr.open(type,url,async);
    xhr.setRequestHeader("X-CSRF-TOKEN", header);
    data !== undefined ? xhr.send(data) : xhr.send();
}