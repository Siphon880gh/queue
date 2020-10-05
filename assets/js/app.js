window.checkmarks = [];

async function loadList() {
  const list = await $.getJSON("list.json", (list)=>{
    var raw = $("#template-list-item").html();
    var template = Handlebars.compile(raw);
    var html = template({array:list});
    console.log("Test handlebar: ", html);
    console.log("Test handlebar: Should be HTML of list items.");
    $(".list ul").html(html);
  });
  return list;
}

async function loadCheckmarks() {
  $.get("logic/read-order.php").done(checkmarksJson=>{ 
    checkmarksJson = checkmarksJson.replace("\"", "").replace("\"", "");
    window.checkmarks = JSON.parse(checkmarksJson);
    renderOrderedNums();
  });
} // loadCheckmarks

function saveCheckmark(event) {
  // Remove checkmark position in ordered checkmarks array
  var checkmarkPos = parseInt($(event.target).val());
  var foundPos = window.checkmarks.indexOf(checkmarkPos);
  if(foundPos!==-1) {
    window.checkmarks.splice(foundPos, 1);
  }

  // Add to end of ordered checkmarks
  var becameChecked = $(event.target).prop("checked");
  if(becameChecked) {
    window.checkmarks.push(checkmarkPos);
  }

  renderOrderedNums();
  saveCheckmarks();
} // saveCheckmark

function saveCheckmarks() {
  checkmarksStr = JSON.stringify(window.checkmarks);
  $.post("logic/write-order.php", {checkmarks:checkmarksStr}).done((res)=>{
    console.log(res);
  });
}

function renderOrderedNums() {
  $("li .indicator").text("");
  window.checkmarks.forEach((checkmark, pos)=> { 
    // debugger;
    var $checkmark = $("input[type='checkbox']").eq(checkmark);
    $checkmark.prop("checked", true); // checkmark
    $checkmark.closest("li").find(".indicator").text(pos+1); // checkmark
  });
}

async function loadReference(callback) {
    $.get("logic/read-reference.php", (html)=> { 
      console.log("Test loadReference: html", html); 
      console.log("Test loadReference: Should be html of strikethrough texts of the order of items checked off."); 
      $(".reference-order").html(html); 
      callback();
    }); // get
} // loadReference

function saveReference() {
  var html = $(".reference-order").html();
  $.post("logic/write-reference.php", {reference: html}, (debug)=>{
    console.log(debug);
  });
}

function renderReference() {
  var html = "";
  window.checkmarks.forEach((i)=>{ 
    var orderDone = $(".queue-item-name").eq(i).closest("li").find(".indicator").text();
    var queueDone = $(".queue-item-name").eq(i).text();
    html += `<div class="reference-queue-item"><span class="order">${orderDone}. </span><span class="queue">${queueDone}</span></div>`; 
  });
  $(".reference-order").html(html);
  saveReference();
} // renderReference

async function loadNotes() {
    $.get("logic/read-notes.php", (text)=> { 
      console.log("Test notes typed: ", text); 
      console.log("Test notes typed: Should be the text in the notes textarea."); 
      $(".notes-textarea").val(text); 
    }); // get
} // loadReference

function saveNotes() {
  var text = $(".notes-textarea").val();
  $.post("logic/write-notes.php", {notes: text}, (debug)=>{
    console.log(debug);
  });
}

function updateLinethroughs() {
  $(".reference-queue-item .queue.found").removeClass("found");
  $(".indicator").each((a,indicator)=> {
    var $indicator = $(indicator);
    if($indicator.text().length) {
      var queueName = $indicator.prev().text();
      $(`.reference-queue-item .queue:contains("${queueName}")`).addClass("found")
     }
    });
} // updateLinethroughs

$(()=> {
  $(".btn-erase").on("click", event => {
    if(confirm("Clear all checkmarks?"))
      $(".queue-item").prop("checked", false);
    
      window.checkmarks = []; 
      renderOrderedNums(); 
      saveCheckmarks(); 
      updateLinethroughs();

      event.preventDefault();
      event.stopPropagation();
  });

  $(".btn-save-order").on("click", event => {
    renderReference();
    alert('Done: Saved order of items checked off.');
    updateLinethroughs();
  });

  (async function chainCallbacks() {

    await loadList();
    await loadCheckmarks();
    await loadReference(updateLinethroughs);
    await loadNotes();
    await (function() {
      $(".queue-item").on("change", (event)=> { 
        saveCheckmark(event);
        updateLinethroughs();
      });
    })();

  })();

  // loadList();
  // setTimeout(updateLinethroughs, 1000);

  // $(".reference-order").on("change", saveReference); 


  $(".notes-textarea").on("change", ()=> {
    saveNotes();
  });
});