function getResponse(){

    $.ajax({
    url:"http://localhost/Constant/api/product/read.php",
    type:"GET",
    //data:{windowName:windowId},
    success: function(resp){
      console.log(resp);
      var listElement = document.getElementById("responseBlockUl");
      getInsideElement(resp,listElement,0);
    }
  });
}
function getInsideElement(insideElement,listElement,priority){
  var resp = insideElement;
  for(let i = 0 ; i <insideElement.length; i++){

        if(insideElement[i]['cat_child']['message']!='No products found'){
          listElement.innerHTML += "<div style='margin-left:20px;' class='not-empty' id='id"+insideElement[i]['category_id']+"'>"+insideElement[i]['category_name']+"</div>";
        }
        else{
          listElement.innerHTML += "<div style='margin-left:20px;' id='id"+insideElement[i]['category_id']+"'>"+insideElement[i]['category_name']+"</div>";
        }
        var childEl = document.getElementById('id'+insideElement[i]['category_id']);
        getInsideElement(insideElement[i]['cat_child'],childEl,1)
  }
}
