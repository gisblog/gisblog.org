### Mapping Visible Human (2015) ###

See http://gisblog.org/.

* app:		visible human
* version:	dev
* runtime:	js
* path:		/services/map/visible_human/
* uri:		/services/map/visible_human/

embed.html contains a Seadragon embed that uses Silverlight if the user has it installed, otherwise falls back to JavaScript. Supported in all browsers.

library.html contains a Seadragon viewer that uses the Seadragon Ajax library. This viewer is scriptable and has a JavaScript API. Supported in all browsers.

In general, if you want to only show the image, stick with the embed. If you want to take this image and develop a full web app around it, use the library. For more info, visit http://seadragon.com/developer/.

Seadragon Ajax container: This page uses the Seadragon Ajax library to show your composition. You can modify the source of this page to customize and extend the experience. To learn more, visit http://seadragon.com/ajax/.
