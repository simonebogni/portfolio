$( document ).ready(function() {
  //check wheter verbosity is on
  if(localStorage.getItem('verbosity') == "true"){
      //set attribute verbosity = on
      //set verbosity button as selected
  } else {
      //set attribute verbosity = off
      //set verbosity button as not selected
  }

  //verbosity button click listener

  //category button click listener
  function setCategoryButtonEventListener($categoryId){
      $("#skill-category-button-"+$categoryId).click(function(){
          let activeStatus = $("#skill-category-button-"+$categoryId).hasClass("open");
          if(activeStatus){
              $("#skill-category-button-"+$categoryId).removeClass("open");
              $("#skill-category-button-container-"+$categoryId).removeClass("open");
              $("#skill-category-content-"+$categoryId).attr("visibility", "false");
          } else {
              $("#skill-category-button-"+$categoryId).addClass("open");
              $("#skill-category-button-container-"+$categoryId).addClass("open");
              $("#skill-category-content-"+$categoryId).attr("visibility", "true");
          }
      });
  }

  $(".skill-category-button").each(function(){
      console.log("executing: setCategoryButtonEventListener("+$(this).attr("categoryId")+")");
      setCategoryButtonEventListener($(this).attr("categoryId"));
  });
});