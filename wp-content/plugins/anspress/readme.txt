=== AnsPress - Question and answer plugin ===
Contributors: nerdaryan, peterolle, mertskaplan, chrintz
Donate link: https://www.paypal.com/cgi-bin/webscr?business=rah12@live.com&cmd=_xclick&item_name=Donation%20to%20AnsPress%20development
Tags: question, answer, q&a, forum, community, profile
Requires at least: 3.5.1
Tested up to: 4.0
Stable tag: 1.0 PR9
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

AnsPress - Most advance community question and answer plugin for WordPress.

== Description ==
Demo & support forum: http://open-wp.com/questions/

AnsPress is a most complete question and answer system for WordPress. AnsPress is made with developers in mind, highly customizable. AnsPress provide an easy to use override system for theme. List of features:

  * Sorting question and answer by many options.
  * Ajax based form submission
  * Theme system
  * Flag and moderate posts
  * Voting on question and answer
  * Question tags and categories
  * Question labels (i.e. Open, close, duplicate) new labels can be added easily.
  * Select best answer
  * Tags suggestions
  * Comment on question and answer
  * Private messaging system
  * Point based permission (under development)
  * reCaptcha
  * User level : Participant, Editor, Moderator (in future it can be customised and you can add your own levels)
  * Email notification
  * User can add questions to his favorite
  * User can edit profile
  * User can upload cover photo
  * Friends and followers system
  * User points system (reputation)
  * User ranking
  * User badge
  * User profile
  * Pages : Tags, categories, users etc.
  * SOCIAL LOGIN (see FAQ)
  * SYNTAX HIGHLIGHTER (see FAQ)

= Developers =

Project site: [Open-WP](http://open-wp.com)
GitHub repo: [Git AnsPress](https://github.com/open-wp/anspress/)
Twitter: [@openwp](http://twitter.com/openwp)
GooglePlus: [@openwp](https://plus.google.com/+rahularyannerdaryan?rel=author)

= Help & Support =
For fast help and support, please post on our forum http://open-wp.com/questions/

= Language =

 * Spanish - by Peter Olle
 * Turkish - by mertskaplan
 * Danish  - by chrintz


**Page Shortcodes**

Use this shortcode in base to AnsPress work properly
`[anspress]`


== Installation ==

Its very easy to install the plugin.

* Install plugin (WP -> Plugins -> Install new -> Anspress)
* Activate plugin (Plugins -> Installed Plugins -> Activate)
* Create an AnsPress page (mine had done it automatically, but incase it doesnt) Pages -> Add New -> Type [anspress] in the page and publish (the name can be changed to whatever you like, but there must be `[anspress]` shortcode in content.
* Add AnsPress links in your menu, Appearance -> Menus, and then drag AnsPress links in your menu, and save.
* Your page should have the Ask, Categories, Tags, Users etc wherever you placed your menu!


= Page Template =

As AnsPress output its content based on shortcode, so you must edit you page template to avoid double title. So create a page template without title and set it for AnsPress base page. or simply create a page template with this name `page-YOUR_BASE_PAGE_ID.php`. Change the YOUR_BASE_PAGE_ID to the id of the base page.

That's all. enjoy :)


== Frequently Asked Questions ==

**Page Shortcodes**

`[anspress]` add anspress shortcode to your base page for anspress to work properly

= Can I override theme ? =

Yes, you can override the theme file easily. Simply follow below steps:

1. Create a `anspress` dir inside your currently active wordpress theme directory.
	
2. Copy file which you want to override from AnsPress theme dir to currently created dir in your WordPress theme folder.

**Social login**

For activating social login install [WordPress Social Login](http://wordpress.org/plugins/wordpress-social-login/ "WordPress Social Login") and activate it. Then add API keys of providers.
And thats all, rest of things will be handled by AnsPress.

**Syntax highlighter**

For activating social login install [Crayon Syntax Highlighter](http://wordpress.org/plugins/crayon-syntax-highlighter/ "Crayon Syntax Highlighter") and activate it.


== Screenshots ==

1. List of question in home page, category, or tags page.

2. Single page layout with selected answer

3. User profile

4. User's messages and conversations

5. Users page

6. Tags suggestion in ask form

7. Categories page with sub categories

8. Tags page

9. AnsPress options page

10. AnsPress admin menu

11. AnsPress labels

12. AnsPress auto installation page

13. User pages


== Changelog ==

= 1.0 PR9 =

* Added social login
* improved login form
* improved signup form
* updated like_escape to esc_like
* Added Crayon Syntax Highlighter computability
* Added page title
* Fixed: language loading
* Improved comment form
* Added ap_ prefix in capability
* Style improvements
* Cannot make comment on posts outside Anspress #81
* Disabled tinymce in wp_editor
* Improved question page
* Fixed: favorite button count when not logged in
* Fixed when anspress is in child page
* Set default label for new questions #51
* Improved installation page
* Order of anspress rewrite rules
* Added rewrite rule checking and flushing
* Show last activity in question #47
* fixed: undefined obj 

= 1.0 PR7 =

* Default badges #87
* Added badges page for user #86
* Updated badges functions
* Added avatar upload
* #41 Related questions
* Added sorting in users
* Added questions widget widgets/questions.php #37
* Added categories widget #36
* Fixed ap_get_link_to
* Does not work with /%category%/%postname% slug #9 


= 1.0 PR =
* Added auto installation page
* Improved category page
* Improved tags page
* Fixed message button
* Improved users profile 
* Basic email notification system #4 
* #50 Addon control page 
* #48 and #49, followers and following page 
* Added moderate page in admin where all post waiting for moderation can be listed
* Added flagged page where all flagged question and answer can be seen.
* Added new post_status : moderate
* Hold question for moderation
* Hold question for moderation based on user points
* Added reCAPTCHA
* Fixed some undefined issue, and improved cover size
* Add user page #46
* Remove ask form if no question found and instead add a link to ask form
* User's favorites page #33
* Added user answers page #31
* Fixed email validation in APjs, and added user question page #30
* Added blank html and htaccess for preventing directory listing 
* Realtime loading
* Added messaging system
* Added messages table
* Added user profile edit
* Added cover upload 
* Added user profile edit
* Added points events
* Added delete action in points
* Added points editing
* Improved AnsPress option Added option to disable tags Added option to …
* Added tags suggestion and label options
* fixed followers query
* fixed view count system to use ap_meta table
* Updated participants to use ap_meta table
* Added delete option
* Fixed flag and flag meta box
* Added anspress meta and improved voting
* fix error on activation
* Added best answer and ajaxified comments
* Added ajax question submit and validation
* Added full ajax, validation and custom fields in answer form
* Adding Ajax for answer submission
* User template
* Added user ranks
* Improved question page layout
* added question sidebar
* Improved question sorting by question_label
* Added question label in template
* Added color field in question_label
* Moved label to new file
* Added question label
* Added participants
* Added sorting for taxonomy
* Added sorting of questions
* Added moderation page
* Added dashboard 