# Discussion Board

check it out at http://discussion.kylecheung.ca/

## Description

Discussion board implemented using PHP and MYSQL to manage content. Features user authentication with hashed passwords and self expiring sessions for security. Discussion threads store meta data such as last post date, last user to post, post creator. User posts are also counted allowing users to easily see their total post count.

## Technology Used

* `PHP` 
* `MYSQL` 
* `HTML` 
* `CSS` 
* `Linux`

## Lessons Learned

The hardest thing about working with php by far was trying to get headers and links working and redirecting properly. We included our headers in php to avoid having to rewrite code, so we couldn't use relative referencing since a link to the discussions page from the homepage would not be the same from the profile section. Instead we used absolute positioning. However, because we are working on multiple projects. We also need to include the parent folder in the reference since htdocs is the actually root directory. Our links ended up looking something like this:

`href=/http-5202-movietracker/views/authentication/login.php`

This worked pretty well for development. But when it was time to deploy this wouldn't work since `\http-5202-movietracker` would now be the root directory once hosted. I fixed this by adding a .htaccess file that set an environment variable for the root and using that in our links like so

`href="<?= $root ?>/views/authentication/profile.php?user_id=<?= $t->last_post_user_id; ?>"`
