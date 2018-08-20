# kaltura-application-framework-guide
An integration guide for developers implementing the Kaltura Applications Framework in their own applications. 

# To run the sample code you'll need: 
- A `Kaltura Instance URL`, which you'll receive with your KAF account. Send us an email at vpaas@kaltura.com to sign up for an account. 
- Your `Kaltura Partner ID` and `Admin Secret`, which can be found under Integration Settings in the Kaltura Management Console. 
- The `Kaltura PHP 5 Library` which can be found [here](https://github.com/kaltura/KalturaGeneratedAPIClientsPHP/releases)

These should all be set in the config, in addition to: 

- The `UI Conf ID` (or player ID) that will be used for embedding the video player in the webpage. The ID for each player can be found under Studio in the KMC. 
- The `Domain` where the sample code is being hosted - change this accordingly.
- The `Kaltura Service URL` - which should stay as is unless you've been informed otherwise. 

You'll also find the `generateSession` function which creates a Kaltura Session using the Kaltura PHP Client Library. This KS will be included in calls made to the KAF endpoint, in order to authenticate and determine privileges.

### Templates ###

Basic functionalities of KAF that every video application would contain: a media gallery and a way to see a smaller collection of content

**My Media**

This is like a personalized media locker for end users where they can upload assets and manage videos and other media files. A Kaltura Session with the userId of the user is created in order to display the relevant entries.  You can change the `userId` variable in `mymedia_template.php` to see how this affects the content. 

**Collection**

A collection is a category of content that contains entries from the application owner's account. The `Collection Name` is passed into the privileges string, and KAF maps it to the relevant category. The collection name can be modified via the url, along with the user ID and roles. This makes it easy to see what will be displayed in the case of varying users with varying content and permissions. The `userRole` is set to *viewer* but should be set to privateOnlyRole in order to allow publishing. A `contextualRole` determines what a user can do in the context of a collection, and we've set ours to 4 which is *none,* meaning the user can only access public collections. Other options are: 
- 0: `MANAGER`, manages all aspects of collection
- 1: `MODERATOR`, notified on new pending items, can access moderation queue for approval/rejection
- 2: `CONTRIBUTOR`, can add items to collection
- 3: `MEMBER`, can access collection (relevant if collection is restricted/private)
- 4: `NONE`, can access public collections 
Read more about roles and permissions [here](https://knowledge.kaltura.com/kaltura-mediaspacekaltura-application-framework-kaf-roles-and-permissions).

### Media Pickers ###

The Browse, Search and Embed iFrame (BSE), a key component of KAF, is used for the sole purpose of selecting content from the user's own "my media" library or shared repository that is enabled in the KAF instance that the user is given access to. 
You'll find similar workflows in each of the four use cases: 
**The Video Landing Page** allows users to choose a video for the placeholder in a landing page template. We've added a landing page and a file DB that will hold onto the entry after it was selected. 
**Thumbnail Selection for Emails** provides a tool for picking a frame (image) from a video that will be used as a thumbnail in an email. 

**Grabbable Embed** is a more customizable approach to the above scenarios. It allows users to generate embed codes for specific media assets in order to embed in their own pages 

**Product Image Selection** is like the grabbabale embed, but for a product image tag. 

*You'll find some similarities in the code for each of the pickers*

`BSE_RETURN_URL:` BSE stands for Browse Search and Embed. KAF will call this url once an asset is selected. It must reside on the same domain as the page hosting the BSE iFrame and the URL must be in safe-encoding. 

`userId:` This is dynamic. A user ID can be any string but will generally be the email address of the user accessing the application. 

`privileges:` The privileges string to be used when creating the Kaltura Session, in order to determine user's access to the content. The `actionslimit` prevents the generated token from being used for any other API calls. The `privateOnlyRole` is the minimum role allowed for access to My Media. Read more about roles and permissions [here](https://knowledge.kaltura.com/kaltura-mediaspacekaltura-application-framework-kaf-roles-and-permissions)

`bseURL:` The URL to KAF which contains the Kaltura Session which was generated using the userId and privileges

**Handlers:** Each of the media pickers has its own handler, a script which collects the post data, and sends it back as an object to the `handleSelected` function in each of the pickers.  


# How you can help (guidelines for contributors) 
Thank you for helping Kaltura grow! If you'd like to contribute please follow these steps:
* Use the repository issues tracker to report bugs or feature requests
* Read [Contributing Code to the Kaltura Platform](https://github.com/kaltura/platform-install-packages/blob/master/doc/Contributing-to-the-Kaltura-Platform.md)
* Sign the [Kaltura Contributor License Agreement](https://agentcontribs.kaltura.org/)

# Where to get help
* Join the [Kaltura Community Forums](https://forum.kaltura.org/) to ask questions or start discussions
* Read the [Code of conduct](https://forum.kaltura.org/faq) and be patient and respectful

# Get in touch
We'd love to hear from you!
You can learn more about Kaltura and start a free trial at: http://corp.kaltura.com    
Contact us via Twitter [@Kaltura](https://twitter.com/Kaltura) or email: community@kaltura.com  

# License and Copyright Information
All code in this project is released under the [AGPLv3 license](http://www.gnu.org/licenses/agpl-3.0.html) unless a different license for a particular library is specified in the applicable library path.   

Copyright © Kaltura Inc. All rights reserved.   
Authors and contributors: See [GitHub contributors list](https://github.com/kaltura/recruitment-application/graphs/contributors).  
