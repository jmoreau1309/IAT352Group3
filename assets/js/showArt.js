var dataResult;
window.onload = function(){
  filterGenres($('#select_genre').val());

  // filter on select change
  $('#select_genre').on("change", function(){
    filterGenres($(this).val());
  });

  //update on pagination change
  $('#select-page').on("change", function(){
    updatePagination(dataResult);
  });

  $('#first-page-btn').on("click", function(){
    document.getElementById('select-page').selectedIndex = 0;
    updatePagination(dataResult);
    console.log(document.getElementById('select-page').selectedIndex);
  });

  $('#prev-page-btn').on("click", function(){
    if(document.getElementById('select-page').selectedIndex > 0) document.getElementById('select-page').selectedIndex--;
    updatePagination(dataResult);
    console.log(document.getElementById('select-page').selectedIndex);
  });

  $('#next-page-btn').on("click", function(){
    if(document.getElementById('select-page').selectedIndex < (dataResult.length/10)-1 && dataResult.length/10 > 0)
      document.getElementById('select-page').selectedIndex++;
    updatePagination(dataResult);
    console.log(document.getElementById('select-page').selectedIndex);
  });

  $('#last-page-btn').on("click", function(){
    if(dataResult.length/10 > 0) document.getElementById('select-page').selectedIndex = dataResult.length/10;
    updatePagination(dataResult);
    console.log(document.getElementById('select-page').selectedIndex);
  });
};

function filterGenres(value){
  console.log(value);
  //send to server
  var request = $.ajax({
    url: './assets/artApi.php',
    type: 'POST',
    data: {filter_genre: value},
  });

  request.done(function(data){
      //console.log(data);
      var result = JSON.parse(data);

      $(".art-list").empty(); //remove all current elements
      $("#select-page").empty();

      for(let i = 0; i < result.length/10; i++){ //populate pagination dropdown
        $("#select-page").append(`
          <option>`+(i+1)+`</option>
        `);
      }
      updatePagination(result);
      dataResult = result;
  });
}

function updatePagination(result){
  $(".art-list").empty(); //remove all current elements
  var pageLimitValue = ($('#select-page').val()-1)*10;
  for(let i = pageLimitValue; i < pageLimitValue+10; i++){ //populate list
    if(!(result[i] === undefined)){
      $(".art-list").append(`
        <li>
            <a href=\"artdetails.php?artID=${result[i].art_id}\">${result[i].title}</a>
        </li>
      `);
    }
  }
  dataResult = result;
}
