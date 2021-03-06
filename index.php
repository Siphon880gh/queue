<!DOCTYPE html>
<html lang="en">
  <head>
   <title>Queue</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

    <!-- jQuery, Bootstrap, Handlebar JS  -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.6/handlebars.min.js"></script>

    <!-- Assets -->
    <link rel="stylesheet" href="assets/css/style.css" />
    <script src="assets/js/app.js"></script>

    <?php
      if(isset($_GET["dataset"]) && strpos($_GET["dataset"], ".json")>0) {
        $dataset = sprintf("dataset/%s", $_GET["dataset"]);
      } else {
        $dataset = sprintf("dataset/%s", "default.json");
      }
    ?>
    <script>
      try {
        window.dataset = "<?php echo $dataset; ?>";
      } catch(err) {
        alert(err);
      }

    </script>

  </head>
    <body>
      <div class="container">
        <header>
          <h1>
            <span>Queue</span>
            <a class="fab fa-github clickable" href="https://github.com/siphon880gh/queue" target="_blank"></a>
          </h1>
          <p class="desc">This is a todo list that lets you check off tasks that you will be repeating. After the todo list is checked off, you can clear the list and check them off again. For example, you can use this todo list for eating different food groups; After checking off the food groups, you can clear the checklist and check them off again on another day. This tool can memorize the order you check off items so that next time you can follow in roughly the same order of tasks. In the case of food groups, this prevents missing out on a food group for too long.</p>
        </header>

        <section class="list jumbotron">
          <h2>
            <span>List</span>
            <a class="btn-erase fa fa-eraser clickable" href="javascript:void(0);"></a>
          </h2>
        
          <ul>
          </ul>
        </section>

        <template id="template-list-item">
          {{#each array}}
          <li>
            <input class="queue-item" value="{{@key}}" type="checkbox"/>
            <span class="queue-item-name">{{this}}</span>
            <span class="indicator"></span>
          </li>
          {{/each}}
        </template>

        <section class="save-order panel panel-primary">
          <h2 class="panel-heading">Save Order of Checking Off</h2>
          <div class="panel-body">
            <p class="desc">You can save the order of the items done here so the next time you can check off the items in roughly the same order.</p>
            <button class="btn-save-order btn btn-default">Save order of items you've checked off:</button>
            <div class="reference-order" class="bg-info text-info"></div>
          </div>
        </section>

        <section class="notes panel panel-default">
          <h2 class="panel-heading">Notes</h2>
          <div class="panel-body">
            <textarea class="notes-textarea" placeholder="Type any notes here. E.g. Owe a check off item for next time."></textarea>
          </div>
        </section>

      </div>
    </body>
</html>