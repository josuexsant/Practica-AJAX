var xmlHttp = crearXMLHttpRequest();
var nombre = "";

function initEvents() {
  console.log("Se han iniciado los eventos");
  var playButton = document.getElementById("playButton");
  var nombreButton = document.getElementById("nombreButton");
  playButton.disabled = true;
  addEvent(playButton, "click", play, false);
  addEvent(nombreButton, "click", getNombre, false);
}

function getNombre() {
  nombre = document.getElementById("nombre").value;
  console.log("Se ha pulsado el botón de nombre");

  var campoNombre = document.getElementById("nombre");

  if (nombre == "") {
    campoNombre.style.borderColor = "red";
    alert("Introduce un nombre");
  } else {
    campoNombre.style.borderColor = "";
    console.log("Nombre: " + nombre);
    campoNombre.style.borderColor = "";
    playButton.disabled = false;
  }
}

function play() {
  console.log("Se ha iniciado el juego");

  var xmlData =
    "<data><nombre>" +
    nombre +
    "</nombre><apellido>"
  xmlHttp.open(
    "POST",
    "./php/gananciaAleatoria.php?timestamp=" + xmlHttp.timestamp,
    true
  );

  xmlHttp.onreadystatechange = function () {
    if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
      document.getElementById("maxValue").innerHTML =
        "Ganancia máxima: " + xmlHttp.responseText;
      document.getElementById("maxValue").style.visibility = "visible";
      document.getElementById("playButton").disabled = false;
      document.getElementById("cargando").style.visibility = "hidden";
    } else if (xmlHttp.status != 200 && xmlHttp.status != 0) {
      document.getElementById("maxValue").innerHTML =
        "ERROR: " + xmlHttp.status;
      document.getElementById("maxValue").style.visibility = "visible";
      document.getElementById("playButton").disabled = false;
      document.getElementById("cargando").style.visibility = "hidden";
    }
  };
  document.getElementById("maxValue").style.visibility = "hidden";

  document.getElementById("playButton").disabled = true;
  document.getElementById("cargando").style.visibility = "visible";
  xmlHttp.send(xmlData);
}

function crearXMLHttpRequest() {
  var xmlHttp = null;
  if (window.ActiveXObject) xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
  else if (window.XMLHttpRequest) xmlHttp = new XMLHttpRequest();
  return xmlHttp;
}

function addEvent(element, eventName, callback, useCapture) {
  if (element.addEventListener) {
    element.addEventListener(eventName, callback, useCapture);
  } else if (element.attachEvent) {
    element.attachEvent("on" + eventName, callback);
  }
}

addEvent(window, "load", initEvents, false);
