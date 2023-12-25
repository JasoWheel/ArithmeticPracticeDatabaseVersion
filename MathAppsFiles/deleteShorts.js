let getId=["hi"];

function displayUser() {
    getId = findChecked();
    //console.log(getId);
    let UserText = "Name: "+getId[0]+" -- User: "+getId[1];
    document.getElementById("showKid").innerHTML=UserText;
}

function findChecked() {
    var CheckName = document.getElementsByName('CheckName');
    getId = [];
    for(var i=0; i< CheckName.length; i++) {
        if(CheckName[i].checked) {
            getId.push(CheckName[i].id); //realName
            getId.push(CheckName[i].value); //UserName
            return getId;
        }
    } 
}

