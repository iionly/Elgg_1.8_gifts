Elgg Gifts Plugin
Latest Version: 1.8.3
Released: 2014-09-28
Contact: iionly@gmx.de
License: GNU General Public License version 2
Copyright: (c) iionly, Galdrapiu, Christian Heckelmann



Installation:

(0. If you have a previous version of the gifts plugin installed, please disable it and then remove the gifts plugin folder completely before installing the new version. You must only backup or keep the images subfolder with its content to keep your gift images.)

1. Copy the gifts plugin folder into you mod folder,
2. !!!! Set the folder permissions of gifts/images to be writeable by the webserver (chmod 777) !!!!
3. Enable the gifts plugin in the admin section of your site (Configure - Plugins)
5. Configure your Gifts in the admin section of your site (Administer - Utilities - Gifts)


Important!
If you are using a version below 0.1.0 and uploaded pictures to the images folder,
you have to upload the pictures again within the Gifts admin menu


In case uploading gift images for example above slot 20 or 25 fails this can be due to file upload restrictions in php.ini and/or in suhosin.ini (if suhosin modul is used). The default setting of max_file_uploads in php.ini is 20.
The default setting of suhosin.upload.max_uploads in suhosin.ini is 25. These parameters must be set to larger values than the number of gifts. If you can't increase these parameters, you can upload a gift image to a lower slot number to get the resized versions of the image and then rename the files according to the slot number you want the image to take.



Changelog:

v1.8.3 2014-09-28 (by iionly)
    + Layout rework of gift pages (especially adding of breadcrumps and changing title section) to better blend in with the other Elgg pages,
    + "No gifts found." text output if no gifts were found in the context of the pages / widgets,
    + Fix of deprecation issues and replacement of private Elgg API functions if possible,
    + Some general code cleanup.


v1.8.2 2014-01-19 (by iionly)
    + catch the situation when gift entries sent or received by deleted users are to be displayed on the gift plugin's pages, the activity page or within gift widgets.


v1.8.1 2013-06-02 (by iionly)
    + General code cleanup / restructuring and many little improvements,
    + Fixed sending a gift via user avatar hover link / profile page link,
    + Alphabetic sorting of friends in dropdown friends selection on "Send a gift" page,
    + Allow gift sender and receiver to delete gifts,
    + Index page gifts widget (only available if the Widget Manager plugin is installed and "Show all gifts" is enabled),
    + "Private" access level of gifts - now called "Only for me and receiver" access level - means these gifts are visible to the sender and to the receiver (as opposed to only to the sender as with the previous version),
    + For the receiver "Private" gifts are included on the "My gifts" page and in the profile page widget (sorry, including them also on the "All gifts" page or the index page widget would have complicated the implementation quite considerably),
    + River entries for new gifts will only be created if "Show all gifts" is enabled and never for private gifts,
    + German language file added.


v1.8.0beta1 2012-01-05 (by iionly)
    + Compatibility with Elgg 1.8+


v0.2.0 2010-06-30 (by iionly)
    + Compatibility with Elgg 1.7+


v0.1.2 2009-09-18 (by Galdrapiu)
    + Accessright


v0.1.1 2009-09-07 (by Christian Heckelmann)
    + Fix: IE8 Send Button not working


v0.1.0 2009-09-07 (by Christian Heckelmann)
    + Add: River icon
    + Add: New administration area
    + Add: Write a message to your gift
    + Add: "Sent gifts"-page
    + Add: Upload pictures for gifts
    + Add: Gifts Widget for profile
    + Fix: My Gifts Page not showing all my gifts
    + Fix: Gift URL was wrong on river
    + Add: Gift preview
    + Add: You can configure if the "All Gifts"-page is shown
        + Add: Userpoint API Support


v0.0.2 2009-09-02 (by Christian Heckelmann)
    + Better River Support (thanks to DDFUSION)
    + Add: Mail Notification for new gifts
    + Add: User Profile Menu Item "Send gift"
    + Removed noimage notification for gifts with no imagefile


v0.0.1 2009-09-01 (by Christian Heckelmann)
    + Initial Release
