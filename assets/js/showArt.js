$(document).ready(function() {

  filterGenres($('#select_genre').val());

  // filter on select change
  $('#select_genre').on("change", function(){
    filterGenres($(this).val());
  });
});

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

      $(".art-list").empty() //remove all current elements

      result.forEach(element => {
          $(".art-list").append(`
          <li>
              <a href=\"artdetails.php?artID=${element.art_id}\">${element.title}</a>
          </li>
          `);
      });
  });
}
