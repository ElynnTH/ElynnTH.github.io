import './bootstrap';
function changeColor(selectObj) { 
    var idx = selectObj.selectedIndex; 
    var which = selectObj.options[idx].className;
    selectObj.className = which;
}
