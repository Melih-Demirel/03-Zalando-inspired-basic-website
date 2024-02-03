const saveButton = document.getElementById('saveButton');


// Source: https://stackoverflow.com/a/9733420/3695983
function hexToRgb(hex) {
    var shorthandRegex = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
    hex = hex.replace(shorthandRegex, function(m, r, g, b) {
      return r + r + g + g + b + b;
    });
  
    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
    return result ? {
      r: parseInt(result[1], 16),
      g: parseInt(result[2], 16),
      b: parseInt(result[3], 16)
    } : null;
}

function luminance(r, g, b) {
    var a = [r, g, b].map(function (v) {
      v /= 255;
      return v <= 0.03928
        ? v / 12.92
      : Math.pow( (v + 0.055) / 1.055, 2.4 );
    });
    return a[0] * 0.2126 + a[1] * 0.7152 + a[2] * 0.0722;
  }
  
function calculateRatio() {
  
    const color1 = document.getElementById('bg_color1').value;
    const color2 = document.getElementById('text_color1').value;

    const color1rgb = hexToRgb(color1);
    const color2rgb = hexToRgb(color2);

    const color1luminance = luminance(color1rgb.r, color1rgb.g, color1rgb.b);
    const color2luminance = luminance(color2rgb.r, color2rgb.g, color2rgb.b);
  
    const ratio = color1luminance > color2luminance 
    ? ((color2luminance + 0.05) / (color1luminance + 0.05))
    : ((color1luminance + 0.05) / (color2luminance + 0.05));
  
    return ratio;
}
  

function checkContrast(){
    const ratio = calculateRatio();
    let countPasses = 0;
    if(ratio < 1/3)
    countPasses++;
    if(ratio < 1/4.5)
    countPasses++;
    if(ratio < 1/7)
    countPasses++;
    if(countPasses  >= 2){
        saveButton.disabled = false;
        saveButton.innerHTML = "Save";
        saveButton.classList = "customButton py-2 btn btn-outline-success border-success";
    }
    else{
        saveButton.disabled = true;
        saveButton.innerHTML = "Try different colors!";
        saveButton.classList = "customButton py-2 btn btn-outline-danger border-danger";
    }
    document.getElementById("bg_color").value = document.getElementById('bg_color1').value;
    document.getElementById("text_color").value = document.getElementById('text_color1').value;
}