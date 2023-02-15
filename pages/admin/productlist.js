// for Product Viewing
const parent_dev = document.getElementById("modal_view_parent");
const child_dev = document.getElementById("modal_view_outer");
function openmodal() {
    parent_dev.style.display = "block";
    parent_dev.classList.add("open_modal");
    parent_dev.classList.remove("close_modal");
}
window.onclick = function(event){
    if(event.target == parent_dev){
        parent_dev.classList.remove("open_modal");
        parent_dev.classList.add("close_modal");
        parent_dev.style.display = "none";   
    }
}
function close_view_modal(){
    parent_dev.classList.remove("open_modal");
    parent_dev.classList.add("close_modal");
    parent_dev.style.display = "none";
}


// Delete Product Button Click
const parent_conf_div = document.getElementById("parent_confirm_delete");
const child_conf_div = document.getElementById("child_confirm_delete");
parent_conf_div.style.display = "none";
child_conf_div.style.display = "none";

function confirmdelete() {
    parent_conf_div.style.display = "block";
    child_conf_div.style.display = "block";
    child_conf_div.classList.add("open_confirm_modal");
}

function close_confirm_delete(){
    parent_conf_div.style.display = "none";
    child_conf_div.style.display = "none";
    child_conf_div.classList.add("open_confirm_modal");
}

function delte_confirm_direct(){
    parent_conf_div.setAttribute("style", "display:block; position:absolute; width:100%; height:100%");
    child_conf_div.style.display = "block";
    child_conf_div.classList.add("open_confirm_modal");
}


// for Chosing Color of Product Start
var input_color = document.getElementById("color_select_input");
const inp_dev = document.getElementById("color_input_div");
function addcolor(){
    // To Create Color Span
    created_span = document.createElement("span");
    var input_color_value = input_color.value;
    created_span.classList.add("input_span_color");
    created_span.setAttribute('onclick' , 'getId(this)')
    created_span.style.backgroundColor = input_color_value;
    var childs_spans = inp_dev.getElementsByTagName("span").length;
    let x = childs_spans + 1;
    created_span.id = "created_input_Span_" + x;  
    inp_dev.appendChild(created_span);
}


    // To remove Color Span

    function getId(span){
        var deleted_span_id = span.id;
        var deleted_span = document.getElementById(deleted_span_id);
        deleted_span.remove();
    }

// for Chosing Color of Product Ends

// for Chosing Size of Product Start
const input_dev_size = document.getElementById("size_input_storage");
function add_number(){
    // getting Input Size
    var input_size = document.getElementById('number_select').value;
    // To Create Size Span
    create_size_span = document.createElement("span"); 
    create_size_span.innerHTML = input_size;
    create_size_span.classList.add("input_span_size");
    create_size_span.setAttribute('onclick' , 'getIdsize(this)')
    var childs_spans = input_dev_size.getElementsByTagName("span").length;
    let x = childs_spans + 1;
    create_size_span.id = "create_input_size_Span_" + x;  
    input_dev_size.appendChild(create_size_span);
}
// delete Size 
    function getIdsize(span){
    var get_size_id = span.id;
    var deleted_size_span = document.getElementById(get_size_id);
    deleted_size_span.remove();
}