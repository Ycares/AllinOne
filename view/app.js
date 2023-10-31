const parentElement = document.querySelector('main');

const originalDiv = document.querySelector('.card');
const clonedDiv = originalDiv.cloneNode(true);

parentElement.appendChild(clonedDiv);

function ajouterElement() {
    var nouvelElement = document.getElementById("nouvelElement").value;
    var li = document.createElement("li");
    li.appendChild(document.createTextNode(nouvelElement));

    document.getElementById("listeElements").appendChild(li);

    document.getElementById("nouvelElement").value = "";
}