# Queue

By Weng Fei Fung. This is a todo list that lets you check off tasks that you will be repeating. After the todo list is checked off, you can clear the list and check them off again. For example, you can use this todo list for eating different food groups; After checking off the food groups, you can clear the checklist and check them off again on another day. This tool can memorize the order you check off items so that next time you can follow in roughly the same order of tasks. In the case of food groups, this prevents missing out on a food group for too long.

## Live Demo

[See PHP Page](https://wengindustry.com/tools/queue).

## Configuring the todo list

Edit dataset/default.json. Note an array of text entries. Those are the tasks or items.

You can have other todo lists in dataset/. Add the filename to the end of the URL to load it. For example, ?dataset=anotherTaskList.json

## Prerequisites

jQuery, Bootstrap, Handlebar JS, PHP. Let me know if you want a vanilla javascript version.

## Deployment

Deploy on a PHP server. Load index.php.