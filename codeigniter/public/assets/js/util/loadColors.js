document.body.style.backgroundColor = document.getElementById("bg_color").value;
if(document.getElementsByClassName('prefBg')[0]){
    let elements = document.getElementsByClassName('prefBg');
    for(i = 0; i < elements.length; i++) {
        elements[i].style.backgroundColor = document.getElementById("bg_color").value;
    }
}
if(document.getElementsByClassName('prefColor')[0]){
    let elements = document.getElementsByClassName('prefColor');
    for(i = 0; i < elements.length; i++) {
        elements[i].style.color = document.getElementById("text_color").value;
    }
}
if(document.getElementsByClassName('prefButton')[0]){
    let elements = document.getElementsByClassName('prefButton');
    for(i = 0; i < elements.length; i++) {
        elements[i].style.backgroundColor = document.getElementById("bg_color").value;
        elements[i].style.color = document.getElementById("text_color").value;
        elements[i].style.borderColor = document.getElementById("text_color").value;
    }
}
if(document.getElementsByClassName('prefBorder')[0]){
    let elements = document.getElementsByClassName('prefBorder');
    for(i = 0; i < elements.length; i++) {
        elements[i].style.borderColor = document.getElementById("text_color").value;
    }
}