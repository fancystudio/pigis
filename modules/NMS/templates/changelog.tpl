<ul>
<li>Todo:
<ul>
<li>Lists Tab - show disabled vs active lists</li>
<li>Lists - ability to Mark a list as inactive</li>
<li>Users - Ability to filter on confirmed or unconfirmed
<p>Admin should be able to check all unconfirmed users and either confirm them all, or send them another confirmation email message</p>
<li>Users - Ability to prefer text or html mail (much later)</li>
<li>Something to allow a user to re-get the confirmation email</li>
<li>Docs, docs, and more docs</li>
<li><b>The frontend</b></li>
<ul>
  <li>complete the two stage unsubscribe process</li>
  <li>complete the two stage change preferences process</li>
  <li>Add a preference as to wether or not users should get a confirmation email after subscribing and unsubscribing</p>
</ul>
<li>Styling the progress page</li>
</ul>
</li>
<li>Version 2.3.8 - Dec, 2011
  <ul>
    <li>Many minor fixes.</li>
  </ul>
</li>
<li>Version 2.3.5 - Nov, 2011
   <ul>
     <li>More Fixes for CMSMS 1.10.x</li>
   </ul>
</li>
<li>Version 2.3.2 - May, 2010
   <ul>
     <li>Minor fix to admin pagination.</li>
   </ul>
</li>
<li>Version 2.3.1 - April, 2010
   <ul>
     <li>Now requires CGExtensions 1.18.3</li>
   </ul>
</li>
<li>Version 2.3 - March, 2010
   <ul>
     <li>Adds the ability to absolutely delete a user when they unsubscribe from all lists.</li>
     <li>Adds a few bulk actions to the users tab. (delete,confirm,unconfirm)</li>
     <li>Adds the ability to confirm users automatically (assume the email address is valid).</li>
     <li>Minor API changes.</li>
   </ul>
</li>
<li>Version 2.2.5 - October, 2009
    <p>Add NoRedirect options to some actions.</p>
</li>
<li>Version 2.2.4 - October, 2009
    <p>Remove debug statements.</p>
</li>
<li>Version 2.2.3 - September, 2009
    <p>Remembers name/disabled when entering new user manually and giving invalid email-adress. (Sil)</p>
    <p>Implemented filtering on username on admin users tab (Sil)</p>
</li>
<li>Version 2.2.2 - March, 2009
    <p>Fix minor typo in feu import.</p>
</li>
<li>Version 2.2.1 - March, 2009
    <p>Numerous bug fixes.</p>
    <p>Now Require CMS 1.5.2</p>
    <p>Now Require FEU 1.6</p>
    <p>Now Require CGExtensions 1.15</p>
</li>
<li>Version 2.2 - June, 2008
    <p>Now require CMS 1.3.1</p>
    <p>Fix the user settings functionality.</p>
    <p>Fix the CSV Import stuff to be more useable</p>
    <p>Adds the ability to mark a message for display in the archive list.  This solves the problem where some messages were showing up in the archive list even if they were just sent to a private list.  This is because messages in NMS are re-useable and you may send the same message to multiple lists at the same time.</p>
    <p>Fixes problems with the archive message display</p>
    <p>Adds the ability to mark a message as text only</p>
</li>
<li>Version 2.1.1 - March, 2008 (just after 2.1)
    <p>Adds two missing lines that resulted in the confirmation not working when subscribing</p>
</li>
<li>Version 2.1 - March, 2008
    <p>Adds the ability for other modules to interact with NMS</p>
</li>
<li>Version 2.0.1 - February, 2008
    <p>Bump dependencies,</p>
</li>
<li>Version 2.0 - December, 2007
    <p><strong>Note:</strong> This is a Significant set of enhancements to NMS that required breaking backwards compatibility, this version will NOT upgrade from previous versions of NMS.  You should export all data, save it to text files, etc.... and re-import the data later.</p>
    <ul>
      <li>Complete templating support</li>
      <li>Complete support for multipart messages (text and html)</li>
      <li>Complete support for embedded images and attachments</li>
      <li>Bounce Processing via pop3</li>
      <li>Significant rewrite of the frontend (archive and showtemplate actions)</li>
    </ul>
    <p>Thanks to _SjG_ for finding the simple templating issue that caused problems with empty email content on php4 hosts.</p>
</li>
<li>Version 1.0.2 - August, 2007</li>
<p>Allow importing users from FEU <em>(originally done by skypanther, re-implemented by calguy100).</em></p>
<p>Numerous bug fixes</p>
<li>Version 1.0.1 - December, 2006</li>
<p>Fixes to import users, and to a ternery expression when creating a message. I also fixed some stupid problems with process_queue resulting from me doing this too quickly.</p>
<li>Version 1.0 - December, 2006</li>
<p>This <b>is</b> essentially a complete rewrite of the old NMS module.  Everything has been cleaned up and attemtpts have been made to bring it up to proper standards, and lots of new features added. here is a list of the major improvements:</p>
<ul>
<li>Cleanup of the lang strings, etc.</li>
<li>Param-ize the queries for security</li>
<li>Added the concept of Jobs, so that messages can be re-used</li>
<li>Added the concept of username (optional)</li>
<li>Added smarty processing on templates</li>
<li>Added bulk import</li>
<li>Added the concept of a \'private list\'</p>
<li>Devided the admin panel into tabs</li>
<li>Show progress nicely when processing large jobs</li>
<li>Uses CMSMailer module</li>
<li>Events that can be trapped to add additional behaviour</li>
</ul>
<p><strong>Note</strong>, upgrade from the previous version <em>(Including previous betas)</em>is not possible.  A complete uninstall of the old version is required before installing this version of NMS.</p>
</li>
<li>Version .74 27 November 2005. Alpha 3 Release. Fixed bug with confirmation message returnid, image urls, windows php, and a few other small issues.</li>
<li>Version .73 23 November 2005. Alpha 2 Release. Fixed bug with adding messages.</li>
<li>Version .71 22 November 2005. Alpha 1 Release.</li>
<li>Version .5. 17 September 2005. Internal Release.</li>
</ul>
