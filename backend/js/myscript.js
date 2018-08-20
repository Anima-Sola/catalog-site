function getAjaxData(data) { 
    
    var result = $.ajax({
                    type: 'POST',
                    url: 'backend/',
                    data: data,
                    dataType: 'json',
                    async: false,
                    success: function(msg){}, 
                    error: function(){
                        alert('Не удалось связаться с cервером');
                    }        
                });
    return result.responseJSON;
    
}

function generateForm(categories, goodId) {
    
    var form = "<div class='box-modal_close arcticmodal-close'>X</div>";
    
    form += "<div class='categories-modal'>";
        form += "<p>Распределение товара по категориям</p><br>";
        form += "<form method='post' action='" + window.location.href + "'>";
            form += "<input type='hidden' name='edit_catalog' value='" + goodId + "'>";
                form += "<table><tbody>";

                    for(let i = 0; i < categories.length; i++) {
                        if((i % 3) == 0) form += "<tr>";
                        checked = (categories[i]['checked']) ? 'checked' : '';
                        form += "<td style='width: 33%;height:25px;'><input type='checkbox' name='category_id=" + categories[i]['category_id'] + 
                            "' value='cat_id=" + categories[i]['category_id'] + "'" + checked + ">" + categories[i]['category_name'] + "</td>";
                        if((i % 3) == 2) form += "</tr>";
                    }
    
                form += "</tbody></table>";
            form += "<input style='margin:auto; display:block; height: 30px; margin-top:10px;' type='submit' value='СОХРАНИТЬ ИЗМЕНЕНИЯ'>";
        form += "</form>";
    form += "</div>";

    return form;
    
}

function distributeGood(goodId) {
    var categories = getAjaxData('get_categories_by_good_id=' + goodId);
    var form = generateForm(categories, goodId);
    var modalWindow = document.getElementById('modalWindow');
    modalWindow.innerHTML = form;
    $('#modalWindow').arcticmodal({
        afterClose: function(data, el) {
            document.getElementById("good_name_id_" + goodId).focus();
        }
    });
    return false;
}

function showHideSubmit(id, oldClassName, newClassName){
    submit_btn = document.getElementById("submit_btn_" + id);
    edit_link = document.getElementById("edit_link_" + id);
    submit_btn.classList.remove(oldClassName);
    submit_btn.classList.add(newClassName);
    if(id != -1) {
        edit_link.classList.remove(oldClassName);
        edit_link.classList.add(newClassName);
    }
}

function showSubmit(id) {
    setTimeout("showHideSubmit(" + id + ", 'hidden-element', 'shown-element')", 100);
}

function hideSubmit(id) {
    setTimeout("showHideSubmit(" + id + ", 'shown-element', 'hidden-element')", 100);
}

function checkInputFields(self) {
    inputs = self.getElementsByTagName('input');
    if(!inputs.s_good_name.value && !inputs.s_good_description.value && !inputs.s_good_full_description.value && !inputs.s_good_quantity_instock_from.value &&
       !inputs.s_good_quantity_instock_to.value && inputs.s_good_activity.checked && inputs.s_good_is_available_for_order.checked) {
            alert('Не заданы условия поиска');
            return false;    
    }
}