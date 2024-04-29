function addEvent(elemento, nomevento, funcion, captura) {
  if (elemento.attachEvent) {
    elemento.attachEvent("on" + nomevento, funcion);
    return true;
  } else if (elemento.addEventListener) {
    elemento.addEventListener(nomevento, funcion, captura);
    return true;
  } else return false;
}

function crearXMLHttpRequest() {
  var xmlHttp = null;
  if (window.XMLHttpRequest) xmlHttp = new XMLHttpRequest();
  else if (window.ActiveXObject)
    xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");

  // Anti-caché: agregar un parámetro único a la URL
  var timestamp = new Date().getTime();
  if (xmlHttp) xmlHttp.timestamp = timestamp;

  return xmlHttp;
}
