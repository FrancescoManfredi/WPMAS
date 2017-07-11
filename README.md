# WP-MAS
## WordPress Multi Agent System communication plugin

This is a project for my Autonomous Intelligent Agents class @UNIVAQ

### What does it do
You can install this plugin in a WordPress website to send messages to a
multiagent system about events such as new content published, new comments,
new users or new websites views.

Messages are sent via sockets.

Take a look at [basicJadeMAS](https://github.com/FrancescoManfredi/basicJadeMAS)
for an example of how to receive messages on the MAS end.

### How to install
These php files should go inside a folder named wp-multiagentsystem inside the
/wp-content/plugins directory of your wordpress installation.  
After that you will be able to activate it in the plugin section of the administration area.

### How to extend
You can add tracking functionalities for other events very easily. In order to do that
you'll need to:  
- Find what WordPress [action](https://codex.wordpress.org/Plugin_API/Action_Reference)
or [filter](https://codex.wordpress.org/Plugin_API/Filter_Reference) hook better
represents the event you want to track;
- Edit the plugin ui (wpmas-ui.php) to show the needed input fields and to update
the right options in the database (the source code in that file is quite self-explainatory);
- Add a callback function named wpmas_(hook-name)_callback() in the wpmas-callbacks.php
file to create the message you want to send (you can look at the other callbacks to
understand how to do that. It's really simple).

### Security Warning
This plug-in is just an experiment. The communication between WordPress and the
JADE MAS is based on sockets and bypasses the standard communication protocol
used by JADE.
If you inted to use this in production you'll need to pay due attention to any
security issues this may cause.

### Having agents interact with WordPress
The management of the WordPress website by the agents is not included in this
experiments. Ideally an agent could perform any kind of action in response to
a message. WordPress websites have a convenient [REST API](https://developer.wordpress.org/rest-api/) to manage the website
remotely.