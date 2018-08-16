# Kaltura Applications Framework: Amplify your video workflows with just a few lines of code #

The Kaltura Applications Framework, or KAF as we call it around here, is a configurable set of iFrane views that streamlines the integration of common media capabilites and workflows that are part of the Kaltura platform. Contained are a set of embeddable media tools that developers can embed in their applications with minimal code, accelelerating the time to market for media-centric application workflows. 
KAF also supports the [LTI standard](https://en.wikipedia.org/wiki/Learning_Tools_Interoperability) that simplifies integration into learning management systems. 

We've created a [sample application](link) that will help showcase the various functionalities of KAF. 

### Things you'll need in order to run the sample code: ###

- First and foremost your `Kaltura Instance URL`, which you'll receive with your KAF account. Send us an email at vpaas@kaltura.com to sign up for an account. 
- Your `Kaltura Partner ID` and `Admin Secret`, which can be found under Integration Settings in the Kaltura Management Console. 
- The `UI Conf ID` (or player ID) that will be used for embedding the video player in the webpage. The ID for each player can be found under Studio in the KMC. 

Be sure to set these variables in the kaltura_config file of the sample code. Other things you'll find in the config: 
- The `Domain` where the sample code is being hosted - change this accordingly.
- The `Kaltura Service URL` - which should stay as is unless you've been informed otherwise. 
- The `generateSession` function which creates a Kaltura Session without using an instance of the Kaltura Client Library. This KS will be included in calls made to the KAF endpoint, in order to authenticate and determine privileges. 

A word about privileges: every action done in KAF requires a KS (Kaltura Session). Each KS is created with a `privileges` stringa and a user ID, which in most cases is an email address but can technically be any string, and essentially represents the unique user who is currently logged in to your application. The privilege string represents the user's role, what he/she will have access to, as well as other [security options](https://knowledge.kaltura.com/kaltura-mediaspacekaltura-application-framework-kaf-roles-and-permissions). We will cover the KAF specific privileges below in the context of each KAF view.

Now let's discuss the various iFrames and parts of the [sample code](link). 

### My Media ###

This is like a personalized media locker for end users where they can upload assets and manage videos and other media files. 
Behind the scenes, the code  generates a kaltura session using the userid and given prileges for the user and loads their relevant media in a responsive iFrame. That iFrame is responsive and fairly similar to what you may have seen in mediaspace. 

### Collection ###

Simply put, a collection is a category of content, that contains entries in your account. A category has options for metadata, as well as the option to set entitelments and give specific restrictions to the collaborating users on the category - such as public or private view access, and who can publish content into this category (including moderation). In our sample application, the collection name can be modified via the url, as well as the user id and roles. this makes it easy to see what will be displayed in the case of varying users with varying content and varying permissions. 

### Media Pickers ###

The Browse, Search and Embed iFrame (BSE), is a key component of KAF, is used for the sole purpose of selecting content from the user's own "my media" library or any shared repositories the user has access to. The BSE view may be used for a variety of apllicative use cases. Our sample application shows a few such applicative scenarios; 

**The Video Landing Page**

This use case describes giving users a tool to choose a video for the placeholder in a landing page template. Upon selection of the entry, it is embedded as a kaltura player in the landing page, and the template need only remember the entry ID in order to load that same video when rendering the page. 

What's happening behind the scenes? When the entry is chosen, the Kaltura BSE url is called with a suitable Kaltura session. When that session was generated, the return url containing the handler for this specific landing page template (in this case 'handle_selected_media.php') was declared in the privilege string with which the KS was created. That handler in turn calls the script that embeds the kaltura widget with the selected entry ID, along with the partner ID and UI Conf ID that are set in the config. 

**Thumbnail Selection for Emails**

Here we show a scenario of providing users a tool to pick a frame from a video that will used as a thumbnail in an email. Generally, that email would link to the landing page we discussed above where the video actually lives. 
Similar to the video picker above, the BSE url is called with a kaltura session containing information about the return url. In this case however, it calls the Kaltura Thumbnail API with the entry ID and the moment in the video from which to grab the thumbnail. The image from the returned url is then placed in the email. 

**Grabbable Embed**

This functionality echoes the others we've mentioned above, with more of a DIY approach. It will allow users to grab the embed codes for specific media assets, in order to embed in their own pages. (TEST: does the code provide proper embed code for images vs. video vs. audio entries???)

**Product Image**

Similar to the grabbbable embed, but this time for a product image tag. In this case, however, the metedata of the selected entry is packaged as an object, which is easier to send around. The object, as can be seen in `handle_selected_product.php` is made up of embed data like the title, description, tags and duration of the entry. You can learn more the schema [here](https://developers.google.com/search/docs/data-types/video)


While you can get really creative with the Browse, Search and Embed functionality, these use cases should provide a pretty good picture of all that can be done with KAF. You can see from the few workflows just how easy and simple it is to power any application with media selection scenarios and implement a whole set of robust capabilities... with just a couple lines of code. 



